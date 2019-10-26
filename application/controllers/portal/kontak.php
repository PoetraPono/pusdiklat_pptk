<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/kontak_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		if($this->access->permission('create') || $this->access->permission('update')){	
			if($post = $this->input->post()){
				// echo "<pre>";print_r($post);die;
				$insDb = 0;
				foreach ($post as $k => $v) {
					$insDb = $this->kontak_model->update($v,$k);
					if($insDb<1){
						$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Beberapa Perubahan data Gagal, silahkan periksa dan coba lagi',
							'status' 	=> 'error'
						);
						$this->session->set_flashdata('notify', $notify);
						redirect(base_url().'portal/kontak');
					}
				}
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/kontak/');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/kontak');
				}

			} else {
				$data = array();
				$data['datakontak'] = $this->kontak_model->getlist()->result_array();
				$data['dataimg'] 	= $this->kontak_model->getlistofficeimg()->result_array();
				$this->template->display('portal/kontak/index', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}
	public function saveimg(){
		// echo "<pre>";print_r(count($_FILES));die;
		if(count($_FILES)>0){
			$imgistrue = 0;
			foreach ($_FILES as $k => $v) {
				// echo json_encode($k);die;

				$config['upload_path'] = './assets/uploads/kontak/';
				$config['allowed_types'] = 'jpg|jpeg|jpe|png';
				$new_name = "officeimg_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = $k;
				$ifUpload = 0;
				if($this->upload->do_upload($k)){
					$dataupdload = $this->upload->data();
					$ifUpload = 1;
					$attach_path = "assets/uploads/kontak/" . $dataupdload["file_name"];
					// echo $attach_path."<br>";
					$datacreate = array(
						'OFCIMG_FILE'			=> $attach_path,
						'OFCIMG_STATUS'			=> 1,
						'OFCIMG_CREATE_BY'		=> $this->session->userdata('user_id'),
						'OFCIMG_CREATE_DATE'	=> date('Y-m-d H:i:s')
						);
					$imgistrue = $this->kontak_model->addimages($datacreate);
				}else{
					$notify = array(
						'title' 	=> 'Gagal!',
						'message'	=> 'Beberapa gambar gagal disimpan, silahkan periksa dan coba lagi',
						'status' 	=> 'error'
					);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/kontak');
					// $error = array('error' => $this->upload->display_errors());
					// print_r($error);
					// echo 'error';die();
				}
			}
			if($imgistrue>0){
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message'	=> 'Penambahan Gambar Berhasil',
					'status' 	=> 'success'
				);
				$this->session->set_flashdata('notify', $notify);redirect(base_url().'portal/kontak');
			}else{			
				$notify = array(
					'title' 	=> 'Gagal!',
					'message'	=> 'Penambahan Gambar gagal, silahkan coba lagi',
					'status' 	=> 'error'
				);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'portal/kontak');
			}
		}else{
			$notify = array(
				'title' 	=> 'Gagal!',
				'message'	=> 'Penambahan Gambar gagal, silahkan coba lagi',
				'status' 	=> 'error'
			);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/kontak');
		}
	}
	public function delete($id = 0){
		$res = array();
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($id==$idFilter) {
				$act = $this->kontak_model->update(array('CONTACT_STATUS'=>0), $id);
				if($act>0) {
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Data berhasil dihapus',
						'status' 	=> 'success'
					);
				} else {
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Gagal!',
						'message' 	=> 'Data gagal dihapus, coba lagi!',
						'status' 	=> 'error'
					);
				}
			} else {
				$res = array(
					'update'	=> $act,
					'title' 	=> 'Gagal!',
					'message' 	=> 'Data gagal dihapus, coba lagi!',
					'status' 	=> 'error'
				);
			}

			redirect(base_url().'portal/kontak');
		}
		echo json_encode($res);
	}

	public function active($id = 0){
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->kontak_model->update(array('CONTACT_STATUS'=>1), $id);
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
			redirect(base_url().'portal/kontak');
		}
		echo json_encode($res);
	}
	public function deleteIMG($id = 0){
		$res = array();
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($id==$idFilter) {
				$act = $this->kontak_model->updimages($id, array('OFCIMG_STATUS'=>0));
				if($act>0) {
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Data berhasil dihapus',
						'status' 	=> 'success'
					);
				} else {
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Gagal!',
						'message' 	=> 'Data gagal dihapus, coba lagi!',
						'status' 	=> 'error'
					);
				}
			} else {
				$res = array(
					'update'	=> $act,
					'title' 	=> 'Gagal!',
					'message' 	=> 'Data gagal dihapus, coba lagi!',
					'status' 	=> 'error'
				);
			}

			redirect(base_url().'portal/kontak');
		}
		echo json_encode($res);
	}
	public function activeIMG($id = 0){
		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->kontak_model->updimages($id, array('OFCIMG_STATUS'=>1));
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
			redirect(base_url().'portal/kontak');
		}
		echo json_encode($res);
	}
	public function destroyIMG($id = 0){
		$dataimg = $this->kontak_model->getimages($id)->row_array();
		if($dataimg){
			$hasdropped = $this->kontak_model->dropimages($id);
			@unlink("./".$dataimg['OFCIMG_FILE']);
			if($hasdropped){			
				$notify = array(
					'title' 	=> 'Sukses!',
					'message'	=> 'Penghapusan Gambar berhasil',
					'status' 	=> 'success'
				);
			}else{			
				$notify = array(
					'title' 	=> 'Gagal!',
					'message'	=> 'Penghapusan Gambar gagal, silahkan coba lagi',
					'status' 	=> 'error'
				);
			}
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/kontak');			
		}else{
			$notify = array(
				'title' 	=> 'Gagal!',
				'message'	=> 'Penghapusan Gambar gagal, silahkan coba lagi',
				'status' 	=> 'error'
			);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/kontak');			
		}
	}
}