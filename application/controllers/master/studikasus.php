<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studikasus extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/studikasus_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/studikasus/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				
				$config['upload_path'] = './assets/images/studikasus/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|doc|';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "file_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				if($this->upload->do_upload('file_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					
					$imgpath = "assets/images/studikasus/" . $dataupdload["file_name"];
				}else{
				
					$error = array('error' => $this->upload->display_errors());
				}

				$datacreate = array(
						'STUDI_KASUS_NAME' 				=> isset($post['STUDI_KASUS_NAME'])?$post['STUDI_KASUS_NAME']:'',
						'STUDI_KASUS_DESCRIPTION' 		=> isset($post['STUDI_KASUS_DESCRIPTION'])?$post['STUDI_KASUS_DESCRIPTION']:'',
						'STUDI_KASUS_FILE_PATH' 		=> $imgpath,
						'STUDI_KASUS_CREATE_BY' 		=> $this->session->userdata('user_id'),
						'STUDI_KASUS_CREATE_DATE' 		=> date('Y-m-d H:i:s'),
						'STUDI_KASUS_STATUS' 			=> 1
				);
	
				$insDb = $this->studikasus_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'master/studikasus');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/studikasus');
				}

			} else {
				$data = array();
				$this->template->display('master/studikasus/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($silId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$config['upload_path'] = './assets/images/studikasus/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|doc|';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "file_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				$dataupd = array(

						'STUDI_KASUS_NAME' 				=> isset($post['STUDI_KASUS_NAME'])?$post['STUDI_KASUS_NAME']:'',
						'STUDI_KASUS_DESCRIPTION' 		=> isset($post['STUDI_KASUS_DESCRIPTION'])?$post['STUDI_KASUS_DESCRIPTION']:''
						//'STUDI_KASUS_FILE_PATH' 		=> $imgpath,
				);
				if($this->upload->do_upload('file_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
		
					$imgpath = "/assets/images/studikasus/" . $dataupdload["file_name"];
					$dataupd = array(

						'STUDI_KASUS_NAME' 				=> isset($post['STUDI_KASUS_NAME'])?$post['STUDI_KASUS_NAME']:'',
						'STUDI_KASUS_DESCRIPTION' 		=> isset($post['STUDI_KASUS_DESCRIPTION'])?$post['STUDI_KASUS_DESCRIPTION']:'',
						'STUDI_KASUS_FILE_PATH' 		=> $imgpath,
				);
				}else{
				
					$error = array('error' => $this->upload->display_errors());
				}
				/*
				echo "<pre>";
				print_r($dataupd);die();*/
				$insDb = $this->studikasus_model->update($dataupd,$silId);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'master/studikasus');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'duklat/modul');
				}

			} else {
				$data = array();
				$data['modul'] = $this->studikasus_model->getDetail($silId)->row_array();
				$this->template->display('master/studikasus/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["modul"] =  $this->studikasus_model->getDetail($id)->row_array();
			$this->template->display('master/studikasus/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "STUDI_KASUS_NAME";
		$limit = 10;

		$order_field 	= array(
			'STUDI_KASUS_ID',
//			'employee_fullname',
			'STUDI_KASUS_NAME',
			'STUDI_KASUS_DESCRIPTION',
			
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->studikasus_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->studikasus_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->studikasus_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["STUDI_KASUS_NAME"],
				$row["STUDI_KASUS_DESCRIPTION"],
				'<a href="'.base_url().'master/studikasus/detail/'.$row["STUDI_KASUS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/studikasus/update/'.$row["STUDI_KASUS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a data-status="0" data-link="master/studikasus/delete/'.$row["STUDI_KASUS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "STUDI_KASUS_NAME";
		$limit = 10;

		$order_field 	= array(
			'STUDI_KASUS_ID',
//			'employee_fullname',
			'STUDI_KASUS_NAME',
			'STUDI_KASUS_DESCRIPTION',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->studikasus_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->studikasus_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->studikasus_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
//				$row["employee_fullname"],
				$row["STUDI_KASUS_NAME"],
				$row["STUDI_KASUS_DESCRIPTION"],
				'<a href="'.base_url().'master/studikasus/detail/'.$row["STUDI_KASUS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="1" data-link="master/studikasus/aktif/'.$row["STUDI_KASUS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->studikasus_model->delete($id);
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

				redirect(base_url().'master/studikasus');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->studikasus_model->aktif($id);
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


				redirect(base_url().'master/studikasus');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}