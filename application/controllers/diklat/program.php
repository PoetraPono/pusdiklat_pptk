<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/absensi_model');
		$this->load->model('diklat/diklat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/program/index', $data);
	}

	public function listdataaktif(){

		$status="";
		$default_order = "PROGRAM_ID";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'SECTOR_NAME',
			'PROGRAM_START',
			'PROGRAM_END',
			'PROGRAM_TOTAL_KUOTA'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->diklat_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->diklat_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->diklat_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();	
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				$row["PROGRAM_TOTAL_KUOTA"],
				'<a href="'.base_url().'diklat/program/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'diklat/program/requisite/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Setting Persyaratan" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'diklat/program/modul/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Setting Materi & Pengajar" data-placement="top"><i class="icon-profile"></i></a>
				<a href="'.base_url().'diklat/program/seleksi/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Seleksi Peserta" data-placement="top"><i class="icon-users"></i></a>
				<a href="'.base_url().'diklat/program/pesertapdf/'.$row["PROGRAM_ID"].'" target="_blank" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download Daftar Peserta" data-placement="top"><i class="icon-download2"></i></a>
				<a data-status="0" data-link="diklat/program/delete/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	

	public function listdatanonaktif(){
		$default_order = "PROGRAM_NAME";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'SECTOR_NAME',
			'PROGRAM_START',
			'PROGRAM_END',
			'PROGRAM_TOTAL_KUOTA'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->diklat_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->diklat_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->diklat_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				$row["PROGRAM_TOTAL_KUOTA"],
				'<a href="'.base_url().'diklat/program/detail/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="1" data-link="diklat/program/aktif/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				//echo "<pre>"; print_r($post); //die;
				$config['upload_path'] = './assets/images/diklat/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = time()."_01";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				if($this->upload->do_upload('gambar_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "assets/images/diklat/" . $dataupdload["file_name"];
				}else{
					//$imgpath = $this->upload->display_errors();
				}

				$config2['upload_path'] = './assets/images/diklat/';
				$config2['allowed_types'] = 'pdf|doc|docx';
				$new_name2 = time()."_02";
				$config2['file_name'] = $new_name2;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				$field_name = "attach_path";
				$ifUpload = 0;
				$ext = "";
				$attach_path="";
				if($this->upload->do_upload('attach_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$attach_path = "assets/images/diklat/" . $dataupdload["file_name"];
					
				}else{
					//$attach_path = $this->upload->display_errors();
				}
				
				$datacreate = array(
						'PROGRAM_SECTOR_ID' 			=> isset($post['PROGRAM_SECTOR_ID'])?xss_remover($post['PROGRAM_SECTOR_ID']):'',
						//'PROGRAM_SASARAN_ID' 			=> isset($post['PROGRAM_SASARAN_ID'])?xss_remover($post['PROGRAM_SASARAN_ID']):'',
						'PROGRAM_SASARAN' 			=> isset($post['PROGRAM_SASARAN'])?xss_remover($post['PROGRAM_SASARAN']):'',
						'PROGRAM_TYPE' 					=> isset($post['PROGRAM_TYPE'])?xss_remover($post['PROGRAM_TYPE']):'',
						'PROGRAM_NAME'					=> isset($post['PROGRAM_NAME'])?xss_remover($post['PROGRAM_NAME']):'',
						'PROGRAM_DESCRIPTION'			=> isset($post['PROGRAM_DESCRIPTION'])?xss_remover($post['PROGRAM_DESCRIPTION']):'',
						'PROGRAM_TOTAL_HOURS' 			=> isset($post['PROGRAM_TOTAL_HOURS'])?xss_remover($post['PROGRAM_TOTAL_HOURS']):'',
						'PROGRAM_TOTAL_LESSON' 			=> isset($post['PROGRAM_TOTAL_LESSON'])?xss_remover($post['PROGRAM_TOTAL_LESSON']):'',
						'PROGRAM_TOTAL_KUOTA' 			=> isset($post['PROGRAM_TOTAL_KUOTA'])?xss_remover($post['PROGRAM_TOTAL_KUOTA']):'',
						'PROGRAM_RQUISITE'				=> isset($post['PROGRAM_RQUISITE'])?xss_remover($post['PROGRAM_RQUISITE']):'',
						'PROGRAM_START' 				=> date("Y-m-d",strtotime(xss_remover($post['PROGRAM_START']))),
						'PROGRAM_END' 					=> date("Y-m-d",strtotime(xss_remover($post['PROGRAM_END']))),
						'PROGRAM_ATTACHMENT_PATH' 		=> $attach_path,
						'PROGRAM_IMAGE_PATH' 			=> $imgpath,
						'PROGRAM_CREATE_BY' 			=> $this->session->userdata('user_id'),
						'PROGRAM_CREATE_DATE' 			=> date('Y-m-d H:i:s'),
						'PROGRAM_STATUS' 				=> 1
				);
				/*echo '<pre>';
				print_r($datacreate);die();*/
				$insDb = $this->diklat_model->add($datacreate);
				if ($insDb > 0) {
					$notify = array(
								'title' 	=> 'Berhasil!',
								'message' 	=> 'Penambahan data Berhasil',
								'status' 	=> 'success'
							);
						$this->session->set_flashdata('notify', $notify);
						redirect(base_url().'diklat/program');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/program');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				
				$data['bidang']= $this->diklat_model->getListSector()->result_array();
				$data['sasaran']= $this->diklat_model->getListSasaran()->result_array();
				$this->template->display('diklat/program/create', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id){
		if($this->access->permission('update')){	
			if($post = $this->input->post()){
				//print_r($_FILES);
				$config['upload_path'] = './assets/images/diklat/';
				$config['allowed_types'] = 'docx|doc|pdf';
				$new_name = time()."_01";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$attachpath="";
				//echo "<pre>"; print_r($config); die;
				if($this->upload->do_upload('file_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$attachpath = "assets/images/diklat/" . $dataupdload["file_name"];
				}else{
					$error = array('error' => $this->upload->display_errors());
					//print_r($error);
				}

				$config2['upload_path'] = './assets/images/diklat/';
				$config2['allowed_types'] = 'gif|jpg|png';
				$new_name2 = time()."_02";
				$config2['file_name'] = $new_name2;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				$field_name = "gambar_path";
				$ifUpload2 = 0;
				$ext = "";
				$imgpath="";
				if($this->upload->do_upload('gambar_path'))
				{
					//echo "KADIEU"; 
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload2 = 1;
					$imgpath = "assets/images/diklat/" . $dataupdload["file_name"];
				}else{
					$error = array('error' => $this->upload->display_errors());
				}
				$dataupdate = array(
						'PROGRAM_SECTOR_ID' 			=> isset($post['PROGRAM_SECTOR_ID'])?xss_remover($post['PROGRAM_SECTOR_ID']):'',
						//'PROGRAM_SASARAN_ID' 			=> isset($post['PROGRAM_SASARAN_ID'])?xss_remover($post['PROGRAM_SASARAN_ID']):'',
						'PROGRAM_SASARAN' 			=> isset($post['PROGRAM_SASARAN'])?xss_remover($post['PROGRAM_SASARAN']):'',
						'PROGRAM_TYPE' 					=> isset($post['PROGRAM_TYPE'])?xss_remover($post['PROGRAM_TYPE']):'',
						'PROGRAM_NAME'					=> isset($post['PROGRAM_NAME'])?xss_remover($post['PROGRAM_NAME']):'',
						'PROGRAM_DESCRIPTION'			=> isset($post['PROGRAM_DESCRIPTION'])?xss_remover($post['PROGRAM_DESCRIPTION']):'',
						'PROGRAM_TOTAL_HOURS' 			=> isset($post['PROGRAM_TOTAL_HOURS'])?xss_remover($post['PROGRAM_TOTAL_HOURS']):'',
						'PROGRAM_TOTAL_LESSON' 			=> isset($post['PROGRAM_TOTAL_LESSON'])?xss_remover($post['PROGRAM_TOTAL_LESSON']):'',
						'PROGRAM_TOTAL_KUOTA' 			=> isset($post['PROGRAM_TOTAL_KUOTA'])?xss_remover($post['PROGRAM_TOTAL_KUOTA']):'',
						'PROGRAM_RQUISITE'				=> isset($post['PROGRAM_RQUISITE'])?xss_remover($post['PROGRAM_RQUISITE']):'',
						//'PROGRAM_IMAGE_PATH'			=> isset($post['PROGRAM_RQUISITE'])?xss_remover($post['PROGRAM_RQUISITE']):'',
						'PROGRAM_START' 				=> date("Y-m-d",strtotime(xss_remover($post['PROGRAM_START']))),
						'PROGRAM_END' 					=> date("Y-m-d",strtotime(xss_remover($post['PROGRAM_END'])))
						
				);
				if($ifUpload == 1){
					$dataupdate['PROGRAM_ATTACHMENT_PATH'] = $attachpath;
				}
				if($ifUpload2 == 1){
					$dataupdate['PROGRAM_IMAGE_PATH'] = $imgpath;
				}
				//echo '<pre>'; print_r($dataupdate); die();
				$insDb = $this->diklat_model->update($dataupdate, $id);
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Ubah  data Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();			
				$data['bidang']= $this->diklat_model->getListSector()->result_array();
				$data['sasaran']= $this->diklat_model->getListSasaran()->result_array();
				$this->template->display('diklat/program/update', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
			$data['katering']= $this->diklat_model->getkatering($id)->row_array();
			// echo json_encode($data['katering']);die;
			// $data['materi'] = $this->diklat_model->getMateri($id)->row_array();
			$this->template->display('diklat/program/detail', $data);
		}
	}

	public function requisite($id){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				/*echo "<pre>";
				print_r($post); 
				die;*/
				$requisite_name = $post['requisite_name'];
				$requisite_type = $post['requisite_type'];
				$requisite_id = $post['requisite_id'];
				$this->diklat_model->deleteRequisite($post['PROGRAM_ID']);
				for ($i=0; $i < count($requisite_id); $i++) { 
					if($requisite_id[$i] != 0){
						$dataupdate = array(
							//'PROREQ_PROGRAM_ID' => $post['PROGRAM_ID'],
							'PROREQ_DESC' => $requisite_name[$i],
							'PROREQ_TYPE' => $requisite_type[$i],
							'PROREQ_STATUS' => 1
						);
						$this->diklat_model->updateRequisite($dataupdate,$requisite_id[$i]);
					}else{
						$datainsert = array(
							'PROREQ_PROGRAM_ID' => $post['PROGRAM_ID'],
							'PROREQ_DESC' => $requisite_name[$i],
							'PROREQ_TYPE' => $requisite_type[$i],
							'PROREQ_STATUS' => 1
						);
						$this->diklat_model->addRequisite($datainsert);
					}
				}
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Simpan data Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			} else {
				$data = array();
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
				$data['requisite'] = $this->diklat_model->getListRequisite($id)->result_array();
				//$data['bidang']= $this->diklat_model->getListSector()->result_array();
				$this->template->display('diklat/program/requisite', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}
	
	public function modul($id){
		if($this->access->permission('create') && (intval($id)>0)){	
			if($post = $this->input->post()){
				
				$PROGRAM_ID = $post['PROGRAM_ID'];
				$materi_id = $post['materi_id'];
				$materi_modul_id = $post['materi_modul_id'];
				$materi_instructor_id = $post['materi_instructor_id'];
				//$this->diklat_model->deleteRequisite($post['PROGRAM_ID']);
				for ($i=0; $i < count($materi_id); $i++) { 
					if($materi_id[$i] != 0){
						$dataupdate = array(
							'PROMA_MATERI_ID' => $materi_modul_id[$i],
							'PROMA_INSTRUCTOR_ID' => $materi_instructor_id[$i],
							'PROMA_STATUS' => 1						
						);
						$this->diklat_model->updateProgramMateri($dataupdate,$materi_id[$i]);
					}else{
						$datainsert = array(
							'PROMA_PROGRAM_ID' => $PROGRAM_ID,
							'PROMA_MATERI_ID' => $materi_modul_id[$i],
							'PROMA_INSTRUCTOR_ID' => $materi_instructor_id[$i],
							'PROMA_STATUS' => 1
						);
						$this->diklat_model->addProgramMateri($datainsert);
					}
				}
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Simpan data Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			} else {
				$data = array();
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
				$data['proma'] = $this->diklat_model->getListModulDiklat($id)->result_array();
				$data['modul'] = $this->diklat_model->getListModul()->result_array();
				$data['instructor'] = $this->diklat_model->getListInstructor()->result_array();
				//$data['bidang']= $this->diklat_model->getListSector()->result_array();
				$this->template->display('diklat/program/modul', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}

	public function seleksi($id){
		if($this->access->permission('create') && intval($id)>0){	
			if($post = $this->input->post()){
				//echo "<pre>"; print_r($post); die;
				$PROGRAM_ID = $post['PROGRAM_ID'];
				$dataApproved = $post['dataApproved'];
				//$this->diklat_model->deleteParticipant($post['PROGRAM_ID']);
				require './application/libraries/PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$class = $this->diklat_model->getClass($PROGRAM_ID)->row_array();
				for ($i=0; $i < count($dataApproved); $i++) { 
					$dataupdate = array(
						'PROPAR_APPROVE_BY' => $this->session->userdata('user_id'),						
						'PROPAR_APPROVE_DATE' => date('Y-m-d H:i:s', time()),						
						'PROPAR_CLASS' => $class['CLASS'],						
						'PROPAR_STATUS' => 1						
					);
					$this->diklat_model->approveParticipant($dataupdate,$dataApproved[$i]);
					//print_r($dataupdate); die;
					$this->other->sendapprovationmail($dataApproved[$i], $mail);
				}
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Simpan data Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			} else {
				$data = array();
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
				$req = $this->diklat_model->getListRequisite($id)->result_array();
				$participant = $this->diklat_model->getListParticipant($id)->result_array();
				foreach ($participant as $k => $v) {					
					foreach ($req as $r => $vr) {
						$syarat = $this->diklat_model->getRequisite($v['PROPAR_ID'],$vr['PROREQ_ID'])->row_array();
						//echo "<pre>"; print_r($syarat); die;
						$participant[$k]['MEMBER_REQUISITE'][$vr['PROREQ_ID']]['status'] = (count($syarat)>0 ? $syarat['PROATT_STATUS'] : 0);
						$participant[$k]['MEMBER_REQUISITE'][$vr['PROREQ_ID']]['file'] = (count($syarat)>0 ? $syarat['PROATT_FILE_PATH'] : "");
					}
				}
				$data['participant'] = $participant;
				$data['requisite'] = $req;
				$data['statusApprove'] = $this->diklat_model->getStatusApproveParticipant($id);
				$data['group'] = $this->absensi_model->getclassParticipant($id)->result_array();
				//echo "<pre>"; print_r($data); die;
				$this->template->display('diklat/program/seleksi', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}

	public function delete($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'PROGRAM_UPDATE_BY' 			=> $this->session->userdata('user_id'),
					'PROGRAM_UPDATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->diklat_model->delete($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Diklat dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/program');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Diklat gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Diklat gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/program');
		}
	}

	public function aktif($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'PROGRAM_UPDATE_BY' 			=> $this->session->userdata('user_id'),
					'PROGRAM_UPDATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->diklat_model->aktif($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Diklat diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/program');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Diklat gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/program');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Diklat gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/program');
		}
	}

	// function json_program($id=''){
	// 		$program	= $this->diklat_model->getlist_program($id)->result_array();
	// 		echo json_encode($program);
	// 	}
	function json_sasaran($id=0){
		$sasaran	= $this->diklat_model->getlist_sasaran($id)->result_array();
		echo json_encode($sasaran);
	}

	public function exceldaftardiklat(){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		$this->load->library('PHPExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()
				->setTitle("Laporan Pelatihan Pegawai")
				->setSubject("Tabel Laporan Pelatihan Pegawai");
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue("A1", "TABEL LAPORAN PENGEMBANGAN PEGAWAI")	
		        ->setCellValue("A3", "Status")	
		        ->setCellValue("A4", "Jenis Aktifitas")	
		        ->setCellValue("A5", "Tahun Pelaksanaan");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Laporan Gap Kompetensi Periode '.$period[0]['PeriodName'].'.xlsx"');
		header('Content-Disposition: attachment;filename="Laporan Pengembangan Pegawai.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	public function kartupeserta($id=0,$memberid=0){
        $program_detail = $this->diklat_model->getDetail($id)->row_array();//echo json_encode($data['program_detail']);die;
        // $user_detail = $this->session->all_userdata();echo json_encode($user_detail);die;
        $member = $this->diklat_model->getMemberId($memberid)->row_array();
        if($program_detail){
            if($member){
                $instansi = $this->diklat_model->getInstansi($member['MEMBER_INSTANSI_ID'])->row_array();

                //echo "<pre>";print_r($member);die;

                $this->load->library('pdf');
                $this->pdf->pdf = new mPDF('c','A6-P','','Helvetica',12,12,15,10,10,10);
                //$this->pdf->pdf = new mPDF('utf-8', array(190,236));
                $memimage = ($member['MEMBER_PHOTO'] != '') ? $member['MEMBER_PHOTO'] : 'assets/images/member/blank.png';
                $html = '';
                $html .= '<h2 style="margin-top:25px;margin-bottom:0;text-align:center; font-size:84px; color:#38322d; font-style: oblique;">PESERTA</h2>';
                $html .= '<h2 style="margin-top:10px;margin-bottom:0;text-align:center; font-size:36px; color:#38322d;">'.$program_detail['PROGRAM_NAME'].'</h2>';
                $html .= '<p style="margin-top:0;margin-bottom:20px;text-align:center; font-size:28px; color:#6b635c;">Depok, '.dateEnToId($program_detail['PROGRAM_START'], "d M Y").($program_detail['PROGRAM_END']!=""?' s/d '.dateEnToId($program_detail['PROGRAM_END'],"d M Y"):'').'</p>';
                $html .= '<p></p>';
                $html .= '<p></p>';
                $html .= '<p></p>';
                $html .= '<p></p>';
                $html .= '<p></p>';
                $html .= '<p style="text-align:center;"><img style="margin-top:-6px;" src="'.$this->config->item('path_web').$memimage.'" width="260" height="354"></img></p>';
                $html .= '<p></p>';
                $html .= '<h2 style="margin-top:10px;margin-bottom:0;text-align:center;font-size:64px; color:#954703;">'.$member["MEMBER_NAME"].'</h2>';
                $html .= '<h2 style="margin-top:10px;margin-bottom:0;text-align:center;font-size:28px; color:#954703;">'.$instansi["INSTANSI_NAME"].'</h2>';
                $this->pdf->pdf->SetWatermarkImage(base_url().'berkas/kartu_peserta.jpg',1);
                $this->pdf->pdf->showWatermarkImage = true;
                $this->pdf->pdf->SetTitle('Kartu Peserta');
                $this->pdf->pdf->WriteHTML($html, 2);
                $this->pdf->pdf->Output('Kartu Peserta '.time(), 'I');
            }else{
                ECHO "MEMBER TIDAK DITEMUKAN!!! PENGUNDUHAN GAGAL.";
            }
        }else{
            echo "PROGRAM TIDAK DITEMUKAN!!! PENGUNDUHAN GAGAL.";
        }

    }

    public function pesertapdf($id = 0){
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
    	if(count($group) > 0){
	    	foreach ($group as $k => $g) {
	    		$propar = $this->absensi_model->getlistParticipant($id,$g['PROPAR_CLASS'])->result_array();
	    		$htmlpdf = '';
		    	$htmlpdf .= '<h4 style="text-transform: uppercase;text-align:center">DAFTAR PESERTA</h4>';
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
		    							<th style="border: 1px solid black;padding:5px;text-align:center">#</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:left">Nama Lengkap</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:left">Instansi</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Telepon/Ponsel</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Email</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Username</th>
		    						</tr>
		    					</thead>';
		    	$htmlpdf .=		'<tbody>';
								if(count($propar)>0){
									$no = 1;
									foreach ($propar as $k => $v) {
				$htmlpdf .=				'<tr>
											<td style="border: 1px solid black;padding:5px;text-align:center">'.$no.'</td>
											<td style="border: 1px solid black;padding:5px;">'.$v["MEMBER_NAME"].'</td>
											<td style="border: 1px solid black;padding:5px;">'.$v["INSTANSI_NAME"].'</td>
											<td style="border: 1px solid black;padding:5px;">'.($v["MEMBER_PHONE"]==""?"-":$v["MEMBER_PHONE"]).'</td>
											<td style="border: 1px solid black;padding:5px;">'.($v["MEMBER_EMAIL"]==""?"-":$v["MEMBER_EMAIL"]).'</td>
											<td style="border: 1px solid black;padding:5px;">'.($v["MEMBER_USERNAME"]==""?"-":$v["MEMBER_USERNAME"]).'</td>
										</tr>';
										$no+=1;				
									}
								}    	
				$htmlpdf .=		'</tbody>
		    				</table>';   
		    	} 
		    }else{
		    	$htmlpdf = '';
		    	$htmlpdf .= '<h4 style="text-transform: uppercase;text-align:center">DAFTAR PESERTA</h4>';
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
		    						$htmlpdf .= '</tbody>
		    				</table>';
		    	$htmlpdf .= '<br>';
			    $htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%;font-size:10px">
		    					<thead>
		    						<tr>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">#</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:left">Nama Lengkap</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:left">Instansi</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Telepon/Ponsel</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Email</th>
		    							<th style="border: 1px solid black;padding:5px;text-align:center">Username</th>
		    						</tr>
		    					</thead>';
		    	$htmlpdf .=		'<tbody>';
				$htmlpdf .=		'<tr>
								<td colspan="6" style="border: 1px solid black;padding:5px;text-align:center">Tidak ada peserta yang lolos seleksi</td>
								</tr>
		    					<tbody></table>';

		    }
	    $headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
    	$this->pdf->pdf->SetHTMLHeader($headerhtml);
    	$this->pdf->pdf->AddPage();
    	$this->pdf->pdf->WriteHTML($htmlpdf, 2);
    	$this->pdf->pdf->SetTitle('Daftar Peserta - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
       	$this->pdf->pdf->Output('Daftar Peserta - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

	}
	/*function sendmailnotif($id=0){
		$this->other->sendapprovationmail($id);
	}*/
}