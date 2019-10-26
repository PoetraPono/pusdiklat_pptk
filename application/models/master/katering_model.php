
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class katering_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_kat($id) {
		/*$this->db->query("
			INSERT INTO T_REF_CATERING
			(
				
				CATERING_NAME,
				CATERING_PRICE,
				CATERING_FILE_PATH,
				CATERING_CREATE_BY,
				CATERING_CREATE_DATE,
				CATERING_STATUS,
				CATERING_LOG_ID
			
			)
			SELECT
				CATERING_NAME,
				CATERING_PRICE,
				CATERING_FILE_PATH,
				CATERING_CREATE_BY,
				CATERING_CREATE_DATE,
				CATERING_STATUS,
				CATERING_ID
			FROM T_REF_CATERING WHERE CATERING_ID = ".$id."
		");*/
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('CATERING_LOG_ID is null');
		$this->db->where('CATERING_STATUS',1);
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
			$this->db->order_by('CATERING_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_CATERING',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('CATERING_LOG_ID is null');
		$this->db->where('CATERING_STATUS',1);
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
		$this->db->from('T_REF_CATERING');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('CATERING_LOG_ID is null');
		$this->db->where('CATERING_STATUS',0);
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
			$this->db->order_by('CATERING_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_CATERING',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('CATERING_LOG_ID is null');
		$this->db->where('CATERING_STATUS',0);
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
		// $this->db->from('T_REF_CATERING');
		$this->db->from('T_REF_CATERING');
		return $this->db->count_all_results(); 
	}

	function getDetailKatering($KatId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('CATERING_ID', $KatId);
		// return $this->db->get('T_REF_CATERING');
		return $this->db->get('T_REF_CATERING');
	}

	function getDetailMenu($KatId){
	return $this->db->query("SELECT * FROM T_REF_CATERING_MENU WHERE CAT_MENU_CATERING_ID = '$KatId'")->result();
	}

	function deletekateringlist($KatId){
		$this->db->query("DELETE T_REF_CATERING_MENU WHERE CAT_MENU_CATERING_ID = '$KatId'");
	}

	function getListAcc(){
		return $this->db->get_where('sys_access', array('access_status' => 1));
	}

	function ListAcc(){
		return $this->db->get_where('sys_access', array('access_status' => 1));
	}

	function addkatering($datacatering){
		$this->db->insert('T_REF_CATERING', $datacatering);
		return $this->db->insert_id();
	}

	function updatekatering($datacatering, $id){
		$this->db->where('CATERING_ID', $id);
		return $this->db->update('T_REF_CATERING', $datacatering);
	}

	function updatemenu($datainsert, $cat_menu_id, $id){
		$this->db->where('CAT_MENU_ID', $cat_menu_id);
		$this->db->where('CAT_MENU_CATERING_ID', $id);
		return $this->db->update('T_REF_CATERING_MENU', $datainsert);
	}

	function addmenu($datainsert){
		return $this->db->insert('T_REF_CATERING_MENU', $datainsert);
	}

	function addemployee($datacreate){
		$this->db->insert('master_employees', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $idpengguna){
		$this->db->where('user_id', $idpengguna);
		return $this->db->update('sys_users', $dataupdate);
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
		$this->insert_log_kat($id);
		$this->db->set('CATERING_STATUS',0);
		$this->db->where('CATERING_ID', $id);
		return $this->db->update('T_REF_CATERING');
	}

	function aktif($id){
		$this->insert_log_kat($id);
		$this->db->set('CATERING_STATUS',1);
		$this->db->where('CATERING_ID', $id);
		return $this->db->update('T_REF_CATERING');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */