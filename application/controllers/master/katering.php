<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Katering extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/katering_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/katering/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/images/katering/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "file_menu";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				if($this->upload->do_upload('file_menu'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "assets/images/katering/" . $dataupdload["file_name"];
				}else{
					$error = array('error' => $this->upload->display_errors());
				}
				$datacatering = array(
					'CATERING_NAME'				=> isset($post['add_name'])?$post['add_name']:'',
					//'CATERING_PRICE' 			=> isset($post['add_price'])?$post['add_price']:'',
					'CATERING_FILE_PATH' 			=> $imgpath,
					'CATERING_CREATE_BY'		=> $this->session->userdata('user_id'),
					'CATERING_CREATE_DATE'		=> date('Y-m-d H:i:s'),
					'CATERING_STATUS' 			=> 1
				);
				$inscatering = $this->katering_model->addkatering($datacatering);
				$id = $inscatering;
				$menu_name = $post['menu_name'];
				$menu_kategori = $post['kategori'];
				$menu_id = $post['menu_id'];

				// echo"<pre>";print_r($post); print_r($datainstansi);die;
				for ($i=0; $i < count($menu_id) ; $i++) { 
					$datainsert = array(
							'CAT_MENU_CATERING_ID' =>$id,
							'CAT_MENU_NAME' => $menu_name[$i],
							'CAT_MENU_CAT_ID' => $menu_kategori[$i],
							'CAT_MENU_STATUS' => 1
						);
						$insmenu = $this->katering_model->addmenu($datainsert);
				}
				if($inscatering > 0 && $insmenu){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data Katering Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/katering/detail/'.$inscatering);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data katering gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/katering');
				}
			}else{
				$data = array();
				$this->template->display('master/katering/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	function update($id = 0){
		if($this->access->permission('update')){
			$data["katering"] = $this->katering_model->getDetailKatering($id)->row_array();
			$data["cat_menu"] = $this->katering_model->getDetailMenu($id);
			$this->template->display('master/katering/update', $data);			
		}else{
			$this->access->redirect('404');
		}		
	}

	function update_(){
		if($this->access->permission('update')){
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/images/katering/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "file_menu";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				$datacatering = array(
					'CATERING_NAME'				=> isset($post['add_accname'])?$post['add_accname']:''
				);
				if($this->upload->do_upload('file_menu'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "assets/images/katering/" . $dataupdload["file_name"];
					$datacatering['CATERING_FILE_PATH'] = $imgpath;
				}else{
					$error = array('error' => $this->upload->display_errors());
				}
				
				$id = $post['id_katering'];
				$inscatering = $this->katering_model->updatekatering($datacatering, $id);
				$menu_name = $post['menu_name'];
				$menu_kategori = $post['kategori'];
				$this->katering_model->deletekateringlist($id);
				for ($i=0; $i < count($menu_kategori) ; $i++) {
					$datainsert = array(
						'CAT_MENU_CATERING_ID' =>$id,
						'CAT_MENU_NAME' => $menu_name[$i],
						'CAT_MENU_CAT_ID' => $menu_kategori[$i],
						'CAT_MENU_STATUS' => 1
					);
					//echo '<pre>'; print_r($datainsert); die();
					$insmenu = $this->katering_model->addmenu($datainsert);
				}
				if($inscatering){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Ubah Data Katering Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/katering/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Ubah Data katering gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/katering');
				}
			}else{
				$data = array();
				$this->template->display('master/katering/update', $data);
			}			
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["katering"] = $this->katering_model->getDetailKatering($id)->row_array();
			$data["cat_menu"] = $this->katering_model->getDetailMenu($id);
			$this->template->display('master/katering/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "CATERING_NAME";
		$limit = 10;

		$order_field 	= array(
			'CATERING_ID',
			'CATERING_NAME',
			'CATERING_PRICE'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->katering_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->katering_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->katering_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["CATERING_NAME"],
				($row["CATERING_FILE_PATH"] != '') ? '<a href="'.base_url().$row["CATERING_FILE_PATH"].'" download>download</a> ':'menu belum di upload',
				//$row["CATERING_STATUS_NAME"],
				'<a href="'.base_url().'master/katering/detail/'.$row["CATERING_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/katering/update/'.$row["CATERING_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/katering/delete/'.$row["CATERING_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "CATERING_NAME";
		$limit = 10;

		$order_field 	= array(
			'CATERING_ID',
			'CATERING_NAME',
			'CATERING_PRICE'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->katering_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->katering_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->katering_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["CATERING_NAME"],
				'<a href="'.base_url().$row["CATERING_FILE_PATH"].'" >download</a> ',
				//$row["CATERING_STATUS_NAME"],
				'<a href="'.base_url().'master/katering/detail/'.$row["CATERING_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/katering/aktif/'.$row["CATERING_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->katering_model->delete($id);
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

				redirect(base_url().'master/katering');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->katering_model->aktif($id);
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


				redirect(base_url().'master/katering');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}