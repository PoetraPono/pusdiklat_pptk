<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lakip extends CI_Controller{
	private $limit=10;
	function __construct(){
		parent:: __construct();
		$this->load->model('portal/lakip_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}
	public function index(){
		$data = array();
		$this->template->display('portal/lakip/index', $data);
	}
	public function listdata($status=0){
		$default_order = "LAKIP_TITLE";
		$limit = 10;
		$order_field 	= array(
			'LAKIP_ID',
			'LAKIP_TITLE',
			'LAKIP_DESCRIPTION',
			'LAKIP_DATE',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->lakip_model->count_all($search,$order_field,$status);
		$data['iTotalDisplayRecords'][] = $this->lakip_model->count_all($search,$order_field,$status);


		$aaData = array();
		$getData 	= $this->lakip_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field,$status)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$content = $row["LAKIP_DESCRIPTION"];
			if (str_word_count(strip_tags($content), 0) > 30) {
				$words = str_word_count(strip_tags($content), 2);
				$pos = array_keys($words);
				$content = substr(strip_tags($content), 0, $pos[30]) . '...';
			}
			if($row["LAKIP_STATUS"]==1){
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["LAKIP_TITLE"],
					strip_tags($content),
					dateEnToId(date('Y-m-d', strtotime($row["LAKIP_DATE"])), 'd/m/y'),
					'<a href="'.base_url().'portal/lakip/detail/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/lakip/update/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/lakip/delete/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			}else{
				$aaData[] = array(
					'<center>'.$no.'</center>',
					$row["LAKIP_TITLE"],
					strip_tags($content),
					dateEnToId(date('Y-m-d', strtotime($row["LAKIP_DATE"])), 'd/m/y'),
					'<a href="'.base_url().'portal/lakip/detail/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
					<a href="'.base_url().'portal/lakip/update/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
					<a href="'.base_url().'portal/lakip/aktif/'.$row["LAKIP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-checkmark"></i></a>');
			}
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$config['upload_path'] = 'assets/uploads/lakip';
				$config['allowed_types'] = '*';
				$new_name = "lakipfile_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "LAKIP_FILE_PATH";
				$ifUpload = 0;
				if($this->upload->do_upload('LAKIP_FILE_PATH')){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "./assets/uploads/lakip/" . $dataupdload["file_name"];
				}else{
					// $attach_path = isset($post['filessss_'])?'./assets/uploads/lakip/'.$post['filessss_']:'';
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
					'LAKIP_TITLE'		=> $post["LAKIP_TITLE"]!=''?$post["LAKIP_TITLE"]:'',
					'LAKIP_DESCRIPTION'=> $post["LAKIP_DESCRIPTION"]!=''?$post["LAKIP_DESCRIPTION"]:'',
					'LAKIP_FILE_PATH'	=> $attach_path,
					'LAKIP_DATE'		=> $post["LAKIP_DATE"]!=''?date('Y-m-d', strtotime($post["LAKIP_DATE"])):null,
					'LAKIP_CREATE_BY'	=> $this->session->userdata('user_id'),
					'LAKIP_CREATE_DATE'=> date('Y-m-d H:i:s'),
					'LAKIP_STATUS'		=> 1
				);
				$insDb = $this->lakip_model->add($datacreate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/lakip');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/lakip');
				}
			} else {
				$data = array();
				$this->template->display('portal/lakip/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function update($id){
		if($this->access->permission('update')){	
			$data = array();
			$data['LAKIP'] = $this->lakip_model->getdetail($id)->row_array();
			if($post = $this->input->post()){
				$config['upload_path'] = 'assets/uploads/lakip';
				$config['allowed_types'] = '*';
				$new_name = "lakipfile_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "LAKIP_FILE_PATH";
				$ifUpload = 0;
				if($this->upload->do_upload('LAKIP_FILE_PATH')){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "./assets/uploads/lakip/" . $dataupdload["file_name"];
					if($data['LAKIP']['LAKIP_FILE_PATH']!=""){
						@unlink('./'.$data['LAKIP']['LAKIP_FILE_PATH']);
					}
				}else{
					$attach_path = $data['LAKIP']['LAKIP_FILE_PATH'];
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
					'LAKIP_TITLE'		=> $post["LAKIP_TITLE"]!=''?$post["LAKIP_TITLE"]:'',
					'LAKIP_DESCRIPTION'=> $post["LAKIP_DESCRIPTION"]!=''?$post["LAKIP_DESCRIPTION"]:'',
					'LAKIP_FILE_PATH'	=> $attach_path,
					'LAKIP_DATE'		=> $post["LAKIP_DATE"]!=''?date('Y-m-d', strtotime($post["LAKIP_DATE"])):null,
					'LAKIP_CREATE_BY'	=> $this->session->userdata('user_id'),
					'LAKIP_CREATE_DATE'=> date('Y-m-d H:i:s'),
					'LAKIP_STATUS'		=> 1
				);
				$insDb = $this->lakip_model->upd($id, $dataupdate);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/lakip');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/lakip');
				}
			} else {
				$this->template->display('portal/lakip/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function detail($id=0){
		if($this->access->permission('read')){	
			$data = array();
			$data['LAKIP'] = $this->lakip_model->getdetail($id)->row_array();
			$this->template->display('portal/lakip/detail', $data);
		}else{
			$this->access->redirect('404');
		}
	}
	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->lakip_model->upd($id, array('LAKIP_STATUS'=>0));
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

				redirect(base_url().'portal/lakip');
			}
			echo json_encode($res);
	}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
					$del = $this->lakip_model->upd($id, array('LAKIP_STATUS'=>1));
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


				redirect(base_url().'portal/lakip');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}
}