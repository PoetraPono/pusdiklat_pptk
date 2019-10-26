<?php 
class Diklat_model extends CI_Model {

	function __construct() 
	{
		parent::__construct();		
	}

	function insert_log_prog($id) {
		/*$this->db->query("
			INSERT INTO T_PROGRAM
			(
				
				PROGRAM_SECTOR_ID,
				PROGRAM_NAME,
				PROGRAM_TOTAL_HOURS,
				PROGRAM_TOTAL_LESSON,
				PROGRAM_START,
				PROGRAM_END,
				PROGRAM_ATTACHMENT_PATH,
				PROGRAM_IMAGE_PATH,
				PROGRAM_CREATE_BY,
				PROGRAM_CREATE_DATE,
				PROGRAM_STATUS,
				PROGRAM_LOG_ID

			
			)
			SELECT
				PROGRAM_SECTOR_ID,
				PROGRAM_NAME,
				PROGRAM_TOTAL_HOURS,
				PROGRAM_TOTAL_LESSON,
				PROGRAM_START,
				PROGRAM_END,
				PROGRAM_ATTACHMENT_PATH,
				PROGRAM_IMAGE_PATH,
				PROGRAM_CREATE_BY,
				PROGRAM_CREATE_DATE,
				PROGRAM_STATUS,
				PROGRAM_ID
			FROM T_PROGRAM WHERE PROGRAM_ID = ".$id."
		");*/
	}
	
	function getKatering($id){
		$this->db->select('PP.*,RC.*');
		$this->db->where('PP.PROCAT_PROGRAM_ID', $id);
		$this->db->join('T_REF_CATERING RC', 'PP.PROCAT_CATERING_ID = RC.CATERING_ID', 'LEFT');
		return $this->db->get('T_PROGRAM_CATERING PP');
	}
	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='DESC', $search='', $fields=''){
		$this->db->where('PROGRAM_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS', 1);
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
			$this->db->order_by('PROGRAM_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_PROGRAM',$limit,$offset);
	}

	function count_all($search='', $fields=''){
		$this->db->where('PROGRAM_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS', 1);
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
		$this->db->from('V_PROGRAM');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields=''){
		$this->db->where('PROGRAM_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS',0);
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
			$this->db->order_by('PROGRAM_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('V_PROGRAM',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields=''){
		$this->db->where('PROGRAM_LOG_ID is null');
		$this->db->where('PROGRAM_STATUS',0);
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
		$this->db->from('V_PROGRAM');
		return $this->db->count_all_results(); 
	}

	function create_cat($data){
		$this->db->insert('T_PROGRAM_CATERING', $data);
		return $this->db->insert_id();
	}
	function getlist_procat($id){
		$this->db->where('PROCAT_PROGRAM_ID', $id);
		return $this->db->get('T_PROGRAM_CATERING');
	}
	function getlist_paketsoal(){
		$this->db->where('PACKET_STATUS', 1);
		$this->db->where('PACKET_LOG_ID', NULL);
		return $this->db->get('T_REF_QUE_PACK');		
	}
	function getlist_soalonpaket($id=0){
		$this->db->SELECT('A.*, B.QUESTION_VALUE AS DETPACK_QUESTION_VALUE');
		$this->db->where('A.DETPACK_PACKET_ID', $id);
		$this->db->order_by('DETPACK_SORT','ASC');
		$this->db->join('T_REF_QUESTIONS B', 'A.DETPACK_QUESTION_ID = B.QUESTION_ID', 'LEFT');
		return $this->db->get('T_REF_DET_QUE_PACK A');
	}
	function getlist_optiononpaket($id=0){
		$this->db->where('OPTION_QUESTION_ID', $id);
		$this->db->order_by('OPTION_SORT','ASC');
		$this->db->order_by('OPTION_STATUS','1');
		return $this->db->get('T_REF_QUE_OPTIONS');
	}

	function delete_cat($id){
		$this->db->where('PROCAT_PROGRAM_ID', $id);
		return $this->db->delete('T_PROGRAM_CATERING');
	}
	function create_catdet($data){
		$this->db->insert('T_PROGRAM_DET_CATERING', $data);
		return $this->db->insert_id();
	}
	function getlist_catdet($id){
		$this->db->select('P.*, R.CAT_MENU_NAME AS DET_CAT_MENU_NAME');
		$this->db->where('P.DET_PROCAT_ID', $id);
		$this->db->join('T_REF_CATERING_MENU R', 'R.CAT_MENU_ID = P.DET_CAT_MENU_ID', 'LEFT');
		return $this->db->get('T_PROGRAM_DET_CATERING P');
	}
	function delete_catdet($id){
		$this->db->where('DET_PROCAT_ID', $id);
		return $this->db->delete('T_PROGRAM_DET_CATERING');
	}

	function getDetail($progId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('PROGRAM_ID', $progId);
		return $this->db->get('T_PROGRAM');
	}

	function getPidana($Id){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('TINDAK_PIDANA_ID', $Id);
		return $this->db->get('T_REF_TINDAK_PIDANA');
	}

	function getMenuDetail($id){
		$this->db->where('CAT_MENU_CATERING_ID', $id);
		$this->db->select("
			T_REF_CATERING_MENU.CAT_MENU_ID,
			T_REF_CATERING_MENU.CAT_MENU_CATERING_ID,
			T_REF_CATERING_MENU.CAT_MENU_NAME,
			T_REF_CATERING_MENU.CAT_MENU_STATUS,
			T_REF_CATERING_MENU.CAT_MENU_CAT_ID,
			T_REF_MENU_CATEGORY.CAT_MENU_NAME as CAT_MENU_CAT_NAME"
		);
		$this->db->join('T_REF_MENU_CATEGORY', 'T_REF_CATERING_MENU.CAT_MENU_CAT_ID = T_REF_MENU_CATEGORY.CAT_MENU_ID', 'LEFT');
		$this->db->order_by('T_REF_CATERING_MENU.CAT_MENU_CAT_ID', 'ASC');
		return $this->db->get('T_REF_CATERING_MENU');
	}
	function getMenuCat(){
		$this->db->where('CAT_MENU_STATUS', 1);
		return $this->db->get('T_REF_MENU_CATEGORY');
	}

	function getListSector(){
		return $this->db->get_where('T_REF_SECTOR', array('SECTOR_STATUS' => 1));
	}

	function getListSasaran(){
		return $this->db->get_where('T_REF_TINDAK_PIDANA', array('TINDAK_PIDANA_STATUS' => 1));
	}

	function getListInstructor(){
		return $this->db->get_where('T_REF_INSTRUCTOR', array('INSTRUCTOR_STATUS' => 1, 'INSTRUCTOR_LOG_ID' => null));
	}

	function getListModul(){
		return $this->db->get_where('T_REF_SILABUS', array('SILABUS_STATUS' => 1, 'SILABUS_LOG_ID' => null));
	}

	function getListRequisite($Id) {
		$this->db->where('PROREQ_PROGRAM_ID', $Id);
		$this->db->where('PROREQ_STATUS', 1);
		$this->db->order_by('PROREQ_ID', 'ASC');
		return $this->db->get('T_PROGRAM_REQUISITE');
	}

	function addRequisite($datacreate){
		$this->db->insert('T_PROGRAM_REQUISITE', $datacreate);
		return $this->db->insert_id();
	}

	function updateRequisite($dataupdate,$id){
		$this->db->where('PROREQ_ID', $id);
		$this->db->update('T_PROGRAM_REQUISITE', $dataupdate);		
	}

	function checkRequisite($prparid,$proreqid){
		$this->db->where('PROATT_PARTICIPANT_ID', $prparid);
		$this->db->where('PROATT_REQUISITE_ID', $proreqid);
		$this->db->where('PROATT_STATUS', 1);
		$this->db->from('T_PROGRAM_REQ_ATTACH');
		return $this->db->count_all_results(); 	
	}
	function getRequisite($prparid,$proreqid){
		$this->db->where('PROATT_PARTICIPANT_ID', $prparid);
		$this->db->where('PROATT_REQUISITE_ID', $proreqid);
		//$this->db->where('PROATT_STATUS', 1);
		return $this->db->get('T_PROGRAM_REQ_ATTACH');		
	}
	function getStatusApproveParticipant($id){
		$this->db->where('PROPAR_PROGRAM_ID', $id);
		$this->db->where('PROPAR_STATUS', 1);
		$this->db->from('T_PROGRAM_PARTICIPANT');
		return $this->db->count_all_results(); 	
	}

	function deleteRequisite($id){
		$this->db->where('PROREQ_PROGRAM_ID', $id);
		$this->db->set('PROREQ_STATUS', 0);
		$this->db->update('T_PROGRAM_REQUISITE');		
	}

	function addProgramMateri($datacreate){
		$this->db->insert('T_PROGRAM_MATERI', $datacreate);
		return $this->db->insert_id();
	}

	function updateProgramMateri($dataupdate,$id){
		$this->db->where('PROMA_ID', $id);
		$this->db->update('T_PROGRAM_MATERI', $dataupdate);		
	}	

	function deleteProgramMateri($id){
		$this->db->where('PROMA_PROGRAM_ID', $id);
		$this->db->set('PROMA_STATUS', 0);
		$this->db->update('T_PROGRAM_MATERI');		
	}

	function getListModulDiklat($Id) {
		$this->db->where('PROMA_PROGRAM_ID', $Id);
		$this->db->where('PROMA_STATUS', 1);
		return $this->db->get('T_PROGRAM_MATERI');
	}

	function getListParticipant($Id) {
		$this->db->where('PROPAR_PROGRAM_ID', $Id);
		$this->db->order_by('MEMBER_JML_REQUISITE', 'desc');
		$this->db->order_by('PROPAR_SUBMIT_DATE', 'ASC');
		return $this->db->get('V_PROGRAM_PARTICIPANT');
	}

	function addModulDiklat($datacreate){
		$this->db->insert('T_PROGRAM_MATERI', $datacreate);
		return $this->db->insert_id();
	}

	function updateModulDiklat($dataupdate,$id){
		$this->db->where('PROMA_ID', $id);
		$this->db->update('T_PROGRAM_MATERI', $dataupdate);		
	}

	function approveParticipant($dataupdate,$id){
		$this->db->where('PROPAR_ID', $id);
		$this->db->update('T_PROGRAM_PARTICIPANT', $dataupdate);		
	}

	function deleteParticipant($id){
		$this->db->set('PROPAR_STATUS', 2);
		$this->db->where('PROPAR_PROGRAM_ID', $id);
		$this->db->update('T_PROGRAM_PARTICIPANT');		
	}

	function deleteModulDiklat($id){
		$this->db->where('PROMA_PROGRAM_ID', $id);
		$this->db->set('PROMA_STATUS', 0);
		$this->db->update('T_PROGRAM_MATERI');		
	}

	function addpromat($data){
		$this->db->insert('T_PROGRAM_MATERI', $data);
		return $this->db->insert_id(); 
	}


	function add($datacreate){
		$this->db->insert('T_PROGRAM', $datacreate);
		return $this->db->insert_id();
	}

	function addc($data){
		$this->db->insert('master_catstkhldrid', $data);
		return $this->db->insert_id(); 
	}

	function update($dataupdate, $id){
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM', $dataupdate);
	}

	function getlist_program($id=''){
		$this->db->where('SECTOR_ID', $id);
		$this->db->where('SECTOR_STATUS', 1);
		return $this->db->get('T_REF_SECTOR');
	}
	function getlist_sasaran($id=0){
		$this->db->where('TINDAK_PIDANA_SECTOR_ID', $id);
		$this->db->where('TINDAK_PIDANA_STATUS', 1);
		return $this->db->get('T_REF_TINDAK_PIDANA');
	}

	// function getSector($Sectorid){
	// 	$this->db->where('SECTOR_ID', $Sectorid);
	// 	return $this->db->get('T_REF_SECTOR');
	// }

	function deletemat($matId){
		$this->db->where('PROMA_PROGRAM_ID', $matId);
		return $this->db->delete('T_PROGRAM_MATERI');
	}

	function delete($id){
		$this->insert_log_prog($id);
		$this->db->set('PROGRAM_STATUS',0);
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM');
	}

	function aktif($id){
		$this->insert_log_prog($id);
		$this->db->set('PROGRAM_STATUS',1);
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM');
	}

	function getListProgram(){
		$this->db->where('PROGRAM_STATUS', 1);
		$this->db->order_by('PROGRAM_END', 'DESC');
		return $this->db->get('T_PROGRAM',10);
	}

	function getClass($id){
		$query = "SELECT ((ISNULL(COUNT(1),7) / (SELECT ISNULL(PROGRAM_TOTAL_KUOTA,0) FROM T_PROGRAM WHERE PROGRAM_ID = {$id})) + 1) AS CLASS FROM T_PROGRAM_PARTICIPANT WHERE PROPAR_STATUS = 1 AND PROPAR_PROGRAM_ID = {$id}";
		return $this->db->query($query);
	}

	function getMemberId($nik){
	    $this->db->where('MEMBER_ID', $nik);
	    return $this->db->get('T_REF_MEMBER');
	}

	function getInstansi($id=0){
	    $this->db->where('INSTANSI_ID', $id);
	    $this->db->where('INSTANSI_STATUS', 1);
	    return $this->db->get('T_REF_INSTANSI');
  	}

}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */