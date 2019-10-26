<?php
class Other {

	protected $_ci;

	function __construct(){
		$this->_ci = &get_instance();
	}

	public function GetLogCode(){
		$LogId = '';
		$InitialCode = date('Y', time()).str_pad(date('m', time()), 2, "0", STR_PAD_LEFT).str_pad(date('d', time()), 2, "0", STR_PAD_LEFT);
		$NextNumber = 1;

		$GetLast = $this->_ci->db->query("SELECT MAX(log_code) AS CODE FROM sys_logs WHERE log_code LIKE '".$InitialCode."%'")->row_array();
		if($GetLast['CODE']>0) {
			$LogId = $InitialCode.str_pad((intval(substr($GetLast['CODE'], 8, 8))+1), 8, "0", STR_PAD_LEFT);
		} else {
			$LogId = $InitialCode.str_pad($NextNumber, 8, "0", STR_PAD_LEFT);
		}
		return $LogId;
	}

	public function GetSequence($_table){
		$GetLast = $this->_ci->db->query("SELECT SEQ_".$_table.".NEXTVAL as NEXTNUM FROM DUAL")->row_array();
		return $GetLast['NEXTNUM'];
	}

	public function InsertLog($code, $objek, $action, $menuId, $tableName)
	{
		$this->_ci->db->set('log_code', $code);
		$this->_ci->db->set('log_user_id', $this->_ci->session->userdata('user_id'));
		$this->_ci->db->set('log_menu_id', $menuId);
		$this->_ci->db->set('log_action', $action);
		$this->_ci->db->set('log_object', $objek);
		$this->_ci->db->set('log_date', date('Y-m-d H:i:s', time()));
		$this->_ci->db->insert('sys_logs');
	}
	public function InsertHistories($history_table_name, $history_table_id, $history_table_status, $history_table_action, $history_table_reason=null)
	{
		$this->_ci->db->set('history_user_id', $this->_ci->session->userdata('user_id'));
		$this->_ci->db->set('history_table_name', $history_table_name);
		$this->_ci->db->set('history_table_id', $history_table_id);
		$this->_ci->db->set('history_table_status', $history_table_status);
		$this->_ci->db->set('history_table_action', $history_table_action);
		$this->_ci->db->set('history_table_reason', $history_table_reason);
		$this->_ci->db->set('history_date', date('Y-m-d H:i:s', time()));
		$this->_ci->db->insert('sys_histories');
	}
	public function InsertNotif($notify) {
		$this->_ci->db->set('notif_date', date('Y-m-d H:i:s', time()));
		return $this->_ci->db->insert('sys_notif', $notify);
	}
	public function RemoveNotif($notif_category,$notif_data_id) {
		$notify = array('notif_is_count' => 0);
		$this->_ci->db->where('notif_category', $notif_category);
		$this->_ci->db->where('notif_data_id', $notif_data_id);
		return $this->_ci->db->update('sys_notif', $notify);

	}
	public function RemoveNotifPerson($notif_category = "",$notif_data_id = 0,$notif_user_id = 0) {
		return $this->_ci->db->query("UPDATE sys_notif SET notif_is_count = 0 WHERE notif_category = '".$notif_category."' AND notif_data_id = '".$notif_data_id."' AND notif_user_id = '".$notif_user_id."'");		

	}
	public function GetUserNotif($grup="", $menu_id = 0, $target_name="") {
		$query="";
		if($grup=="RE"){
			$query = "SELECT user_id,employee_email,employee_fullname FROM master_employees INNER JOIN sys_users ON user_employee_id = employee_id WHERE employee_is_redaktur = 1 AND user_status = 1";
		}elseif($grup=="PR"){
			$query = "SELECT aa.user_id,bb.employee_email,bb.employee_fullname FROM sys_users aa INNER JOIN master_employees bb ON aa.user_employee_id = bb.employee_id WHERE aa.user_access_id IN(SELECT a.access_detail_access_id FROM sys_access_details AS a WHERE a.access_detail_can_approve = 1 AND a.access_detail_status = 1 AND a.access_detail_menu_id = ".$menu_id." ) AND aa.user_status = 1";
		}
		return $this->_ci->db->query($query);
	}
	public function getSettingValue($settingCode, $settingType){
		$result = $this->_ci->db->select('SETTING_VALUE')->where('SETTING_CODE', $settingCode)->where('SETTING_TYPE', $settingType)->get('SYS_SETTINGS')->result_array();
		foreach ($result as $value) {
			return $value['SETTING_VALUE'];
		}
	}
	public function sendapprovationmail($id=0, $mail){
		$this->_ci->db->select('A.*, B.PROGRAM_NAME, B.PROGRAM_START, B.PROGRAM_END, C.INSTANSI_NAME, C.INSTANSI_ADDRESS');
		$this->_ci->db->where('A.PROPAR_ID', $id);
		$this->_ci->db->where('A.PROPAR_STATUS', 1);
		$this->_ci->db->where('A.PROPAR_MAILSENT', null);
		// $this->_ci->db->join('dbo.T_PROGRAM B', 'A.PROPAR_PROGRAM_ID = B.PROGRAM_ID', 'LEFT');
		// $this->_ci->db->join('dbo.T_REF_INSTANSI C', 'A.MEMBER_INSTANSI_ID = C.INSTANSI_ID', 'LEFT');
		$this->_ci->db->join('T_PROGRAM B', 'A.PROPAR_PROGRAM_ID = B.PROGRAM_ID', 'LEFT');
		$this->_ci->db->join('T_REF_INSTANSI C', 'A.MEMBER_INSTANSI_ID = C.INSTANSI_ID', 'LEFT');
		// $datas = $this->_ci->db->get('dbo.V_PROGRAM_PARTICIPANT A')->row_array();
		$datas = $this->_ci->db->get('V_PROGRAM_PARTICIPANT A')->row_array();
		// $datas = $this->_ci->db->get('dbo.V_PROGRAM_PARTICIPANT A')->row_array();

		// echo json_encode($datas);die;

		if($datas){
			$mail->IsSMTP();
			$mail->SMTPDebug = 0; //debugging: 1 = errors and messages, 2 = messages only
			$mail->Host = "smtp.ppatk.go.id";
			$mail->Port = 25;
			$mail->Username = "john.swatrahadi@ppatk.go.id";
			$mail->Password = "p3rmana";
			$mail->SMTPAuth = false;
			$mail->SMTPSecure = false;
			$mail->SMTPAutoTLS = false;
			$mail->CharSet =  "utf-8";
			$mail->setFrom('pusdiklat-apuppt@ppatk.go.id', 'Pusdiklat APU-PPT');

			/*$mail->IsSMTP();
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "emailtestprograms@gmail.com";
			$mail->Password = "qwe123890iop";
			$mail->setFrom('emailtestprograms@gmail.com', 'Pusdiklat APU-PPT');*/
			$mail->Subject = 'Pemberitahuan hasil seleksi program Pusdiklat APU-PPT!';

			$mail->addAddress($datas['MEMBER_EMAIL'], $datas['MEMBER_NAME']);
			$mail->Body = "
					<p>Kepada Yth. <b>".$datas['MEMBER_NAME']."</b>,</p>
					<p style='text-align: justify;'>Diberitahukan bahwa peserta dengan keterangan:</p> 
					<table>
						<tr>
							<td>Nama Peserta</td>
							<td>:</td>
							<td><b>".$datas['MEMBER_NAME']."</b></td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>:</td>
							<td><b>".$datas['MEMBER_NIP']."</b></td>
						</tr>
						<tr>
							<td>NIK</td>
							<td>:</td>
							<td><b>".$datas['MEMBER_NIK']."</b></td>
						</tr>
						<tr>
							<td>Nama Instansi</td>
							<td>:</td>
							<td><b>".$datas['INSTANSI_NAME']."</b></td>
						</tr>
						<tr>
							<td>Alamat Instansi</td>
							<td>:</td>
							<td><b>".$datas['INSTANSI_ADDRESS']."</b></td>
						</tr>
					</table>
					<p>Bahwa anda telah <b>LULUS</b> seleksi dalam program ".$datas['PROGRAM_NAME']." Pusdiklat APU-PPT. Diwajibkan untuk membawa persyaratan dan dokumen yang telah anda upload pada saat pendaftaran seleksi pelatihan.</p>
					<br><br><br>
					<span>--</span><br>
					<span>Pusdiklat APU-PPT,</span><br>
					<span><b>Sistem Email Otomatis Pusdiklat APU-PPT</b></span><br><br>
					<span style='color:gray'><i>- Do Not Reply -</i></span>
				";
				$mail->IsHTML(true);
			/*
				Selamat anda telah lolos seleksi dalam program Pelatihan Pencegahan Korupsi
			*/
			// echo "Pengiriman email berhasil!";
			
			$this->_ci->db->where('PROPAR_ID', $id);
			$this->_ci->db->where('PROPAR_STATUS', 1);
			$this->_ci->db->set('PROPAR_MAILSENT', 1);
			// $datas = $this->_ci->db->update('dbo.T_PROGRAM_PARTICIPANT');
			$datas = $this->_ci->db->update('T_PROGRAM_PARTICIPANT');
		
			if (!$mail->send()) {
				return "Mailer Error: " . $mail->ErrorInfo . "\nHubugi kami apabila email belum anda terima";
			} else {
				$mail->ClearAllRecipients();
				return "mailsent";
			}
		}
	}
	public function getUserName($name){

		$hasstring = substr($name, 0, strpos($name, ' '));
		$string = ($hasstring != "") ? $hasstring : $name;
		$characters = '0123456789';
	    $randstring = '';
	    for ($i = 0; $i < 4; $i++) {
	        $randstring .= $characters[rand(0, (strlen($characters)-1))];
	    }
	    $username = strtolower($string).$randstring;
	    $hasil = $this->cekUserName($username);
	    if($hasil > 0){
	    	$this->getUserName($name);
	    }else{
	    	return $username;
	    }
	}

	public function cekUserName($username)
	{
		// $res = $this->_ci->db->query("SELECT COUNT(1) as JML FROM T_REF_MEMBER WHERE MEMBER_USERNAME = '".$username."'")->row_array();
		$res = $this->_ci->db->query("SELECT 1 as JML FROM T_REF_MEMBER WHERE MEMBER_USERNAME = '".$username."'")->row_array();
		return $res['JML'];
	}
}