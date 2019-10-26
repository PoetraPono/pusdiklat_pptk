
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('POPUP_STATUS',1);
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
			$this->db->order_by('POPUP_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_POPUP',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('POPUP_STATUS',1);
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
		$this->db->from('T_REF_POPUP');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('POPUP_STATUS',0);
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
			$this->db->order_by('POPUP_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_POPUP',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('POPUP_STATUS',0);
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
		$this->db->from('T_REF_POPUP');
		return $this->db->count_all_results(); 
	}

	function getDetail($KatId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('POPUP_ID', $KatId);
		return $this->db->get('T_REF_POPUP');
	}


	function add($datacreate){
		$this->db->insert('T_REF_POPUP', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $idpengguna){
		$this->db->where('POPUP_ID', $idpengguna);
		return $this->db->update('T_REF_POPUP', $dataupdate);
	}

	function delete($id){
		// $this->insert_log_ins($id);
		$this->db->set('POPUP_SHOW',0);
		$this->db->where('POPUP_ID', $id);
		return $this->db->update('T_REF_POPUP');
	}

	function aktif($id){
		// $this->insert_log_ins($id);
		$this->db->set('POPUP_SHOW',1);
		$this->db->where('POPUP_ID', $id);
		return $this->db->update('T_REF_POPUP');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */