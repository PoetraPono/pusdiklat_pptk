<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller{

	private $limit=10;

	function __construct(){
		parent:: __construct();
		$this->load->model('portal/gallery_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('portal/gallery/index', $data);
	}

	function update($gallID = 0){
		if($this->access->permission('read')){
			if($post = $this->input->post()){
				$dataupdate = array(
                   	'GALLERIES_TITLE' 		        => isset($post['GALLERIES_TITLE'])?$post['GALLERIES_TITLE']:'',
					'GALLERIES_DESC' 		        => isset($post['GALLERIES_DESC'])?$post['GALLERIES_DESC']:'',
					'GALLERIES_DATE'				=> date("Y-m-d", strtotime($this->input->post('GALLERIES_DATE'))),
					);

				$insDb = $this->gallery_model->update($dataupdate, $gallID);


				if($insDb>0){
					if($_FILES['gbr-image']['name'][0]!=''){
						$files = $_FILES;
						$cpt = count($_FILES['gbr-image']['name']);
						$galeri_type = $post['image_type'];
						//$data = array();
					    for($i = 0; $i < $cpt; $i ++) {

					        $_FILES['gbr-image']['name'] = $files['gbr-image']['name'][$i];
					        $_FILES['gbr-image']['type'] = $files['gbr-image']['type'][$i];
					        $_FILES['gbr-image']['tmp_name'] = $files['gbr-image']['tmp_name'][$i];
					        $_FILES['gbr-image']['error'] = $files['gbr-image']['error'][$i];
					        $_FILES['gbr-image']['size'] = $files['gbr-image']['size'][$i];
					       
					        $this->load->library('upload');
					        $new_name = time()."_0".$i;				
					        $this->upload->initialize($this->set_upload_options($new_name));
					        if($this->upload->do_upload('gbr-image')){
						        $dataImg = array('upload_data' => $this->upload->data());
						        $filePath = 'assets/images/gallerys/';
						        $dataImg = array(
						        	'GALLERY_LIST_GALLERY_ID' => $gallID,
						        	//'GALLERY_LIST_IMAGE_DESC' => $dataImg['upload_data']['file_name'],
						        	'GALLERY_LIST_IMAGE_PATH' => $filePath.$dataImg['upload_data']['file_name'],
						        	'GALLERY_LIST_IMAGE_TYPE' => $galeri_type[$i],
						        	'GALLERY_LIST_STATUS' => 1
						        	);
						        $this->gallery_model->add_images($dataImg);
						    }

					    }
					}
				}


				if($insDb > 0){
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Perubahan Gallery Berhasil',
						'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'portal/gallery');
				}else{
					$notify = array(
						'title' 	=> 'Gagal!',
						'message'	=> 'Perubahan gallery gagal, silahkan coba lagi',
						'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'portal/gallery');
				}
			}

			$data = array();
			$data['getDetail']  	= $this->gallery_model->getDetail($gallID)->row_array();
			$data["gallerydetail"]= $this->gallery_model->getGalleryDetail($gallID)->result_array();
			$this->template->display('portal/gallery/update', $data);
		}else{
			$this->access->redirect('404');
		}
	}

	function updatedes($gallID = 0){
        $id = $this->input->post('GALLERY_LIST_GALLERY_ID');
        $data = array(
            'GALLERY_LIST_IMAGE_DESC'    => $this->input->post('gallery_detail_description'),
           
        );
        $this->gallery_model->updategallerydes($id, $data);
        echo json_encode(array("status" => TRUE));
	}

    public function ajax_edit($id)
    {
        $data = $this->gallery_model->getGalleryDetails($id)->row_array();
        echo json_encode($data);
    }
	
	public function create(){
		if($this->access->permission('create')){
			
			if($post = $this->input->post()){
				$datapostgallery = array(
					'GALLERIES_TITLE' 		        => isset($post['GALLERIES_TITLE'])?$post['GALLERIES_TITLE']:'',
					'GALLERIES_DESC' 		        => isset($post['GALLERIES_DESC'])?$post['GALLERIES_DESC']:'',
					'GALLERIES_DATE'				=> date("Y-m-d", strtotime($this->input->post('GALLERIES_DATE'))),
					'GALLERIES_CREATE_BY'		    => $this->session->userdata('user_id'),
					'GALLERIES_CREATE_DATE'			=> date('Y-m-d H:i:s'),
					'GALLERIES_STATUS' 				=> 1
					);

				$insDb = $this->gallery_model->addgallery($datapostgallery);
				$galeri_type = $post['image_type'];


				if($insDb>0){
					if($_FILES['gbr-image']['name'][0]!=''){
						$files = $_FILES;
						$cpt = count($_FILES['gbr-image']['name']);
						//$data = array();
					    for($i = 0; $i < $cpt; $i ++) {

					        $_FILES['gbr-image']['name'] = $files['gbr-image']['name'][$i];
					        $_FILES['gbr-image']['type'] = $files['gbr-image']['type'][$i];
					        $_FILES['gbr-image']['tmp_name'] = $files['gbr-image']['tmp_name'][$i];
					        $_FILES['gbr-image']['error'] = $files['gbr-image']['error'][$i];
					        $_FILES['gbr-image']['size'] = $files['gbr-image']['size'][$i];

					        $this->load->library('upload');
					        $new_name = time()."_0".$i;				
					        $this->upload->initialize($this->set_upload_options($new_name));
					        $this->upload->do_upload('gbr-image');

					        $dataImg = array('upload_data' => $this->upload->data());
					        $filePath = 'assets/images/gallerys/';
					        $dataImg = array(
					        	'GALLERY_LIST_GALLERY_ID' => $insDb,
					        	'GALLERY_LIST_IMAGE_PATH' => $filePath.$dataImg['upload_data']['file_name'],
					        	'GALLERY_LIST_IMAGE_TYPE' => $galeri_type[$i],
					        	'GALLERY_LIST_STATUS' => 1
					        	);
					        $this->gallery_model->add_images($dataImg);
					    }
					}
				}

		
					if($insDb > 0){
						$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Tambah Gallery Berhasil',
							'status' 	=> 'success'
							);
						$this->session->set_flashdata('notify', $notify);

						redirect(base_url().'portal/gallery');
					}else{
						$notify = array(
							'title' 	=> 'Gagal!',
							'message' 	=> 'Tambah Gallery gagal, silahkan coba lagi',
							'status' 	=> 'error'
							);
						$this->session->set_flashdata('notify', $notify);

						redirect(base_url().'portal/gallery');
					}
                echo json_encode(array("status" => TRUE));
				}

			$data = array();
			// $data['accList']  	= $this->gallery_model->getListAcc()->result_array();
			$this->template->display('portal/gallery/create', $data);
		} else {
			$this->access->redirect('404');
		}
							
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$gallery = $this->gallery_model->getDetail($id)->row_array();
			$data["gallery"] = $gallery;
            $gallerydetail = $this->gallery_model->getGalleryDetail($id)->result_array();
            $data["gallerydetail"]= $gallerydetail;
            //echo "<pre>"; print_r($data); die;
			$this->template->display('portal/gallery/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "GALLERIES_TITLE";
		$limit = 10;

		$order_field 	= array(
			'GALLERIES_ID',
			'GALLERIES_TITLE',
			//'GALLERIES_DESC',
			
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->gallery_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->gallery_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->gallery_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["GALLERIES_TITLE"],
                $row["GALLERIES_DESC"],
				date('d F Y', strtotime($row["GALLERIES_DATE"])),
				'<a href="'.base_url().'portal/gallery/detail/'.$row["GALLERIES_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'portal/gallery/update/'.$row["GALLERIES_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
				<a href="'.base_url().'portal/gallery/delete/'.$row["GALLERIES_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function listdatanonaktif(){
		$default_order = "GALLERIES_TITLE";
		$limit = 10;

		$order_field 	= array(
            'GALLERIES_ID',
            'GALLERIES_TITLE',
            //'GALLERIES_DESC',
            
          
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->gallery_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->gallery_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->gallery_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
                $row["GALLERIES_TITLE"],
                $row["GALLERIES_DESC"],
               date('d F Y', strtotime($row["GALLERIES_DATE"])),
                
				'<a href="'.base_url().'portal/gallery/detail/'.$row["GALLERIES_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'portal/gallery/aktif/'.$row["GALLERIES_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function ajax_delete($gallID = 0){

        $gallIDFilter = filter_var($gallID, FILTER_SANITIZE_NUMBER_INT);
        $data = array();
        $status = 0;
		if($this->access->permission('delete')) {
            if($gallID==$gallIDFilter) {

                $get    = $this->gallery_model->getGalleryDetails($gallID)->row_array();;
			    $file   = $get['GALLERY_LIST_IMAGE_PATH'];

				$del = $this->gallery_model->deletefoto($gallID);
				if( $del > 0){
                    $path_to_file = FCPATH.'/assets/images/gallerys/gallerydetails/'.$file;
                    unlink($path_to_file);
                    $notify = array(
                        'title' 	=> 'Berhasil!',
                        'message' 	=> 'Foto Berhasil Dihapus',
                        'status' 	=> 'success'
                    );
                    $this->session->set_flashdata('notify', $notify);
                    $status = 1;
				} else {
                    $notify = array(
                        'title' 	=> 'Gagal!',
                        'message' 	=> 'Gallery gagal dinonaktifkan',
                        'status' 	=> 'error'
                    );
                    $this->session->set_flashdata('notify', $notify);
                }
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Gallery gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Gallery gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
		}
		$data['status'] = $status;
		echo json_encode($data);
	}

	public function delete($gallID = 0){

        $gallIDFilter = filter_var($gallID, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($gallID==$gallIDFilter) {

				$dataupdate = array(
					 'GALLERIES_CREATE_BY' 				=> $this->session->userdata('user_id'),
                     'GALLERIES_CREATE_DATE' 			=> date('Y-m-d H:i:s')			
                     );

				$del = $this->gallery_model->deletegallery($gallID, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Gallery dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'portal/gallery');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Gallery gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'portal/gallery');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Gallery gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/gallery');
		}
	}

	public function aktif($gallID = 0){

        $gallIDFilter = filter_var($gallID, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($gallID==$gallIDFilter) {

				$dataupdate = array(
                    'GALLERIES_CREATE_BY' 				=> $this->session->userdata('user_id'),
                    'GALLERIES_CREATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->gallery_model->aktifgallery($gallID, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Gallery diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'portal/gallery');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Gallery gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'portal/gallery');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Gallery gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'portal/gallery');
		}
	}

	private function set_upload_options($name="") {
		$this->load->library('upload');
	    // upload an image options
	    $config = array ();
	    $config['upload_path'] = './assets/images/gallerys/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $name;
		$config['max_size']  = '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

	    return $config;
	}

	public function deletelist($id,$idlist){
		$this->gallery_model->deletelist($idlist);
		redirect(base_url().'portal/gallery/update/'.$id);
	}	
	public function upload($id){
        /**
         * upload.php
         *
         * Copyright 2013, Moxiecode Systems AB
         * Released under GPL License.
         *
         * License: http://www.plupload.com/license
         * Contributing: http://www.plupload.com/contributing
         */

#!! IMPORTANT:
#!! this file is just an example, it doesn't incorporate any security checks and
#!! is not recommended to be used in production environment as it is. Be sure to
#!! revise it and customize to your needs.


// Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        /*
        // Support CORS
        header("Access-Control-Allow-Origin: *");
        // other CORS headers if any...
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }
        */

// 5 minutes execution time
        @set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
        //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        $targetDir = '././assets/images/gallerys';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

// Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        //echo $fileName;
//        $id = $this->gallery_model->getId()->row_array();
//        $gallerydetailid = $id['gallery_id'];
//
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


// Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

// Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            $datapost = array(
                'GALLERY_LIST_GALLERY_ID'         => $id,
                'GALLERY_LIST_IMAGE_DESC'        => "Description",
                'GALLERY_LIST_IMAGE_PATH'          => $fileName
            );
            $insDb = $this->gallery_model->add($datapost);
        }

// Return Success JSON-RPC response

        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
}