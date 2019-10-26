<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluasi extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/evaluasi_model');
		$this->load->model('diklat/diklat_model');
		$this->load->model('diklat/testing_model');
		$this->load->model('report_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/evaluasi/index', $data);
	}

	public function listdataaktif(){

		$status="";
		$default_order = "PROGRAM_ID";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->evaluasi_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->evaluasi_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->evaluasi_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {

			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				'<a href="'.base_url().'diklat/evaluasi/detail/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="lihat" data-placement="top"><i class="icon-file6"></i></a> <a href="'.base_url().'diklat/evaluasi/printPDF/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download PDF Hasil Evaluasi" target="_blank" data-placement="top"><i class="icon-file-pdf"></i></a> <a href="'.base_url().'diklat/evaluasi/printExcel/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download Excel Hasil Evaluasi" target="_blank" data-placement="top"><i class="icon-file-excel"></i></a>');
			$no++;
		}
		$data['aaData'] = $aaData;
		//echo '<pre>'; print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

    public function listdataavaluasi($id = 0){

        $status="";
        $default_order = "EVALUASI_ID";
        $limit = 10;

        $order_field 	= array(
            'EVALUASI_ID',
            'MEMBER_NAME',
            'EVALUASI_NILAI_INDEX',
            'EVALUASI_PROSENTASE'

        );
        $order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
        $order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
        $sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
        $search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
        $search 	= xss_remover($search);
        $limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
        $start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
        $data['sEcho'] = $this->input->get('sEcho');
        $data['iTotalRecords'][] = $this->evaluasi_model->count_all_detail($search,$order_field, $id);
        $data['iTotalDisplayRecords'][] = $this->evaluasi_model->count_all_detail($search,$order_field, $id);


        $aaData = array();
        $getData 	= $this->evaluasi_model->get_paged_list_detail($limit, $start, $order, $sort, $search, $order_field, $id)->result_array();
        $no = (($start == 0) ? 1 : $start + 1);
        foreach ($getData as $row) {

            $aaData[] = array(
                '<center>'.$no.'</center>',
                $row["MEMBER_NAME"],
                $row["INSTANSI_NAME"],
                $row["EVALUASI_IND_MODUL"],
				$row["EVALUASI_PRO_MODUL"],
				$row["EVALUASI_IND_WIDYAISWARA"],
				'<a href="javascipt:void();" onclick="showDetail('.$row['EVALUASI_PROGRAM_ID'].','.$row["MEMBER_ID"].')">'.$row["EVALUASI_PRO_WIDYAISWARA"].'</a>',
				$row["EVALUASI_IND_KELAS"],
				$row["EVALUASI_PRO_KELAS"],
				$row["EVALUASI_IND_MAKANAN"],
				$row["EVALUASI_PRO_MAKANAN"],
				$row["EVALUASI_IND_PENUNJANG"],
				$row["EVALUASI_PRO_PENUNJANG"],
                $row["EVALUASI_NILAI_INDEX"],
                $row["EVALUASI_PROSENTASE"]);
            $no++;
        }
        $data['aaData'] = $aaData;
		//echo '<pre>'; print_r($data);die();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function detail($id=0){
		if($this->access->permission('read')){
		    $data['program'] = $this->evaluasi_model->getDetail($id)->row_array();
		    $data['all'] = $this->evaluasi_model->getRataAll($id)->row_array();
		    $peserta = $this->evaluasi_model->getEvalPeserta($id)->result_array();
		    if(count($peserta) > 0){
		    	$modul = $this->evaluasi_model->getEvalModul($id)->result_array();
		    }else{
		    	$modul = $this->evaluasi_model->getRefEvalModul()->result_array();
		    }
		    $data['modul'] = $modul;
		    foreach ($peserta as $k => $v) {
		    	$peserta[$k]['evalmodul'] = $this->evaluasi_model->getEvalPesertaModul($id,$v['EVALUASI_MEMBER_ID'])->result_array();
		    }
		    $data['peserta'] = $peserta;
		    //echo "<pre>"; print_r($data); die;
			$this->template->display('diklat/evaluasi/detail', $data);
		}
	}

	public function showdetail($id=0,$memberid=0){
		$hasil = $this->evaluasi_model->detailRateInstructor($id,$memberid)->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
		
	}

	public function printExcel($id){
		//echo $str = chr(68); die;
		$this->load->library('PHPExcel');
			$styleBorder = array(
		      	'borders' => array(
		        	'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN
		          	)
		      	)
		  	);
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()
					->setCreator($this->session->userdata('user_fullname'))
					->setLastModifiedBy($this->session->userdata('user_fullname'))
					->setTitle("EVALUASI DIKLAT")
					->setSubject("HASIL EVALUASI DIKLAT");
		$diklat = $this->diklat_model->getDetail($id)->row_array();
		$participant = $this->evaluasi_model->getEvalPeserta($id)->result_array();
		
		if(count($participant) > 0){
		
			$modul = $this->evaluasi_model->getEvalModul($id)->result_array();
		    foreach ($participant as $k => $v) {
		    	$participant[$k]['evalmodul'] = $this->evaluasi_model->getEvalPesertaModul($id,$v['EVALUASI_MEMBER_ID'])->result_array();
		    }
		    //echo "<pre>"; print_r($participant); die;
			$all = $this->evaluasi_model->getRataAll($id)->row_array();
			$tgl_pelatihan = "";
	    	if($diklat['PROGRAM_START']!="" and $diklat['PROGRAM_END']!=""){
	    		if($diklat['PROGRAM_START']==$diklat['PROGRAM_END']){
					$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");
	    		}elseif($diklat['PROGRAM_START']==""){
					$tgl_pelatihan = dateEnToId($diklat['PROGRAM_END'], "d F Y");    			
	    		}elseif($diklat['PROGRAM_END']==""){
					$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");    			
	    		}else{
					$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y"). " s.d " .dateEnToId($diklat['PROGRAM_END'], "d F Y");
	    		}
	    	}

	    	

			/*$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);*/


			$objPHPExcel->getActiveSheet()->mergeCells('A1:O1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:O2');
			$objPHPExcel->getActiveSheet()->mergeCells('A3:O3');

			$objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
			$objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
			$objPHPExcel->getActiveSheet()->mergeCells('C4:C5');

			$objPHPExcel->getActiveSheet()->mergeCells('D4:F4');
			$objPHPExcel->getActiveSheet()->mergeCells('G4:I4');
			$objPHPExcel->getActiveSheet()->mergeCells('J4:L4');
			$objPHPExcel->getActiveSheet()->mergeCells('M4:N4');

			$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("A1", "DAFTAR HASIL EVALUASI DIKLAT")	
			        ->setCellValue("A2", "Nama Program : ".$diklat['PROGRAM_NAME'])	
			        ->setCellValue("A3", 'Dari Tanggal: '.$tgl_pelatihan)	

			        ->setCellValue("A4", "No.")	
			        ->setCellValue("B4", "Nama Peserta")	
			        ->setCellValue("C4", "Instansi")

			        ->setCellValue("D4", "Materi")	
			        ->setCellValue("D5", "I")	
			        ->setCellValue("E5", "P(%)")	
			        ->setCellValue("F5", "K&S")

			        ->setCellValue("G4", "Pengajar")	
			        ->setCellValue("G5", "I")	
			        ->setCellValue("H5", "P(%)")	
			        ->setCellValue("I5", "K&S")

			        ->setCellValue("J4", "Penyelenggaraan")	
			        ->setCellValue("J5", "I")	
			        ->setCellValue("K5", "P(%)")	
			        ->setCellValue("L5", "K&S")

			        ->setCellValue("M4", "Total")	
			        ->setCellValue("M5", "I")	
			        ->setCellValue("N5", "P(%)")	
			        ;	

	        $baris=6;
	        $no=1;
	        foreach ($participant as $k => $v) {
	        	$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("A".$baris, $no)	
			        ->setCellValue("B".$baris, $v['MEMBER_NAME'])	
			        ->setCellValue("C".$baris, $v['INSTANSI_NAME'])
			        ;	
			        $xz = 68*1;
			        foreach ($v['evalmodul'] as $n => $m) {
			        	$str1 = chr($xz);
			        	$str2 = chr($xz+1);
			        	$str3 = chr($xz+2);
			        	$objPHPExcel->setActiveSheetIndex(0)
				        ->setCellValue($str1.$baris, $m['EVALUASI_MODUL_INDEX'])	
				        ->setCellValue($str2.$baris, $m['EVALUASI_MODUL_PROSEN'])
				        ->setCellValue($str3.$baris, $m['EVALUASI_MODUL_NOTED'])
				        ;
				        $xz++;
				        $xz++;
				        $xz++;
			        }
			    $str4 = chr($xz);
			    $str5 = chr($xz+1);   
			    $objPHPExcel->setActiveSheetIndex(0)
			        //->setCellValue("A".$baris, $no)	
			        ->setCellValue($str4.$baris, $v['EVALUASI_NILAI_INDEX'])	
			        ->setCellValue($str5.$baris, $v['EVALUASI_PROSENTASE'])
			        ;    
		       $baris++;
		       $no++;
	        }
	        $objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("C".$baris, "TOTAL KESELURUHAN")			        
			        ;
			$nz = 68*1;
	        foreach ($modul as $k => $v) {
	        	$str1 = chr($nz);
	        	$str2 = chr($nz+1);
	        	$str3 = chr($nz+2);
	        	$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue($str1.$baris, $v['EVALUASI_INDEX'])	
		        ->setCellValue($str2.$baris, $v['EVALUASI_PROSEN'])
		        //->setCellValue($str3.$baris, $m['EVALUASI_MODUL_NOTED'])
		        ;
		        $nz++;
		        $nz++;
		        $nz++;
	        }        
	        $str4 = chr($xz);
		    $str5 = chr($xz+1);   
		    $objPHPExcel->setActiveSheetIndex(0)
		       // ->setCellValue("A".$baris, $no)	
		        ->setCellValue($str4.$baris, $all['EVALUASI_NILAI_INDEX'])	
		        ->setCellValue($str5.$baris, $all['EVALUASI_PROSENTASE'])
		        ;    
	        $objPHPExcel->getActiveSheet()->getStyle('A4:N4')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getstyle('A1')->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->setTitle('EVALUASI DIKLAT');
			$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A4:N5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A4:N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A6:N'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);	
			$objPHPExcel->getActiveSheet()->getstyle('A6:A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getstyle('B6:C'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getstyle('D6:E'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getstyle('F6:F'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getstyle('G6:H'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getstyle('I6:I'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getstyle('J6:K'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getstyle('L6:L'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getstyle('M6:N'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//$objPHPExcel->getActiveSheet()->getstyle('O6:N'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			//$baris = $baris - 1;
			$objPHPExcel->getActiveSheet()->getStyle('A4:N'.$baris)->applyFromArray($styleBorder);
			$baris++;
			$baris++;
			$pengajar = $this->evaluasi_model->detailRateInstructor($id,0)->result_array();
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, "HASIL EVALUASI WIDYAISWARA");
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':E'.$baris);	
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$baris++;
			$fbaris = $baris;
			$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("A".$baris, "No.")	
			        ->setCellValue("B".$baris, "Nama Peserta")	
			        ->setCellValue("C".$baris, "Instansi")
			        ;
			$nz = 68*1;   
			foreach ($pengajar as $o => $p) {
				$name = ($p['INSTRUCTOR_FIRST_TITLE'] != '') ? $p['INSTRUCTOR_FIRST_TITLE']." ":"";
				$name .= ($p['INSTRUCTOR_NAME'] != '') ? $p['INSTRUCTOR_NAME']."":"";
				$name .= ($p['INSTRUCTOR_LAST_TITLE'] != '') ? ", ".$p['INSTRUCTOR_LAST_TITLE']:"";
				$str1 = chr($nz);
				$str2 = chr($nz+1);
				$baris1 = $baris;
				$baris2 = $baris+1;
				$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue($str1.$baris1, $name)	
			        ->setCellValue($str1.$baris2, "I")	
			        ->setCellValue($str2.$baris2, "P(%)")	
			    ;	
			    $objPHPExcel->getActiveSheet()->mergeCells($str1.$baris1.':'.$str2.$baris1);	
				/*echo $str1.$baris1."->".$name; 
				echo "<br>";*/
			    $nz++;
			    $nz++;
			}		
			//die;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':A'.($baris+1));	
			$objPHPExcel->getActiveSheet()->mergeCells('B'.$baris.':B'.($baris+1));	
			$objPHPExcel->getActiveSheet()->mergeCells('C'.$baris.':C'.($baris+1));	
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);	
			$objPHPExcel->getActiveSheet()->getstyle('A'.$baris.':Z'.($baris+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':Z'.$baris)->getFont()->setBold(true);
			$baris++;
			$baris++;
			$no = 1;
			foreach ($participant as $k => $v) {
	        	$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("A".$baris, $no)	
			        ->setCellValue("B".$baris, $v['MEMBER_NAME'])	
			        ->setCellValue("C".$baris, $v['INSTANSI_NAME'])
			        ;	
			        $nz = 68*1;
			        $hasil = $this->evaluasi_model->detailRateInstructor($id,$v["EVALUASI_MEMBER_ID"])->result_array();
				    foreach ($hasil as $o => $z) {					
						$str1 = chr($nz);
						$str2 = chr($nz+1);
						$objPHPExcel->setActiveSheetIndex(0)
					        ->setCellValue($str1.$baris, $this->numberformat($z["NILAI_INDEX"]))	
					        ->setCellValue($str2.$baris, $this->numberformat($z["NILAI_PROSEN"]))	
					    ;	
					    $nz++;
					    $nz++;
					}	
				$no++;
				$baris++;	
			}
			$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue("C".$baris, "TOTAL KESELURUHAN")
			        ;	
			$nz = 68*1;
			$lastchar = 68;
			foreach ($pengajar as $n => $z) {			    	
				$str1 = chr($nz);
				$str2 = chr($nz+1);
				$objPHPExcel->setActiveSheetIndex(0)
			        ->setCellValue($str1.$baris, $this->numberformat($z["NILAI_INDEX"]))	
			        ->setCellValue($str2.$baris, $this->numberformat($z["NILAI_PROSEN"]))	
			    ;	
			    $nz++;
			    $lastchar = $nz;
			    $nz++;

			}
			$lastcol = chr($lastchar);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fbaris.':'.$lastcol.$baris)->applyFromArray($styleBorder);
		}else{
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "DAFTAR HASIL EVALUASI DIKLAT BELUM TERSEDIA");
			$objPHPExcel->getActiveSheet()->mergeCells('A1:O1');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		}
		//$objPHPExcel->setActiveSheetIndex(0);
		ob_end_clean();//IMPORTANT!!!
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="HASIL EVALUASI DIKLAT.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	
	public function printPDF($id){
		/*$number = 100.0000000000000;
		if (preg_match('/\.\d{0,}/', $number)) {
		    echo number_format((float)$number, 2, '.', '');
		} else {
		    echo (int)$number;
		}
		die;*/
		$this->load->library('pdf');
		$this->pdf->pdf = new mPDF('c','A4-L','','Helvetica');
		$diklat = $this->diklat_model->getDetail($id)->row_array();
		$participant = $this->evaluasi_model->getEvalPeserta($id)->result_array();
		$modul = $this->evaluasi_model->getEvalModul($id)->result_array();
	    foreach ($participant as $k => $v) {
	    	$participant[$k]['evalmodul'] = $this->evaluasi_model->getEvalPesertaModul($id,$v['EVALUASI_MEMBER_ID'])->result_array();
	    }
	    
		$all = $this->evaluasi_model->getRataAll($id)->row_array();
		$tgl_pelatihan = "";
    	if($diklat['PROGRAM_START']!="" and $diklat['PROGRAM_END']!=""){
    		if($diklat['PROGRAM_START']==$diklat['PROGRAM_END']){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");
    		}elseif($diklat['PROGRAM_START']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_END'], "d F Y");    			
    		}elseif($diklat['PROGRAM_END']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");    			
    		}else{
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y"). " s.d " .dateEnToId($diklat['PROGRAM_END'], "d F Y");
    		}
    	}
    	$htmlpdf = "";
    	// $htmlpdf .= '<h2 style="text-transform: uppercase;text-align:center"><small>DATA KAMAR</small></h2>';
    	// $htmlpdf .= '<br>';
    	$htmlpdf .= '<h3 style="text-align:center;">HASIL EVALUASI DIKLAT</h3><br/><br/>';
    	$htmlpdf .= '<table style="border-top: 1px solid black; border-bottom: 1px solid black;width:100%">
    					<tbody>
    						<tr>
    							<td valign="top" width="25%">Nama Program</td>
    							<td valign="top" width="2%">:</td>
    							<td valign="top">'. (($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-") .'</td>
    						</tr>
    						<tr>
    							<td valign="top">Deskripsi Program</td>
    							<td valign="top">:</td>
    							<td valign="top">'. (($diklat['PROGRAM_DESCRIPTION']!="")?$diklat['PROGRAM_DESCRIPTION']:"-") .'</td>
    						</tr>
    						<tr>
    							<td valign="top">Tanggal Pelatihan</td>
    							<td valign="top">:</td>
    							<td valign="top">'. $tgl_pelatihan .'</td>
    						</tr>    						
    					</tbody>
    				</table>';
    	$htmlpdf .= '<br>';
    	if(count($participant) > 0){
	    	$htmlpdf .= '<h5 style="text-align:center;">HASIL EVALUASI KESELURUHAN</h5>';
			$htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%;font-size:11px;">
							<thead>
								<tr>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="5%">No.</th>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="20%">Nama Peserta</th>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="15%">Instansi</th>';
						foreach ($modul as $k => $v) {
							$htmlpdf .= '<th colspan="2" style="border: 1px solid black;padding:5px;text-align:center">'.$v['EVALUASI_POINT_NAME'].'</th>';
						}
						$htmlpdf .= '<th colspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="10%">Total</th>
								</tr>
								<tr>';
						foreach ($modul as $k => $v) {
							$htmlpdf .= '<th style="border: 1px solid black;padding:5px;text-align:center">I</th>
									<th style="border: 1px solid black;padding:5px;text-align:center">P (%)</th>';
						}								
						$htmlpdf .= '<th style="border: 1px solid black;padding:5px;text-align:center">I</th>
									<th style="border: 1px solid black;padding:5px;text-align:center">P (%)</th>
								</tr>
							</thead>
							<tbody>';
	    	$no = 1;
		    foreach ($participant as $k => $v) {	
				$htmlpdf .= '<tr style="vertical-align:top;">
	    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$no.'</td>    					
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v["MEMBER_NAME"].'</td> 
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v["INSTANSI_NAME"].'</td>';
				foreach ($v['evalmodul'] as $n => $m) {			
					$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$m["EVALUASI_MODUL_INDEX"].'</td>
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$m["EVALUASI_MODUL_PROSEN"].'</td>';
				}
							
				$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$v["EVALUASI_NILAI_INDEX"].'</td> 
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$v["EVALUASI_PROSENTASE"].'</td>
							</tr>';
				$no++;
		    }
		    $htmlpdf .= '<tr style="vertical-align:top;">
	    					<td colspan="3" valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>TOTAL KESELURUHAN</b></td>';
	    	foreach ($modul as $k => $v) {
	    		$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$v["EVALUASI_INDEX"].'</b></td> 
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$v["EVALUASI_PROSEN"].'</b></td>';
	    	}				
				$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$all["EVALUASI_NILAI_INDEX"].'</b></td> 
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$all["EVALUASI_PROSENTASE"].'</b></td>
							</tr>';
		    $htmlpdf .= '</tbody></table><br/>';

		    $pengajar = $this->evaluasi_model->detailRateInstructor($id,0)->result_array();

	    	$htmlpdf .= '<h5 style="text-align:center;">HASIL EVALUASI WIDYAISWARA</h5>';
			$htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%;font-size:11px;">
							<thead>
								<tr>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="5%">No.</th>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="20%">Nama Peserta</th>
									<th rowspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="15%">Instansi</th>';
					foreach ($pengajar as $o => $p) {
						$name = ($p['INSTRUCTOR_FIRST_TITLE'] != '') ? $p['INSTRUCTOR_FIRST_TITLE']." ":"";
						$name .= ($p['INSTRUCTOR_NAME'] != '') ? $p['INSTRUCTOR_NAME']."":"";
						$name .= ($p['INSTRUCTOR_LAST_TITLE'] != '') ? ", ".$p['INSTRUCTOR_LAST_TITLE']:"";
						$htmlpdf .= '<th colspan="2" style="border: 1px solid black;padding:5px;text-align:center" width="15%">'.$name.'</th>';
					}			
					$htmlpdf .= '</tr><tr>';
					foreach ($pengajar as $o => $p) {
						$htmlpdf .= '<th style="border: 1px solid black;padding:5px;text-align:center">I</th>
									<th style="border: 1px solid black;padding:5px;text-align:center">P</th>';
					}
					$htmlpdf .= '</tr>
							</thead>
							<tbody>';
	    	$no = 1;
		    foreach ($participant as $k => $v) {	
		    	$hasil = $this->evaluasi_model->detailRateInstructor($id,$v["EVALUASI_MEMBER_ID"])->result_array();
				$htmlpdf .= '<tr style="vertical-align:top;">
	    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$no.'</td>    					
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v["MEMBER_NAME"].'</td> 
							<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v["INSTANSI_NAME"].'</td>';
				foreach ($hasil as $n => $z) {
					$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$this->numberformat($z["NILAI_INDEX"]).'</td> 
								<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$this->numberformat($z["NILAI_PROSEN"]).'</td>';
				}
				$htmlpdf .= '</tr>';
				$no++;
		    }
		    $htmlpdf .= '<tr style="vertical-align:top;">
	    					<td colspan="3" valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>TOTAL KESELURUHAN</b></td>';
			foreach ($pengajar as $n => $z) {
					$htmlpdf .= '<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$this->numberformat($z["NILAI_INDEX"]).'</b></td> 
								<td valign="top" style="border: 1px solid black;padding:5px;text-align:center"><b>'.$this->numberformat($z["NILAI_PROSEN"]).'</b></td>';
			}
			$htmlpdf .= '</tr>';	
	     	$htmlpdf .= '</tbody></table>';
	     }else{
	     	$htmlpdf .= "<h4 style='text-align:center;'>DAFTAR HASIL EVALUASI BELUM TERSEDIA</h4>";
	     }
     	$headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
	    	$this->pdf->pdf->SetHTMLHeader($headerhtml);
    	$this->pdf->pdf->SetTitle('Hasil Evaluasi Diklat - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
        $this->pdf->pdf->WriteHTML($htmlpdf, 2);
        $this->pdf->pdf->Output('Hasil Evaluasi Diklat - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

    }

    function numberformat( $number )
	{
		if (preg_match('/\.\d{0,}/', $number)) {
		    return number_format((float)$number, 2, '.', '');
		} else {
		    return (int)$number;
		}
	}
}