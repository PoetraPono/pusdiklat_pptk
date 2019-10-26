<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengadaan_model extends CI_Model {
  public function __construct(){
    parent::__construct();
  }
	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='', $status=0){
		$this->db->where('ANNOUN_STATUS',$status);
		if($search!='' AND $fields!=''){
			$likeclause = '(';
			$i=0;
			foreach($fields as $field){
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

		if (empty($order_column) || empty($order_type)){
			$this->db->order_by('ANNOUN_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}
		// return $this->db->get('T_POR_ANNOUNCEMENT',$limit,$offset);
		return $this->db->get('T_POR_ANNOUNCEMENT',$limit,$offset);
	}
	function count_all($search='', $fields='', $status=0){	
		$this->db->where('ANNOUN_STATUS',$status);
		if($search!='' AND $fields!=''){
			$likeclause = '(';
			$i=0;
			foreach($fields as $field){
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
		// $this->db->from('T_POR_ANNOUNCEMENT');
		$this->db->from('T_POR_ANNOUNCEMENT');
		return $this->db->count_all_results(); 
	}
	function add($data){
		// $this->db->insert('T_POR_ANNOUNCEMENT', $data);
		$this->db->insert('T_POR_ANNOUNCEMENT', $data);
		return $this->db->insert_id();
	}
	function upd($id, $data){
		$this->db->where('ANNOUN_ID', $id);
		// return $this->db->update('T_POR_ANNOUNCEMENT', $data);
		return $this->db->update('T_POR_ANNOUNCEMENT', $data);
	}
	function getdetail($id){
		$this->db->where('ANNOUN_ID', $id);
		$this->db->where('ANNOUN_STATUS', 1);
		// return $this->db->get('T_POR_ANNOUNCEMENT');
		return $this->db->get('T_POR_ANNOUNCEMENT');
	}


	function getAnnoun(){
		$this->db->where('ANNOUN_STATUS', 1);
		$this->db->order_by('ANNOUN_DATE_START', 'DESC');
		// return $this->db->get('T_POR_ANNOUNCEMENT'); 
		return $this->db->get('T_POR_ANNOUNCEMENT'); 
	}
	public function getList($limit,$start){
		// $query = "SELECT * FROM T_POR_ANNOUNCEMENT WHERE ANNOUN_STATUS = 1  ";
		$query = "SELECT * FROM T_POR_ANNOUNCEMENT WHERE ANNOUN_STATUS = 1  ";
		$query .= "ORDER BY ANNOUN_DATE_START DESC OFFSET ".$start." ROWS FETCH NEXT ".$limit." ROWS ONLY";
		return $this->db->query($query);
	}
	public function getCount(){
		$this->db->where('ANNOUN_STATUS', 1);
		$query = $this->db->get('T_POR_ANNOUNCEMENT');
		return $query->num_rows();
	}

}