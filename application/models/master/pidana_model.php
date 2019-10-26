
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pidana_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('TINDAK_PIDANA_STATUS',1);
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
			$this->db->order_by('TINDAK_PIDANA_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_TINDAK_PIDANA',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('TINDAK_PIDANA_STATUS',1);
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
		$this->db->from('V_TINDAK_PIDANA');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('TINDAK_PIDANA_STATUS',0);
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
			$this->db->order_by('TINDAK_PIDANA_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_TINDAK_PIDANA',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('TINDAK_PIDANA_STATUS',0);
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
		$this->db->from('V_TINDAK_PIDANA');
		return $this->db->count_all_results(); 
	}

	function getDetail($pidId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('TINDAK_PIDANA_ID', $pidId);
		return $this->db->get('V_TINDAK_PIDANA');
	}

	function getListBidang(){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('SECTOR_STATUS', 1);
		return $this->db->get('T_REF_SECTOR');
	}


	function add($datacreate){
		$this->db->insert('T_REF_TINDAK_PIDANA', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $idpengguna){
		$this->db->where('TINDAK_PIDANA_ID', $idpengguna);
		return $this->db->update('T_REF_TINDAK_PIDANA', $dataupdate);
	}

	function delete($id){
		// $this->insert_log_ins($id);
		$this->db->set('TINDAK_PIDANA_STATUS',0);
		$this->db->where('TINDAK_PIDANA_ID', $id);
		return $this->db->update('T_REF_TINDAK_PIDANA');
	}

	function aktif($id){
		// $this->insert_log_ins($id);
		$this->db->set('TINDAK_PIDANA_STATUS',1);
		$this->db->where('TINDAK_PIDANA_ID', $id);
		return $this->db->update('T_REF_TINDAK_PIDANA');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */