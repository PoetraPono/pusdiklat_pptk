<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_REF_MEMBER
			(
				MEMBER_NAME,
				MEMBER_USERNAME,
				MEMBER_PASSWORD,
				MEMBER_NIK,
				MEMBER_EMAIL,
				MEMBER_PHONE,
				MEMBER_CREATE_BY,
				MEMBER_CREATE_DATE,
				MEMBER_STATUS,
				MEMBER_LOG_ID
				
			)
			SELECT
				MEMBER_NAME,
				MEMBER_USERNAME,
				MEMBER_PASSWORD,
				MEMBER_NIK,
				MEMBER_EMAIL,
				MEMBER_PHONE,
				MEMBER_CREATE_BY,
				MEMBER_CREATE_DATE,
				MEMBER_STATUS,
				MEMBER_ID
			FROM T_REF_MEMBER WHERE MEMBER_ID = ".$id."
		");
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('MEMBER_LOG_ID is null');
		$this->db->where('MEMBER_STATUS',1);
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
				} else {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}

		if (empty($order_column) || empty($order_type))
		{
			$this->db->order_by('MEMBER_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_REF_MEMBER',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('MEMBER_LOG_ID is null');
		$this->db->where('MEMBER_STATUS',1);
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
				} else {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}
		$this->db->from('V_REF_MEMBER');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('MEMBER_LOG_ID is null');
		$this->db->where('MEMBER_STATUS',0);
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
				} else {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}

		if (empty($order_column) || empty($order_type))
		{
			$this->db->order_by('MEMBER_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_MEMBER',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('MEMBER_LOG_ID is null');
		$this->db->where('MEMBER_STATUS',0);
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
				} else {
					$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}
		$this->db->from('T_REF_MEMBER');
		return $this->db->count_all_results(); 
	}

	function add($data){
		// $this->db->insert('T_REF_MEMBER', $data);
		$this->db->insert('T_REF_MEMBER', $data);
		return $this->db->insert_id();
	}


	function getDetail($Id) {
		$this->db->where('MEMBER_ID', $Id);
		// return $this->db->get('V_REF_MEMBER');
		return $this->db->get('V_REF_MEMBER');
	}

	function getListProgramParticipant($id) {
		// $query = "SELECT * FROM V_PROGRAM WHERE PROGRAM_ID IN (SELECT PROPAR_PROGRAM_ID FROM T_PROGRAM_PARTICIPANT WHERE PROPAR_STATUS = 1 AND PROPAR_MEMBER_ID = '".$id."')";
		$query = "SELECT * FROM V_PROGRAM WHERE PROGRAM_ID IN (SELECT PROPAR_PROGRAM_ID FROM T_PROGRAM_PARTICIPANT WHERE PROPAR_STATUS = 1 AND PROPAR_MEMBER_ID = '".$id."')";
		
		return $this->db->query($query);
	}


	// function getInsById($insId){
	// 	$this->db->select('INSTANSI_ID, INSTANSI_NAME');
	// 	$this->db->join('T_REF_MEMINS', 'MEMINS_INSTANSI_ID = INSTANSI_ID', 'left');
	// 	$this->db->where('MEMINS_MEMBER_ID', $insId);
	// 	return $this->db->get('T_REF_INSTANSI');
	// }


	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('MEMBER_ID', $id);
		return $this->db->update('T_REF_MEMBER', $dataupdate);
	}

	function delete($id){
		//$this->insert_log($id);
		$this->db->set('MEMBER_STATUS',0);
		$this->db->where('MEMBER_ID', $id);
		return $this->db->update('T_REF_MEMBER');
	}

	function aktif($id){
		$this->insert_log($id);
		$this->db->set('MEMBER_STATUS',1);
		$this->db->where('MEMBER_ID', $id);
		return $this->db->update('T_REF_MEMBER');
	}

	function getKabupaten($code){
        $this->db->where('KABUPATEN_PROV_CODE', $code); 
        $this->db->where('KABUPATEN_STATUS', 1);
        return $this->db->get('T_REF_KABUPATEN');
    }

    function getJabatan(){
        $this->db->where('JABATAN_STATUS', 1);
        return $this->db->get('T_REF_JABATAN');
    }

    function getInstansi(){
        $this->db->where('INSTANSI_STATUS', 1);
        $this->db->where('INSTANSI_LOG_ID', NULL);
        $this->db->order_by('INSTANSI_NAME', 'ASC');
        return $this->db->get('T_REF_INSTANSI');
    }

    function getGender(){
        $this->db->where('GENDER_STATUS', 1);
        return $this->db->get('T_REF_GENDER');
    }

    function get_provinces(){
        $this->db->order_by('PROVINSI_STATUS', 1);
        return $this->db->get('T_REF_PROVINSI');
        
    }
     function getSector(){
        $this->db->where('INSTANSI_CATEGORY_STATUS', 1);
        return $this->db->get('T_REF_INSTANSI_CATEGORY');
    }

    function check_username($username){
        $this->db->where('MEMBER_USERNAME', $username);
        $this->db->where('MEMBER_LOG_ID IS NULL');
        return $this->db->get('T_REF_MEMBER');
    }
}