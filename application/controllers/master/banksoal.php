<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banksoal extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/banksoal_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/banksoal/index', $data);
	}

	public function listdataaktif(){
		$status="";
		$default_order = "QUESTION_VALUE";
		$limit = 10;

		$order_field 	= array(
			'QUESTION_ID',
			'QUESTION_VALUE',
			);
		
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->banksoal_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->banksoal_model->count_all($search,$order_field);
		
		$aaData = array();
		$getData 	= $this->banksoal_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		// echo "<pre>";print_r($getData);
		// die;

		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["QUESTION_VALUE"],
				'<a href="'.base_url().'master/banksoal/detail/'.$row["QUESTION_ID"].'" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/banksoal/update/'.$row["QUESTION_ID"].'" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/banksoal/delete/'.$row["QUESTION_ID"].'" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function listdatanonaktif(){
		$status="";
		$default_order = "QUESTION_VALUE";
		$limit = 10;

		$order_field 	= array(
			'QUESTION_ID',
			'QUESTION_VALUE',
			);
		
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->banksoal_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->banksoal_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->banksoal_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["QUESTION_VALUE"],
				'<a href="'.base_url().'master/banksoal/detail/'.$row["QUESTION_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/banksoal/aktif/'.$row["QUESTION_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				// echo json_encode($post);die;
				$datapost = array();
				foreach ($post['addQuestion'] as $k => $v) {
					// echo "<pre>";
					if($v !=""){
						$question = array(
							'QUESTION_VALUE'		=> $v,
							'QUESTION_CREATE_BY'	=> $this->session->userdata('user_id'),
							'QUESTION_CREATE_DATE'	=> date('Y-m-d H:i:s'),
							'QUESTION_STATUS'		=> 1
						);
						// print_r($question);echo '<hr><br>';
						$insDb = $this->banksoal_model->add($question);
						// $insDb = "1";
						if($insDb){
							$jawaban = isset($post['addAnswer_'.$k])?$post['addAnswer_'.$k]:"";
							foreach ($post['addOption_'.$k] as $kk => $vv) {
								$details = array(
									'OPTION_QUESTION_ID'	=> $insDb,
									'OPTION_VALUE'			=> $vv,
									'OPTION_SORT'			=> $kk,
									'OPTION_ANSWER'			=> ($jawaban==$kk)?1:0,
									'OPTION_STATUS'			=> 1
								);
								// print_r($details);echo '<hr><br>';
								$insDbdet = $this->banksoal_model->adddetails($details);
								if(!$insDbdet){
									$notify = array(
											'title' 	=> 'Gagal!',
											'message'	=> 'Penambahan Data Bank Soal gagal, silahkan coba lagi',
											'status' 	=> 'error'
										);
									$this->session->set_flashdata('notify', $notify);
									redirect(base_url().'master/banksoal');
								}
							}
						}else{
							$notify = array(
									'title' 	=> 'Gagal!',
									'message'	=> 'Penambahan Data Bank Soal gagal, silahkan coba lagi',
									'status' 	=> 'error'
								);
							$this->session->set_flashdata('notify', $notify);
							redirect(base_url().'master/banksoal');
						}
					}
				}
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Penambahan Data Bank Soal Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'master/banksoal');
			}else{
				$data = array();
				$this->template->display('master/banksoal/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function update($id){
		if($this->access->permission('update')){
			if($post = $this->input->post()){		
				$question = array(
					'QUESTION_VALUE'		=> $post['addQuestion']!=""?$post['addQuestion']:null,
					'QUESTION_CREATE_BY'	=> $this->session->userdata('user_id'),
					'QUESTION_CREATE_DATE'	=> date('Y-m-d H:i:s'),
					'QUESTION_STATUS'		=> 1
				);
				$insDb = $this->banksoal_model->update($question, $id);
				if($insDb){
					$jawaban = isset($post['addAnswer'])?$post['addAnswer']:"";
					$this->banksoal_model->del_opt($id);
					foreach ($post['addOption'] as $kk => $vv) {
						$details = array(
							'OPTION_QUESTION_ID'	=> $id,
							'OPTION_VALUE'			=> $vv,
							'OPTION_SORT'			=> $kk,
							'OPTION_ANSWER'			=> ($jawaban==$kk)?1:0,
							'OPTION_STATUS'			=> 1
						);
						$insDbdet = $this->banksoal_model->adddetails($details);
						if(!$insDbdet){
							$notify = array(
									'title' 	=> 'Gagal!',
									'message'	=> 'Update Data Bank Soal gagal, silahkan coba lagi',
									'status' 	=> 'error'
								);
							$this->session->set_flashdata('notify', $notify);
							redirect(base_url().'master/banksoal');
						}
					}
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Update Data Bank Soal Berhasil',
						'status' 	=> 'success'
					);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/banksoal');

				}
			}else{
				$data = array();
				$data['soal'] 		= $this->banksoal_model->get($id)->row_array();
				$data['jawaban'] 	= $this->banksoal_model->getlist_options($id)->result_array();
				$this->template->display('master/banksoal/update', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}
	public function detail($id){
		if($this->access->permission('read')){
			$data = array();
			$data['soal'] 		= $this->banksoal_model->get($id)->row_array();
			$data['jawaban'] 	= $this->banksoal_model->getlist_options($id)->result_array();
			$this->template->display('master/banksoal/detail', $data);
		}else{
			$this->access->redirect('404');
		}
	}

	public function delete($id = 0){
		$res = array();
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($id==$idFilter) {
				$del = $this->banksoal_model->delete($id);
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

			redirect(base_url().'master/banksoal');
		}
		echo json_encode($res);
	}
	public function aktif($id = 0){
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->banksoal_model->aktif($id);
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


				redirect(base_url().'master/banksoal');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}

}

?>