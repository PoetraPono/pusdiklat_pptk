<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategorievaluasi extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/kategorievaluasi_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/kategorievaluasi/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datacreate = array(
					'EVALUASI_PARENT_ID'		=> 0,
					'EVALUASI_POINT_NAME' 		=> isset($post['EVALUASI_POINT_NAME'])?$post['EVALUASI_POINT_NAME']:'',
					'EVALUASI_TYPE' 			=> 1,
					'EVALUASI_STATUS' 			=> 1
				);
				// echo"<pre>"; print_r($datacreate);die;
				$insDb = $this->kategorievaluasi_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data pidana Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kategorievaluasi');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data pidana gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kategorievaluasi');
				}
			}else{
				$data = array();
				$data['bidang'] = $this->kategorievaluasi_model->getListBidang()->result_array();
				// echo"<pre>";print_r($data['bidang']); die;
				$this->template->display('master/kategorievaluasi/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id=0){
		if($this->access->permission('update')){
			if($post = $this->input->post()){
				$update = array(
					'EVALUASI_PARENT_ID'		=> 0,
					'EVALUASI_POINT_NAME' 		=> isset($post['EVALUASI_POINT_NAME'])?$post['EVALUASI_POINT_NAME']:'',
					//'service_status' => 1
				);
				// echo"<pre>";print_r($update); die;
				$insDb = $this->kategorievaluasi_model->update($update,$id);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Pengubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kategorievaluasi');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Pengubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
				}
				redirect(base_url().'master/kategorievaluasi');
			}
			$data = array();
			$data['bidang'] = $this->kategorievaluasi_model->getListBidang()->result_array();
			$user = $this->kategorievaluasi_model->getDetail($id)->row_array();
			$data["pidana"] = $user;

			$this->template->display('master/kategorievaluasi/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->kategorievaluasi_model->getDetail($id)->row_array();
			$data["pidana"] = $user;
			$this->template->display('master/kategorievaluasi/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "EVALUASI_PARENT_ID";
		$limit = 10;

		$order_field 	= array(
			'EVALUASI_PARENT_ID',
			'EVALUASI_POINT_NAME',
			);

		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->kategorievaluasi_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->kategorievaluasi_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->kategorievaluasi_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["EVALUASI_POINT_NAME"],
				'
				<a href="'.base_url().'master/kategorievaluasi/update/'.$row["EVALUASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/kategorievaluasi/delete/'.$row["EVALUASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "EVALUASI_PARENT_ID";
		$limit = 10;

		$order_field 	= array(
			'EVALUASI_PARENT_ID',
			'EVALUASI_POINT_NAME',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->kategorievaluasi_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->kategorievaluasi_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->kategorievaluasi_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["EVALUASI_POINT_NAME"],
				'<a href="'.base_url().'master/kategorievaluasi/aktif/'.$row["EVALUASI_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->kategorievaluasi_model->delete($id);
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

				redirect(base_url().'master/kategorievaluasi');
			}
			echo json_encode($res);
	}
	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->kategorievaluasi_model->aktif($id);
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


				redirect(base_url().'master/kategorievaluasi');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}