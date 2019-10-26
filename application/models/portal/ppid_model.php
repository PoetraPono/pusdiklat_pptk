<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ppid_model extends CI_Model {
  public function __construct(){
    parent::__construct();
  }
	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='', $status=0){
		$this->db->where('PPID_STATUS',$status);
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
			$this->db->order_by('PPID_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}
		return $this->db->get('T_POR_PPID',$limit,$offset);
	}
	function count_all($search='', $fields='', $status=0){	
		$this->db->where('PPID_STATUS',$status);
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
		$this->db->from('T_POR_PPID');
		return $this->db->count_all_results(); 
	}
	function add($data){
		$this->db->insert('T_POR_PPID', $data);
		return $this->db->insert_id();
	}
	function upd($id, $data){
		$this->db->where('PPID_ID', $id);
		return $this->db->update('T_POR_PPID', $data);
	}
	function getdetail($id){
		$this->db->where('PPID_ID', $id);
		$this->db->where('PPID_STATUS', 1);
		return $this->db->get('T_POR_PPID');
	}
}