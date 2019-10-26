
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banksoal_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}

	function insert_log($id) {
		$this->db->query("
			INSERT INTO T_REF_QUESTIONS
			(
				
				QUESTION_VALUE,
				QUESTION_CREATE_BY,
				QUESTION_CREATE_DATE,
				QUESTION_STATUS,
				QUESTION_LOG_ID

			
			)
			SELECT
				QUESTION_VALUE,
				QUESTION_CREATE_BY,
				QUESTION_CREATE_DATE,
				QUESTION_STATUS,
				QUESTION_ID

			FROM T_REF_QUESTIONS WHERE QUESTION_ID = ".$id."
		");
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
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

	function count_all($search='', $fields=''){	
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

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
		$this->db->where('QUESTION_LOG_ID is null');
		$this->db->where('QUESTION_STATUS',0);
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

	function count_allnonaktif($search='', $fields=''){	
		$this->db->where('QUESTION_LOG_ID is null');
		$this->db->where('QUESTION_STATUS',0);
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
		$this->db->insert('T_REF_QUESTIONS', $datacreate);
		return $this->db->insert_id();
	}
	function get($id){
		$this->db->where('QUESTION_ID', $id);
		return $this->db->get('T_REF_QUESTIONS');
	}
	function getlist_options($id){
		$this->db->where('OPTION_QUESTION_ID', $id);
		return $this->db->get('T_REF_QUE_OPTIONS');
	}
	function adddetails($datacreate){
		$this->db->insert('T_REF_QUE_OPTIONS', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $id){
		$this->insert_log($id);
		$this->db->where('QUESTION_ID', $id);
		return $this->db->update('T_REF_QUESTIONS', $dataupdate);
	}

	function del_opt($id){
		$query = "DELETE T_REF_QUE_OPTIONS WHERE OPTION_QUESTION_ID = ".$id;
		$this->db->query($query);
	}

	function delete($id){
		$this->insert_log($id);
		$this->db->set('QUESTION_STATUS',0);
		$this->db->where('QUESTION_ID', $id);
		return $this->db->update('T_REF_QUESTIONS');
	}


	function aktif($id){
		$this->insert_log($id);
		$this->db->set('QUESTION_STATUS',1);
		$this->db->where('QUESTION_ID', $id);
		return $this->db->update('T_REF_QUESTIONS');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */