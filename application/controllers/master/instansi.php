<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/instansi_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/instansi/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datacinst = array(
					'INSTANSI_NAME'				=> isset($post['add_name'])?$post['add_name']:'',
					'INSTANSI_ADDRESS' 			=> isset($post['add_address'])?$post['add_address']:'',
					'INSTANSI_CATEGORY' 		=> isset($post['add_category'])?$post['add_category']:'',
					'INSTANSI_PHONE' 			=> isset($post['add_phone'])?$post['add_phone']:'',
					'INSTANSI_PIC_NAME' 		=> isset($post['add_pic_name'])?$post['add_pic_name']:'',
					'INSTANSI_PIC_PHONE' 		=> isset($post['add_pic_phone'])?$post['add_pic_phone']:'',
					'INSTANSI_CREATE_BY'		=> $this->session->userdata('user_id'),
					'INSTANSI_CREATE_DATE'		=> date('Y-m-d H:i:s'),
					'INSTANSI_STATUS' 			=> 1
				);
				// echo"<pre>";print_r($post); print_r($datainstansi);die;
				$insDb = $this->instansi_model->add($datacinst);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data Instansi Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/instansi/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data Instansi gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/instansi');
				}
			}else{
				$data = array();
				$data['listcategory'] = $this->instansi_model->getlistcategory()->result_array();
				$this->template->display('master/instansi/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id=0){
		if($this->access->permission('update') && intval($id)>0){
			if($post = $this->input->post()){
				$update = array(

					'INSTANSI_NAME'				=> isset($post['update_name'])?$post['update_name']:'',
					'INSTANSI_ADDRESS' 			=> isset($post['update_address'])?$post['update_address']:'',
					'INSTANSI_CATEGORY' 		=> isset($post['update_category'])?$post['update_category']:'',
					'INSTANSI_PHONE' 			=> isset($post['update_phone'])?$post['update_phone']:'',
					'INSTANSI_PIC_NAME' 		=> isset($post['update_pic_name'])?$post['update_pic_name']:'',
					'INSTANSI_PIC_PHONE' 		=> isset($post['update_pic_phone'])?$post['update_pic_phone']:'',
					//'service_status' => 1
				);
				$insDb = $this->instansi_model->update($update,$id);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Pengubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/instansi/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Pengubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
				}
				redirect(base_url().'master/instansi');
			}
			$data = array();
			$user = $this->instansi_model->getDetail($id)->row_array();
			$data["instansi"] = $user;
			$data['listcategory'] = $this->instansi_model->getlistcategory()->result_array();
			$this->template->display('master/instansi/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->instansi_model->getDetail($id)->row_array();
			$data["instansi"] = $user;
			$this->template->display('master/instansi/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "INSTANSI_NAME";
		$limit = 10;

		$order_field 	= array(
			'INSTANSI_ID',
			'INSTANSI_NAME',
			'INSTANSI_CATEGORY_NAME',
			'INSTANSI_ADDRESS',
			'INSTANSI_STATUS_NAME',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->instansi_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->instansi_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->instansi_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["INSTANSI_NAME"],
				$row["INSTANSI_CATEGORY_NAME"],
				$row["INSTANSI_ADDRESS"],
				$row["INSTANSI_PHONE"],
				$row["INSTANSI_PIC_NAME"],
				$row["INSTANSI_PIC_PHONE"],
				'<a href="'.base_url().'master/instansi/detail/'.$row["INSTANSI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/instansi/update/'.$row["INSTANSI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/instansi/delete/'.$row["INSTANSI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "INSTANSI_NAME";
		$limit = 10;

		$order_field 	= array(
			'INSTANSI_ID',
			'INSTANSI_NAME',
			'INSTANSI_CATEGORY_NAME',
			'INSTANSI_ADDRESS',
			'INSTANSI_STATUS_NAME',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->instansi_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->instansi_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->instansi_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["INSTANSI_NAME"],
				$row["INSTANSI_CATEGORY_NAME"],
				$row["INSTANSI_ADDRESS"],
				$row["INSTANSI_PHONE"],
				$row["INSTANSI_PIC_NAME"],
				$row["INSTANSI_PIC_PHONE"],
				'<a href="'.base_url().'master/instansi/detail/'.$row["INSTANSI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/instansi/aktif/'.$row["INSTANSI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->instansi_model->delete($id);
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

				redirect(base_url().'master/instansi');
			}
			echo json_encode($res);
	}
	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->instansi_model->aktif($id);
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


				redirect(base_url().'master/instansi');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}