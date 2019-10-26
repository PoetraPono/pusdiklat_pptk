
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paketsoal_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_REF_QUE_PACK
			(	
				PACKET_NAME,
				PACKET_CREATE_BY,
				PACKET_CREATE_DATE,
				PACKET_STATUS,
				PACKET_LOG_ID
			)
			SELECT
				PACKET_NAME,
				PACKET_CREATE_BY,
				PACKET_CREATE_DATE,
				PACKET_STATUS,
				PACKET_ID

			FROM T_REF_QUE_PACK WHERE PACKET_ID = ".$id."
		");
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
		$this->db->where('PACKET_LOG_ID is null');
		$this->db->where('PACKET_STATUS',1);
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
			$this->db->order_by('PACKET_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_QUE_PACK',$limit,$offset);
	}

	function count_all($search='', $fields=''){	
		$this->db->where('PACKET_LOG_ID is null');
		$this->db->where('PACKET_STATUS',1);
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
		$this->db->from('T_REF_QUE_PACK');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
		$this->db->where('PACKET_LOG_ID is null');
		$this->db->where('PACKET_STATUS',0);
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
			$this->db->order_by('PACKET_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_QUE_PACK',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields=''){	
		$this->db->where('PACKET_LOG_ID is null');
		$this->db->where('PACKET_STATUS',0);
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
		$this->db->from('T_REF_QUE_PACK');
		return $this->db->count_all_results(); 
	}

	function get_paged_list_listsoal($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
		$this->db->where('QUESTION_LOG_ID is null');
		$this->db->where('QUESTION_STATUS',1);
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
			$this->db->order_by('QUESTION_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_QUESTIONS',$limit,$offset);
	}

	function count_all_listsoal($search='', $fields=''){	
		$this->db->where('QUESTION_LOG_ID is null');
		$this->db->where('QUESTION_STATUS',1);
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
		$this->db->from('T_REF_QUESTIONS');
		return $this->db->count_all_results(); 
	}

	// function getDetail($KatId){
	// 	// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
	// 	$this->db->where('INSTANSI_ID', $KatId);
	// 	return $this->db->get('V_SYS_INSTANSI');
	// }

	function add($datacreate){
		$this->db->insert('T_REF_QUE_PACK', $datacreate);
		return $this->db->insert_id();
	}
	function get($id){
		$this->db->where('PACKET_ID', $id);
		return $this->db->get('T_REF_QUE_PACK');
	}
	function getlist_detail($id){
		$this->db->SELECT('A.*, B.QUESTION_VALUE AS DETPACK_QUESTION_VALUE');
		$this->db->where('A.DETPACK_PACKET_ID', $id);
		$this->db->join('T_REF_QUESTIONS B', 'A.DETPACK_QUESTION_ID = B.QUESTION_ID', 'LEFT');
		return $this->db->get('T_REF_DET_QUE_PACK A');
	}
	function adddetails($datacreate){
		$this->db->insert('T_REF_DET_QUE_PACK', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('PACKET_ID', $id);
		return $this->db->update('T_REF_QUE_PACK', $dataupdate);
	}

	function del_opt($id){
		$query = "DELETE T_REF_DET_QUE_PACK WHERE DETPACK_PACKET_ID = ".$id;
		$this->db->query($query);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('PACKET_STATUS',0);
		$this->db->where('PACKET_ID', $id);
		return $this->db->update('T_REF_QUE_PACK');
	}


	function aktif($id){
		$this->insert_log($id);
		$this->db->set('PACKET_STATUS',1);
		$this->db->where('PACKET_ID', $id);
		return $this->db->update('T_REF_QUE_PACK');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */