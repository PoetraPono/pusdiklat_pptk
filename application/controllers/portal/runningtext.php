<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Runningtext extends CI_Controller{
	private $limit=10;
	function __construct(){
		parent:: __construct();
		$this->load->model('portal/runningtext_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}
	public function index(){
		$data = array();
		$this->template->display('portal/runningtext/index', $data);
	}
	public function listdata($status=0){
		$default_order = "RUN_TEXT";
		$limit = 10;
		$order_field 	= array(
			'RUN_ID',
			'RUN_TEXT',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->runningtext_model->count_all($search,$order_field,$status);
		$data['iTotalDisplayRecords'][] = $this->runningtext_model->count_all($search,$order_field,$status);


		$aaData = array();
		$getData 	= $this->runningtext_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field,$status)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			if($row["RUN_STATUS"]==1){
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["RUN_TEXT"],
					'<a href="'.base_url().'portal/runningtext/detail/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/runningtext/update/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/runningtext/delete/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			}else{
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["RUN_TEXT"],
					'<a href="'.base_url().'portal/runningtext/detail/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/runningtext/update/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/runningtext/aktif/'.$row["RUN_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-checkmark"></i></a>');
			}
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$datacreate = array(
					'RUN_TEXT'			=> $post["RUN_TEXT"]!=''?strip_tags($post["RUN_TEXT"]):'',
					'RUN_CREATE_ID'		=> $this->session->userdata('user_id'),
					'RUN_CREATE_DATE'	=> date('Y-m-d H:i:s'),
					'RUN_STATUS'		=> 1
				);
				$insDb = $this->runningtext_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/runningtext');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/runningtext');
				}
			} else {
				$data = array();
				$this->template->display('portal/runningtext/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function update($id){
		if($this->access->permission('update')){	
			$data = array();
			$data['RUN'] = $this->runningtext_model->getdetail($id)->row_array();
			if($post = $this->input->post()){
				$dataupdate = array(
					'RUN_TEXT'			=> $post["RUN_TEXT"]!=''?strip_tags($post["RUN_TEXT"]):'',
					'RUN_CREATE_ID'		=> $this->session->userdata('user_id'),
					'RUN_CREATE_DATE'	=> date('Y-m-d H:i:s'),
					'RUN_STATUS'		=> 1
				);
				$insDb = $this->runningtext_model->upd($id, $dataupdate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/runningtext');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/runningtext');
				}
			} else {
				$this->template->display('portal/runningtext/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function detail($id=0){
		if($this->access->permission('read')){	
			$data = array();
			$data['RUN'] = $this->runningtext_model->getdetail($id)->row_array();
			$this->template->display('portal/runningtext/detail', $data);
		}else{
			$this->access->redirect('404');
		}
	}
	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->runningtext_model->upd($id, array('RUN_STATUS'=>0));
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

				redirect(base_url().'portal/runningtext');
			}
			echo json_encode($res);
	}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
					$del = $this->runningtext_model->upd($id, array('RUN_STATUS'=>1));
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


				redirect(base_url().'portal/runningtext');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}