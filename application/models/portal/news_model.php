<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_POR_NEWS
			(
				NEWS_TITLE,
				NEWS_CONTENT,
				NEWS_TAGS,
				NEWS_IMAGE_PATH,
				NEWS_CREATE_BY,
				NEWS_CREATE_DATE,
				NEWS_STATUS,
				NEWS_LOG_ID
				
			)
			SELECT
				NEWS_TITLE,
				NEWS_CONTENT,
				NEWS_TAGS,
				NEWS_IMAGE_PATH,
				NEWS_CREATE_BY,
				NEWS_CREATE_DATE,
				NEWS_STATUS,
				NEWS_ID
			FROM T_POR_NEWS WHERE NEWS_ID = ".$id."
		");
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('NEWS_LOG_ID is null');
		$this->db->where('NEWS_STATUS',1);
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
			$this->db->order_by('NEWS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_NEWS_CATEGORY',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('NEWS_LOG_ID is null');
		$this->db->where('NEWS_STATUS',1);
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
		$this->db->from('V_NEWS_CATEGORY');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('NEWS_LOG_ID is null');
		$this->db->where('NEWS_STATUS',0);
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
			$this->db->order_by('NEWS_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_NEWS_CATEGORY',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('NEWS_LOG_ID is null');
		$this->db->where('NEWS_STATUS',0);
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
		$this->db->from('V_NEWS_CATEGORY');
		return $this->db->count_all_results(); 
	}

	function add($data){
		$this->db->insert('T_POR_NEWS', $data);
		return $this->db->insert_id();
	}

	function getDetail($Id) {
		$this->db->where('NEWS_ID', $Id);
		return $this->db->get('V_NEWS_CATEGORY');
	}

	function get($newsId) {
		$this->db->where('NEWS_ID', $newsId);
		return $this->db->get('T_POR_NEWS');
	}

	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('NEWS_ID', $id);
		return $this->db->update('T_POR_NEWS', $dataupdate);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('NEWS_STATUS',0);
		$this->db->where('NEWS_ID', $id);
		return $this->db->update('T_POR_NEWS');
	}

	function aktif($id){
		$this->insert_log($id);
		$this->db->set('NEWS_STATUS',1);
		$this->db->where('NEWS_ID', $id);
		return $this->db->update('T_POR_NEWS');
	}

	function listCategory(){
		$this->db->where('CATEGORY_STATUS', 1);
		return $this->db->get('T_POR_CATEGORY');
	}


}