<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publikasi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		/*$this->db->query("
			INSERT INTO T_POR_PUBLIKASI
			(
				PUBLIKASI_TYPE,
				PUBLIKASI_TITLE,
				PUBLIKASI_CONTENT,
				PUBLIKASI_FILE_PATH,
				PUBLIKASI_CREATE_BY,
				PUBLIKASI_CREATE_DATE,
				PUBLIKASI_STATUS,
				PUBLIKASI_LOG_ID
				
			)
			SELECT
				PUBLIKASI_TYPE,
				PUBLIKASI_TITLE,
				PUBLIKASI_CONTENT,
				PUBLIKASI_FILE_PATH,
				PUBLIKASI_CREATE_BY,
				PUBLIKASI_CREATE_DATE,
				PUBLIKASI_STATUS,
				PUBLIKASI_ID
			FROM T_POR_PUBLIKASI WHERE PUBLIKASI_ID = ".$id."
		");*/
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('PUBLIKASI_LOG_ID is null');
		$this->db->where('PUBLIKASI_STATUS',1);
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
			$this->db->order_by('PUBLIKASI_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_PUBLIKASI',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('PUBLIKASI_LOG_ID is null');
		$this->db->where('PUBLIKASI_STATUS',1);
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
		$this->db->from('V_SYS_PUBLIKASI');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('PUBLIKASI_LOG_ID is null');
		$this->db->where('PUBLIKASI_STATUS',0);
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
			$this->db->order_by('PUBLIKASI_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_PUBLIKASI',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('PUBLIKASI_LOG_ID is null');
		$this->db->where('PUBLIKASI_STATUS',0);
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
		$this->db->from('V_SYS_PUBLIKASI');
		return $this->db->count_all_results(); 
	}

	function add($data){
		$this->db->insert('T_POR_PUBLIKASI', $data);
		return $this->db->insert_id();
	}

	function addtype($data){
		$this->db->insert('T_REF_TYPES', $data);
		return $this->db->insert_id(); 
	}

	function get($pubId) {
		$this->db->where('PUBLIKASI_ID', $pubId);
		return $this->db->get('T_POR_PUBLIKASI');
	}

	function getDetail($Id) {
		$this->db->where('PUBLIKASI_ID', $Id);
		return $this->db->get('T_POR_PUBLIKASI');
	}

	function getTypes() {
		$this->db->order_by('TYPE_NAME', 'ASC');
		return $this->db->get('T_REF_TYPES');
	}


	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('PUBLIKASI_ID', $id);
		return $this->db->update('T_POR_PUBLIKASI', $dataupdate);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('PUBLIKASI_STATUS',0);
		$this->db->where('PUBLIKASI_ID', $id);
		return $this->db->update('T_POR_PUBLIKASI');
	}

	function aktif($id){
		$this->insert_log($id);
		$this->db->set('PUBLIKASI_STATUS',1);
		$this->db->where('PUBLIKASI_ID', $id);
		return $this->db->update('T_POR_PUBLIKASI');
	}
}