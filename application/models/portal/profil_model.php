<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profil_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_POR_PROFIL
			(
				PROFIL_NAME,
				PROFIL_DESC,
				PROFIL_CREATED,
				PROFIL_CREATE_DATE,
				PROFIL_STATUS,
				PROFIL_LOG_ID,
				PROFIL_LINK
				
			)
			SELECT
				PROFIL_NAME,
				PROFIL_DESC,
				PROFIL_CREATED,
				PROFIL_CREATE_DATE,
				PROFIL_STATUS,
				PROFIL_ID,
				PROFIL_LINK
			FROM T_POR_PROFIL WHERE PROFIL_ID = ".$id."
		");
	}

	function getlists() {
		$this->db->where('PROFIL_STATUS', 1);
		$this->db->where('PROFIL_LOG_ID', NULL);
		return $this->db->get('T_POR_PROFIL');
	}
	function getlistimages($id) {
		$this->db->where('IMG_PROFIL_ID', $id);
		$this->db->where('IMG_STATUS', 1);
		$this->db->order_by('IMG_CATEGORY', 'ASC');
		return $this->db->get('T_POR_PROFIL_IMG');
	}
	function updatedata($data, $id){
		$this->insert_log($id);
		$this->db->where('PROFIL_ID', $id);
		return $this->db->update('T_POR_PROFIL', $data);
	}
	function createimages($data){
		$this->db->insert('T_POR_PROFIL_IMG', $data);
		return $this->db->insert_id();
	}
	function destroydataimages($id){
		$this->db->where('IMG_PROFIL_ID', $id);
		return $this->db->delete('T_POR_PROFIL_IMG');
	}
}