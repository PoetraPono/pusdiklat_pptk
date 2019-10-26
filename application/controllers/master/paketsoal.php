<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paketsoal extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/paketsoal_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/paketsoal/index', $data);
	}

	public function listdataaktif(){
		$status="";
		$default_order = "PACKET_NAME";
		$limit = 10;

		$order_field 	= array(
			'PACKET_ID',
			'PACKET_NAME',
			);
		
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->paketsoal_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->paketsoal_model->count_all($search,$order_field);
		
		$aaData = array();
		$getData 	= $this->paketsoal_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		// echo "<pre>";print_r($getData);
		// die;

		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PACKET_NAME"],
				'<a href="'.base_url().'master/paketsoal/detail/'.$row["PACKET_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/paketsoal/update/'.$row["PACKET_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/paketsoal/delete/'.$row["PACKET_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function listdatanonaktif(){
		$status="";
		$default_order = "PACKET_NAME";
		$limit = 10;

		$order_field 	= array(
			'PACKET_ID',
			'PACKET_NAME',
			);
		
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->paketsoal_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->paketsoal_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->paketsoal_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PACKET_NAME"],
				'<a href="'.base_url().'master/paketsoal/detail/'.$row["PACKET_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/paketsoal/aktif/'.$row["PACKET_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listsoal(){
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
		$data['iTotalRecords'][] = $this->paketsoal_model->count_all_listsoal($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->paketsoal_model->count_all_listsoal($search,$order_field);
		
		$aaData = array();
		$getData 	= $this->paketsoal_model->get_paged_list_listsoal($limit, $start, $order, $sort, $search, $order_field)->result_array();

		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				'<span id="value_'.$row["QUESTION_ID"].'">'.$row["QUESTION_VALUE"].'</span>',
				'<button id="btnval_'.$row["QUESTION_ID"].'" onclick="catch_this('.$row["QUESTION_ID"].')" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Ambil Soal" data-placement="top"><i class="icon-plus"></i></button>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){

				// echo json_encode($post);die;
				$question = array(
					'PACKET_NAME'			=> $post['add_judul']!=""?$post['add_judul']:'null',
					'PACKET_CREATE_BY'		=> $this->session->userdata('user_id'),
					'PACKET_CREATE_DATE'	=> date('Y-m-d H:i:s'),
					'PACKET_STATUS'			=> 1
				);

				// print_r($question);echo '<hr><br>';
				$insDb = $this->paketsoal_model->add($question);
				// $insDb = "1";
				// echo $insDb;
				// die;
				if($insDb){
					foreach ($post['idpilihan'] as $k => $v) {
						// echo "<pre>";
						$detque = array(
							'DETPACK_PACKET_ID'		=> $insDb,
							'DETPACK_QUESTION_ID'	=> $v,
							'DETPACK_SORT'			=> $k,
							'DETPACK_STATUS'		=> 1
						);
						// print_r($detque);echo '<hr><br>';
						$insDbs = $this->paketsoal_model->adddetails($detque);
						if(!$insDbs){
							$notify = array(
								'title' 	=> 'Gagal!',
								'message'	=> 'Beberapa soal tidak tersimpan, mohon untuk cek dan update di menu update.',
								'status' 	=> 'error'
							);
							$this->session->set_flashdata('notify', $notify);
							redirect(base_url().'master/paketsoal');
						}
					}
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data Paket Soal gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/paketsoal');
				}
				// die();
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Penambahan Data Paket Soal Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'master/paketsoal');
			}else{
				$data = array();
				$this->template->display('master/paketsoal/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function update($id){
		if($this->access->permission('update')){
			if($post = $this->input->post()){		

				// echo json_encode($post); die;
				$question = array(
					'PACKET_NAME'			=> $post['add_judul']!=""?$post['add_judul']:'null',
					'PACKET_CREATE_BY'		=> $this->session->userdata('user_id'),
					'PACKET_CREATE_DATE'	=> date('Y-m-d H:i:s'),
					'PACKET_STATUS'			=> 1
				);

				// print_r($question);echo '<hr><br>';
				$insDb = $this->paketsoal_model->update($question, $id);
				// $insDb = "1";
				// echo $insDb;
				// die;
				$this->paketsoal_model->del_opt($id);
				if($insDb){
					foreach ($post['idpilihan'] as $k => $v) {
						// echo "<pre>";
						$detque = array(
							'DETPACK_PACKET_ID'		=> $id,
							'DETPACK_QUESTION_ID'	=> $v,
							'DETPACK_SORT'			=> $k,
							'DETPACK_STATUS'		=> 1
						);
						// print_r($detque);echo '<hr><br>';
						$insDbs = $this->paketsoal_model->adddetails($detque);
						if(!$insDbs){
							$notify = array(
								'title' 	=> 'Gagal!',
								'message'	=> 'Beberapa soal tidak tersimpan, mohon untuk cek dan update di menu update.',
								'status' 	=> 'error'
							);
							$this->session->set_flashdata('notify', $notify);
							redirect(base_url().'master/paketsoal');
						}
					}
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data Paket Soal gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/paketsoal');
				}
				// die();
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Penambahan Data Paket Soal Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'master/paketsoal');
			}else{
				$data = array();
				$data['paketsoal'] 		= $this->paketsoal_model->get($id)->row_array();
				$data['detailpaket'] 	= $this->paketsoal_model->getlist_detail($id)->result_array();
				// echo json_encode($data['detailpaket']);die;
				$this->template->display('master/paketsoal/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function detail($id){
		if($this->access->permission('read')){
			$data = array();
			$data['paketsoal'] 		= $this->paketsoal_model->get($id)->row_array();
			$data['detailpaket'] 	= $this->paketsoal_model->getlist_detail($id)->result_array();
			$this->template->display('master/paketsoal/detail', $data);
		}else{
			$this->access->redirect('404');
		}
	}

	public function delete($id = 0){
		$res = array();
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($id==$idFilter) {
				$del = $this->paketsoal_model->delete($id);
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

			redirect(base_url().'master/paketsoal');
		}
		echo json_encode($res);
	}
	public function aktif($id = 0){
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->paketsoal_model->aktif($id);
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


				redirect(base_url().'master/paketsoal');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}

}

?>