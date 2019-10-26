<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studikasus_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		/*$this->db->query("
			INSERT INTO T_REF_STUDI_KASUS
			(
				STUDI_KASUS_NAME,
				STUDI_KASUS_DESCRIPTION,
				STUDI_KASUS_FILE_PATH,
				STUDI_KASUS_CREATE_BY,
				STUDI_KASUS_CREATE_DATE,
				STUDI_KASUS_STATUS,
				STUDI_KASUS_LOG_ID
				
				
			)
			SELECT
				STUDI_KASUS_NAME,
				STUDI_KASUS_DESCRIPTION,
				STUDI_KASUS_FILE_PATH,
				STUDI_KASUS_CREATE_BY,
				STUDI_KASUS_CREATE_DATE,
				STUDI_KASUS_STATUS,
				STUDI_KASUS_ID
			FROM T_REF_STUDI_KASUS WHERE STUDI_KASUS_ID = ".$id."
		");*/
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		
		$this->db->where('STUDI_KASUS_STATUS',1);
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
			$this->db->order_by('STUDI_KASUS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_STUDI_KASUS',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		
		$this->db->where('STUDI_KASUS_STATUS',1);
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
		$this->db->from('T_REF_STUDI_KASUS');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		
		$this->db->where('STUDI_KASUS_STATUS',0);
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
			$this->db->order_by('STUDI_KASUS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_STUDI_KASUS',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		
		$this->db->where('STUDI_KASUS_STATUS',0);
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
		$this->db->from('T_REF_STUDI_KASUS');
		return $this->db->count_all_results(); 
	}

	function add($data){
		$this->db->insert('T_REF_STUDI_KASUS', $data);
		return $this->db->insert_id();
	}


	function getDetail($Id) {
		$this->db->where('STUDI_KASUS_ID', $Id);
		return $this->db->get('T_REF_STUDI_KASUS');
	}


	function update($dataupdate, $id){
		//$this->insert_log($id);
		$this->db->where('STUDI_KASUS_ID', $id);
		return $this->db->update('T_REF_STUDI_KASUS', $dataupdate);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('STUDI_KASUS_STATUS',0);
		$this->db->where('STUDI_KASUS_ID', $id);
		return $this->db->update('T_REF_STUDI_KASUS');
	}

	function aktif($id){
		$this->insert_log($id);
		$this->db->set('STUDI_KASUS_STATUS',1);
		$this->db->where('STUDI_KASUS_ID', $id);
		return $this->db->update('T_REF_STUDI_KASUS');
	}
}