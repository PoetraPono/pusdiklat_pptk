<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajar extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/pengajar_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/pengajar/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$imgpath = "";
				$cvpath  = "";
				$ifUpload = 0;
				$ext = "";

				if(!empty($_FILES['gambar_path']['name'])){

					$config['upload_path'] = './assets/images/diklat/';
					$config['allowed_types'] = 'gif|jpg|png';
					$new_name = time()."_";
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
		
					if($this->upload->do_upload('gambar_path'))
					{
						$gambarPathUpl = $this->upload->data();
						$ext = $gambarPathUpl["file_ext"];
						$ifUpload = 1;
						$imgpath = "assets/images/diklat/" . $gambarPathUpl["file_name"];
						
					}else{

						$error = array('error' => $this->upload->display_errors());
					}
				}

				if(!empty($_FILES['file_path']['name'])){
					$config['upload_path'] = './assets/images/diklat/cv/';
					$config['allowed_types'] = 'pdf|docx|';
					$new_name = time()."_";
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
		
					if($this->upload->do_upload('file_path'))
					{
						$cvPathUpl = $this->upload->data();
						$ext = $cvPathUpl["file_ext"];
						$ifUpload = 1;
						$cvpath = "assets/images/diklat/cv/" . $cvPathUpl["file_name"];
						
					}else{
						$error = array('error' => $this->upload->display_errors());
					}
				}
				

				$datacreate = array(
						'INSTRUCTOR_NAME' 				=> isset($post['INSTRUCTOR_NAME'])?xss_remover($post['INSTRUCTOR_NAME']):'',
						'INSTRUCTOR_FIRST_TITLE'		=> isset($post['INSTRUCTOR_FIRST_TITLE'])?xss_remover($post['INSTRUCTOR_FIRST_TITLE']):'',
						'INSTRUCTOR_LAST_TITLE' 		=> isset($post['INSTRUCTOR_LAST_TITLE'])?xss_remover($post['INSTRUCTOR_LAST_TITLE']):'',
						'INSTRUCTOR_ADDRESS' 			=> isset($post['INSTRUCTOR_ADDRESS'])?xss_remover($post['INSTRUCTOR_ADDRESS']):'',
						'INSTRUCTOR_EMAIL' 				=> isset($post['INSTRUCTOR_EMAIL'])?xss_remover($post['INSTRUCTOR_EMAIL']):'',
						'INSTRUCTOR_IMAGE_PATH' 		=> $imgpath,
						'INSTRUCTOR_CV_PATH' 			=> $cvpath,
						'INSTRUCTOR_CREATE_BY' 			=> xss_remover($this->session->userdata('user_id')),
						'INSTRUCTOR_CREATE_DATE' 		=> date('Y-m-d H:i:s'),
						'INSTRUCTOR_STATUS' 			=> 1
				);
				$insDb = $this->pengajar_model->add($datacreate);

				// echo "<pre>";
				// print_r($datacreate);die();
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/pengajar/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/pengajar');
				}

			} else {
				$data = array();
				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);
				$this->template->display('diklat/pengajar/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$adata = $this->pengajar_model->getDetail($id)->row_array();

				$imgpath = "";
				$cvpath  = "";
				$ifUpload = 0;
				$ext = "";

				if(!empty($_FILES['gambar_path']['name'])){

					$config['upload_path'] = './assets/images/diklat/';
					$config['allowed_types'] = 'gif|jpg|png';
					$new_name = time()."_";
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
		
					if($this->upload->do_upload('gambar_path'))
					{
						$gambarPathUpl = $this->upload->data();
						$ext = $gambarPathUpl["file_ext"];
						$ifUpload = 1;
						$imgpath = "assets/images/diklat/" . $gambarPathUpl["file_name"];
						
					}else{
						$error = array('error' => $this->upload->display_errors());
					}
				}

				if(!empty($_FILES['file_path']['name'])){
					$config['upload_path'] = './assets/images/diklat/cv/';
					$config['allowed_types'] = 'pdf';
					$new_name = time()."_";
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
		
					if($this->upload->do_upload('file_path'))
					{
						$cvPathUpl = $this->upload->data();
						$ext = $cvPathUpl["file_ext"];
						$ifUpload = 1;
						$cvpath = "assets/images/diklat/cv/" . $cvPathUpl["file_name"];
						
					}else{
						$error = array('error' => $this->upload->display_errors());
					}
				}

				$dataupd = array(
						'INSTRUCTOR_NAME' 				=> isset($post['INSTRUCTOR_NAME'])?$post['INSTRUCTOR_NAME']:'',
						'INSTRUCTOR_FIRST_TITLE'		=> isset($post['INSTRUCTOR_FIRST_TITLE'])?$post['INSTRUCTOR_FIRST_TITLE']:'',
						'INSTRUCTOR_LAST_TITLE' 		=> isset($post['INSTRUCTOR_LAST_TITLE'])?$post['INSTRUCTOR_LAST_TITLE']:'',
						'INSTRUCTOR_ADDRESS' 			=> isset($post['INSTRUCTOR_ADDRESS'])?$post['INSTRUCTOR_ADDRESS']:'',
						'INSTRUCTOR_EMAIL' 				=> isset($post['INSTRUCTOR_EMAIL'])?$post['INSTRUCTOR_EMAIL']:'',
						'INSTRUCTOR_IMAGE_PATH' 		=> $imgpath!=""?$imgpath:$adata['INSTRUCTOR_IMAGE_PATH'],
						'INSTRUCTOR_CV_PATH' 			=> $cvpath!=""?$cvpath:$adata['INSTRUCTOR_CV_PATH']
					
				);
				$insDb = $this->pengajar_model->update($dataupd,$id);

				// echo "<pre>";
				// print_r($dataupd);die();
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/pengajar/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'ubah data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/pengajar');
				}
			
			} else {
				$data = array();
				$data["pengajar"] = $this->pengajar_model->getDetail($id)->row_array();
				$this->template->display('diklat/pengajar/update', $data);			}
		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$data["pengajar"] = $this->pengajar_model->getDetail($id)->row_array();
			$this->template->display('diklat/pengajar/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "INSTRUCTOR_NAME";
		$limit = 10;

		$order_field 	= array(
			'INSTRUCTOR_ID',
			'INSTRUCTOR_NAME',
			'INSTRUCTOR_ADDRESS',
			'INSTRUCTOR_EMAIL',
			// 'INSTRUCTOR_STATUS',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pengajar_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pengajar_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->pengajar_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$name = ($row['INSTRUCTOR_FIRST_TITLE'] != '') ? $row['INSTRUCTOR_FIRST_TITLE']." ":"";
			$name .= ($row['INSTRUCTOR_NAME'] != '') ? $row['INSTRUCTOR_NAME']."":"";
			$name .= ($row['INSTRUCTOR_LAST_TITLE'] != '') ? ", ".$row['INSTRUCTOR_LAST_TITLE']:"";
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$name,
				$row["INSTRUCTOR_ADDRESS"],
				$row["INSTRUCTOR_EMAIL"],
				($row["INSTRUCTOR_CV_PATH"] != '' ? '<a href="'.base_url().$row["INSTRUCTOR_CV_PATH"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download CV" download data-placement="top"><i class="icon-download"></i></a>':'-'),
				'<a href="'.base_url().'diklat/pengajar/detail/'.$row["INSTRUCTOR_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'diklat/pengajar/update/'.$row["INSTRUCTOR_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a data-status="0" data-link="diklat/pengajar/delete/'.$row["INSTRUCTOR_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "INSTRUCTOR_NAME";
		$limit = 10;

		$order_field 	= array(
			'INSTRUCTOR_ID',
			'INSTRUCTOR_NAME',
			'INSTRUCTOR_ADDRESS',
			'INSTRUCTOR_EMAIL',
			// 'INSTRUCTOR_STATUS',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pengajar_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pengajar_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->pengajar_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$name = ($row['INSTRUCTOR_FIRST_TITLE'] != '') ? $row['INSTRUCTOR_FIRST_TITLE']." ":"";
			$name .= ($row['INSTRUCTOR_NAME'] != '') ? $row['INSTRUCTOR_NAME']."":"";
			$name .= ($row['INSTRUCTOR_LAST_TITLE'] != '') ? ", ".$row['INSTRUCTOR_LAST_TITLE']:"";
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$name,
				$row["INSTRUCTOR_ADDRESS"],
				$row["INSTRUCTOR_EMAIL"],
				($row["INSTRUCTOR_CV_PATH"] != '' ? '<a href="'.base_url().$row["INSTRUCTOR_CV_PATH"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download CV" download data-placement="top"><i class="icon-download"></i></a>':'-'),
				'<a href="'.base_url().'diklat/pengajar/detail/'.$row["INSTRUCTOR_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a data-status="0" data-link="diklat/pengajar/aktif/'.$row["INSTRUCTOR_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title=" Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete($peng_id = 0){

		$peng_idFilter = filter_var($peng_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($peng_id==$peng_idFilter) {

				$dataupdate = array(
					'INSTRUCTOR_CREATE_BY' 				=> $this->session->userdata('user_id'),
					'INSTRUCTOR_CREATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->pengajar_model->delete($peng_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/pengajar');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/pengajar');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/pengajar');
		}
	}

	public function aktif($peng_id = 0){

		$peng_idFilter = filter_var($peng_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($peng_id==$peng_idFilter) {

				$dataupdate = array(
					'user_update_by' 			=> $this->session->userdata('user_id'),
					'user_update_date' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->pengajar_model->aktif($peng_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/pengajar');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/pengajar');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/pengajar');
		}
	}
}