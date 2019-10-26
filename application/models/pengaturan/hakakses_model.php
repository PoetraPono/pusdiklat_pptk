<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ACCESS_STATUS',1);
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
			$this->db->order_by('AKSESID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ACCESS',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('ACCESS_STATUS',1);
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

		$this->db->from('V_SYS_ACCESS');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ACCESS_STATUS',0);
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
			$this->db->order_by('AKSESID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ACCESS',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('ACCESS_STATUS',0);
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

		$this->db->from('V_SYS_ACCESS');
		return $this->db->count_all_results(); 
	}

	function add($datacreate){
		$this->db->insert('T_SYS_ACCESS', $datacreate);
		return $this->db->insert_id();
	}

	function addDetail($dataAccDetail){
		$this->db->insert('T_SYS_ACCESS_DETAILS', $dataAccDetail);
	}

	function update($idakses, $dataupdate){
		$this->db->where('ACCESS_ID', $idakses);
		return $this->db->update('T_SYS_ACCESS', $dataupdate);
	}

	function updateDetail($menuid,$accessid,$dataupdate){
		$this->db->where('ACCESS_DETAIL_MENU_ID',$menuid);
		$this->db->where('ACCESS_DETAIL_ACCESS_ID',$accessid);
		$this->db->update('T_SYS_ACCESS_DETAILS', $dataupdate);
	}

	function delete_detail($idakses){
		$this->db->where('ACCESS_DETAIL_ACCESS_ID',$idakses);
		return $this->db->delete('T_SYS_ACCESS_DETAILS');
	}

	function getListhakakses(){
		return $this->db->get_where('T_SYS_ACCESS', array('ACCESS_STATUS' => 1));
	}

	function getlistakses(){
		return $this->db->get_where('T_SYS_ACCESS_DETAILS', array('ACCESS_DETAIL_STATUS' => 1));
	}

	function getDetailakses($idakses){
		$this->db->where('ACCESS_DETAIL_ACCESS_ID',$idakses);
		return $this->db->get('T_SYS_ACCESS_DETAILS');
	}

	function getDetailhakakses($idakses){
		$this->db->where('ACCESS_ID',$idakses);
		return $this->db->get('T_SYS_ACCESS');
	}

	function gethakakses($idakses){
		return $this->db->get_where('T_SYS_ACCESS', array('ACCESS_ID' => $idakses));
	}

	function deleteakses($idakses, $dataupdate){
		$this->db->set('ACCESS_STATUS',0);
		$this->db->where('ACCESS_ID', $idakses);
		return $this->db->update('T_SYS_ACCESS', $dataupdate);
	}

	function aktifakses($idakses, $dataupdate){
		$this->db->set('ACCESS_STATUS',1);
		$this->db->where('ACCESS_ID', $idakses);
		return $this->db->update('T_SYS_ACCESS', $dataupdate);
	}

	function get_listmenu_induk($id){
		$query = "SELECT
			M.MENU_ID,
			M.MENU_PARENT_ID,
			M.MENU_URL,
			M.MENU_NAME,
			M.MENU_ICON,
			M.MENU_SORT,
			M.MENU_STATUS,
			1 AS MENU_LEVEL
		FROM
			T_SYS_MENUS AS M
		WHERE
		M.MENU_PARENT_ID = '".$id."' ORDER BY M.MENU_SORT ASC";
		return $this->db->query($query);
	}

	function get_listmenu_anak($id, $sort){
		$query = "SELECT
			M.MENU_ID,
			M.MENU_PARENT_ID,
			M.MENU_URL,
			M.MENU_ICON,
			M.MENU_NAME,
			CONCAT('".$sort."','.',M.MENU_SORT) AS MENU_SORT,
			M.MENU_STATUS,
			2 AS MENU_LEVEL
		FROM
			T_SYS_MENUS AS M
		WHERE
		M.MENU_PARENT_ID = '".$id."'";
		return $this->db->query($query);
	}

	function get_listmenu_anakk($id, $sort){
		$query = "SELECT
			M.MENU_ID,
			M.MENU_PARENT_ID,
			M.MENU_URL,
			M.MENU_ICON,
			M.MENU_NAME,
			CONCAT('".$sort."','.',M.MENU_SORT) AS MENU_SORT,
			M.MENU_STATUS,
			3 AS MENU_LEVEL
		FROM
			T_SYS_MENUS AS M
		WHERE
		M.MENU_PARENT_ID = '".$id."'";
		return $this->db->query($query);
	}

}

/* End of file hakakses_model.php */
/* Location: ./application/models/hakakses_model.php */