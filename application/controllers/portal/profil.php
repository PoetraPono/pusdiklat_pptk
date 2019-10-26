<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/profil_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		redirect(base_url()."portal/profil/about");
	}
	public function about(){
		if($this->access->permission('create') && $this->access->permission('update')){
			$data = array();
			$data['getlists'] = $this->profil_model->getlists()->result_array();
			// echo "<pre>";
			// print_r($data);die;
			// [PROFIL_ID]
			// [PROFIL_NAME]
			// [PROFIL_DESC]
			// [PROFIL_CREATED] 
			// [PROFIL_CREATE_DATE] 
			// [PROFIL_STATUS]
			// [PROFIL_LOG_ID] 
			// [PROFIL_LINK]
			$this->template->display('portal/profil/index', $data);
		} else {
			$this->access->redirect('404');			
		}
	}
	public function about_save($id=0){
		if($post = $this->input->post()){
			echo "<pre>";
			print_r($post);
			if($id==7){
				$video_file = $post['old_videos'];
			}else if($id==6){
				$video_file = $post['old_images'];
			}else{
				$video_file = NULL;
			}
			if(isset($_FILES["videos"]) && pathinfo($_FILES["videos"]['name'], PATHINFO_FILENAME)!=''){
				$config['upload_path'] = './assets/video/';
				$config['allowed_types'] = '*';
				$new_name = "profilvid_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "videos";
				$ifUpload = 0;
				if($this->upload->do_upload($field_name)){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "images/profil/" . $dataupdload["file_name"];
					$filename = pathinfo($_FILES["videos"]['name'], PATHINFO_FILENAME);
					@unlink('./'.$post['old_videos']);
					$video_file = 'assets/video/'.$new_name.'.'.(pathinfo($_FILES["videos"]['name'], PATHINFO_EXTENSION));
				}
			}
			if(isset($_FILES["images"]) && pathinfo($_FILES["images"]['name'], PATHINFO_FILENAME)!=''){
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = '*';
				$new_name = "profilvid_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "images";
				$ifUpload = 0;
				if($this->upload->do_upload($field_name)){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "images/profil/" . $dataupdload["file_name"];
					$filename = pathinfo($_FILES["images"]['name'], PATHINFO_FILENAME);
					@unlink('./'.$post['old_images']);
					$video_file = 'assets/images/'.$new_name.'.'.(pathinfo($_FILES["images"]['name'], PATHINFO_EXTENSION));
				}
			}
			// echo $video_file;
			$dataupdate = array(
				'PROFIL_DESC'		=> $post['description']!=""?$post['description']:'',
				'PROFIL_CREATED'	=> $this->session->userdata('user_id'),
				'PROFIL_LINK'		=> $video_file,
				'PROFIL_CREATE_DATE'=> date('Y-m-d H:i:s')
				);
			$istrue = $this->profil_model->updatedata($dataupdate,$id);

			if($istrue){			
				$allimgready = $this->profil_model->getlistimages($id)->result_array();
				$this->profil_model->destroydataimages($id);
				if(isset($post['kategori_gambar'])!=""){
					$gambars = $post['kategori_gambar'];
					$savedgambar = array();
					foreach ($gambars as $index => $v) {
						$config['upload_path'] = './images/profil/';
						$config['allowed_types'] = 'jpg|jpeg|jpe|png';
						$new_name = "profilimg_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						$field_name = "gambar_path".$index;
						$ifUpload = 0;
						if($this->upload->do_upload('gambar_path'.$index)){
							$dataupdload = $this->upload->data();
							$ifUpload = 1;
							$attach_path = "images/profil/" . $dataupdload["file_name"];
							$filename = pathinfo($_FILES["gambar_path".$index]['name'], PATHINFO_FILENAME);

							// $filename = $this->input->post('new_val');
						    /*$source_path = './' . $attach_path;
						    $target_path = './images/profil/thumbs/';
						    $config_manip = array(
						        'image_library' 	=> 'gd2',
						        'source_image' 		=> $source_path,
						        'new_image' 		=> $target_path,
						        'maintain_ratio' 	=> TRUE,
						        'create_thumb' 		=> TRUE,
						        'thumb_marker' 		=> '_thumb',
						        'width' 			=> 400,
						        'height' 			=> 400
						    );
						    $this->load->library('image_lib', $config_manip);
						    if (!$this->image_lib->resize()) {
						        echo $this->image_lib->display_errors();
						    }
							$this->image_lib->clear();*/
						    // clear //
						}else{
							$attach_path = isset($post['filessss_'.$index])?'images/profil/'.$post['filessss_'.$index]:'';
							$filename = isset($post['filename_'.$index])?$post['filename_'.$index]:'';
							// $error = array('error' => $this->upload->display_errors());
							// print_r($error);
							// echo 'error';die();
						}
						$savedgambar[] = $attach_path;
						$datacreate = array(
							'IMG_PROFIL_ID'		=> $id,
							'IMG_DESCRIPTION'	=> $filename,
							'IMG_CATEGORY'		=> $v,
							'IMG_PATH'			=> $attach_path,
							'IMG_STATUS'		=> 1,
							'IMG_CREATE_BY'		=> $this->session->userdata('user_id'),
							'IMG_CREATE_DATE'	=> date('Y-m-d H:i:s')
							);
						$imgistrue = $this->profil_model->createimages($datacreate,$id);
					}
					if(count($savedgambar)>0){
						// echo "<pre>";print_r($savedgambar);
						// echo "<hr>";
						// echo "<pre>";print_r(array_column($allimgready, 'IMG_PATH') );
						// echo "<hr>";
						
						foreach ($allimgready as $k => $v) {
							if(!in_array($v['IMG_PATH'], $savedgambar) ){
								// echo $v['IMG_PATH']."<br>";
								@unlink('./'.$v['IMG_PATH']);
							}
						}
					}
				}

				// die;
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message'	=> 'Perubahan Profil Sejarah berhasil ditambahkan.',
					'status' 	=> 'success'
				);
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message'	=> 'Perubahan Profil Sejarah gagal, harap coba kembali.',
					'status' 	=> 'error'
				);
			}
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/profil');
		}else{
			$notify = array(
				'title' 	=> 'Gagal!',
				'message'	=> 'Perubahan Profil Sejarah gagal, harap coba kembali.',
				'status' 	=> 'error'
			);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/profil');
		}
	}
	public function json_getimages($id=0){
		echo json_encode($this->profil_model->getlistimages($id)->result_array());
	}
					// $getlist_lampiran = $this->persetujuan_model->getlist_lampiran($_id, 1)->result_array();
					// if($this->input->post('new_ket_lampiran')){
					// 	$ket_lampir = $this->input->post('new_ket_lampiran');
					// 	$key_gllampiran = array_column($getlist_lampiran, 'ID');
					// 	$key_lampir=array_keys($ket_lampir);

					// 	foreach ($getlist_lampiran as $no => $dt) {
					// 		$config['upload_path'] = './assets/upload/attachments/';
					// 		$config['allowed_types'] = '*';
					// 		$new_name = "SPKA_AT_".time()."_".$dt['ID'];
					// 		$config['file_name'] = $new_name;
					// 		$this->load->library('upload', $config);
					// 		$this->upload->initialize($config);
					// 		$field_name = "new_file_lampiran_".$dt['ID'];
					// 		$ifUpload = 0;
					// 		$ext = "";
					// 		$attach_path = "";
					// 		if($this->upload->do_upload('new_file_lampiran_'.$dt['ID'])){
					// 			$dataupdload = $this->upload->data();
					// 			$ext = $dataupdload["file_ext"];
					// 			$ifUpload = 1;
					// 			$attach_path = "assets/upload/attachments/" . $dataupdload["file_name"];
					// 			if(isset($dt['FILE_PATH'])!=''){
					// 				@unlink("./".$dt['FILE_PATH']);
					// 			}
					// 		}else{
					// 			//echo 'error';die();
					// 			$attach_path = isset($post['filessss_'.$dt['ID']])?$dt['FILE_PATH']:'';
					// 			// $error = array('error' => $this->upload->display_errors());
					// 			// print_r($error);
					// 		}

					// 		if (in_array($dt['ID'], $key_lampir)){
					// 			$data_lampir = array(
					// 				'CODE'			=> 1,
					// 				'LETTER_ID'		=> $_id,
					// 				'FILE_PATH'		=> $attach_path,
					// 				'DESCRIPTION'	=> $ket_lampir[$dt['ID']],
					// 				'CREATE_BY'		=> $this->session->userdata('user_id'),
					// 				'CREATE_DATE'	=> date('Y-m-d H:i:s'),
					// 				'STATUS'		=> 1
					// 			);
					// 			$this->persetujuan_model->upd_lampiran($data_lampir, $dt['ID']);
					// 		}else{
					// 			if(isset($dt['FILE_PATH'])!=''){
					// 				@unlink("./".$dt['FILE_PATH']);
					// 			}
					// 			$this->make_history($_id, 'menghapus lampiran Surat Permohonan dengan keterangan: '. $ket_lampir[$dt['ID']]);
					// 			$this->persetujuan_model->del_lampiran($dt['ID']);
					// 		}
					// 	}
					// 	foreach ($ket_lampir as $no => $dt) {
					// 		if(!in_array($no, $key_gllampiran)){
					// 			$config['upload_path'] = './assets/upload/attachments/';
					// 			$config['allowed_types'] = '*';
					// 			$new_name = "SPKA_AT_".time()."_".$no;
					// 			$config['file_name'] = $new_name;
					// 			$this->load->library('upload', $config);
					// 			$this->upload->initialize($config);
					// 			$field_name = "new_file_lampiran_".$no;
					// 			$ifUpload = 0;
					// 			$ext = "";
					// 			$attach_path = "";
					// 			if($this->upload->do_upload('new_file_lampiran_'.$no)){
					// 				$dataupdload = $this->upload->data();
					// 				$ext = $dataupdload["file_ext"];
					// 				$ifUpload = 1;
					// 				$attach_path = "assets/upload/attachments/" . $dataupdload["file_name"];
					// 				$this->make_history($_id, 'menghapus lampiran Surat Permohonan dengan keterangan: '. $dt);
					// 			}else{
					// 				$attach_path = isset($post['filessss_'.$no])?'assets/upload/attachments/'.$post['filessss_'.$no]:'';
					// 				// $error = array('error' => $this->upload->display_errors());
					// 			}
					// 			$data_lampir = array(
					// 				'CODE'			=> 1,
					// 				'LETTER_ID'		=> $_id,
					// 				'FILE_PATH'		=> $attach_path,
					// 				'DESCRIPTION'	=> $dt,
					// 				'CREATE_BY'		=> $this->session->userdata('user_id'),
					// 				'CREATE_DATE'	=> date('Y-m-d H:i:s'),
					// 				'STATUS'		=> 1
					// 			);
					// 			$this->persetujuan_model->add_lampiran($data_lampir);
					// 		}
					// 	}
					// }else{
					// 	foreach ($getlist_lampiran as $dt) {
					// 		if(isset($dt['FILE_PATH'])!=''){
					// 			@unlink("./".$dt['FILE_PATH']);
					// 		}
					// 		$this->persetujuan_model->del_lampiran($dt['ID']);
					// 	}
					// 	$this->make_history($_id, 'menghapus semua lampiran Surat Permohonan');
					// }




	/*function update($pggna_id = 0){
		if($this->access->permission('read')){

			if($post = $this->input->post()){
				
				// $getSys = $this->pengguna_model->getSysUser($pggna_id)->row_array();

				// $dataupdateemployee = array(
				// 	'employee_fullname' 		=> isset($post['add_name'])?$post['add_name']:'',
				// 	'employee_nip'				=> isset($post['add_nip'])?$post['add_nip']:'',
				// 	'employee_is_redaktur'		=> isset($post['add_redaktur'])?$post['add_redaktur']:'',
				// 	'employee_address'			=> isset($post['add_address'])?$post['add_address']:'',
				// 	'employee_phone' 			=> isset($post['add_phone'])?$post['add_phone']:'',
				// 	'employee_email' 			=> isset($post['email2'])?$post['email2']:'',
				// 	'employee_update_by'		=> $this->session->userdata('user_id'),
				// 	'employee_update_date'		=> date('Y-m-d H:i:s')
				// 	);
				// $this->pengguna_model->updateemployee($dataupdateemployee,$getSys['user_employee_id']);
				// $dataupdate = array(
				// 	'user_access_id' 			=> isset($post['add_accld'])?$post['add_accld']:'',
				// 	'user_update_by' 			=> $this->session->userdata('user_id'),
				// 	'user_update_date' 			=> date('Y-m-d H:i:s')
				// 	);


				// $insDb = $this->pengguna_model->update($dataupdate, $pggna_id);

				// if($insDb > 0){
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Perubahan pengguna Berhasil',
						'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/profil');
				// }else{
				// 	$notify = array(
				// 		'title' 	=> 'Gagal!',
				// 		'message'	=> 'Perubahan pengguna gagal, silahkan coba lagi',
				// 		'status' 	=> 'error'
				// 		);
				// 	$this->session->set_flashdata('notify', $notify);
				// 	redirect(base_url().'pengaturan/pengguna');
				// }
			}

			$data = array();
			// $data['getDetail']  	= $this->pengguna_model->getDetail($pggna_id)->row_array();
			// $data['accList']  		= $this->pengguna_model->getListAcc()->result_array();
			// $data['List']  			= $this->pengguna_model->ListAcc()->row_array();
			$this->template->display('portal/profil/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}*/

	/*public function create(){
		if($this->access->permission('create')){
			
			if($post = $this->input->post()){

				
				// $datapostemployee = array(
				// 	'employee_fullname' 		=> isset($post['add_name'])?$post['add_name']:'',
				// 	'employee_nip'				=> isset($post['add_nip'])?$post['add_nip']:'',
				// 	'employee_is_redaktur'		=> isset($post['add_redaktur'])?$post['add_redaktur']:'',
				// 	'employee_address'			=> isset($post['add_address'])?$post['add_address']:'',
				// 	'employee_phone' 			=> isset($post['add_phone'])?$post['add_phone']:'',
				// 	'employee_email' 			=> isset($post['email2'])?$post['email2']:'',
				// 	'employee_create_by'		=> $this->session->userdata('user_id'),
				// 	'employee_create_date'		=> date('Y-m-d H:i:s'),
				// 	'employee_status' 			=> 1
				// 	);

				// $employeeid = $this->pengguna_model->addemployee($datapostemployee);
				// if($employeeid > 0){
				// 	$datapost = array(
				// 		'user_name' 				=> isset($post['add_username'])?$post['add_username']:'',
				// 		'user_password'				=> isset($post['password'])?passwordEncoder($post['password']):'',
				// 		'user_access_id' 			=> isset($post['add_accld'])?$post['add_accld']:'',
				// 		'user_employee_id' 			=> $employeeid,
				// 		'user_create_by' 			=> $this->session->userdata('user_id'),
				// 		'user_create_date' 			=> date('Y-m-d H:i:s'),
				// 		'user_status' 				=> 1
				// 		);
				// 	$insDb = $this->pengguna_model->add($datapost,$datapostemployee);
				// 	if($insDb > 0){
						$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Tambah Pengguna Berhasil',
							'status' 	=> 'success'
							);
						$this->session->set_flashdata('notify', $notify);
						
						redirect(base_url().'portal/profil');
				// 	}else{
				// 		$notify = array(
				// 			'title' 	=> 'Gagal!',
				// 			'message' 	=> 'Tambah Pengguna gagal, silahkan coba lagi',
				// 			'status' 	=> 'error'
				// 			);
				// 		$this->session->set_flashdata('notify', $notify);

				// 		redirect(base_url().'pengaturan/pengguna');
				// 	}
				// }else{
				// 	$notify = array(
				// 		'title' 	=> 'Gagal!',
				// 		'message' 	=> 'Tambah Pengguna gagal, silahkan coba lagi',
				// 		'status' 	=> 'error'
				// 		);
				// 	$this->session->set_flashdata('notify', $notify);

				// 	redirect(base_url().'pengaturan/pengguna');
				// }
			}
			
			$data = array();
			// $data['accList']  	= $this->pengguna_model->getListAcc()->result_array();
			$this->template->display('portal/profil/create', $data);
		} else {
			$this->access->redirect('404');
		}
	}*/

	/*public function detail($id=0){
		if($this->access->permission('read')){
			$user = $this->pengguna_model->getDetail($id)->row_array();
			$data["pengguna"] = $user;
			$this->template->display('portal/profil/detail', $data);
		}
	}*/

	/*public function listdataaktif(){
		$default_order = "user_name";
		$limit = 10;

		$order_field 	= array(
			'user_id',
			'user_name',
			'access_name',
			'user_status_name',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pengguna_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pengguna_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->pengguna_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["user_name"],
				$row["access_name"],
				$row["user_status_name"],
				'<a href="'.base_url().'pengaturan/pengguna/detail/'.$row["user_id"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'pengaturan/pengguna/update/'.$row["user_id"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'pengaturan/pengguna/delete/'.$row["user_id"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "user_name";
		$limit = 10;

		$order_field 	= array(
			'user_id',
			'user_name',
			'access_name',
			'user_status_name',
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->pengguna_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->pengguna_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->pengguna_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["user_name"],
				$row["access_name"],
				$row["user_status_name"],
				'<a href="'.base_url().'pengaturan/pengguna/detail/'.$row["user_id"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'pengaturan/pengguna/aktif/'.$row["user_id"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}*/

	/*public function delete($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'user_update_by' 			=> $this->session->userdata('user_id'),
					'user_update_date' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->pengguna_model->deleteuser($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'portal/profil');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'portal/profil');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/profil');
		}
	}

	public function aktif($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'user_update_by' 			=> $this->session->userdata('user_id'),
					'user_update_date' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->pengguna_model->aktifuser($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'portal/profil');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'portal/profil');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/profil');
		}
	}*/
}