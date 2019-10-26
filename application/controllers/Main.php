<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->library(array('template'));
		$this->load->helper(array('form','url'));
		
	}

	public function index(){		
		$data = array();
		$this->template->display('home', $data);
	}

	public function home(){		
		$data = array();
		$this->template->display('home', $data);
	}

	public function profil(){
	//echo "tess";		
		$data = array();
		$this->template->display('profil', $data);
	}

	public function sejarah(){
	//echo "tess";		
		$data = array();
		$this->template->display('sejarah', $data);
	}

	public function Beranda(){		
		$data = array();
		$this->template->display('home', $data);
	}

	public function visi_misi(){		
		$data = array();
		$this->template->display('visi_misi', $data);
	}

	public function tugas_dan_fungsi(){		
		$data = array();
		$this->template->display('tugas_dan_fungsi', $data);
	}

	public function struktur_organisasi(){		
		$data = array();
		$this->template->display('struktur_organisasi', $data);
	}

	public function pegawai(){		
		$data = array();
		$this->template->display('pegawai', $data);
	}

	public function pegawai_detail(){		
		$data = array();
		$this->template->display('pegawai_detail', $data);
	}

	public function widyaiswara(){		
		$data = array();
		$this->template->display('widyaiswara', $data);
	}

	public function widyaiswara_detail(){		
		$data = array();
		$this->template->display('widyaiswara_detail', $data);
	}

	public function sarana_dan_prasarana(){		
		$data = array();
		$this->template->display('sarana_dan_prasarana', $data);
	}

	public function gallery(){		
		$data = array();
		$this->template->display('gallery', $data);
	}


	public function diklat_internal(){
		$data = array();
		$this->template->display('diklat_internal', $data);
	}

	public function diklat_internal_detail(){
		$data = array();
		$this->template->display('diklat_internal_detail', $data);
	}

	public function program_diklat(){
		$data = array();
		$this->template->display('program_diklat', $data);
	}

	public function program_diklat_detail(){
		$data = array();
		$this->template->display('program_diklat_detail', $data);
	}

	public function modul_diklat(){
		$data = array();

		$this->template->display('modul_diklat', $data);
	}

	public function calender_diklat(){
		$data = array();
		$this->template->display('calender_diklat', $data);
	}


	public function faq(){
		$data = array();
		$this->template->display('faq', $data);
	}

	public function alumni(){
		$data = array();
		$this->template->display('alumni', $data);
	}

	public function alumni_detail(){
		$data = array();
		$this->template->display('alumni_detail', $data);
	}

	public function login(){
		$data = array();
		$this->template->display('login', $data);
	}

	public function buat_akun(){
		$data = array();
		$this->template->display('buat_akun', $data);
	}


	public function pendaftaran_peserta(){
		$data = array();
		$this->template->display('pendaftaran_peserta', $data);
	}

	public function artikel(){
		$data = array();
		$this->template->display('artikel', $data);
	}

	public function artikel_detail(){
		$data = array();
		$this->template->display('artikel_detail', $data);
	}

	public function berita(){
		$data = array();
		$this->template->display('berita', $data);
	}

	public function kontak(){
		$data = array();
		$this->template->display('kontak', $data);
	}

	public function pendaftaran(){
		$data = array();
		$this->template->display('pendaftaran', $data);
	}

	public function kalender_diklat(){
		$data = array();
		$this->template->display('kalender_diklat', $data);
	}

	public function jadwal_diklat(){
		$data = array();
		$this->template->display('jadwal_diklat', $data);
	}

	public function jadwal_sertifikasi(){
		$data = array();
		$this->template->display('jadwal_sertifikasi', $data);
	}

	public function contact_person(){
		$data = array();
		$this->template->display('contact_person', $data);
	}


	public function pendaftaran_sertifikasi(){
		$data = array();
		$this->template->display('pendaftaran_sertifikasi', $data);
	}

	public function silabus_singkat(){
		$data = array();
		$this->template->display('silabus_singkat', $data);
	}

	public function silabus2(){
		$data = array();
		$this->template->display('silabus2', $data);
	}

	public function silabus3(){
		$data = array();
		$this->template->display('silabus3', $data);
	}

	public function silabus4(){
		$data = array();
		$this->template->display('silabus4', $data);
	}

	public function calon_peserta_dan_hasil_ujian(){
		$data = array();
		$this->template->display('calon_peserta_dan_hasil_ujian', $data);
	}

	public function sertifikasi(){
		$data = array();
		$this->template->display('sertifikasi', $data);
	}


	public function jurnal(){
		$data = array();
		$this->template->display('jurnal', $data);
	}

	public function annual_report(){
		$data = array();
		$this->template->display('annual_report', $data);
	}

	public function majalah(){
		$data = array();
		$this->template->display('majalah', $data);
	}

	public function informasi_publik(){
		$data = array();
		$this->template->display('informasi_publik', $data);
	}

	public function detail_informasi_setiapsaat(){
		$data = array();
		$this->template->display('detail_informasi_setiapsaat', $data);
	}


	public function modul_diklat_detail_pencucianuang(){
		$data = array();
		$this->template->display('modul_diklat_detail_pencucianuang', $data);
	}


	public function lakip(){
		$data = array();
		$this->template->display('lakip', $data);
	}

	// public function ordinal(){
	// 	$data = array();
	// 	$this->template->display('ordinal', $data);
	// }

	// public function guttman(){
	// 	$data = array();
	// 	$this->template->display('guttman', $data);
	// }

	// public function pertanyaanterbuka(){
	// 	$data = array();
	// 	$this->template->display('pertanyaanterbuka', $data);
	// }

	// public function kompetensi_struktural($id){
	// 	$data = array();
	// 	if($id == 2 && $id == 1){
	// 		$this->template->display('kompetensi_struktural_1', $data);
	// 	}
	// 	$this->template->display('kompetensi_struktural_5', $data);
	// }

	// public function kompetensi_fungsional($id){
	// 	$data = array();
	// 	if($id == 2 && $id == 1){
	// 		$this->template->display('kompetensi_sfungsional_1', $data);
	// 	}
	// 	$this->template->display('kompetensi_fungsional_5', $data);
	// }

	// public function period(){
	// 	$data = array();
	// 	$this->template->display('period', $data);
	// }

	// public function period_edit(){
	// 	$data = array();
	// 	$this->template->display('period_edit', $data);
	// }

	// public function hasil(){
	// 	$data = array();
	// 	$this->template->display('hasil', $data);
	// }

	// public function hasil_detail(){
	// 	$data = array();
	// 	$this->template->display('hasil_detail', $data);
	// }

	// public function tindaklanjut(){
	// 	$data = array();
	// 	$this->template->display('tindaklanjut', $data);
	// }

	// public function tindaklanjut_update(){
	// 	$data = array();
	// 	$this->template->display('tindaklanjut_update', $data);
	// }

	// public function pengguna(){
	// 	$data = array();
	// 	$this->template->display('pengguna', $data);
	// }

	// public function pengguna_update(){
	// 	$data = array();
	// 	$this->template->display('pengguna_update', $data);
	// }

	// public function aksesrole(){
	// 	$data = array();
	// 	$this->template->display('aksesrole', $data);
	// }

	// public function aksesrole_update(){
	// 	$data = array();
	// 	$this->template->display('aksesrole_update', $data);
	// }

	// public function talentpool(){
	// 	$data = array();
	// 	$this->template->display('talentpool', $data);
	// }

	// public function talentpool_detail(){
	// 	$data = array();
	// 	$this->template->display('talentpool_detail', $data);
	// }

	// public function log(){
	// 	$data = array();
	// 	$this->template->display('log', $data);
	// }

}
