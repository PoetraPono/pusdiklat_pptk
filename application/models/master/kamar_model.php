
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kamar_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_rooms($id) {
		/*$this->db->query("
			INSERT INTO T_REF_ROOMS
			(
				
				ROOMS_NAME,
				ROOMS_CAPACITY,
				ROOMS_NUMBER,
				ROOMS_CREATE_BY,
				ROOMS_CREATE_DATE,
				ROOMS_STATUS,
				ROOMS_LOG_ID
			
			)
			SELECT
				ROOMS_NAME,
				ROOMS_CAPACITY,
				ROOMS_NUMBER,
				ROOMS_CREATE_BY,
				ROOMS_CREATE_DATE,
				ROOMS_STATUS,
				ROOMS_ID
			FROM T_REF_ROOMS WHERE ROOMS_ID = ".$id."
		");*/
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ROOMS_LOG_ID is null');
		$this->db->where('ROOMS_STATUS',1);
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
			$this->db->order_by('ROOMS_LOG_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ROOMS',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('ROOMS_LOG_ID is null');
		$this->db->where('ROOMS_STATUS',1);
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
		$this->db->from('V_SYS_ROOMS');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('ROOMS_LOG_ID is null');
		$this->db->where('ROOMS_STATUS',0);
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
			$this->db->order_by('ROOMS_LOG_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_ROOMS',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('ROOMS_LOG_ID is null');
		$this->db->where('ROOMS_STATUS',0);
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
		$this->db->from('V_SYS_ROOMS');
		return $this->db->count_all_results(); 
	}

	function getDetail($KatId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('ROOMS_ID', $KatId);
		return $this->db->get('V_SYS_ROOMS');
	}


	function add($datacreate){
		$this->db->insert('T_REF_ROOMS', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $rommID){
		$this->db->where('ROOMS_ID', $rommID);
		return $this->db->update('T_REF_ROOMS', $dataupdate);
	}

	// function delete($idKat){
	// 	$this->db->set('CATERING_STATUS',0);
	// 	$this->db->where('CATERING_ID', $idKat);
	// 	return $this->db->update('T_REF_CATERING');
	// }

	function delete($id){
		$this->insert_log_rooms($id);
		$this->db->set('ROOMS_STATUS',0);
		$this->db->where('ROOMS_ID', $id);
		return $this->db->update('T_REF_ROOMS');
	}

	function aktif($id){
		$this->insert_log_rooms($id);
		$this->db->set('ROOMS_STATUS',1);
		$this->db->where('ROOMS_ID', $id);
		return $this->db->update('T_REF_ROOMS');
	}

	function chekout($id){
		$this->db->set('ROOMS_IS_FULL',0);
		$this->db->where('ROOMS_ID', $id);
		$this->db->update('T_REF_ROOMS');
	}

}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */