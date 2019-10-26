<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingkelas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getListKelasBaj(){
        return $this->db->get_where('T_REF_ROOM', array('ROOM_STATUS' => 1));
    }

    function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='DESC', $search='', $fields=''){
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

	function count_all($search='', $fields=''){
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
}