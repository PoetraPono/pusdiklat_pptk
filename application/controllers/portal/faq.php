<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/faq_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('portal/faq/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
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
						'FAQ_QUESTION'	=> isset($post['FAQ_QUESTION'])?$post['FAQ_QUESTION']:'',
						'FAQ_ANSWER'	=> isset($post['FAQ_ANSWER'])?$post['FAQ_ANSWER']:'',
						'FAQ_FILE_PATH'	=> $attach_path,
						'FAQ_IMAGE_PATH' => $imgpath,
						'FAQ_STATUS'	=> 1
				);
	
				$insDb = $this->faq_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/faq');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/faq');
				}

			} else {
				$data = array();
				$this->template->display('portal/faq/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($silId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
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
				$dataupd = array(

						'FAQ_QUESTION' 				=> isset($post['FAQ_QUESTION'])?$post['FAQ_QUESTION']:'',
						'FAQ_ANSWER' 		=> isset($post['FAQ_ANSWER'])?$post['FAQ_ANSWER']:'',
					);
				if($ifUpload == 1){
					$dataupd['FAQ_FILE_PATH'] = $attachpath;
				}
				if($ifUpload2 == 1){
					$dataupd['FAQ_IMAGE_PATH'] = $imgpath;
				}
				// echo "<pre>";
				// print_r($dataupd);die();
				$insDb = $this->faq_model->update($dataupd,$silId);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/faq/');
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
				$data['modul'] = $this->faq_model->getDetail($silId)->row_array();
				$this->template->display('portal/faq/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["modul"] =  $this->faq_model->getDetail($id)->row_array();
			$this->template->display('portal/faq/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "FAQ_ID";
		$limit = 10;

		$order_field 	= array(
			'FAQ_ID',
			'FAQ_QUESTION',			
		);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->faq_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->faq_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->faq_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["FAQ_QUESTION"],
				'<a href="'.base_url().'portal/faq/detail/'.$row["FAQ_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'portal/faq/update/'.$row["FAQ_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a data-status="0" data-link="portal/faq/delete/'.$row["FAQ_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "FAQ_ID";
		$limit = 10;

		$order_field 	= array(
			'FAQ_ID',
			'FAQ_QUESTION',
		);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->faq_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->faq_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->faq_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
//				$row["employee_fullname"],
				$row["FAQ_QUESTION"],
				'<a href="'.base_url().'portal/faq/detail/'.$row["FAQ_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="1" data-link="portal/faq/aktif/'.$row["FAQ_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->faq_model->delete($id);
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

				redirect(base_url().'portal/faq');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->faq_model->aktif($id);
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


				redirect(base_url().'portal/faq');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}