<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publikasi extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/publikasi_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('portal/publikasi/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/images/publikasi/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = 'news'.time()."_";
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
						/*echo "<pre>";
						print_r($post["new_code"]); 
						die();*/
					$imgpath = "/assets/images/publikasi/".$dataupdload["file_name"];
				}else{
					//exit;
					$error = array('error' => $this->upload->display_errors());
				}

				$config2['upload_path'] = './assets/images/publikasi/';
				$config2['allowed_types'] = 'pdf|doc|docx';
				$new_name2 = 'lampiran'.time();
				$config2['file_name'] = $new_name;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				$field_name = "file_path";
				$ifUpload = 0;
				$ext = "";
				$filepath="";
				if($this->upload->do_upload('file_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
						/*echo "<pre>";
						print_r($post["new_code"]); 
						die();*/
					$filepath = "/assets/images/publikasi/".$dataupdload["file_name"];
				}else{
					//exit;
					$error = array('error' => $this->upload->display_errors());
				}


				// $content = isset($post['new_content'])?$post['new_content']:'';
				//$content = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $content);
				$datacreate = array(
						'PUBLIKASI_TITLE' 			=> isset($post['PUBLIKASI_TITLE'])?$post['PUBLIKASI_TITLE']:'',
						'PUBLIKASI_CONTENT'			=> isset($post['PUBLIKASI_CONTENT'])?$post['PUBLIKASI_CONTENT']:'',
						'PUBLIKASI_TYPE'			=> isset($post['PUBLIKASI_TYPE'])?$post['PUBLIKASI_TYPE']:'',
						'PUBLIKASI_FILE_PATH' 		=> $imgpath,
						'PUBLIKASI_FILE_LAMPIRAN' 		=> $filepath,
						'PUBLIKASI_CREATE_BY' 		=> $this->session->userdata('user_id'),
						'PUBLIKASI_CREATE_DATE' 	=> date('Y-m-d H:i:s'),
						'PUBLIKASI_STATUS' 			=> 1
				);
				// echo "<pre>";
				// print_r($datacreate); 
				// die();

				$insDb = $this->publikasi_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/publikasi/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/publikasi');
				}

			} else {
				$data = array();
				$data['types'] = $this->publikasi_model->getTypes()->result_array();
				$this->template->display('portal/publikasi/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($pubId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$adata = $this->publikasi_model->getDetail($pubId)->row_array();

				$config['upload_path'] = './assets/images/publikasi/';
				$config['allowed_types'] = 'gif|jpg|png|doc|word|pdf';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				$dataupd = array(

						'PUBLIKASI_TITLE' 			=> isset($post['PUBLIKASI_TITLE'])?$post['PUBLIKASI_TITLE']:'',
						'PUBLIKASI_CONTENT'			=> isset($post['PUBLIKASI_CONTENT'])?$post['PUBLIKASI_CONTENT']:'',
						'PUBLIKASI_TYPE'			=> isset($post['PUBLIKASI_TYPE'])?$post['PUBLIKASI_TYPE']:'',
						
				);
				if($this->upload->do_upload('gambar_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					
					$imgpath = "/assets/images/publikasi/" . $dataupdload["file_name"];
					$dataupd = array(

						'PUBLIKASI_TITLE' 			=> isset($post['PUBLIKASI_TITLE'])?$post['PUBLIKASI_TITLE']:'',
						'PUBLIKASI_CONTENT'			=> isset($post['PUBLIKASI_CONTENT'])?$post['PUBLIKASI_CONTENT']:'',
						'PUBLIKASI_TYPE'			=> isset($post['PUBLIKASI_TYPE'])?$post['PUBLIKASI_TYPE']:'',
						'PUBLIKASI_FILE_PATH' 		=> $imgpath!=""?$imgpath:$adata['PUBLIKASI_FILE_PATH'],
				);
				}else{
					//exit;
					$error = array('error' => $this->upload->display_errors());
				}

				$config2['upload_path'] = './assets/images/publikasi/';
				$config2['allowed_types'] = 'pdf|doc|docx';
				$new_name2 = 'lampiran'.time();
				$config2['file_name'] = $new_name;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				$field_name = "file_path";
				$ifUpload = 0;
				$ext = "";
				$filepath="";
				if($this->upload->do_upload('file_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$filepath2 = "/assets/images/publikasi/".$dataupdload["file_name"];
					$dataupd['PUBLIKASI_FILE_LAMPIRAN'] = $filepath2;
				}else{
					$error = array('error' => $this->upload->display_errors());
				}

				$insDb = $this->publikasi_model->update($dataupd,$pubId);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/publikasi/detail/'.$pubId);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/publikasi');
				}

			} else {
				$data = array();
				$data['publikasi'] = $this->publikasi_model->getDetail($pubId)->row_array();
				$data['types'] = $this->publikasi_model->getTypes($pubId)->result_array();
				$this->template->display('portal/publikasi/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->publikasi_model->getDetail($id)->row_array();
			$data["publikasi"] = $user;
			$data['types'] = $this->publikasi_model->getTypes($id)->row_array();
			$this->template->display('portal/publikasi/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "PUBLIKASI_TYPE";
		$limit = 10;

		$order_field 	= array(
			'PUBLIKASI_ID',
			'PUBLIKASI_TITLE',
			//'PUBLIKASI_CONTENT',
			'TYPE_NAME',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->publikasi_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->publikasi_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->publikasi_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PUBLIKASI_TITLE"],
				$row["PUBLIKASI_CONTENT"],
				$row["TYPE_NAME"],
				'<a href="'.base_url().'portal/publikasi/detail/'.$row["PUBLIKASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'portal/publikasi/update/'.$row["PUBLIKASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a data-status="0" data-link="portal/publikasi/delete/'.$row["PUBLIKASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "PUBLIKASI_TYPE";
		$limit = 10;

		$order_field 	= array(
			'PUBLIKASI_ID',
			'PUBLIKASI_TITLE',
			//'PUBLIKASI_CONTENT',
			'TYPE_NAME',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->publikasi_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->publikasi_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->publikasi_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
//				$row["employee_fullname"],
				$row["PUBLIKASI_TITLE"],
				$row["PUBLIKASI_CONTENT"],
				$row["TYPE_NAME"],
				'<a href="'.base_url().'portal/publikasi/detail/'.$row["PUBLIKASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="1" data-link="portal/publikasi/aktif/'.$row["PUBLIKASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->publikasi_model->delete($id);
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

				redirect(base_url().'portal/publikasi');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->publikasi_model->aktif($id);
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


				redirect(base_url().'portal/publikasi');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}