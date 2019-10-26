<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kamar extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/kamar_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/kamar/index', $data);
	}

	
	public function create(){
		if($this->access->permission('create')){
			if($post = $this->input->post()){
				$datarooms = array(
					'ROOMS_NAME'			=> isset($post['add_name'])?$post['add_name']:'',
					'ROOMS_NUMBER' 			=> isset($post['add_number'])?$post['add_number']:'',
					'ROOMS_CAPACITY'		=> isset($post['add_capacity'])?$post['add_capacity']:'',
					'ROOMS_CREATE_BY'		=> $this->session->userdata('user_id'),
					'ROOMS_CREATE_DATE'		=> date('Y-m-d H:i:s'),
					'ROOMS_STATUS' 			=> 1
				);
				// echo"<pre>";print_r($post); print_r($datainstansi);die;
				$insDb = $this->kamar_model->add($datarooms);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Penambahan Data Ruanan Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kamar/detail/'.$insDb);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Penambahan Data Ruangan gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kamar');
				}
			}else{
				$data = array();
				$this->template->display('master/kamar/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	
	public function update($id){
		if($this->access->permission('update')){
			if($post = $this->input->post()){
				$datapost = array(
						'ROOMS_NAME' 			=> isset($post['update_name'])?$post['update_name']:'',
						'ROOMS_CAPACITY'			=> isset($post['update_capacity'])?$post['update_capacity']:'',
						'ROOMS_NUMBER' 		=> isset($post['update_number'])?$post['update_number']:''
					);
				$id=isset($post['id_room'])?$post['id_room']:'';
				$insDb = $this->kamar_model->update($datapost, $id);
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Pengubahan Data Kamar Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kamar/detail/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Pengubahan Data Kamar , silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/kamar');
				}
			}else{
				$data = array();
				$data['rooms'] = $this->kamar_model->getDetail($id)->row_array();
				$this->template->display('master/kamar/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	
	public function detail($id=0){
		if($this->access->permission('read')){
			$data['rooms']= $this->kamar_model->getDetail($id)->row_array();
			$this->template->display('master/kamar/detail', $data);
		}
	}

	public function listdataaktif(){

		$status="";
		$default_order = "ROOMS_IS_FULL";
		$limit = 10;

		$order_field 	= array(
			'ROOMS_IS_FULL',
			'ROOMS_NAME',
			'ROOMS_NUMBER',
			'ROOMS_CAPACITY',
			'ROOMS_STATUS_NAME'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->kamar_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->kamar_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->kamar_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$checkout = ($row["ROOMS_IS_FULL"] == 1 ? '<a href="'.base_url().'master/kamar/chekout/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Chekout" data-placement="top"><i class="icon-exit"></i></a>':'');
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["ROOMS_NAME"],
				$row["ROOMS_NUMBER"],
				$row["ROOMS_CAPACITY"],
				$row["ROOMS_STATUS_NAME"],
				$checkout.
				'<a href="'.base_url().'master/kamar/detail/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'master/kamar/update/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'master/kamar/delete/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "ROOMS_NAME";
		$limit = 10;

		$order_field 	= array(
			'ROOMS_ID',
			'ROOMS_NAME',
			'ROOMS_NUMBER',
			'ROOMS_CAPACITY'
			//'ROOMS_STATUS_NAME',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->kamar_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->kamar_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->kamar_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["ROOMS_NAME"],
				$row["ROOMS_NUMBER"],
				$row["ROOMS_CAPACITY"],
				//$row["ROOMS_STATUS_NAME"],
				'<a href="'.base_url().'master/kamar/detail/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/kamar/aktif/'.$row["ROOMS_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// function upload() 
	// {
		
	// 	if ($this->access->permission('create')){

	// 		redirect('login/failed');

	// 	}
		
	// 	$tz_string = "Asia/Jakarta"; // Use one from list of TZ names http://php.net/manual/en/timezones.php 
	// 	$tz_object = new DateTimeZone($tz_string); 
			
	// 	$datetime = new DateTime(); 
	// 	$datetime->setTimezone($tz_object);  
    
	// 	$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'/'.folder_name().'upload/users/'; 
	// 	$config['allowed_types'] = '*';
	// 	$config['max_size']  = '10000'; 
	// 	$this->load->library('upload', $config);
		
	// 	if ( ! $this->upload->do_upload())
	// 	{	 
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$this->session->set_flashdata('alert', "0,$error");	 
	// 		//print_r($error);
			
	// 		redirect('users');
	// 	} 
	// 	else
	// 	{	
  
	// 		$upload_data = $this->upload->data(); 
	// 		$nama_lama =  $upload_data['file_name'];
	// 		$nama_baru =  'Users_'. $datetime->format('Y.m.d') . '-' . $datetime->format("H.i.s") .'-'.  $upload_data['file_ext'] ;
			
	// 		//upload gede
	// 		rename($config['upload_path'] . $nama_lama, $config['upload_path'] . $nama_baru);
			 
	// 		//upload thumb 
	// 		$fileNameResize = $config['upload_path'].$upload_data['file_name'];
			 
	// 		$resize = array(
	// 			"width"         => 24,
	// 			"height"        => 24,
	// 			"quality"        => '100%',
	// 			"source_image"    => $config['upload_path'] . $nama_baru,
	// 			"new_image"        => $config['upload_path'] . 'thumb_24/' . $nama_baru
	// 		);
	// 		$this->image_lib->initialize($resize); 
			
	// 		if(!$this->image_lib->resize())					
	// 			die($this->image_lib->display_errors());
			 
	// 		//upload thumb 
	// 		$fileNameResize = $config['upload_path'].$upload_data['file_name'];
			 
	// 		$resize = array(
	// 			"width"         => 300,
	// 			"height"        => 300,
	// 			"quality"        => '100%',
	// 			"source_image"    => $config['upload_path'] . $nama_baru,
	// 			"new_image"        => $config['upload_path'] . 'thumb_300/' . $nama_baru
	// 		);
	// 		$this->image_lib->initialize($resize); 
			
	// 		if(!$this->image_lib->resize())					
	// 			die($this->image_lib->display_errors());
				
	// 		$data['foto'] = $nama_baru;
			
	// 		$data['userid'] = $this->input->post('userid2'); 
			  
	// 		$data['muid'] = get_instance()->session->userdata('userid');
			
	// 		$data['mdate'] = $datetime->format('Y.m.d') . '-' .  $datetime->format("H.i.s"); 
			 
	// 		$this->mdl_users->update($data['userid'],$data);

	// 		$this->session->set_flashdata('alert', "1,Data berhasil diubah.");		
			
	// 		redirect('users');

	// 	}

	// }

	
	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->kamar_model->delete($id);
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

				redirect(base_url().'master/kamar');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->kamar_model->aktif($id);
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


				redirect(base_url().'master/kamar');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}

	public function chekout($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($id==$idFilter) {
			$this->kamar_model->chekout($id);
		}
		redirect(base_url().'master/kamar');		
	}
}