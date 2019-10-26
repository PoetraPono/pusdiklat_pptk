<?php 
class Report_model extends CI_Model {

	function __construct() 
	{
		parent::__construct();		
	}

	function getListProgram($start,$end){
		$query = "SELECT * FROM V_PROGRAM WHERE PROGRAM_STATUS = 1 AND PROGRAM_START  BETWEEN '{$start}' AND '{$end}'";
		return $this->db->query($query);
	}

	function getListPeserta($start,$end){
		// $query = "SELECT
					// *
				// FROM
					// V_PROGRAM_PARTICIPANT
				// WHERE
					// PROPAR_STATUS = 1
				// AND PROGRAM_STATUS = 1
				// AND PROGRAM_START BETWEEN '{$start}'
				// AND '{$end}' ORDER BY PROPAR_PROGRAM_ID ASC, MEMBER_NAME ASC";
		$query = "SELECT
					*
				FROM
					V_PROGRAM_PARTICIPANT
				WHERE
					PROPAR_STATUS = 1
				AND PROGRAM_STATUS = 1
				AND PROGRAM_START BETWEEN '{$start}'
				AND '{$end}' ORDER BY PROPAR_PROGRAM_ID ASC, MEMBER_NAME ASC";
		return $this->db->query($query);
	}

	function getListInstansi($start,$end){
		// $query = "SELECT
					// P.INSTANSI_NAME,
					// P.PROGRAM_NAME,
					// P.PROGRAM_START,
					// P.PROGRAM_END,
					// CAST(P.PROGRAM_DESCRIPTION AS VARCHAR(4000)) AS PROGRAM_DESCRIPTION,
					// P.SECTOR_NAME,
					// P.TINDAK_PIDANA_NAME,
					// COUNT(1) AS JML_PESERTA
				// FROM
					// V_PROGRAM_PARTICIPANT AS P
				// WHERE
					// P.PROPAR_STATUS = 1
				// AND P.PROGRAM_STATUS = 1
				// AND P.PROGRAM_START BETWEEN '{$start}'
				// AND '{$end}'
				// GROUP BY
					// P.INSTANSI_NAME,
					// P.PROGRAM_NAME,
					// P.PROGRAM_START,
					// P.PROGRAM_END,
					// CAST(P.PROGRAM_DESCRIPTION AS VARCHAR(4000)),
					// P.SECTOR_NAME,
					// P.TINDAK_PIDANA_NAME ORDER BY PROGRAM_START ASC";
		$query = "SELECT
					P.INSTANSI_NAME,
					P.PROGRAM_NAME,
					P.PROGRAM_START,
					P.PROGRAM_END,
					CAST(P.PROGRAM_DESCRIPTION AS VARCHAR(4000)) AS PROGRAM_DESCRIPTION,
					P.SECTOR_NAME,
					P.TINDAK_PIDANA_NAME,
					COUNT(1) AS JML_PESERTA
				FROM
					V_PROGRAM_PARTICIPANT AS P
				WHERE
					P.PROPAR_STATUS = 1
				AND P.PROGRAM_STATUS = 1
				AND P.PROGRAM_START BETWEEN '{$start}'
				AND '{$end}'
				GROUP BY
					P.INSTANSI_NAME,
					P.PROGRAM_NAME,
					P.PROGRAM_START,
					P.PROGRAM_END,
					CAST(P.PROGRAM_DESCRIPTION AS VARCHAR(4000)),
					P.SECTOR_NAME,
					P.TINDAK_PIDANA_NAME ORDER BY PROGRAM_START ASC";
		return $this->db->query($query);
	}

	function listSector(){
		// $query = "SELECT
			// SECTOR_ID,
			// SECTOR_NAME,
			// (
				// SELECT
					// COUNT (1)
				// FROM
					// T_PROGRAM
				// WHERE
					// PROGRAM_SECTOR_ID = SECTOR_ID
				// AND PROGRAM_STATUS = 1
			// ) AS JML
		// FROM
			// T_REF_SECTOR";
		$query = "SELECT
			SECTOR_ID,
			SECTOR_NAME,
			(
				SELECT
					COUNT (1)
				FROM
					T_PROGRAM
				WHERE
					PROGRAM_SECTOR_ID = SECTOR_ID
				AND PROGRAM_STATUS = 1
			) AS JML
		FROM
			T_REF_SECTOR";
		return $this->db->query($query);
	}

	function listSasaran($id){
		// $query = "SELECT
					// TINDAK_PIDANA_ID,
					// TINDAK_PIDANA_NAME,
					// (
						// SELECT
							// COUNT (1)
						// FROM
							// T_PROGRAM
						// WHERE
							// PROGRAM_SASARAN_ID = TINDAK_PIDANA_ID
						// AND PROGRAM_STATUS = 1
					// ) AS JML
				// FROM
					// T_REF_TINDAK_PIDANA
				// WHERE TINDAK_PIDANA_SECTOR_ID = {$id}";
		$query = "SELECT
					TINDAK_PIDANA_ID,
					TINDAK_PIDANA_NAME,
					(
						SELECT
							COUNT (1)
						FROM
							T_PROGRAM
						WHERE
							PROGRAM_SASARAN_ID = TINDAK_PIDANA_ID
						AND PROGRAM_STATUS = 1
					) AS JML
				FROM
					T_REF_TINDAK_PIDANA
				WHERE TINDAK_PIDANA_SECTOR_ID = {$id}";
		return $this->db->query($query);
	}


}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */