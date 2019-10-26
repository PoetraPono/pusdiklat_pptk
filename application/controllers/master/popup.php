<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('master/popup_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('master/popup/index', $data);
	}
	

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["popup"] = $this->popup_model->getDetail($id)->row_array();
			// $data["sig"] = $this->popup_model->getSignature($id)->row_array();
			$this->template->display('master/popup/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "POPUP_ID";
		$limit = 10;

		$order_field 	= array(
			'POPUP_ID',
			'POPUP_IMAGE_PATH',
			'POPUP_DESC',
			'POPUP_SHOW'
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->popup_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->popup_model->count_all($search,$order_field);

		$aaData = array();
		$getData 	= $this->popup_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();

		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aksi = ($row['POPUP_SHOW']==1) ? '<a data-status="0" data-link="master/popup/delete/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip show_confirm" data-original-title="Sembunyikan" data-placement="top"><i class="icon-close"></i></a>':'<a href="'.base_url().'master/popup/aktif/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Tampilkan" data-placement="top"><i class="icon-checkmark3"></i></a>';
				$aaData[] = array(
				'<center>'.$no.'</center>',
				"<img src=".base_url().$row['POPUP_IMAGE_PATH']." class=\'img-thumbnail\' style=\'width:80px;height:60px; align:center;\'>",
				$row["POPUP_DESC"],
				($row['POPUP_SHOW']==1) ? "<i class='icon-checkmark3'></i>":"",
				'<a href="'.base_url().'master/popup/detail/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> 
				<a href="'.base_url().'master/popup/update/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Ubah popup" data-placement="top"><i class="icon-pencil"></i></a> '.$aksi
				
				);

			$no++;
		}
		// die;
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function listdatanonaktif(){
		$default_order = "POPUP_ID";
		$limit = 10;

		$order_field 	= array(
			'POPUP_ID',
			'POPUP_IMAGE_PATH',
			'POPUP_DESC',
			'POPUP_SHOW'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->popup_model->count_allnonaktif($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->popup_model->count_allnonaktif($search,$order_field);


		$aaData = array();
		$getData 	= $this->popup_model->get_paged_listnonaktif($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$aaData[] = array(
				'<center>'.$no.'</center>',
				"<img src=".base_url().$row['POPUP_IMAGE_PATH']." class=\'img-thumbnail\' style=\'width:80px;height:60px;\'>",
				$row["POPUP_DESC"],
				($row['POPUP_SHOW']==1) ? "<center><i class='fa fa-check'></i></center>":"",
				'<a href="'.base_url().'master/popup/detail/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a> '.
				'<a href="'.base_url().'master/popup/aktif/'.$row["POPUP_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function create(){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/uploads/popup/';
				$config['allowed_types'] = 'jpg|png';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				$insDb = 0;
				$error = 0;
				if($this->upload->do_upload('gambar_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "assets/uploads/popup/".$dataupdload["file_name"];
					$insDb = 1;
				}else{
					//$error = array('error' => $this->upload->display_errors());
					$error = $this->upload->display_errors();
				}

				$datacreate = array(
						'POPUP_DESC'					=> isset($post['POPUP_DESC'])?$post['POPUP_DESC']:'',
						'POPUP_IMAGE_PATH' 				=> $imgpath,
						'POPUP_SHOW'					=> isset($post['POPUP_SHOW'])?$post['POPUP_SHOW']:'',
						'POPUP_STATUS' 					=> 1
				);
		
				$this->popup_model->add($datacreate);
			
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Upload File Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'master/popup/');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> $error,
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/popup');
				}

			} else {
				$data = array();
				$this->template->display('master/popup/create', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}


	public function update($id){
		if($this->access->permission('update')){	
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/uploads/popup/';
				$config['allowed_types'] = 'jpg|png';
				$new_name = time()."_"."popup";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				$dataupdate = array(
						'POPUP_DESC'					=> isset($post['POPUP_DESC'])?$post['POPUP_DESC']:'',
						//'POPUP_IMAGE_PATH' 				=> $imgpath,
						//'POPUP_SHOW'					=> isset($post['POPUP_SHOW'])?$post['POPUP_SHOW']:'',
						
				);
				if($this->upload->do_upload('gambar_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "/assets/uploads/popup/" . $dataupdload["file_name"];
					$dataupdate = array(
						'POPUP_DESC'					=> isset($post['POPUP_DESC'])?$post['POPUP_DESC']:'',
						'POPUP_IMAGE_PATH' 				=> $imgpath
						//'POPUP_SHOW'					=> isset($post['POPUP_SHOW'])?$post['POPUP_SHOW']:'',
						
					);
				}else{
					$error = array('error' => $this->upload->display_errors());
				}

				
				//echo '<pre>';
				//print_r($dataupdate);die();
				$insDb = $this->popup_model->update($dataupdate, $id);

				// echo '<pre>';
				// print_r($dataupdate);die();
				if ($insDb > 0) {
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Ubah  data Berhasil',
						'status' 	=> 'success'
					);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/popup');
				}else{

					$notify = array(
						'title' 	=> 'Gagal!',
						'message' 	=> 'Ubah  data gagal, silahkan coba bebrapa saat lagi',
						'status' 	=> 'success'
					);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'master/popup');
				}
				
				
			} else {
				$data = array();
				$data['popup'] = $this->popup_model->getDetail($id)->row_array();
				$this->template->display('master/popup/update', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}


	function download($id){
        $memberid = $this->session->userdata('user_id');
        $idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        require("engine/phpDocx.php");
        //echo file_get_contents("file/temp_kontrak.docx"); die;
        //$this->load->library("docxgen-master/phpdocx");
        $part = $this->popup_model->getPartcicpantSert($id,$memberid)->row_array();
        $prog = $this->popup_model->getProgramSert($part['PROPAR_PROGRAM_ID'])->row_array();
        $sert = $this->popup_model->getDetailSert($part['PROPAR_PROGRAM_ID'])->row_array();
        // echo '<pre>';
        // print_r($sert); die;
        
        $tgl = date('d M Y', strtotime($prog['PROGRAM_START']))." s.d ". date('d M Y', strtotime($prog['PROGRAM_END']));
        $phpdocx = new phpdocx("engine/template_popup.docx");
        $phpdocx->assign("#NAMAPESERTA#",strtoupper($part['MEMBER_NAME']));
        $phpdocx->assign("#NAMAPROGRAM#",strtoupper($prog['PROGRAM_NAME']));
        $phpdocx->assign("#TANGGALPROGRAM#",$tgl);
        $phpdocx->assign("#TTDJABATAN1#",$sert['SIGNATURE_JABATAN1']);
        $phpdocx->assign("#TTDJABATAN2#",$sert['SIGNATURE_JABATAN2']);
        $phpdocx->assign("#TTDNAMA1#",$sert['SIGNATURE_NAME1']);
        $phpdocx->assign("#TTDNAMA2#",$sert['SIGNATURE_NAME2']);

        $phpdocx->download("Sertfikat-".$id.".docx");

    }




public function delete($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'POPUP_CREATE_BY' 				=> $this->session->userdata('user_id'),
					'POPUP_CREATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->popup_model->delete($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'master dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'master/popup');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'master gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'master/popup');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'master gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'master/popup');
		}
	}

	public function aktif($pggna_id = 0){

		$pggna_idFilter = filter_var($pggna_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($pggna_id==$pggna_idFilter) {

				$dataupdate = array(
					'POPUP_CREATE_BY' 			=> $this->session->userdata('user_id'),
					'POPUP_CREATE_DATE' 		=> date('Y-m-d H:i:s')
					);

				$del = $this->popup_model->aktif($pggna_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'master diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'master/popup');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'master gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'master/popup');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'master gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'master/popup');
		}
	}

	function convertToPdf (){
		$output_dir = BASEPATH."third_party";
	    $doc_file = BASEPATH."third_party/test.docx";
	    $pdf_file = "test.pdf";
	    $output_file = $output_dir . $pdf_file;
	    $doc_file = "file:///" . $doc_file;
	    $output_file = "file:///" . $output_file;
	    $this->word2pdf($doc_file,$output_file);
	}
	function MakePropertyValue($name,$value,$osm){
    	$oStruct = $osm->Bridge_GetStruct("com.sun.star.beans.PropertyValue");
    	$oStruct->Name = $name;
    	$oStruct->Value = $value;
    	return $oStruct;
    }
    function word2pdf($doc_url, $output_url){
    //echo $output_url;
    //Invoke the OpenOffice.org service manager
    $osm = new COM("com.sun.star.ServiceManager") or die ("Please be sure that OpenOffice.org is installed.\n");
    //Set the application to remain hidden to avoid flashing the document onscreen
    $args = array(MakePropertyValue("Hidden",true,$osm));
    //Launch the desktop
    $oDesktop = $osm->createInstance("com.sun.star.frame.Desktop");
    //Load the .doc file, and pass in the "Hidden" property from above
    $oWriterDoc = $oDesktop->loadComponentFromURL($doc_url,"_blank", 0, $args);
    //Set up the arguments for the PDF output
    $export_args = array($this->MakePropertyValue("FilterName","writer_pdf_Export",$osm));
    //print_r($export_args);
    //Write out the PDF
    $oWriterDoc->storeToURL($output_url,$export_args);
    $oWriterDoc->close(true);
    }
    

}



