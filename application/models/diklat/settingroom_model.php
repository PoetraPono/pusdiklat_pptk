<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingroom_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='DESC', $search='', $fields='')
	{
		$this->db->select('V_PROGRAM.*, (SELECT COUNT(1) FROM T_PROGRAM_PARTICIPANT WHERE V_PROGRAM.PROGRAM_ID = PROPAR_PROGRAM_ID AND PROPAR_STATUS = 1) AS JML_PESERTA');
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

	function count_all($search='', $fields='')
	{	
		$this->db->select('V_PROGRAM.*, (SELECT COUNT(1) FROM T_PROGRAM_PARTICIPANT WHERE V_PROGRAM.PROGRAM_ID = PROPAR_PROGRAM_ID AND PROPAR_STATUS = 1) AS JML_PESERTA');
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

	function createData($data){
		$this->db->insert('T_PROGRAM_ROOM', $data);
		return $this->db->insert_id();
	}

	function deleteData($id){
		// $query1 = "UPDATE T_REF_ROOMS
					// SET ROOMS_IS_FULL = 0
					// WHERE
						// ROOMS_ID IN (
							// SELECT
								// PROROOM_ROOM_ID
							// FROM
								// T_PROGRAM_ROOM
							// WHERE
								// PROROOM_PROGRAM_ID = {$id}
						// )";
		$query1 = "UPDATE T_REF_ROOMS
					SET ROOMS_IS_FULL = 0
					WHERE
						ROOMS_ID IN (
							SELECT
								PROROOM_ROOM_ID
							FROM
								T_PROGRAM_ROOM
							WHERE
								PROROOM_PROGRAM_ID = {$id}
						)";
		$this->db->query($query1);
		// $query = "DELETE T_PROGRAM_ROOM WHERE PROROOM_PROGRAM_ID = ".$id;
		$query = "DELETE T_PROGRAM_ROOM WHERE PROROOM_PROGRAM_ID = ".$id;
		$this->db->query($query);
	}

	function getListRoom($id, $start,$end){
		$query = "SELECT
					R.ROOMS_ID,
					R.ROOMS_NAME,
					R.ROOMS_NUMBER,
					R.ROOMS_CAPACITY,
					R.ROOMS_IS_FULL,
					(
						SELECT
							COUNT (1)
						FROM
							T_PROGRAM_ROOM PR
						WHERE
							PR.PROROOM_ROOM_ID = R.ROOMS_ID
						AND ('{$start} 14:00:00' BETWEEN PROROOM_START
						AND PROROOM_END
						OR '{$end} 12:00:00' BETWEEN PROROOM_START
						AND PROROOM_END)
						AND PROROOM_PROGRAM_ID != {$id}
						AND R.ROOMS_IS_FULL = 0
					) AS ROOM_STATUS,
					(
						SELECT
							COUNT (1)
						FROM
							T_PROGRAM_ROOM PR
						WHERE
							PR.PROROOM_ROOM_ID = R.ROOMS_ID
						AND '{$start} 14:00:00' BETWEEN PROROOM_START
						AND PROROOM_END
						AND PROROOM_PROGRAM_ID = {$id}
					) AS ROOM_ISI,
					ROOMS_STATUS AS ROOM_ACTIVE
				FROM
					T_REF_ROOMS R
				WHERE R.ROOMS_STATUS IN (0,1)";					
		return $this->db->query($query);
	}

	function getListPeserta($id){
		$query = "SELECT
					*,
					(SELECT COUNT(1) FROM T_PROGRAM_ROOM WHERE PROROOM_PROGRAM_ID = PROPAR_PROGRAM_ID AND PROROOM_PARTICIPANT_ID = PROPAR_ID AND PROROOM_STATUS = 1) AS STATUS_BOOKING
				FROM
					V_PROGRAM_PARTICIPANT
				WHERE
					PROPAR_PROGRAM_ID = {$id}
				AND PROPAR_STATUS = 1
				ORDER BY
					MEMBER_NAME ASC";
		return $this->db->query($query);
	}

	function getIsiRoom($id,$roomid){
		$query = "SELECT
					PROPAR_ID,
					MEMBER_NAME,
					MEMBER_GENDER
				FROM
					T_PROGRAM_ROOM
				LEFT JOIN V_PROGRAM_PARTICIPANT ON PROPAR_ID = PROROOM_PARTICIPANT_ID
				WHERE
					PROROOM_PROGRAM_ID = {$id}
				AND PROROOM_ROOM_ID = {$roomid}
				AND PROROOM_STATUS = 1";
		return $this->db->query($query);
	}	

	function checkStatusSetting($id){
		// $query = "SELECT
				// (SELECT COUNT(1) FROM T_PROGRAM_PARTICIPANT WHERE PROPAR_PROGRAM_ID = PROGRAM_ID AND PROPAR_STATUS = 1) AS JML_PARTICIPANT,
				// (SELECT COUNT(1) FROM T_PROGRAM_ROOM WHERE PROROOM_PROGRAM_ID = PROGRAM_ID AND PROROOM_STATUS = 1) AS JML_BOOKING
			// FROM
				// T_PROGRAM
			// WHERE
				// PROGRAM_ID = ".$id;
		$query = "SELECT
				(SELECT COUNT(1) FROM T_PROGRAM_PARTICIPANT WHERE PROPAR_PROGRAM_ID = PROGRAM_ID AND PROPAR_STATUS = 1) AS JML_PARTICIPANT,
				(SELECT COUNT(1) FROM T_PROGRAM_ROOM WHERE PROROOM_PROGRAM_ID = PROGRAM_ID AND PROROOM_STATUS = 1) AS JML_BOOKING
			FROM
				T_PROGRAM
			WHERE
				PROGRAM_ID = ".$id;
		return $this->db->query($query);
	}

	function getlist_proroom($id){
		//$this->db->where('PROROOM_PROGRAM_ID', $id);
		// $this->db->group_by('PROROOM_PROGRAM_ID');
		//return $this->db->get('V_PROGRAM_ROOM');
		// $query = "SELECT
					// ROOMS_NAME,
					// ROOMS_CAPACITY,
					// ROOMS_NUMBER,
					// PROROOM_ROOM_ID
				// FROM
					// V_PROGRAM_ROOMS
				// WHERE
					// PROROOM_PROGRAM_ID = {$id}
				// GROUP BY
					// ROOMS_NAME,
					// ROOMS_CAPACITY,
					// ROOMS_NUMBER,
	// PROROOM_ROOM_ID";
	$query = "SELECT
					ROOMS_NAME,
					ROOMS_CAPACITY,
					ROOMS_NUMBER,
					PROROOM_ROOM_ID
				FROM
					V_PROGRAM_ROOMS
				WHERE
					PROROOM_PROGRAM_ID = {$id}
				GROUP BY
					ROOMS_NAME,
					ROOMS_CAPACITY,
					ROOMS_NUMBER,
	PROROOM_ROOM_ID";
		return $this->db->query($query);
	}


	function getlist_detailroom($progid,$id){
		$this->db->where('PROROOM_PROGRAM_ID', $progid);
		$this->db->where('PROROOM_ROOM_ID', $id);
		return $this->db->get('V_PROGRAM_ROOMS');
	}
	function setfullRoom($id){
		$this->db->set('ROOMS_IS_FULL', 1);
		$this->db->where('ROOMS_ID', $id);
		$this->db->update('T_REF_ROOMS');
	}

	
}