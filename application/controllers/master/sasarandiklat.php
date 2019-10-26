<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sasarandiklat extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/pidana_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/pidana/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datacreate = array(
					'TINDAK_PIDANA_SECTOR_ID'		=> isset($post['TINDAK_PIDANA_SECTOR_ID'])?$post['TINDAK_PIDANA_SECTOR_ID']:'',
					'TINDAK_PIDANA_NAME' 			=> isset($post['TINDAK_PIDANA_NAME'])?$post['TINDAK_PIDANA_NAME']:'',
					'TINDAK_PIDANA_STATUS' 			=> 1
				);
				// echo"<pre>"; print_r($datacreate);die;
				$insDb = $this->pidana_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data pidana Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/sasarandiklat/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data pidana gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/sasarandiklat');
				}
			}else{
				$data = array();
				$data['bidang'] = $this->pidana_model->getListBidang()->result_array();
				// echo"<pre>";print_r($data['bidang']); die;
				$this->template->display('master/pidana/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id=0){
		if($this->access->permission('update')){
			if($post = $this->input->post()){
				$update = array(

					'TINDAK_PIDANA_SECTOR_ID'		=> isset($post['TINDAK_PIDANA_SECTOR_ID'])?$post['TINDAK_PIDANA_SECTOR_ID']:'',
					'TINDAK_PIDANA_NAME' 			=> isset($post['TINDAK_PIDANA_NAME'])?$post['TINDAK_PIDANA_NAME']:'',
					//'service_status' => 1
				);
				// echo"<pre>";print_r($update); die;
				$insDb = $this->pidana_model->update($update,$id);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Pengubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/sasarandiklat/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Pengubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
				}
				redirect(base_url().'master/sasarandiklat');
			}
			$data = array();
			$data['bidang'] = $this->pidana_model->getListBidang()->result_array();
			$user = $this->pidana_model->getDetail($id)->row_array();
			$data["pidana"] = $user;

			$this->template->display('master/pidana/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->pidana_model->getDetail($id)->row_array();
			$data["pidana"] = $user;
			$this->template->display('master/pidana/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "TINDAK_PIDANA_NAME";
		$limit = 10;

		$order_field 	= array(
			'SECTOR_NAME',
			'TINDAK_PIDANA_ID',
			'TINDAK_PIDANA_NAME',
			);

		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pidana_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pidana_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->pidana_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["TINDAK_PIDANA_NAME"],
				$row["SECTOR_NAME"],
				'<a href="'.base_url().'master/sasarandiklat/detail/'.$row["TINDAK_PIDANA_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/sasarandiklat/update/'.$row["TINDAK_PIDANA_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/sasarandiklat/delete/'.$row["TINDAK_PIDANA_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "TINDAK_PIDANA_NAME";
		$limit = 10;

		$order_field 	= array(
			'TINDAK_PIDANA_ID',
			'SECTOR_NAME',
			'TINDAK_PIDANA_NAME',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pidana_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pidana_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->pidana_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["TINDAK_PIDANA_NAME"],
				$row["SECTOR_NAME"],
				'<a href="'.base_url().'master/sasarandiklat/detail/'.$row["TINDAK_PIDANA_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/sasarandiklat/aktif/'.$row["TINDAK_PIDANA_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
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
					$del = $this->pidana_model->delete($id);
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

				redirect(base_url().'master/sasarandiklat');
			}
			echo json_encode($res);
	}
	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->pidana_model->aktif($id);
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


				redirect(base_url().'master/sasarandiklat');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}