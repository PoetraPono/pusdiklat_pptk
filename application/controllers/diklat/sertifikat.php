<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/sertifikat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/sertifikat/index', $data);
	}

	public function setting($id){
		if($this->access->permission('update')){	
			if($post = $this->input->post()){
				$dataupdate = array(
						'SERTIFIKAT_PROGRAM_ID' 		=> $id,
						'SERTIFIKAT_TYPE' 				=> isset($post['SERTIFIKAT_TYPE'])?$post['SERTIFIKAT_TYPE']:'',
						'SERTIFIKAT_SIGNATURE1' 		=> isset($post['SERTIFIKAT_SIGNATURE1'])?$post['SERTIFIKAT_SIGNATURE1']:'',
						'SERTIFIKAT_SIGNATURE2'			=> isset($post['SERTIFIKAT_SIGNATURE2'])?$post['SERTIFIKAT_SIGNATURE2']:'',
						'SERTIFIKAT_STATUS'				=> 1	
						
				);
	
				$insDb = $this->sertifikat_model->setting($dataupdate, $id);
				// echo "<pre>";
				// print_r($dataupdate);die;
				$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Ubah  data Berhasil',
						'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/sertifikat');
			} else {
				$data = array();
				// $data['sertifikat'] = $this->sertifikat_model->getDetail($id)->row_array();
				$data['program']= $this->sertifikat_model->getListProgram()->result_array();
				$data['sig']= $this->sertifikat_model->getListSignature()->result_array();
				$this->template->display('diklat/sertifikat/create', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}

	public function update($id){
		if($this->access->permission('update')){	
			if($post = $this->input->post()){
				$config['upload_path'] = './assets/images/file/';
				$config['allowed_types'] = 'gif|jpg|png';
				$new_name = time()."_";
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$field_name = "gambar_path";
				$ifUpload = 0;
				$ext = "";
				$imgpath="";
				if($this->upload->do_upload('gambar_path'))
				{
					$dataupdload = $this->upload->data();
					$ext = $dataupdload["file_ext"];
					$ifUpload = 1;
					$imgpath = "/assets/images/file/" . $dataupdload["file_name"];
				}else{
					$error = array('error' => $this->upload->display_errors());
				}

				$dataupdate = array(
						'SERTIFIKAT_TYPE' 				=> isset($post['SERTIFIKAT_TYPE'])?$post['SERTIFIKAT_TYPE']:'',
						'SERTIFIKAT_PROGRAM_ID' 		=> $id,
						'SERTIFIKAT_SIGNATURE1' 		=> isset($post['SERTIFIKAT_SIGNATURE1'])?$post['SERTIFIKAT_SIGNATURE1']:'',
						'SERTIFIKAT_SIGNATURE2'			=> isset($post['SERTIFIKAT_SIGNATURE2'])?$post['SERTIFIKAT_SIGNATURE2']:'',
						
				);
	
				$insDb = $this->sertifikat_model->update($dataupdate, $id);

				// echo '<pre>';
				// print_r($dataupdate);die();
				if ($insDb > 0) {
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Ubah  data Berhasil',
						'status' 	=> 'success'
					);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/sertifikat/detail/'.$id);
				}else{

					$notify = array(
						'title' 	=> 'Gagal!',
						'message' 	=> 'Ubah  data gagal, silahkan coba bebrapa saat lagi',
						'status' 	=> 'success'
					);

					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/sertifikat');
				}
				
				
			} else {
				$data = array();
				$data['sertifikat'] = $this->sertifikat_model->getDetail($id)->row_array();
				$data['program']= $this->sertifikat_model->getListProgram()->result_array();
				$data['sig']= $this->sertifikat_model->getListSignature()->result_array();
				$this->template->display('diklat/sertifikat/update', $data);
			}

		}else{
			$this->access->redirect('404');
		}
	}


	public function detail($id=0){
		if($this->access->permission('read')){
			$data["sertifikat"] = $this->sertifikat_model->getDetail($id)->row_array();
			// $data["sig"] = $this->sertifikat_model->getSignature($id)->row_array();
			$this->template->display('diklat/sertifikat/detail', $data);
		}
	}

	public function listdataaktif(){
		$default_order = "PROGRAM_ID";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'SERTIFIKAT_TYPE'
			
			
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->sertifikat_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->sertifikat_model->count_all($search,$order_field);

		$aaData = array();
		$getData 	= $this->sertifikat_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();

		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			// echo $row['SERTIFIKAT_TYPE']."<br>";
			$eksternal = "";
			if ($row['SERTIFIKAT_TYPE'] != '-') {
				$eksternal .= '<a href="'.base_url().'diklat/sertifikat/uploadfile/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat Sertifkat" data-placement="top"><i class="icon-upload"></i></a>';
			}

			if($row['SERTIFIKAT_STATUS'] == 'Sudah Di Atur'){

				$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SERTIFIKAT_TYPE"],
				'<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>',

				'<a href="'.base_url().'diklat/sertifikat/detail/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
				<a href="'.base_url().'diklat/sertifikat/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Ubah Sertifikat" data-placement="top"><i class="icon-pencil"></i></a>&nbsp;'.$eksternal);

			}else{

				$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SERTIFIKAT_TYPE"],
				'<i class="icon-spinner8 tip" data-original-title="Belum diatur" data-placement="top" style="color:orange;"></i>',

				'<a href="'.base_url().'diklat/sertifikat/detail/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>&nbsp;
				<a href="'.base_url().'diklat/sertifikat/setting/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Setting Sertifikat" data-placement="top"><i class="icon-wrench2"></i></a>'.$eksternal);

			}

			$no++;
		}
		// die;
		$data['aaData'] = $aaData;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function uploadfile($id){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				/*echo $post['PROPAR_MEMBER_ID'];
				print_r($_FILES);
				die();*/

				// $participant = $post['PROPAR_MEMBER_ID'];
				// $submit = $post['PROPAR_SUBMIT_DATE'];
				// $status = $post['PROPAR_STATUS'];

				$config['upload_path'] = './assets/uploads/file/';
				$config['allowed_types'] = 'pdf|doc|docx|jpg|png';
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
					// echo "keduie";die;
					$imgpath = "assets/uploads/file/".$dataupdload["file_name"];
					$insDb = 1;
				}else{
					//$error = array('error' => $this->upload->display_errors());
					$error = $this->upload->display_errors();
				}

				$fileupload = array(
						//'PROPAR_PROGRAM_ID'				=> $id,
						//'PROPAR_MEMBER_ID'				=> isset($post['PROPAR_MEMBER_ID'])?$post['PROPAR_MEMBER_ID']:'',
						'PROPAR_SERTIFIKAT_PATH' 		=> $imgpath,
						'PROPAR_STATUS' 				=> 1
				);
				$this->sertifikat_model->uploadfile($fileupload, $id);
				/*echo "<pre>";
				print_r($fileupload); 
				die();*/
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Upload File Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/sertifikat/uploadfile/'.$id);
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> $error,
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/sertifikat/uploadfile/'.$id);
				}

			} else {
				$data = array();
				$data['peserta'] = $this->sertifikat_model->getDetail($id)->row_array();
				$data['partisipan'] = $this->sertifikat_model->getListParticipant($id)->result_array();
				
				//echo "<pre>"; print_r($data); die;
				$this->template->display('diklat/sertifikat/uploadfile', $data);
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
        $part = $this->sertifikat_model->getPartcicpantSert($id,$memberid)->row_array();
        $prog = $this->sertifikat_model->getProgramSert($part['PROPAR_PROGRAM_ID'])->row_array();
        $sert = $this->sertifikat_model->getDetailSert($part['PROPAR_PROGRAM_ID'])->row_array();
        $modul = $this->sertifikat_model->getModulList($part['PROPAR_PROGRAM_ID'])->result_array();
        $nosertfikat = str_pad($part['PROPAR_ID'],6,"0",STR_PAD_LEFT)."/pusdiklatapuppt/". date('M/Y', strtotime($prog['PROGRAM_START']));
        $tgl_pelatihan = "";
        if($prog['PROGRAM_START']!="" and $prog['PROGRAM_END']!=""){
    		if($prog['PROGRAM_START']==$prog['PROGRAM_END']){
				$tgl_pelatihan = dateEnToId($prog['PROGRAM_START'], "d F Y");
    		}elseif(date("M", strtotime($prog['PROGRAM_START'])) == date("M", strtotime($prog['PROGRAM_END']))){
				$tgl_pelatihan = date("d", strtotime($prog['PROGRAM_START']))." s.d ".dateEnToId($prog['PROGRAM_END'], "d F Y");    
			}else{
				$tgl_pelatihan = dateEnToId($prog['PROGRAM_START'], "d F Y"). " s.d " .dateEnToId($prog['PROGRAM_END'], "d F Y");
    		}
    	}
      /*  echo '<pre>';
        print_r($modul); die;*/
        
        $tgl = date('d M Y', strtotime($prog['PROGRAM_START']))." s.d ". date('d M Y', strtotime($prog['PROGRAM_END']));
        $this->load->library('pdf');
        $this->pdf->pdf = new mPDF('c','A4-L','','Helvetica',12,12,10,10,10,10);
        //$this->pdf->pdf = new mPDF('utf-8', array(190,236));
        $html = '';
        $html .= '<p style="color:#FF4500; font-family: Courier New;">&nbsp;</p>';
        $html .= '<h2 style="margin-top:0px;margin-bottom:0;text-align:left; font-size:96px; color:#ffffff; font-family: Courier New;">SERTIFIKAT</h2>';
        $html .= '<h2 style="margin-top:-20px;text-align:left; font-size:20px; color:#ffffff; font-family: Courier New;">&nbsp;Nomor : '.$nosertfikat.'</h2>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p style="margin-top:0px;margin-bottom:0px;text-align:left; font-size:20px; color:#FF6347; font-family: Courier New;">DIBERIKAN KEPADA :</p>';
        $html .= '<h3 style="margin-top:0px;margin-bottom:0px;text-align:left;font-size:78px; color:#FF6347; font-family: Courier New;">'.$part["MEMBER_NAME"].'</h3>';
        $html .= '<h3 style="margin-top:0px;margin-bottom:0px;text-align:left;font-size:24px; color:#FF6347; font-family: Courier New;">Instansi : '.$part["INSTANSI_NAME"].'</h3>';
        $html .= '<p style="margin-top:20px;margin-bottom:0px;text-align:left; font-size:20px; color:#FF6347; font-family: Courier New;">SEBAGAI PESERTA DALAM PELATIHAN :</p>';
        $html .= '<p style="margin-top:0px;margin-bottom:0px;text-align:left;font-size:30px; color:#FF8C00; font-family: Courier New;">'.$prog["PROGRAM_NAME"].'</p>';
        $html .= '<p style="margin-top:0px;margin-bottom:20px;text-align:left; font-size:22px; color:#FF8C00; font-family: Courier New;">pada '.$tgl_pelatihan.' di Pusdiklat APU-PPT, Depok - Jawa Barat</p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $html .= '<p></p>';
        $footerhtml = '<p style="margin-top:0;margin-bottom:0px;text-align:center; padding-left:50%;font-size:28px; color:#FF6347; font-family: Courier New; font-weight:bold;"><u>'.$sert['SIGNATURE_NAME1'].'</u></p>';
        $footerhtml .= '<p style="margin-top:0px;margin-bottom:0px;text-align:center; padding-left:50%; 	font-size:20px; color:#FF6347; font-family: Courier New;">'.$sert['SIGNATURE_JABATAN1'].'</p>';
        $footerhtml .= '<p></p>';
        $this->pdf->pdf->SetWatermarkImage(base_url().'berkas/sertifikat_depan.jpg',1);
        $this->pdf->pdf->showWatermarkImage = true;
        $this->pdf->pdf->WriteHTML($html, 2);
        $this->pdf->pdf->SetHTMLFooter($footerhtml);
        $this->pdf->pdf->AddPage('c','A4-L','','Helvetica',12,12,10,10,10,10);
        $html = '';
    	$html .= '<p>&nbsp;</p>';
        $html .= '<p>&nbsp;</p>';
        $html .= '<p style="margin-top:0px;margin-bottom:0px;text-align:center; font-size:24px; color:#FF6347; font-family: Courier New;">Program Diklat</p>';
        $html .= '<p style="margin-top:0px;margin-bottom:0px;text-align:center; font-size:24px; color:#FF6347; font-family: Courier New;">'.$prog["PROGRAM_NAME"].'</p>';
        $html .= '<p></p>';
        $html .= '<table style="width:100%">';
		$html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td width="50%" valign="top">';
        $html .= '<table style="border: 1px solid #FF6347;border-collapse:collapse;width:100%; padding:20px; margin:20px;">';
        $html .= '<body>';
        $n = 0;
        $x = ceil((count($modul)/2));
        foreach ($modul as $k => $v) {
        	$no = $n+1;
        	if($k < $x){
	        	$html .= '<tr style="border: 1px solid #FF6347;text-align:left"><td valign="top" style="width:50px; border: 1px solid #FF6347; text-align:center; font-size:14px; color:#FF6347; font-family: Courier New; padding:5px;">'.$no.'</td><td valign="top" style="border: 1px solid #FF6347; text-align:left; font-size:14px; color:#FF6347; font-family: Courier New; padding:5px;">'.$v['SILABUS_NAME'].' '.$v['SILABUS_DESCRIPTION'].'</td></tr>';
	        	$n++;
        	}
        }
        $html .= '</body>';
        $html .= '</table>';
        $html .= '</td>';
        $html .= '<td width="50%" valign="top">';
        $html .= '<table style="border: 1px solid #FF6347;border-collapse:collapse;width:100%; padding:20px; margin:20px;">';
        $html .= '<body>';
        
        foreach ($modul as $k => $v) {
        	$no = $n+1;
        	if($k >= $x){
	        	$html .= '<tr style="border: 1px solid #FF6347;text-align:left"><td valign="top" style="width:50px; border: 1px solid #FF6347; text-align:center; font-size:14px; color:#FF6347; font-family: Courier New; padding:5px;">'.$no.'</td><td valign="top" style="border: 1px solid #FF6347; text-align:left; font-size:14px; color:#FF6347; font-family: Courier New; padding:5px;">'.$v['SILABUS_NAME'].' '.$v['SILABUS_DESCRIPTION'].'</td></tr>';
	        	$n++;
        	}
        }
        $html .= '</body>';
        $html .= '</table>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
       	$footerhtmlback = '<p style="margin-top:0;margin-bottom:0px;text-align:center; padding-left:50%;font-size:28px; color:#FF6347; font-family: Courier New; font-weight:bold;"><u>'.$sert['SIGNATURE_NAME2'].'</u></p>';
        $footerhtmlback .= '<p style="margin-top:0px;margin-bottom:0px;text-align:center; padding-left:50%; 	font-size:20px; color:#FF6347; font-family: Courier New;">'.$sert['SIGNATURE_JABATAN2'].'</p>';
        $footerhtmlback .= '<p></p>';
		
        $this->pdf->pdf->SetWatermarkImage(base_url().'berkas/sertifikat_belakang.jpg',1);
        $this->pdf->pdf->showWatermarkImage = true;

        $this->pdf->pdf->WriteHTML($html, 2);
        $this->pdf->pdf->SetHTMLFooter($footerhtmlback);
        $this->pdf->pdf->SetTitle('Sertifikat');
        $this->pdf->pdf->Output('Sertifikat '.time(), 'I');

    }

    function downloadbak($id){
        $memberid = $this->session->userdata('user_id');
        $idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        require("engine/phpDocx.php");
        //echo file_get_contents("file/temp_kontrak.docx"); die;
        //$this->load->library("docxgen-master/phpdocx");
        $part = $this->sertifikat_model->getPartcicpantSert($id,$memberid)->row_array();
        $prog = $this->sertifikat_model->getProgramSert($part['PROPAR_PROGRAM_ID'])->row_array();
        $sert = $this->sertifikat_model->getDetailSert($part['PROPAR_PROGRAM_ID'])->row_array();
        // echo '<pre>';
        // print_r($sert); die;
        
        $tgl = date('d M Y', strtotime($prog['PROGRAM_START']))." s.d ". date('d M Y', strtotime($prog['PROGRAM_END']));
        $phpdocx = new phpdocx("engine/template_sertifikat2.docx");
        $phpdocx->assign("#NAMAPESERTA#",strtoupper($part['MEMBER_NAME']));
        $phpdocx->assign("#NAMAPROGRAM#",strtoupper($prog['PROGRAM_NAME']));
        $phpdocx->assign("#TANGGALPROGRAM#",$tgl);
        $phpdocx->assign("#TTDJABATAN1#",$sert['SIGNATURE_JABATAN1']);
        $phpdocx->assign("#TTDJABATAN2#",$sert['SIGNATURE_JABATAN2']);
        $phpdocx->assign("#TTDNAMA1#",$sert['SIGNATURE_NAME1']);
        $phpdocx->assign("#TTDNAMA2#",$sert['SIGNATURE_NAME2']);

        $phpdocx->download("Sertfikat-".$id.".docx");

    }




	public function delete($peng_id = 0){

		$peng_idFilter = filter_var($peng_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('delete')) {
			if($peng_id==$peng_idFilter) {

				$dataupdate = array(
					'INSTRUCTOR_CREATE_BY' 				=> $this->session->userdata('user_id'),
					'INSTRUCTOR_CREATE_DATE' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->sertifikat_model->delete($peng_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna dinonaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/sertifikat');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal dinonaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/sertifikat');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal dinonaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/sertifikat');
		}
	}

	public function aktif($peng_id = 0){

		$peng_idFilter = filter_var($peng_id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($peng_id==$peng_idFilter) {

				$dataupdate = array(
					'user_update_by' 			=> $this->session->userdata('user_id'),
					'user_update_date' 			=> date('Y-m-d H:i:s')
					);

				$del = $this->sertifikat_model->aktif($peng_id, $dataupdate);
				$notify = array(
					'title' 	=> 'Berhasil!',
					'message' 	=> 'Pengguna diaktifkan',
					'status' 	=> 'success'
					);
				$this->session->set_flashdata('notify', $notify);

				redirect(base_url().'diklat/sertifikat');
			} else {
				$notify = array(
					'title' 	=> 'Gagal!',
					'message' 	=> 'Pengguna gagal diaktifkan',
					'status' 	=> 'error'
					);
				$this->session->set_flashdata('notify', $notify);
				redirect(base_url().'diklat/sertifikat');
			}
		} else {
			$notify = array(
				'title' 	=> 'Gagal!',
				'message' 	=> 'Pengguna gagal diaktifkan',
				'status' 	=> 'error'
				);
			$this->session->set_flashdata('notify', $notify);
			redirect(base_url().'diklat/sertifikat');
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



