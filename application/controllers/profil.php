<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->library(array('template'));
		$this->load->helper(array('form','url'));
		
	}

	public function index(){		
		$data = array();
		$this->template->displays('profil', $data);
	}

	// public function sejarah(){
	// //echo "tess";		
	// 	$data = array();
	// 	$this->template->display('sejarah', $data);
	// }

	// public function Beranda(){		
	// 	$data = array();
	// 	$this->template->display('home', $data);
	// }

	// public function visi_misi(){		
	// 	$data = array();
	// 	$this->template->display('visi_misi', $data);
	// }

	// public function tugas_dan_fungsi(){		
	// 	$data = array();
	// 	$this->template->display('tugas_dan_fungsi', $data);
	// }

	// public function struktur_organisasi(){		
	// 	$data = array();
	// 	$this->template->display('struktur_organisasi', $data);
	// }

	// public function pegawai(){		
	// 	$data = array();
	// 	$this->template->display('', $data);
	// }

	// public function widayasiswara(){		
	// 	$data = array();
	// 	$this->template->display('', $data);
	// }

	// public function gallery(){		
	// 	$data = array();
	// 	$this->template->display('gallery', $data);
	// }


	// public function diklat_internal(){
	// 	$data = array();
	// 	$this->template->display('diklat_internal', $data);
	// }

	// public function diklat_eksternal(){
	// 	$data = array();
	// 	$this->template->display('diklat_eksternal', $data);
	// }

	// public function modul_diklat(){
	// 	$data = array();

	// 	$this->template->display('modul_diklat', $data);
	// }

	// public function calender_diklat(){
	// 	$data = array();
	// 	$this->template->display('calender_diklat', $data);
	// }

	// public function faq(){
	// 	$data = array();
	// 	$this->template->display('faq', $data);
	// }

}
