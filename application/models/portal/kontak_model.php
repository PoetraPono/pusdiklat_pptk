<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak_model extends CI_Model {
	public function __construct(){
		parent::__construct();	
	}
	function add($data){
		$this->db->insert('T_REF_CONTACTS', $data);
		return $this->db->insert_id();
	}
	function addimages($data){
		$this->db->insert('T_POR_OFFICEIMG', $data);
		return $this->db->insert_id();
	}
	function updimages($id, $data){
		$this->db->where('OFCIMG_ID', $id);
		return $this->db->update('T_POR_OFFICEIMG',$data);
	}
	function dropimages($id){
		$this->db->where('OFCIMG_ID', $id);
		return $this->db->delete('T_POR_OFFICEIMG');
	}
	function getlist() {
		return $this->db->get('T_REF_CONTACTS');
	}
	function getlistofficeimg() {
		$this->db->order_by('OFCIMG_STATUS','ASC');
		return $this->db->get('T_POR_OFFICEIMG');
	}
	function getimages($id) {
		$this->db->where('OFCIMG_ID',$id);
		return $this->db->get('T_POR_OFFICEIMG');
	}
	function update($data, $id){
		$this->db->where('CONTACT_ID', $id);
		return $this->db->update('T_REF_CONTACTS', $data);
	}
	function delete($id){
		$this->db->set('CONTACT_STATUS',0);
		$this->db->where('CONTACT_ID', $id);
		return $this->db->update('T_REF_CONTACTS');
	}
	function aktif($id){
		$this->db->set('CONTACT_STATUS',1);
		$this->db->where('CONTACT_ID', $id);
		return $this->db->update('T_REF_CONTACTS');
	}
}