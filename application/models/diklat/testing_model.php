
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
	}

	public function createTesting($data) {
		$this->db->insert('T_PROGRAM_TESTING', $data);
		return $this->db->insert_id();
	}
	public function updateTesting($id, $type, $data) {
		$this->db->where('PROTEST_PROGRAM_ID', $id);
		$this->db->where('PROTEST_TYPE', $type);
		return $this->db->update('T_PROGRAM_TESTING', $data);
	}
	public function createsoal($data) {
		$this->db->insert('T_PROGRAM_QUESTIONS', $data);
		return $this->db->insert_id();
	}
	public function createScore($data) {
		$this->db->insert('T_PROGRAM_SCORE', $data);
		return $this->db->insert_id();		
	}
	//////////////////////////////////////////////
	public function getlistScore($propar_id, $type) {
		$this->db->where('PROSCR_PROPAR_ID', $propar_id);
		$this->db->where('PROSCR_PROTEST_TYPE', $type);
		$this->db->where('PROSCR_STATUS', 1);
		return $this->db->get('T_PROGRAM_SCORE');
	}
	public function createoption($data) {
		$this->db->insert('T_PROGRAM_QUE_OPTIONS', $data);
		return $this->db->insert_id();
	}
	
	public function high_post_test(){
		//SELECT MAX(proscr_value) AS 'Maximum Value' FROM t_program_score WHERE proscr_protest_type = '2';
		$query = "
		SELECT Max(`B`.`PROSCR_VALUE`) AS 'max_post_test', `c`.`MEMBER_NAME`, `c`.`MEMBER_EMAIL`, `B`.`PROSCR_PROTEST_TYPE`,
		`c`.`PROPAR_PROGRAM_ID` 
		FROM
		`t_program_testing` AS `A`  INNER JOIN `t_program_score` AS `B` ON `A`.`PROTEST_PROGRAM_ID` = `B`.`PROSCR_PROPAR_ID`
		INNER JOIN `V_PROGRAM_PARTICIPANT` AS `c` ON `B`.`PROSCR_PROPAR_ID` = `c`.`PROPAR_PROGRAM_ID`
		WHERE
		`B`.`PROSCR_PROTEST_TYPE` = 2 ";
		return $this->db->query($query);
	}
	public function high_pre_test(){
		//SELECT MAX(proscr_value) AS 'Maximum Value' FROM t_program_score WHERE proscr_protest_type = '2';
		$query = "
		SELECT Max(`B`.`PROSCR_VALUE`) AS 'max_pre_test', `c`.`MEMBER_NAME`, `c`.`MEMBER_EMAIL`, `B`.`PROSCR_PROTEST_TYPE`,
		`c`.`PROPAR_PROGRAM_ID` 
		FROM
		`t_program_testing` AS `A`  INNER JOIN `t_program_score` AS `B` ON `A`.`PROTEST_PROGRAM_ID` = `B`.`PROSCR_PROPAR_ID`
		INNER JOIN `V_PROGRAM_PARTICIPANT` AS `c` ON `B`.`PROSCR_PROPAR_ID` = `c`.`PROPAR_PROGRAM_ID`
		WHERE
		`B`.`PROSCR_PROTEST_TYPE` = 1 ";
		return $this->db->query($query);
	}
	
	public function minimum_pre_test()
	{
		$query = "SELECT Min(`B`.`PROSCR_VALUE`) AS 'min_pre_test', `c`.`MEMBER_NAME` FROM `t_program_testing` AS `A` INNER JOIN `t_program_score` AS `B` ON `A`.`PROTEST_PROGRAM_ID` = `B`.`PROSCR_PROPAR_ID` INNER JOIN `V_PROGRAM_PARTICIPANT` AS `c` ON `B`.`PROSCR_PROPAR_ID` = `c`.`PROPAR_PROGRAM_ID` WHERE `B`.`PROSCR_PROTEST_TYPE` = 1 ";
		return $this->db->query($query);
	}
	
	public function maximum_post_test()
	{
		$query = "SELECT Max(`B`.`PROSCR_VALUE`) AS 'max_post_test', `c`.`MEMBER_NAME` FROM `t_program_testing` AS `A` INNER JOIN `t_program_score` AS `B` ON `A`.`PROTEST_PROGRAM_ID` = `B`.`PROSCR_PROPAR_ID` INNER JOIN `V_PROGRAM_PARTICIPANT` AS `c` ON `B`.`PROSCR_PROPAR_ID` = `c`.`PROPAR_PROGRAM_ID` WHERE `B`.`PROSCR_PROTEST_TYPE` = 2 ";
		return $this->db->query($query);
	}
	
	public function all_posttest_value()
	{
		$query = "SELECT proscr_value FROM t_program_score WHERE proscr_protest_type = '2'";
		return $this->db->query($query);
	}
	
	/////////////////////////////////////////////////
	public function getlistTesting($id, $type=0) {
		$this->db->where('PROTEST_PROGRAM_ID', $id);
		if($type!=0){
			$this->db->where('PROTEST_TYPE', $type);
		}
		return $this->db->get('T_PROGRAM_TESTING');
	}

	function getlist_soal($id=0){
		$this->db->where('QUESTION_PROTEST_ID', $id);
		$this->db->where('QUESTION_STATUS', 1);
		$this->db->order_by('QUESTION_SORT','ASC');
		return $this->db->get('T_PROGRAM_QUESTIONS');
	}
	function getlist_option($id=0){
		$this->db->where('OPTION_QUESTION_ID', $id);
		$this->db->where('OPTION_STATUS', 1);
		$this->db->order_by('OPTION_SORT','ASC');
		return $this->db->get('T_PROGRAM_QUE_OPTIONS');
	}
	function getlist_optionsoal($id=0){
		$this->db->where('OPTION_QUESTION_ID', $id);
		$this->db->where('OPTION_STATUS', 1);
		$this->db->order_by('OPTION_SORT','ASC');
		return $this->db->get('T_REF_QUE_OPTIONS');
	}
	function delete_soal($id=0){
		$this->db->where('QUESTION_PROTEST_ID', $id);
		return $this->db->delete('T_PROGRAM_QUESTIONS');
	}
	function delete_option($id=0){
		$this->db->where('OPTION_QUESTION_ID', $id);
		return $this->db->delete('T_PROGRAM_QUE_OPTIONS');
	}
	function deleteScore($propar_id, $type){
		$this->db->where('PROSCR_PROPAR_ID', $propar_id);
		$this->db->where('PROSCR_PROTEST_TYPE', $type);
		return $this->db->delete('T_PROGRAM_SCORE');
	}



	public function startEndTes($id,$type,$status) {
		$this->db->set('PROTEST_IS_START', $status);
		$this->db->where('PROTEST_TYPE', $type);
		$this->db->where('PROTEST_PROGRAM_ID', $id);
		$this->db->update('T_PROGRAM_TESTING');
	}

	function getListParticipant($Id) {
		$this->db->where('PROPAR_PROGRAM_ID', $Id);
		$this->db->where('PROPAR_STATUS', 1);
		$this->db->order_by('INSTANSI_NAME', 'ASC');
		$this->db->order_by('MEMBER_NAME', 'ASC');
		return $this->db->get('V_PROGRAM_PARTICIPANT');
	}

	function update_pretest($qid, $answer){
		$this->db->query("UPDATE T_PROGRAM_QUE_OPTIONS SET OPTION_ANSWER = 0 WHERE OPTION_QUESTION_ID = {$qid}");
		$this->db->query("UPDATE T_PROGRAM_QUE_OPTIONS SET OPTION_ANSWER = 1 WHERE OPTION_QUESTION_ID = '".$qid."' AND OPTION_ID = '".$answer."'");
	}

	function getlistTestingParticipant($id){
		$query = "SELECT T_PROGRAM_SCORE.* FROM T_PROGRAM_SCORE LEFT JOIN T_PROGRAM_PARTICIPANT ON PROPAR_ID = PROSCR_PROPAR_ID WHERE PROPAR_PROGRAM_ID = '".$id."'";
		return $this->db->query($query);
	}

	function ReScoring($id,$jml){
		//step 1 update jawaban benar
		$query1 = "UPDATE T_PROGRAM_SCORE_DETAIL
		SET T_PROGRAM_SCORE_DETAIL.PROSCR_DETAIL_ANSWER_TRUE = T_PROGRAM_QUE_OPTIONS.OPTION_VALUE
		FROM
			T_PROGRAM_QUE_OPTIONS
		WHERE
			T_PROGRAM_SCORE_DETAIL.PROSCR_DETAIL_QUESTION_ID = T_PROGRAM_QUE_OPTIONS.OPTION_QUESTION_ID
		AND T_PROGRAM_QUE_OPTIONS.OPTION_ANSWER = 1
		AND T_PROGRAM_SCORE_DETAIL.PROSCR_DETAIL_PROSCR_ID = '".$id."'";
		//echo $query1; die;
		$this->db->query($query1);
		//step 2 update benar/salah jawaban peserta
		$query2 = "UPDATE T_PROGRAM_SCORE_DETAIL
		SET PROSCR_DETAIL_IS_TRUE = (
			CASE
			WHEN PROSCR_DETAIL_ANSWER_TRUE = PROSCR_DETAIL_ANSWER THEN
				1
			ELSE
				0
			END
		)
		WHERE PROSCR_DETAIL_PROSCR_ID = '".$id."'";
		$this->db->query($query2);

		//step 3 update nilai tes peserta
		$query3 = "UPDATE T_PROGRAM_SCORE
		SET PROSCR_VALUE = ((
			SELECT
				CAST(COUNT (1) AS DECIMAL)
			FROM
				T_PROGRAM_SCORE_DETAIL
			WHERE
				PROSCR_DETAIL_PROSCR_ID = PROSCR_ID
			AND PROSCR_DETAIL_IS_TRUE = 1
		)/ ".$jml.") * 100
		WHERE PROSCR_ID = '".$id."'";
		$this->db->query($query3);

	}
	// public function getQuestionOption($qId) {
	// 	$this->db->where('QUEOPTION_QUESTION_ID', $qId);
	// 	$this->db->order_by('QUEOPTION_SORT', 'ASC');
	// 	return $this->db->get('T_PROGRAM_QUE_OPTIONS');
	// }

}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */