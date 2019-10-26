<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/absensi_model');
		$this->load->model('diklat/diklat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		// $testString = "qwertyuiopasdfghjklzxcvbnm,./?QWERTYUIOPASDFGHJKLZXCVBNM~!@#$%^&*()_+`1234567890-=[]{};:'<>?";
	 //    echo xss_remover($testString);die;
	    // echo preg_replace("/[^A-Za-z0-9_,.\/!@#$%&*()\-+?]/", "", $testString);
    	// preg_match('/[^A-Za-z0-9_]/', $callback
		// die;
		$this->template->display('diklat/absensi/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datacreate = array(
						'MEMBER_NAME' 			=> isset($post['MEMBER_NAME'])?$post['MEMBER_NAME']:'',
						'MEMBER_USERNAME'		=> isset($post['MEMBER_USERNAME'])?$post['MEMBER_USERNAME']:'',
						'MEMBER_PASSWORD'		=> isset($post['MEMBER_PASSWORD'])?$post['MEMBER_PASSWORD']:'',
						'MEMBER_NIK'			=> isset($post['MEMBER_NIK'])?$post['MEMBER_NIK']:'',
						'MEMBER_EMAIL'			=> isset($post['MEMBER_EMAIL'])?$post['MEMBER_EMAIL']:'',
						'MEMBER_PHONE'			=> isset($post['MEMBER_PHONE'])?$post['MEMBER_PHONE']:'',	
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

					redirect(base_url().'diklat/absensi/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/settingroom');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$this->template->display('diklat/absensi/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($pubId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				
				//$content = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $content);
				$dataupd = array(

						'MEMBER_NAME' 			=> isset($post['MEMBER_NAME'])?$post['MEMBER_NAME']:'',
						'MEMBER_USERNAME'		=> isset($post['MEMBER_USERNAME'])?$post['MEMBER_USERNAME']:'',
						'MEMBER_PASSWORD'		=> isset($post['MEMBER_PASSWORD'])?$post['MEMBER_PASSWORD']:'',
						'MEMBER_NIK'			=> isset($post['MEMBER_NIK'])?$post['MEMBER_NIK']:'',
						'MEMBER_EMAIL'			=> isset($post['MEMBER_EMAIL'])?$post['MEMBER_EMAIL']:'',
						'MEMBER_PHONE'			=> isset($post['MEMBER_PHONE'])?$post['MEMBER_PHONE']:'',
				);
				/*echo "<pre>";
				print_r($dataupd); 
				die();*/

				$insDb = $this->peserta_model->update($dataupd,$pubId);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/absensi/detail/'.$pubId);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/settingroom');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$data['peserta'] = $this->peserta_model->getDetail($pubId)->row_array();
				
				$this->template->display('diklat/absensi/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function listabsensi($id=0){
		if($this->access->permission('read')){
			 $data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
                $data['absen'] = $this->absensi_model->getAbsen($id)->row_array();
                
                $begin = new DateTime($data['diklat']['PROGRAM_START']);
				$end = new DateTime($data['diklat']['PROGRAM_END']);
				$listdate = array();
				$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
				$n=0;
				foreach($daterange as $date){
				    $listdate[$n]['date'] = $date->format("Y-m-d");
					$n++;
				}
				
				$listdate[$n]['date'] = $data['diklat']['PROGRAM_END'];
 				$i = 0;
 				foreach ($listdate as $val) {
 					
 					// echo $val['date']; die;
 					$prosen = $this->absensi_model->getlist_Absen($id,$val['date'])->result_array();
 					//print_r($prosen);die;
                 	$listdate[$i]['prosen'] = $prosen;
                 	$i++;
                }
				$data['listdate'] = $listdate;
			$this->template->display('diklat/absensi/listabsensi', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "PROGRAM_NAME";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'PROGRAM_START',
			'PROGRAM_END',
			'PROGRAM_TOTAL_KUOTA'
			);
		// $testString = "12.322,11T";
  //   echo preg_replace("/[^0-9,.]/", "", $testString);
  //   preg_match('/[^A-Za-z0-9_]/', $callback
		
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->diklat_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->diklat_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->diklat_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();	
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$adadata = $row["PROGRAM_ABSEN_FILE_PATH"]!=""?'':'disabled="true"';
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				'<a '.$adadata.' href="'.base_url().$row["PROGRAM_ABSEN_FILE_PATH"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat Absensi" data-placement="top" style="padding:2px 5px" target="_blank">Download Absen <i class="icon-file6"></i></a>',
				'',
				'<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>',
				//'<a href="'.base_url().'diklat/absensi/listabsensi/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat Absensi" data-placement="top"><i class="icon-file6"></i></a>
				'<a href="'.base_url().'diklat/absensi/absenpdf/'.$row["PROGRAM_ID"].'" target="_blank" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download Format Absensi" data-placement="top"><i class="icon-download2"></i></a>
				<a href="javascript:void(0);" class="btn btn-xs btn-default btn-icon tip" data-original-title="Upload Hasil Absensi" data-placement="top" onclick="uploadabsen('.$row["PROGRAM_ID"].')"><i class="icon-upload2"></i></a>'
				);
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function absenpdf($id = 0){
		$this->load->library('pdf');

		$diklat = $this->diklat_model->getDetail($id)->row_array();
		$group = $this->absensi_model->getclassParticipant($id)->result_array();
		
		// echo json_encode($propar);die;
		$begin = new DateTime($diklat['PROGRAM_START']);
		$end = new DateTime($diklat['PROGRAM_END']);
		$listdate = array();
		$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
		
		foreach($daterange as $date){
		    array_push($listdate, $date->format("Y-m-d"));
		}
		array_push($listdate, $diklat['PROGRAM_END']);
		$htmldate = "";
		$htmldatebody = "";
		foreach ($listdate as $key => $value) {
			$htmldate .= '<th style="border: 1px solid black;padding:5px;text-align:center">'.dateEnToId($value, 'd M').'</th>';
			$htmldatebody .= '<td style="height:60px; border: 1px solid black;padding:5px;"></td>';
		}
		// echo json_encode($listdate);die;
    	if($diklat['PROGRAM_START']!="" and $diklat['PROGRAM_END']!=""){
    		if($diklat['PROGRAM_START']==$diklat['PROGRAM_END']){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");
    		}elseif($diklat['PROGRAM_START']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_END'], "d F Y");    			
    		}elseif($diklat['PROGRAM_END']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");    			
    		}else{
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y"). " s.d " .dateEnToId($diklat['PROGRAM_END'], "d F Y");
    		}
    	}

    	foreach ($group as $k => $g) {
    		$propar = $this->absensi_model->getlistParticipant($id,$g['PROPAR_CLASS'])->result_array();
    		$htmlpdf = '';
	    	$htmlpdf .= '<h4 style="text-transform: uppercase;text-align:center">DAFTAR HADIR</h4>';
	    	$htmlpdf .= '<h4 style="text-align:center; padding:0px;">'. (($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-") .'</h4>';
	    	$htmlpdf .= '<h4 style="text-align:center">Gedung Pusdiklat Cimanggis</h4>';
	    	$htmlpdf .= '<table style="border-top: 1px solid black; border-bottom: 1px solid black;width:100%;font-size:12px">
	    					<tbody>
	    						<tr>
	    							<td valign="top" width="25%">Nama Program</td>
	    							<td valign="top" width="2%">:</td>
	    							<td valign="top">'. (($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-") .'</td>
	    						</tr>
	    						<tr>
	    							<td valign="top">Deskripsi Program</td>
	    							<td valign="top">:</td>
	    							<td valign="top">'. (($diklat['PROGRAM_DESCRIPTION']!="")?$diklat['PROGRAM_DESCRIPTION']:"-") .'</td>
	    						</tr>
	    						<tr>
	    							<td valign="top">Tanggal Pelatihan</td>
	    							<td valign="top">:</td>
	    							<td valign="top">'. $tgl_pelatihan .'</td>
	    						</tr>';
			if(count($group) != 1){
				$htmlpdf .= '<tr>
    							<td valign="top">Kelas</td>
    							<td valign="top">:</td>
    							<td valign="top">'. $g['PROPAR_CLASS'] .'</td>
    						</tr>';
			}
	    	$htmlpdf .= '</tbody>
	    				</table>';
	    	$htmlpdf .= '<br>';
		    $htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%;font-size:10px">
	    					<thead>
	    						<tr>
	    							<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center">#</th>
	    							<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:left">Nama Lengkap</th>
	    							<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:left">Instansi</th>
	    							<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center">Telepon/Ponsel</th>
	    							<th colspan="'.count($listdate).'" style="border: 1px solid black;padding:5px;text-align:center">Paraf</th>
	    						</tr>
	    						<tr>
	    							'.$htmldate.'
	    						</tr>
	    					</thead>';
	    	$htmlpdf .=		'<tbody>';
							if(count($propar)>0){
								$no = 1;
								foreach ($propar as $k => $v) {
			$htmlpdf .=				'<tr>
										<td style="height:60px; border: 1px solid black;padding:5px;text-align:center">'.$no.'</td>
										<td style="height:60px; border: 1px solid black;padding:5px;">'.$v["MEMBER_NAME"].'</td>
										<td style="height:60px; border: 1px solid black;padding:5px;">'.$v["INSTANSI_NAME"].'</td>
										<td style="height:60px; border: 1px solid black;padding:5px;">'.($v["MEMBER_PHONE"]==""?"-":$v["MEMBER_PHONE"]).'</td>
										'.$htmldatebody.'
									</tr>';
									$no+=1;				
								}
							}    	
			$htmlpdf .=		'</tbody>
	    				</table>';    
	    	$headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
	    	$this->pdf->pdf->SetHTMLHeader($headerhtml);
	    	$this->pdf->pdf->AddPage();
	    	$this->pdf->pdf->WriteHTML($htmlpdf, 2);
    	}
    	
    	// echo htmlspecialchars($htmlpdf);die;
    	
       	
    	$this->pdf->pdf->SetTitle('Absensi program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
       	$this->pdf->pdf->Output('Absensi program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

	}
	public function uploadabsen(){
		// echo json_encode($this->input->post());die;
		$config['upload_path'] = './assets/uploads/absensi/';
		$config['allowed_types'] = '*';
		$new_name = "absensi_".$this->input->post('programid').'_'.time();
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$field_name = "fileabsenpath";
		$ifUpload = 0;
		if($this->upload->do_upload('fileabsenpath') && intval($this->input->post('programid'))>0){
			$dataupdload = $this->upload->data();
			$getdetailprogram = $this->absensi_model->getdetailprogram($this->input->post('programid'))->row_array();
			$uploaddoc = $this->absensi_model->uploadabsenfile($this->input->post('programid'), 'assets/uploads/absensi/'.$dataupdload["file_name"]);

			if($uploaddoc){			
				if(isset($getdetailprogram['PROGRAM_ABSEN_FILE_PATH'])){
					@unlink('./'.$getdetailprogram['PROGRAM_ABSEN_FILE_PATH']);
				}
				$notify = array(
						'title' 	=> 'Sukses!',
						'message'	=> 'Upload Dokumen Berhasil!',
						'status' 	=> 'success'
					);
			}else{
				$notify = array(
						'title' 	=> 'Gagal!',
						'message'	=> 'Upload Dokumen Gagal! Silahkan coba lagi',
						'status' 	=> 'error'
					);
			}
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/absensi');
		}else{
			$notify = array(
					'title' 	=> 'Gagal!',
					'message'	=> 'Upload Dokumen Gagal! Silahkan coba lagi',
					'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/absensi');

			// $error = array('error' => $this->upload->display_errors());
			// $attach_path = isset($post['filessss_'])?'assets/uploads/absensi/'.$post['filessss_']:'';
			// print_r($error);
		}
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

				redirect(base_url().'diklat/settingroom');
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


				redirect(base_url().'diklat/settingroom');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}