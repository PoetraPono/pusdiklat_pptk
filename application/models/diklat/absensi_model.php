<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getListKelasBaj(){
        return $this->db->get_where('T_REF_ROOM', array('ROOM_STATUS' => 1));
    }

    function getListKelas($id, $start,$end){
		$query = "SELECT
					R.ROOM_ID,
					R.ROOM_BUILDING,
					R.ROOM_CAPACITY,
					R.ROOM_NAME,
					R.ROOM_TYPE,
					(
						SELECT
							COUNT (1)
						FROM
							T_PROGRAM_CLASSROOM PR
						WHERE
							PR.CLASSROOM_ROOM_ID = R.ROOM_ID
						AND ('{$start} 14:00:00' BETWEEN CLASSROOM_START_DATE
						AND CLASSROOM_END_DATE
						OR '{$end} 12:00:00' BETWEEN CLASSROOM_START_DATE
						AND CLASSROOM_END_DATE)
						AND CLASSROOM_PROGRAM_ID != {$id}
					) AS ROOM_STATUS,
					(
						SELECT
							COUNT (1)
						FROM
							T_PROGRAM_CLASSROOM PR
						WHERE
							PR.CLASSROOM_ROOM_ID = R.ROOM_ID
						AND '{$start} 14:00:00' BETWEEN CLASSROOM_START_DATE
						AND CLASSROOM_END_DATE
						AND CLASSROOM_PROGRAM_ID = {$id}
					) AS ROOM_ISI
				FROM
					T_REF_ROOM R
				WHERE
					R.ROOM_STATUS = 1";					
		return $this->db->query($query);
	}

    function createData($data){
		$this->db->insert('T_PROGRAM_CLASSROOM', $data);
		return $this->db->insert_id();
	}



	function deleteData($id){
		$query = "DELETE T_PROGRAM_CLASSROOM WHERE CLASSROOM_PROGRAM_ID = ".$id;
		$this->db->query($query);
	}

	function getAbsen($progId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('ABSENCE_PROGRAM_ID', $progId);
		return $this->db->get('T_PROGRAM_ABSENCES');
	}
	function getclassParticipant($progId){
		$query = "SELECT
					PROPAR_CLASS
				FROM
					V_PROGRAM_PARTICIPANT
				WHERE
					PROPAR_PROGRAM_ID = {$progId}
				AND PROPAR_STATUS = 1
				GROUP BY PROPAR_CLASS";
		return $this->db->query($query);
	}

	function getlistParticipant($progId,$class=""){
		$this->db->where('P.PROPAR_PROGRAM_ID', $progId);
		if($class!=""){
			$this->db->where('P.PROPAR_CLASS', $class);
		}
		$this->db->where('P.PROPAR_STATUS', 1);
		$this->db->order_by('P.MEMBER_NAME', 'ASC');
		$this->db->join('T_REF_INSTANSI I', 'P.MEMBER_INSTANSI_ID = I.INSTANSI_ID', 'LEFT');
		return $this->db->get('V_PROGRAM_PARTICIPANT P');
	}


	function checkStatusSetting($id){
		// $query = "SELECT
				// (SELECT COUNT(1) FROM T_PROGRAM_CLASSROOM WHERE CLASSROOM_PROGRAM_ID = PROGRAM_ID AND CLASSROOM_STATUS = 1) AS JML_BOOKING
			// FROM
				// T_PROGRAM
			// WHERE
				// PROGRAM_ID = ".$id;
		$query = "SELECT
				(SELECT COUNT(1) FROM T_PROGRAM_CLASSROOM WHERE CLASSROOM_PROGRAM_ID = PROGRAM_ID AND CLASSROOM_STATUS = 1) AS JML_BOOKING
			FROM
				T_PROGRAM
			WHERE
				PROGRAM_ID = ".$id;
		return $this->db->query($query);
	}

	// function getListVendor(){
	// 	$this->db->where('CATERING_STATUS',1);
	// 	return $this->db->get('T_REF_CATERING');
	// }

		function getListVendor(){
		$this->db->where('CATERING_STATUS',1);
		return $this->db->get('T_REF_CATERING');
	}

	
	function getlist_Absen($id,$date){
		$this->db->where('ABSENCE_PROGRAM_ID', $id);
		$this->db->where('ABSENCE_PROGRAM_DATE', $date);
		$this->db->join('V_PROGRAM_PARTICIPANT', 'PROPAR_ID = ABSENCE_PARTICIPANT_ID', 'left');
		return $this->db->get('T_PROGRAM_ABSENCES');
	}
	function uploadabsenfile($id, $data){
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->update('T_PROGRAM', array('PROGRAM_ABSEN_FILE_PATH'=>$data));		
	}
	function getdetailprogram($id){
		$this->db->where('PROGRAM_ID', $id);
		return $this->db->get('T_PROGRAM');
	}
}