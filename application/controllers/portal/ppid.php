<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ppid extends CI_Controller{
	private $limit=10;
	function __construct(){
		parent:: __construct();
		$this->load->model('portal/ppid_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}
	public function index(){
		$data = array();
		$this->template->display('portal/ppid/index', $data);
	}
	public function listdata($status=0){
		$default_order = "PPID_TITLE";
		$limit = 10;
		$order_field 	= array(
			'PPID_ID',
			'PPID_TITLE',
			'PPID_DESCRIPTION',
			'PPID_DATE',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->ppid_model->count_all($search,$order_field,$status);
		$data['iTotalDisplayRecords'][] = $this->ppid_model->count_all($search,$order_field,$status);


		$aaData = array();
		$getData 	= $this->ppid_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field,$status)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$content = $row["PPID_DESCRIPTION"];
			if (str_word_count(strip_tags($content), 0) > 30) {
				$words = str_word_count(strip_tags($content), 2);
				$pos = array_keys($words);
				$content = substr(strip_tags($content), 0, $pos[30]) . '...';
			}
			if($row["PPID_STATUS"]==1){
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["PPID_TITLE"],
					strip_tags($content),
					dateEnToId(date('Y-m-d', strtotime($row["PPID_DATE"])), 'd/m/y'),
					'<a href="'.base_url().'portal/ppid/detail/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/ppid/update/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/ppid/delete/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			}else{
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["PPID_TITLE"],
					strip_tags($content),
					dateEnToId(date('Y-m-d', strtotime($row["PPID_DATE"])), 'd/m/y'),
					'<a href="'.base_url().'portal/ppid/detail/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/ppid/update/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/ppid/aktif/'.$row["PPID_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-checkmark"></i></a>');
			}
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$config['upload_path'] = 'assets/uploads/ppid';
				$config['allowed_types'] = '*';
				$new_name = "ppidfile_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "PPID_FILE_PATH";
				$ifUpload = 0;
				if($this->upload->do_upload('PPID_FILE_PATH')){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "./assets/uploads/ppid/" . $dataupdload["file_name"];
				}else{
					// $attach_path = isset($post['filessss_'])?'./assets/uploads/ppid/'.$post['filessss_']:'';
					// $filename = isset($post['filename_'])?$post['filename_']:'';
					$attach_path = '';
					// $error = array('error' => $this->upload->display_errors());
					// print_r($error);
					// echo 'error';die();
					$notify = array(
						'title' 	=> 'Gagal!',
						'message'	=> 'Upload file gagal, silahkan coba lagi',
						'status' 	=> 'error'
					);
					$this->session->set_flashdata('notify', $notify);
				}
				$datacreate = array(
					'PPID_TITLE'		=> $post["PPID_TITLE"]!=''?$post["PPID_TITLE"]:'',
					'PPID_DESCRIPTION'=> $post["PPID_DESCRIPTION"]!=''?$post["PPID_DESCRIPTION"]:'',
					'PPID_FILE_PATH'	=> $attach_path,
					'PPID_DATE'		=> $post["PPID_DATE"]!=''?date('Y-m-d', strtotime($post["PPID_DATE"])):null,
					'PPID_CREATE_BY'	=> $this->session->userdata('user_id'),
					'PPID_CREATE_DATE'=> date('Y-m-d H:i:s'),
					'PPID_STATUS'		=> 1
				);
				$insDb = $this->ppid_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/ppid');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/ppid');
				}
			} else {
				$data = array();
				$this->template->display('portal/ppid/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function update($id){
		if($this->access->permission('update')){	
			$data = array();
			$data['PPID'] = $this->ppid_model->getdetail($id)->row_array();
			if($post = $this->input->post()){
				$config['upload_path'] = 'assets/uploads/ppid';
				$config['allowed_types'] = '*';
				$new_name = "ppidfile_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "PPID_FILE_PATH";
				$ifUpload = 0;
				if($this->upload->do_upload('PPID_FILE_PATH')){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "./assets/uploads/ppid/" . $dataupdload["file_name"];
					if($data['PPID']['PPID_FILE_PATH']!=""){
						@unlink('./'.$data['PPID']['PPID_FILE_PATH']);
					}
				}else{
					$attach_path = $data['PPID']['PPID_FILE_PATH'];
					$notify = array(
						'title' 	=> 'Gagal!',
						'message'	=> 'Upload file gagal, silahkan coba lagi',
						'status' 	=> 'error'
					);
					$this->session->set_flashdata('notify', $notify);
					// $filename = isset($post['filename_'])?$post['filename_']:'';
					// $attach_path = '';
					// $error = array('error' => $this->upload->display_errors());
					// print_r($error);
					// echo 'error';die();
				}
				// echo json_encode($post);die;
				$dataupdate = array(
					'PPID_TITLE'		=> $post["PPID_TITLE"]!=''?$post["PPID_TITLE"]:'',
					'PPID_DESCRIPTION'=> $post["PPID_DESCRIPTION"]!=''?$post["PPID_DESCRIPTION"]:'',
					'PPID_FILE_PATH'	=> $attach_path,
					'PPID_DATE'		=> $post["PPID_DATE"]!=''?date('Y-m-d', strtotime($post["PPID_DATE"])):null,
					'PPID_CREATE_BY'	=> $this->session->userdata('user_id'),
					'PPID_CREATE_DATE'=> date('Y-m-d H:i:s'),
					'PPID_STATUS'		=> 1
				);
				$insDb = $this->ppid_model->upd($id, $dataupdate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/ppid');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/ppid');
				}
			} else {
				$this->template->display('portal/ppid/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function detail($id=0){
		if($this->access->permission('read')){	
			$data = array();
			$data['PPID'] = $this->ppid_model->getdetail($id)->row_array();
			$this->template->display('portal/ppid/detail', $data);
		}else{
			$this->access->redirect('404');
		}
	}
	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->ppid_model->upd($id, array('PPID_STATUS'=>0));
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

				redirect(base_url().'portal/ppid');
			}
			echo json_encode($res);
	}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
					$del = $this->ppid_model->upd($id, array('PPID_STATUS'=>1));
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


				redirect(base_url().'portal/ppid');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}