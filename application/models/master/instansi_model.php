
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_ins($id) {
		/*$this->db->query("
			INSERT INTO T_REF_INSTANSI
			(
				
				INSTANSI_NAME,
				INSTANSI_ADDRESS,
				INSTANSI_PARTICIPANTS,
				INSTANSI_PHONE,
				INSTANSI_PIC_NAME,
				INSTANSI_PIC_PHONE,
				INSTANSI_CREATE_BY,
				INSTANSI_CREATE_DATE,
				INSTANSI_STATUS,
				INSTANSI_LOG_ID
			
			)
			SELECT
				INSTANSI_NAME,
				INSTANSI_ADDRESS,
				INSTANSI_PARTICIPANTS,
				INSTANSI_PHONE,
				INSTANSI_PIC_NAME,
				INSTANSI_PIC_PHONE,
				INSTANSI_CREATE_BY,
				INSTANSI_CREATE_DATE,
				INSTANSI_STATUS,
				INSTANSI_ID
			FROM T_REF_INSTANSI WHERE INSTANSI_ID = ".$id."
		");*/
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('INSTANSI_LOG_ID is null');
		$this->db->where('INSTANSI_STATUS',1);
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
			$this->db->order_by('INSTANSI_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_INSTANSI',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('INSTANSI_LOG_ID is null');
		$this->db->where('INSTANSI_STATUS',1);
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
		$this->db->from('V_SYS_INSTANSI');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('INSTANSI_LOG_ID is null');
		$this->db->where('INSTANSI_STATUS',0);
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
			$this->db->order_by('INSTANSI_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_SYS_INSTANSI',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('INSTANSI_LOG_ID is null');
		$this->db->where('INSTANSI_STATUS',0);
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
		$this->db->from('V_SYS_INSTANSI');
		return $this->db->count_all_results(); 
	}

	function getDetail($KatId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('INSTANSI_ID', $KatId);
		return $this->db->get('V_SYS_INSTANSI');
	}


	function add($datacreate){
		$this->db->insert('T_REF_INSTANSI', $datacreate);
		return $this->db->insert_id();
	}

	function update($dataupdate, $idpengguna){
		$this->db->where('INSTANSI_ID', $idpengguna);
		return $this->db->update('T_REF_INSTANSI', $dataupdate);
	}

	function delete($id){
		$this->insert_log_ins($id);
		$this->db->set('INSTANSI_STATUS',0);
		$this->db->where('INSTANSI_ID', $id);
		return $this->db->update('T_REF_INSTANSI');
	}

	function aktif($id){
		$this->insert_log_ins($id);
		$this->db->set('INSTANSI_STATUS',1);
		$this->db->where('INSTANSI_ID', $id);
		return $this->db->update('T_REF_INSTANSI');
	}

	function getlistcategory(){
		$this->db->where('INSTANSI_CATEGORY_STATUS', 1);
		return $this->db->get('T_REF_INSTANSI_CATEGORY');
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */