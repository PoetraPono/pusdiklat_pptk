<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrasi extends CI_Controller{

	function __construct(){
		parent:: __construct();
	}

	public function index(){
		$data = array();
		$this->template->display('Registrasi/index', $data);
	}
	public function create(){
		$data = array();
		$this->template->display('Registrasi/create', $data);
	}
	public function update(){
		$data = array();
		$this->template->display('Registrasi/update', $data);
	}
	public function detail(){
		$data = array();
		$this->template->display('Registrasi/detail', $data);
	}
}