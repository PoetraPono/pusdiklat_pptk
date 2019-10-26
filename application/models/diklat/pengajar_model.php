
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajar_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_peng($id) {
		$this->db->query("
			INSERT INTO T_REF_INSTRUCTOR
			(
				
				INSTRUCTOR_NAME,
				INSTRUCTOR_FIRST_TITLE,
				INSTRUCTOR_LAST_TITLE,
				INSTRUCTOR_ADDRESS,
				INSTRUCTOR_CV_PATH,
				INSTRUCTOR_IMAGE_PATH,
				INSTRUCTOR_CREATE_BY,
				INSTRUCTOR_CREATE_DATE,
				INSTRUCTOR_STATUS,
				INSTRUCTOR_LOG_ID
			
			)
			SELECT
				INSTRUCTOR_NAME,
				INSTRUCTOR_FIRST_TITLE,
				INSTRUCTOR_LAST_TITLE,
				INSTRUCTOR_ADDRESS,
				INSTRUCTOR_CV_PATH,
				INSTRUCTOR_IMAGE_PATH,
				INSTRUCTOR_CREATE_BY,
				INSTRUCTOR_CREATE_DATE,
				INSTRUCTOR_STATUS,
				INSTRUCTOR_ID
			FROM T_REF_INSTRUCTOR WHERE INSTRUCTOR_ID = ".$id."
		");
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('INSTRUCTOR_LOG_ID is null');
		$this->db->where('INSTRUCTOR_STATUS',1);
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
			$this->db->order_by('INSTRUCTOR_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_INSTRUCTOR',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('INSTRUCTOR_LOG_ID is null');
		$this->db->where('INSTRUCTOR_STATUS',1);
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
		$this->db->from('T_REF_INSTRUCTOR');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('INSTRUCTOR_LOG_ID is null');
		$this->db->where('INSTRUCTOR_STATUS',0);
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
			$this->db->order_by('INSTRUCTOR_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_REF_INSTRUCTOR',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('INSTRUCTOR_LOG_ID is null');
		$this->db->where('INSTRUCTOR_STATUS',0);
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
		$this->db->from('T_REF_INSTRUCTOR');
		return $this->db->count_all_results(); 
	}

	function getDetail($insId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('INSTRUCTOR_ID', $insId);
		return $this->db->get('T_REF_INSTRUCTOR');
	}

	function get($newsId) {
		$this->db->where('NEWS_ID', $newsId);
		return $this->db->get('T_POR_NEWS');
	}


	function add($datacreate){
		$this->db->insert('T_REF_INSTRUCTOR', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $id){
		$this->insert_log_peng($id);
		$this->db->where('INSTRUCTOR_ID', $id);
		return $this->db->update('T_REF_INSTRUCTOR', $dataupdate);
	}

	function delete($id){
		$this->insert_log_peng($id);
		$this->db->set('INSTRUCTOR_STATUS',0);
		$this->db->where('INSTRUCTOR_ID', $id);
		return $this->db->update('T_REF_INSTRUCTOR');
	}

	function aktif($id){
		$this->insert_log_peng($id);
		$this->db->set('INSTRUCTOR_STATUS',1);
		$this->db->where('INSTRUCTOR_ID', $id);
		return $this->db->update('T_REF_INSTRUCTOR');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */