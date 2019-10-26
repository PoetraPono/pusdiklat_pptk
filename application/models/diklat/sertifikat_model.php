
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log_sert($id) {
		/*$this->db->query("
			INSERT INTO T_PROGRAM_SERTIFIKAT
			(
				
				SERTIFIKAT_PROGRAM_ID,
				SERTIFIKAT_TYPE,
				SERTIFIKAT_SIGNATURE1,
				SERTIFIKAT_SIGNATURE2,
				SERTIFIKAT_STATUS,
				SERTIFIKAT_LOG_ID

			)
			SELECT
				SERTIFIKAT_PROGRAM_ID,
				SERTIFIKAT_TYPE,
				SERTIFIKAT_SIGNATURE1,
				SERTIFIKAT_SIGNATURE2,
				SERTIFIKAT_ID
			
			FROM T_PROGRAM_SERTIFIKAT WHERE SERTIFIKAT_ID = ".$id."
		");*/
	}
	

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		//$this->db->where('SERTIFIKAT_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS',1);
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
			$this->db->order_by('SERTIFIKAT_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_PROGRAM_SERTIFIKAT',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		//$this->db->where('SERTIFIKAT_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS',1);
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
		$this->db->from('V_PROGRAM_SERTIFIKAT');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{

		$this->db->where('PROGRAM_STATUS',1);
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
			$this->db->order_by('SERTIFIKAT_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_PROGRAM_SERTIFIKAT',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	

		$this->db->where('PROGRAM_STATUS',1);
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
		$this->db->from('V_PROGRAM_SERTIFIKAT');
		return $this->db->count_all_results(); 
	}

	function getDetail($id){
		// $this->db->join('T_PROGRAM', 'employee_id = user_employee_id', 'inner');
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->get('V_PROGRAM_SERTIFIKAT');
	}

	function getSertifikat($id){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		return $this->db->get_where('T_PROGRAM_SERTIFIKAT', array('SERTIFIKAT_STATUS' => 1));
	}

	function getListSignature(){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		return $this->db->get_where('T_REF_SIGNATURE', array('SIGNATURE_STATUS' => 1));
	}

	function getListProgram(){
		return $this->db->get_where('T_PROGRAM', array('PROGRAM_STATUS' => 1));
	}


	// function add($dataupdate,$settingId){
	// 	$this->db->where('SERTIFIKAT_ID', $settingId);
	// 	$this->db->update('T_PROGRAM_SERTIFIKAT', $dataupdate);		
	// }	
	function setting($dataupdate,$id){
		
		$this->db->insert('T_PROGRAM_SERTIFIKAT', $dataupdate);		
	}	
	
	function update($dataupdate, $id){
		$this->db->where('SERTIFIKAT_PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM_SERTIFIKAT', $dataupdate);		
	}

	function uploadfile($fileupload, $id){
		$this->db->where('PROPAR_PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM_PARTICIPANT', $fileupload);		
	}	

	function delete($id){
		$this->insert_log_sert($id);
		$this->db->set('SERTIFIKAT_STATUS',0);
		$this->db->where('SERTIFIKAT_ID', $id);
		return $this->db->update('T_PROGRAM_SERTIFIKAT');
	}

	function aktif($id){
		$this->insert_log_sert($id);
		$this->db->set('SERTIFIKAT_STATUS',1);
		$this->db->where('SERTIFIKAT_ID', $id);
		return $this->db->update('T_PROGRAM_SERTIFIKAT');
	}

	function getPartcicpant($id){
		$this->db->where('PROPAR_ID', $id);
		return $this->db->get('V_PROGRAM_PARTICIPANT');
	}

	function getListParticipant($Id) {
		//$this->db->where('SERTIFIKAT_TYPE', 2);
		$this->db->where('PROPAR_PROGRAM_ID', $Id);
		$this->db->where('PROPAR_STATUS', 1);
		$this->db->order_by('MEMBER_JML_REQUISITE', 'desc');
		$this->db->order_by('PROPAR_SUBMIT_DATE', 'ASC');
		return $this->db->get('V_PROGRAM_PARTICIPANT');
	}

	function getJmlhPserta($id){
		$this->db->where('SERTIFIKAT_ID', $id);
		$this->db->where('SERTIFIKAT_TYPE', 1);
		return $this->db->get('T_PROGRAM_SERTIFIKAT');
		return $this->db->count_all_results(); 
	}

	function getProgram($id){
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->get('V_PROGRAM');
	}

	function getPartcicpantSert($Id) {
	    $this->db->where('PROPAR_ID', $Id);
	    $this->db->order_by('MEMBER_JML_REQUISITE', 'desc');
	    $this->db->order_by('PROPAR_SUBMIT_DATE', 'ASC');
	    return $this->db->get('V_PROGRAM_PARTICIPANT');
  	}

	 function getDetailSert($id){
	    // $this->db->join('T_PROGRAM', 'employee_id = user_employee_id', 'inner');
	    $this->db->where('PROGRAM_ID', $id);
	    return $this->db->get('V_PROGRAM_SERTIFIKAT');
	  }



	  function getProgramSert($id){
	    $this->db->where('PROGRAM_ID', $id);
	    return $this->db->get('V_PROGRAM');
	  }

	function getModulList($id){
		$this->db->select('PROMA_MATERI_ID,SILABUS_NAME,SILABUS_DESCRIPTION');
		$this->db->where('PROMA_PROGRAM_ID', $id);
		$this->db->where('PROMA_STATUS', 1);
		$this->db->join('T_REF_SILABUS','PROMA_MATERI_ID = SILABUS_ID', 'LEFT');
		$this->db->group_by('PROMA_MATERI_ID,SILABUS_NAME,SILABUS_DESCRIPTION');
	    return $this->db->get('T_PROGRAM_MATERI');
	}

}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */