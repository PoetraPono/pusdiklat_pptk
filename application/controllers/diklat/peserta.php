<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/peserta_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/peserta/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$datacreate = array(
			
						'MEMBER_NAME' 			=> isset($post['MEMBER_NAME'])?xss_remover($post['MEMBER_NAME']):'',
						'MEMBER_USERNAME'		=> isset($post['MEMBER_USERNAME'])?xss_remover($post['MEMBER_USERNAME']):'',
						'MEMBER_PASSWORD'		=> isset($post['MEMBER_PASSWORD'])?xss_remover($post['MEMBER_PASSWORD']):'',
						'MEMBER_NIK'			=> isset($post['MEMBER_NIK'])?xss_remover($post['MEMBER_NIK']):'',
						'MEMBER_EMAIL'			=> isset($post['MEMBER_EMAIL'])?xss_remover($post['MEMBER_EMAIL']):'',
						'MEMBER_PHONE'			=> isset($post['MEMBER_PHONE'])?xss_remover($post['MEMBER_PHONE']):'',	
						'MEMBER_CREATE_BY' 		=> $this->session->userdata('user_id'),
						'MEMBER_CREATE_DATE' 	=> date('Y-m-d H:i:s'),
						'MEMBER_STATUS' 		=> 1
						
				);
			

				$insDb = $this->peserta_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/peserta/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/peserta');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$this->template->display('diklat/peserta/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($pubId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$idp = isset($post['MEMBER_ID'])?$post['MEMBER_ID']:'';
				$dataupd = array(
                    'MEMBER_NAME'               => isset($post['MEMBER_NAME'])?$post['MEMBER_NAME']:'',
                    'MEMBER_NIK'                => isset($post['MEMBER_NIK'])?$post['MEMBER_NIK']:'',
                    'MEMBER_EMAIL'              => isset($post['MEMBER_EMAIL'])?$post['MEMBER_EMAIL']:'',
                    'MEMBER_PHONE'              => isset($post['MEMBER_PHONE'])?$post['MEMBER_PHONE']:'',
                    'MEMBER_ADDRESS'            => isset($post['MEMBER_ADDRESS'])?$post['MEMBER_ADDRESS']:'',
                    'MEMBER_NIP'                => isset($post['MEMBER_NIP'])?$post['MEMBER_NIP']:'',
                    'MEMBER_GENDER'             => isset($post['MEMBER_GENDER'])?$post['MEMBER_GENDER']:'',
                    'MEMBER_PROV_CODE'          => isset($post['MEMBER_PROV_CODE'])?$post['MEMBER_PROV_CODE']:'',
                    'MEMBER_KAB_CODE'           => isset($post['MEMBER_KAB_CODE'])?$post['MEMBER_KAB_CODE']:'',
                    'MEMBER_INSTANSI_ID'        => isset($post['MEMBER_INSTANSI_ID'])?$post['MEMBER_INSTANSI_ID']:'',
                    'MEMBER_JABATAN_ID'         => isset($post['MEMBER_JABATAN_ID'])?$post['MEMBER_JABATAN_ID']:'',
                    'MEMBER_TEMPAT_LAHIR'       => isset($post['MEMBER_TEMPAT_LAHIR'])?$post['MEMBER_TEMPAT_LAHIR']:'',
                    'MEMBER_TGL_LAHIR'          => isset($post['MEMBER_TGL_LAHIR'])?$post['MEMBER_TGL_LAHIR']:''
                );

				$insDb = $this->peserta_model->update($dataupd,$idp);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/peserta');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/peserta');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$data['peserta'] = $this->peserta_model->getDetail($pubId)->row_array();
				$data['provinsi']       = $this->peserta_model->get_provinces()->result_array();
	            $data['gender']         = $this->peserta_model->getGender()->result_array();
	            $data['instansi']       = $this->peserta_model->getInstansi()->result_array();
	            $data['jabatan']        = $this->peserta_model->getJabatan()->result_array();
	            $data['kabupaten']      = $this->peserta_model->getKabupaten($data['peserta']['MEMBER_PROV_CODE'])->result_array();
	            $data['sector']         = $this->peserta_model->getSector()->result_array();
				//echo "<pre>"; print_r($data); die;
				$this->template->display('diklat/peserta/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["peserta"] =  $this->peserta_model->getDetail($id)->row_array();
			$data["diklat"] =  $this->peserta_model->getListProgramParticipant($id)->result_array();
			$this->template->display('diklat/peserta/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "MEMBER_NAME";
		$limit = 10;

		$order_field 	= array(
			'MEMBER_ID',
			'MEMBER_NAME',
			'MEMBER_NIK',
			'MEMBER_ADDRESS',
			'MEMBER_PHONE',
			'MEMBER_EMAIL',
			'MEMBER_JML_DIKLAT'			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->peserta_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->peserta_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->peserta_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["MEMBER_NAME"],
				$row["MEMBER_USERNAME"],
				$row["MEMBER_NIK"],
				$row["INSTANSI_NAME"],
				$row["MEMBER_ADDRESS"],
				$row["MEMBER_PHONE"],
				$row["MEMBER_EMAIL"],
				$row["MEMBER_JML_DIKLAT"],
				'<a href="'.base_url().'diklat/peserta/detail/'.$row["MEMBER_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'diklat/peserta/update/'.$row["MEMBER_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a> '.
				'<a data-status="0" data-link="diklat/peserta/delete/'.$row["MEMBER_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>'
				);
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "MEMBER_NAME";
		$limit = 10;

		$order_field 	= array(
			'MEMBER_ID',
			'MEMBER_NAME',
			'MEMBER_PHONE',
			'MEMBER_EMAIL',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->peserta_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->peserta_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->peserta_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
//				$row["employee_fullname"],
				$row["MEMBER_NAME"],
				$row["MEMBER_PHONE"],
				$row["MEMBER_EMAIL"],
				'<a href="'.base_url().'diklat/peserta/detail/'.$row["MEMBER_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="1" data-link="diklat/peserta/aktif/'.$row["MEMBER_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->peserta_model->delete($id);
					if($del>0) {
						$res = array(
							'update'	=> $del,
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Data berhasil dihapus',
							'status' 	=> 'success'
						);
					} else {
						$res = array(
							'update'	=> $del,
							'title' 	=> 'Gagal!',
							'message' 	=> 'Data gagal dihapus, coba lagi!',
							'status' 	=> 'error'
						);
					}
				} else {
					$res = array(
							'update'	=> $del,
							'title' 	=> 'Gagal!',
							'message' 	=> 'Data gagal dihapus, coba lagi!',
							'status' 	=> 'error'
						);
				}

				redirect(base_url().'diklat/peserta');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->peserta_model->aktif($id);
				if($act>0){
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Data berhasil diaktifkan',
						'status' 	=> 'success'
					);
				}else{
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Gagal!',
						'message' 	=> 'Data gagal diaktifkan, coba lagi!',
						'status' 	=> 'error'
					);					
				}
			} else {
				$res = array(
					'update'	=> $act,
					'title' 	=> 'Gagal!',
					'message' 	=> 'Data gagal diaktifkan, coba lagi!',
					'status' 	=> 'error'
				);
			}


				redirect(base_url().'diklat/peserta');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}

	public function json_regencies($kode){
        //$kode = $this->input->post('kode');
        $regencies  = $this->peserta_model->getKabupaten($kode)->result_array();
        $content 	= '';
		if(count($regencies)>0){
			foreach ($regencies as $regencie) {
				$content .= '<option value="'.$regencie['KABUPATEN_KODE'].'">'.$regencie['KABUPATEN_NAME'].'</option>';
			}
		}
		echo $content;
        //echo json_encode($regencies);
    }

    public function reset_password($id){
    	$datas = $this->peserta_model->getDetail($id)->row_array();
    	if(count($datas) > 0){
    		$password = $this->generateRandomString(8);
    		$dataupd = array(
                    'MEMBER_PASSWORD' => passwordEncoder($password)
                );
			$insDb = $this->peserta_model->update($dataupd,$id);
	    	require './application/libraries/PHPMailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			
			/*$mail->IsSMTP();
			$mail->SMTPOptions = array(
	           'ssl' => array(
	               'verify_peer' => false,
	               'verify_peer_name' => false,
	               'allow_self_signed' => true
	           )
	       );
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "emailtestprograms@gmail.com";
			$mail->Password = "qwe123890iop";
			$mail->setFrom('emailtestprograms@gmail.com', 'Pusdiklat APU-PPT');*/
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

			$mail->addAddress($datas['MEMBER_EMAIL'], $datas['MEMBER_NAME']);
			$mail->Subject = 'Reset password member website Pusdiklat APU-PPT';

			$mail->Body    = "
				<p>Kepada Yth. <b>".$datas['MEMBER_NAME']."</b>,</p>
				<p style='text-align: justify;'>Kami telah me-reset password akun anda dengan detil dan keterangan sebagai berikut:</p>
				<ul>
					<li>Nama Lengkap: <b>".$datas['MEMBER_NAME']."</b></li>
					<li>Username: <b>".$datas['MEMBER_USERNAME']."</b></li>
					<li>Password: <b>".$password."</b></li>
				</ul>
				<p style='text-align: justify;'>Berikut link untuk melakukan login:</p>
				<p style='text-align: justify;'><a href='".base_url()."profil/auth/login'>".base_url()."profil/auth/login</a></p>
				<p style='text-align: justify;'>Anda juga dapat merubah password anda setelah login pada link di detail akun anda.</p>
				<p style='text-align: justify;'>Terima kasih.</p>
				<br><br><br>
				<span>--</span><br>
				<span>Salam Hangat,</span><br>
				<span><b>Sistem Email Otomatis Pusdiklat APU-PPT</b></span><br><br>
				<span style='color:gray'><i>- Do Not Reply -</i></span>
				";
			$mail->IsHTML(true); 
			if (!$mail->send()) {
				$status = "Mailer Error: " . $mail->ErrorInfo . "\nHubugi kami apabila email belum anda terima";
			} else {
				$status = "ok";
			}
		}else{
			$status = "data tidak ditemukan";
		}
		echo $status;
		//return $status;
    }

    public function change_password($id,$password){
    	$datas = $this->peserta_model->getDetail($id)->row_array();
    	if(count($datas) > 0){
    		//$password = $this->generateRandomString(8);
    		$dataupd = array(
                    'MEMBER_PASSWORD' => passwordEncoder($password)
                );
			$insDb = $this->peserta_model->update($dataupd,$id);
	    	$status = "ok";
		}else{
			$status = "data tidak ditemukan";
		}
		echo $status;
		//return $status;
    }
    public function change_username($id,$username){
    	$datas = $this->peserta_model->getDetail($id)->row_array();
    	if(count($datas) > 0){
    		//$password = $this->generateRandomString(8);
    		$dataupd = array(
                    'MEMBER_USERNAME' => $username
                );
			$insDb = $this->peserta_model->update($dataupd,$id);
	    	$status = "ok";
		}else{
			$status = "data tidak ditemukan";
		}
		echo $status;
		//return $status;
    }
    public function check_username($username){
    	$datas = $this->peserta_model->check_username($username)->result_array();
    	if(count($datas) == 0){
    		$status = "ok";
		}else{
			$status = "Username sudah digunakan!";
		}
		echo $status;
		//return $status;
    }
    function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}