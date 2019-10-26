<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanan extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/layanan_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('portal/layanan/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datacreate = array(
					'SERVICE_TYPE'				=> isset($post['SERVICE_TYPE'])?$post['SERVICE_TYPE']:'',
					'SERVICE_NAME' 				=> isset($post['SERVICE_NAME'])?$post['SERVICE_NAME']:'',
					'SERVICE_LINK'				=> isset($post['SERVICE_LINK'])?$post['SERVICE_LINK']:'',
					'SERVICE_DESC' 				=> isset($post['SERVICE_DESC'])?$post['SERVICE_DESC']:'',
					'SERVICE_CEREATE_BY'		=> isset($post['SERVICE_CEREATE_BY'])?$post['SERVICE_CEREATE_BY']:'',
					'SERVICE_CREATE_DATE' 		=> isset($post['SERVICE_CREATE_DATE'])?$post['SERVICE_CREATE_DATE']:'',
					'SERVICE_STATUS' 			=> 1
				);
				// echo"<pre>";print_r($datacreate);die;
				$insDb = $this->layanan->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data layanan Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/layanan/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data layanan gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/layanan');
				}
			}else{
				$data = array();

				$this->template->display('portal/layanan/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id=0){
		if($this->access->permission('update')){
			if($post = $this->input->post()){
				$update = array(

					// 'SERVICE_TYPE'				=> isset($post['SERVICE_TYPE'])?$post['SERVICE_TYPE']:'',
					'SERVICE_NAME' 				=> isset($post['SERVICE_NAME'])?$post['SERVICE_NAME']:'',
					'SERVICE_LINK'				=> isset($post['SERVICE_LINK'])?$post['SERVICE_LINK']:'',
					'SERVICE_DESC' 				=> isset($post['SERVICE_DESC'])?$post['SERVICE_DESC']:'',
					//'service_status' => 1
				);
				// echo"<pre>";print_r($update);die;
				$insDb = $this->layanan_model->update($update,$id);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Pengubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/layanan/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Pengubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
				}
				redirect(base_url().'portal/layanan');
			}
			$data = array();
			$user = $this->layanan_model->getDetail($id)->row_array();
			$data["layanan"] = $user;
			$this->template->display('portal/layanan/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->layanan_model->getDetail($id)->row_array();
			$data["layanan"] = $user;
			$this->template->display('portal/layanan/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "SERVICE_NAME";
		$limit = 10;

		$order_field 	= array(
			'SERVICE_ID',
			// 'SERVICE_TYPE',
			'SERVICE_NAME',
			'SERVICE_LINK',
			// 'SERVICE_STATUS'
			);

		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->layanan_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->layanan_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->layanan_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				// $row["SERVICE_TYPE"],
				$row["SERVICE_NAME"],
				$row["SERVICE_LINK"],
				// $row["SERVICE_STATUS"],
				'<a href="'.base_url().'portal/layanan/detail/'.$row["SERVICE_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'portal/layanan/update/'.$row["SERVICE_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "SERVICE_NAME";
		$limit = 10;

		$order_field 	= array(
			'SERVICE_ID',
			'SERVICE_TYPE',
			'SERVICE_NAME',
			'SERVICE_LINK',
			// 'SERVICE_STATUS'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->layanan_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->layanan_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->layanan_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["SERVICE_TYPE"],
				$row["SERVICE_NAME"],
				$row["SERVICE_LINK"],
				// $row["SERVICE_STATUS"],
				'<a href="'.base_url().'portal/layanan/detail/'.$row["SERVICE_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'portal/layanan/aktif/'.$row["SERVICE_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->layanan_model->delete($id);
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

				redirect(base_url().'portal/layanan');
			}
			echo json_encode($res);
	}
	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->layanan_model->aktif($id);
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


				redirect(base_url().'portal/layanan');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}