<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengguna_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('USER_STATUS',1);
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
			$this->db->order_by('USER_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_USERS',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('USER_STATUS',1);
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
		$this->db->from('V_SYS_USERS');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('USER_STATUS',0);
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
			$this->db->order_by('USER_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_USERS',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('USER_STATUS',0);
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
		$this->db->from('V_SYS_USERS');
		return $this->db->count_all_results(); 
	}

	function getDetail($pggnaId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('USER_ID', $pggnaId);
		return $this->db->get('V_SYS_USERS');
	}

	function getListAcc(){
		return $this->db->get_where('T_SYS_ACCESS', array('ACCESS_STATUS' => 1));
	}

	function ListAcc(){
		return $this->db->get_where('T_SYS_ACCESS', array('ACCESS_STATUS' => 1));
	}

	function add($datacreate){
		$this->db->insert('T_SYS_USERS', $datacreate);
		return $this->db->insert_id();
	}

	function addemployee($datacreate){
		$this->db->insert('master_employees', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $idpengguna){
		$this->db->where('user_id', $idpengguna);
		return $this->db->update('t_sys_users', $dataupdate);
	}

	function updateemployee($dataemployee, $id){
		$this->db->where('employee_id', $id);
		return $this->db->update('t_master_employees',$dataemployee);
	}

	function getSysUser($userId){
		return $this->db->get_where('v_sys_users', array('user_id' => $userId));
	}

	function deleteuser($userId, $dataupdate){
		$this->db->set('user_status',0);
		$this->db->where('user_id', $userId);
		return $this->db->update('t_sys_users', $dataupdate);
	}

	function aktifuser($userId, $dataupdate){
		$this->db->set('user_status',1);
		$this->db->where('user_id', $userId);
		return $this->db->update('t_sys_users',  $dataupdate);
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */