<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('report_model','');		
	}

	public function index(){
		$data = array();
		$this->template->display('nocategories/report/index', $data);
	}

	public function exceldaftardiklat($start,$end){
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
				->setTitle("PROGRAM DIKLAT")
				->setSubject("DAFTAR PROGRAM DIKLAT");

		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue("A1", "DAFTAR PROGRAM DIKLAT")	
		        ->setCellValue("A2", 'Dari Tanggal: '.dateEntoId($start,"d F Y").' s/d '.dateEntoId($end,"d F Y"))	
		        ->setCellValue("A3", "")	

		        ->setCellValue("A4", "No.")	
		        ->setCellValue("B4", "Nama Program")	
		        ->setCellValue("C4", "Deskripsi Program")	
		        ->setCellValue("D4", "Tanggal Mulai")	
		        ->setCellValue("E4", "Tanggal Selesai")
		        ->setCellValue("F4", "Bidang Program")
		        ->setCellValue("G4", "Sasaran Diklat")
		        ;	

        $baris=5;
        $no=1;
        $result = $this->report_model->getListProgram($start,$end)->result_array();
        //echo "<pre>"; print_r($result); die;
        foreach ($result as $writes=>$write) {
        	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A".$baris, $no)	
			->setCellValue("B".$baris, $write['PROGRAM_NAME'])	
			->setCellValue("C".$baris, $write['PROGRAM_DESCRIPTION'])
			->setCellValue("D".$baris, date("d-m-Y",strtotime($write['PROGRAM_START'])))
			->setCellValue("E".$baris, date("d-m-Y",strtotime($write['PROGRAM_END'])))
			->setCellValue("F".$baris, $write['SECTOR_NAME'])
			->setCellValue("G".$baris, $write['TINDAK_PIDANA_NAME']);
	        $baris++;$no++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);

		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A1:G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A5:G'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);	
		$objPHPExcel->getActiveSheet()->getstyle('A5:A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('B5:C'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->getstyle('D5:E'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('F5:G'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
		$objPHPExcel->getActiveSheet()->getStyle('A4:G'.$baris)->getAlignment()->setWrapText(TRUE);

		$baris = $baris - 1;
		$objPHPExcel->getActiveSheet()->getStyle('A4:G'.$baris)->applyFromArray($styleBorder);
		

		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getstyle('A1')->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setTitle('PROGRAM DIKLAT');

		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="DAFTAR PROGRAM DIKLAT.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}


	public function exceldaftarpeserta($start,$end){
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
				->setTitle("PESERTA PROGRAM DIKLAT")
				->setSubject("DAFTAR PESERTA PROGRAM DIKLAT");

		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue("A1", "DAFTAR PESERTA PROGRAM DIKLAT")	
		        ->setCellValue("A2", 'Dari Tanggal: '.dateEntoId($start,"d F Y").' s/d '.dateEntoId($end,"d F Y"))	
		        ->setCellValue("A3", "")	

		        ->setCellValue("A4", "No.")	
		        ->setCellValue("B4", "Nama")	
		        ->setCellValue("C4", "NIK")	
		        ->setCellValue("D4", "Intansi")	
		        ->setCellValue("E4", "Nama Program")	
		        ->setCellValue("F4", "Deskripsi Program")	
		        ->setCellValue("G4", "Tanggal Mulai")	
		        ->setCellValue("H4", "Tanggal Selesai")
		        ->setCellValue("I4", "Bidang Program")
		        ->setCellValue("J4", "Sasaran Diklat")
		        ;	

        $baris=5;
        $no=1;
        $result = $this->report_model->getListPeserta($start,$end)->result_array();
        //echo "<pre>"; print_r($result); die;
        foreach ($result as $writes=>$write) {
        	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A".$baris, $no)	
			->setCellValue("B".$baris, $write['MEMBER_NAME'])	
			->setCellValue("C".$baris, $write['MEMBER_NIK'])	
			->setCellValue("D".$baris, $write['INSTANSI_NAME'])	
			->setCellValue("E".$baris, $write['PROGRAM_NAME'])	
			->setCellValue("F".$baris, $write['PROGRAM_DESCRIPTION'])
			->setCellValue("G".$baris, date("d-m-Y",strtotime($write['PROGRAM_START'])))
			->setCellValue("H".$baris, date("d-m-Y",strtotime($write['PROGRAM_END'])))
			->setCellValue("I".$baris, $write['SECTOR_NAME'])
			->setCellValue("J".$baris, $write['TINDAK_PIDANA_NAME']);
	        $baris++;$no++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);

		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A1:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A5:J'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);	
		$objPHPExcel->getActiveSheet()->getstyle('A5:A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('B5:B'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->getstyle('C5:C'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('D5:F'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->getstyle('G5:H'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('I5:J'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:J3');
		$objPHPExcel->getActiveSheet()->getStyle('A4:J'.$baris)->getAlignment()->setWrapText(TRUE);

		$baris = $baris - 1;
		$objPHPExcel->getActiveSheet()->getStyle('A4:J'.$baris)->applyFromArray($styleBorder);
		

		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getstyle('A1')->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setTitle('PESERTA PROGRAM DIKLAT');

		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="DAFTAR PESERTA PROGRAM DIKLAT.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	public function exceldaftarinstansi($start,$end){
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
				->setTitle("INSTANSI PESERTA PROGRAM DIKLAT")
				->setSubject("DAFTAR INSTANSI PESERTA PROGRAM DIKLAT");

		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue("A1", "DAFTAR INSTANSI PESERTA PROGRAM DIKLAT")	
		        ->setCellValue("A2", 'Dari Tanggal: '.dateEntoId($start,"d F Y").' s/d '.dateEntoId($end,"d F Y"))	
		        ->setCellValue("A3", "")	

		        ->setCellValue("A4", "No.")	
		        ->setCellValue("B4", "Intansi")	
		        ->setCellValue("C4", "Jumlah Peserta")	
		        ->setCellValue("D4", "Nama Program")	
		        ->setCellValue("E4", "Deskripsi Program")	
		        ->setCellValue("F4", "Tanggal Mulai")	
		        ->setCellValue("G4", "Tanggal Selesai")
		        ->setCellValue("H4", "Bidang Program")
		        ->setCellValue("I4", "Sasaran Diklat")
		        ;	

        $baris=5;
        $no=1;
        $result = $this->report_model->getListInstansi($start,$end)->result_array();
        //echo "<pre>"; print_r($result); die;
        foreach ($result as $writes=>$write) {
        	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A".$baris, $no)	
			->setCellValue("B".$baris, $write['INSTANSI_NAME'])	
			->setCellValue("C".$baris, $write['JML_PESERTA'])
			->setCellValue("D".$baris, $write['PROGRAM_NAME'])	
			->setCellValue("E".$baris, $write['PROGRAM_DESCRIPTION'])
			->setCellValue("F".$baris, date("d-m-Y",strtotime($write['PROGRAM_START'])))
			->setCellValue("G".$baris, date("d-m-Y",strtotime($write['PROGRAM_END'])))
			->setCellValue("H".$baris, $write['SECTOR_NAME'])
			->setCellValue("I".$baris, $write['TINDAK_PIDANA_NAME']);
	        $baris++;$no++;
		}

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);

		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A1:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('A5:I'.$baris)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);	
		$objPHPExcel->getActiveSheet()->getstyle('A5:A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('B5:B'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->getstyle('C5:C'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('D5:E'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->getstyle('F5:G'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getstyle('H5:I'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
		$objPHPExcel->getActiveSheet()->getStyle('A4:I'.$baris)->getAlignment()->setWrapText(TRUE);

		$baris = $baris - 1;
		$objPHPExcel->getActiveSheet()->getStyle('A4:I'.$baris)->applyFromArray($styleBorder);
		

		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getstyle('A1')->getFont()->setSize(14);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setTitle('INSTANSI PESERTA PROGRAM DIKLAT');

		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="DAFTAR INSTANSI PESERTA PROGRAM DIKLAT.xlsx"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	
}