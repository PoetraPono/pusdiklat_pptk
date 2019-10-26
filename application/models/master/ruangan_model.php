
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ruangan_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_room($id) {
		$this->db->query("
			INSERT INTO T_REF_ROOM
			(
				
				ROOM_NAME,
				ROOM_NUMBER,
				ROOM_BUILDING,
				ROOM_CREATE_BY,
				ROOM_CREATE_DATE,
				ROOM_STATUS,
				ROOM_LOG_ID
			
			)
			SELECT
				ROOM_NAME,
				ROOM_NUMBER,
				ROOM_BUILDING,
				ROOM_CREATE_BY,
				ROOM_CREATE_DATE,
				ROOM_STATUS,
				ROOM_ID
			FROM T_REF_ROOM WHERE ROOM_ID = ".$id."
		");
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ROOM_LOG_ID is null');
		$this->db->where('ROOM_STATUS',1);
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
			$this->db->order_by('ROOM_LOG_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ROOM',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('ROOM_LOG_ID is null');
		$this->db->where('ROOM_STATUS',1);
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
		$this->db->from('V_SYS_ROOM');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ROOM_LOG_ID is null');
		$this->db->where('ROOM_STATUS',0);
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
			$this->db->order_by('ROOM_LOG_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ROOM',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('ROOM_LOG_ID is null');
		$this->db->where('ROOM_STATUS',0);
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
		$this->db->from('V_SYS_ROOM');
		return $this->db->count_all_results(); 
	}

	function getDetail($KatId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('ROOM_ID', $KatId);
		return $this->db->get('V_SYS_ROOM');
	}


	function add($datacreate){
		$this->db->insert('T_REF_ROOM', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $rommID){
		$this->db->where('ROOM_ID', $rommID);
		return $this->db->update('T_REF_ROOM', $dataupdate);
	}

	
	function getemployee($pggnaId) {
		$this->db->where('employee_id', $pggnaId);
		return $this->db->get('master_employees');
	}

	function updateemployee($dataemployee, $id){
		$this->db->where('employee_id', $id);
		return $this->db->update('master_employees',$dataemployee);
	}

	function getSysUser($userId){
		return $this->db->get_where('view_sys_users', array('user_id' => $userId));
	}

	// function delete($idKat){
	// 	$this->db->set('CATERING_STATUS',0);
	// 	$this->db->where('CATERING_ID', $idKat);
	// 	return $this->db->update('T_REF_CATERING');
	// }

	function delete($id){
		//$this->insert_log_room($id);
		$this->db->set('ROOM_STATUS',0);
		$this->db->where('ROOM_ID', $id);
		return $this->db->update('T_REF_ROOM');
	}

	function aktif($id){
		//$this->insert_log_room($id);
		$this->db->set('ROOM_STATUS',1);
		$this->db->where('ROOM_ID', $id);
		return $this->db->update('T_REF_ROOM');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */