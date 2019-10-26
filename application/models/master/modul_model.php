<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_REF_SILABUS
			(
				SILABUS_NAME,
				SILABUS_DESCRIPTION,
				SILABUS_FILE_PATH,
				SILABUS_CREATE_BY,
				SILABUS_CREATE_DATE,
				SILABUS_STATUS,
				SILABUS_LOG_ID
				
				
			)
			SELECT
				SILABUS_NAME,
				SILABUS_DESCRIPTION,
				SILABUS_FILE_PATH,
				SILABUS_CREATE_BY,
				SILABUS_CREATE_DATE,
				SILABUS_STATUS,
				SILABUS_ID
			FROM T_REF_SILABUS WHERE SILABUS_ID = ".$id."
		");
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('SILABUS_LOG_ID is null');
		$this->db->where('SILABUS_STATUS',1);
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
			$this->db->order_by('SILABUS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_SILABUS',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('SILABUS_LOG_ID is null');
		$this->db->where('SILABUS_STATUS',1);
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
		$this->db->from('T_REF_SILABUS');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('SILABUS_LOG_ID is null');
		$this->db->where('SILABUS_STATUS',0);
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
			$this->db->order_by('SILABUS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_SILABUS',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('SILABUS_LOG_ID is null');
		$this->db->where('SILABUS_STATUS',0);
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
		$this->db->from('T_REF_SILABUS');
		return $this->db->count_all_results(); 
	}

	function add($data){
		$this->db->insert('T_REF_SILABUS', $data);
		return $this->db->insert_id();
	}


	function getDetail($Id) {
		$this->db->where('SILABUS_ID', $Id);
		return $this->db->get('T_REF_SILABUS');
	}


	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('SILABUS_ID', $id);
		return $this->db->update('T_REF_SILABUS', $dataupdate);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('SILABUS_STATUS',0);
		$this->db->where('SILABUS_ID', $id);
		return $this->db->update('T_REF_SILABUS');
	}

	function aktif($id){
		$this->insert_log($id);
		$this->db->set('SILABUS_STATUS',1);
		$this->db->where('SILABUS_ID', $id);
		return $this->db->update('T_REF_SILABUS');
	}
}