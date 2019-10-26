<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/news_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('portal/news/index', $data);
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/uploads/news/';
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
					$imgpath = "assets/uploads/news/" . $dataupdload["file_name"];
				}else{
					//exit;
					$error = array('error' => $this->upload->display_errors());
				}

				$content = isset($post['new_content'])?$post['new_content']:'';
				//$content = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $content);
				$datacreate = array(
						'NEWS_TITLE' 			=> isset($post['new_title'])?$post['new_title']:'',
						'NEWS_CONTENT' 			=> isset($post['new_content'])?$post['new_content']:'',
						'NEWS_DATE'				=> date("Y-m-d H:i:s",strtotime($post['new_date'])),
						'NEWS_CATEGORY_ID'		=> isset($post['category_id'])?$post['category_id']:'',
						'NEWS_TAGS'				=> isset($post['new_tag'])?$post['new_tag']:'',
						'NEWS_IMAGE_PATH' 		=> $imgpath,
						'NEWS_CREATE_BY' 		=> $this->session->userdata('user_id'),
						'NEWS_CREATE_DATE' 		=> date('Y-m-d H:i:s'),
						'NEWS_STATUS' 			=> 1
				);
				// echo "<pre>";
				// print_r($datacreate); 
				// die();

				$insDb = $this->news_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/news');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/news');
				}

			} else {
				$data = array();
				$data['category'] = $this->news_model->listCategory()->result_array();
				$this->template->display('portal/news/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($newsId){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){

				$adata = $this->news_model->get($newsId)->row_array();

				$config['upload_path'] = './assets/uploads/news/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = time()."_";
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
					print_r($dataupdload); 
					die();
					exit;*/
					$imgpath = "assets/uploads/news/" . $dataupdload["file_name"];
				}else{
					//exit;
					$error = array('error' => $this->upload->display_errors());
				}

				//$content = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $content);
				$dataupd = array(

						'NEWS_TITLE' 			=> isset($post['upd_title'])?$post['upd_title']:'',
						'NEWS_CONTENT' 			=> isset($post['upd_content'])?$post['upd_content']:'',
						'NEWS_CATEGORY_ID'		=> isset($post['category_id'])?$post['category_id']:'',
						'NEWS_DATE'				=> date("Y-m-d H:i:s",strtotime($post['upd_date'])),
						'NEWS_PUBLISHER'		=> isset($post['upd_publisher'])?$post['upd_publisher']:'',
						'NEWS_TAGS'				=> isset($post['upd_tag'])?$post['upd_tag']:'',
						'NEWS_IMAGE_PATH' 		=> $imgpath!=""?$imgpath:$adata['image_path']
				);
				/*echo "<pre>";
				print_r($dataupd); 
				die();*/

				$insDb = $this->news_model->update($dataupd,$newsId);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/news/');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/news');
				}

			} else {
				$data = array();
				$data['category'] = $this->news_model->listCategory()->result_array();
				$data['news'] = $this->news_model->get($newsId)->row_array();
				// $data['countries'] = $this->news_model->getCountry()->result_array();
				$this->template->display('portal/news/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->news_model->getDetail($id)->row_array();
			$data["news"] = $user;
			$this->template->display('portal/news/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "NEWS_TITLE";
		$limit = 10;

		$order_field 	= array(
			'NEWS_ID',
			'NEWS_TITLE',
			'CATEGORY_NAME',
			'NEWS_DATE',
			'NEWS_PUBLISHER',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->news_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->news_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->news_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["NEWS_TITLE"],
				$row["CATEGORY_NAME"],
				date('d M Y',strtotime($row["NEWS_DATE"])),
				$row["NEWS_PUBLISHER"],
				
				'<a href="'.base_url().'portal/news/detail/'.$row["NEWS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'portal/news/update/'.$row["NEWS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'portal/news/delete/'.$row["NEWS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "NEWS_TITLE";
		$limit = 10;

		$order_field 	= array(
			'NEWS_ID',
			'NEWS_TITLE',
			'CATEGORY_NAME',
			'NEWS_DATE',
			'NEWS_PUBLISHER',
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->news_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->news_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->news_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["NEWS_TITLE"],
				$row["CATEGORY_NAME"],
				date('d M Y',strtotime($row["NEWS_DATE"])),
				$row["NEWS_PUBLISHER"],
				
				'<a href="'.base_url().'portal/news/detail/'.$row["NEWS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'portal/news/aktif/'.$row["NEWS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->news_model->delete($id);
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

				redirect(base_url().'portal/news');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->news_model->aktif($id);
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


				redirect(base_url().'portal/news');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}