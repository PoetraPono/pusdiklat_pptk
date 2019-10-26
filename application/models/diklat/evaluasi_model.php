
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluasi_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='DESC', $search='', $fields=''){
		$this->db->where('PROGRAM_STATUS',1);
		$this->db->where('PROGRAM_LOG_ID IS NULL');
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

		return $this->db->get('T_PROGRAM',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{
		$this->db->where('PROGRAM_STATUS',1);
		$this->db->where('PROGRAM_LOG_ID IS NULL');
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
		$this->db->from('T_PROGRAM');
		return $this->db->count_all_results(); 
	}

    function get_paged_list_detail($limit=10, $offset=0, $order_column='', $order_type='DESC', $search='', $fields='', $id=''){
        $this->db->join('T_PROGRAM', 'PROGRAM_ID = EVALUASI_PROGRAM_ID', 'left');
        $this->db->join('V_REF_MEMBER', 'MEMBER_ID = EVALUASI_MEMBER_ID', 'left');
        $this->db->where('EVALUASI_PROGRAM_ID', $id);
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

        return $this->db->get('T_PROGRAM_EVALUASI',$limit,$offset);
    }

    function count_all_detail($search='', $fields='', $id='')
    {
        $this->db->join('T_PROGRAM', 'PROGRAM_ID = EVALUASI_PROGRAM_ID', 'left');
        $this->db->join('T_REF_MEMBER', 'MEMBER_ID = EVALUASI_MEMBER_ID', 'left');
        $this->db->where('EVALUASI_PROGRAM_ID', $id);
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
        $this->db->from('T_PROGRAM_EVALUASI');
        return $this->db->count_all_results();
    }

	function getDetail($progId){
		// $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('PROGRAM_ID', $progId);
		return $this->db->get('T_PROGRAM');
	}

	function getRataAll($id){
		// $query = "SELECT
					// SUM(E.EVALUASI_NILAI_INDEX) / COUNT(E.EVALUASI_NILAI_INDEX) AS EVALUASI_NILAI_INDEX,
					// SUM(E.EVALUASI_PROSENTASE) / COUNT(E.EVALUASI_PROSENTASE) AS EVALUASI_PROSENTASE,
					// SUM(E.EVALUASI_IND_MODUL) / COUNT(E.EVALUASI_IND_MODUL) AS EVALUASI_IND_MODUL,
					// SUM(E.EVALUASI_PRO_MODUL) / COUNT(E.EVALUASI_PRO_MODUL) AS EVALUASI_PRO_MODUL,
					// SUM(E.EVALUASI_IND_WIDYAISWARA) / COUNT(E.EVALUASI_IND_WIDYAISWARA) AS EVALUASI_IND_WIDYAISWARA,
					// SUM(E.EVALUASI_PRO_WIDYAISWARA) / COUNT(E.EVALUASI_PRO_WIDYAISWARA) AS EVALUASI_PRO_WIDYAISWARA,
					// SUM(E.EVALUASI_IND_KELAS) / COUNT(E.EVALUASI_IND_KELAS) AS EVALUASI_IND_KELAS,
					// SUM(E.EVALUASI_PRO_KELAS) / COUNT(E.EVALUASI_PRO_KELAS) AS EVALUASI_PRO_KELAS,
					// SUM(E.EVALUASI_IND_MAKANAN) / COUNT(E.EVALUASI_IND_MAKANAN) AS EVALUASI_IND_MAKANAN,
					// SUM(E.EVALUASI_PRO_MAKANAN) / COUNT(E.EVALUASI_PRO_MAKANAN) AS EVALUASI_PRO_MAKANAN,
					// SUM(E.EVALUASI_IND_PENUNJANG) / COUNT(E.EVALUASI_IND_PENUNJANG) AS EVALUASI_IND_PENUNJANG,
					// SUM(E.EVALUASI_PRO_PENUNJANG) / COUNT(E.EVALUASI_PRO_PENUNJANG) AS EVALUASI_PRO_PENUNJANG
				// FROM
					// T_PROGRAM_EVALUASI AS E
				// WHERE E.EVALUASI_PROGRAM_ID = {$id}
				// GROUP BY E.EVALUASI_PROGRAM_ID";
		$query = "SELECT
					SUM(E.EVALUASI_NILAI_INDEX) / COUNT(E.EVALUASI_NILAI_INDEX) AS EVALUASI_NILAI_INDEX,
					SUM(E.EVALUASI_PROSENTASE) / COUNT(E.EVALUASI_PROSENTASE) AS EVALUASI_PROSENTASE,
					SUM(E.EVALUASI_IND_MODUL) / COUNT(E.EVALUASI_IND_MODUL) AS EVALUASI_IND_MODUL,
					SUM(E.EVALUASI_PRO_MODUL) / COUNT(E.EVALUASI_PRO_MODUL) AS EVALUASI_PRO_MODUL,
					SUM(E.EVALUASI_IND_WIDYAISWARA) / COUNT(E.EVALUASI_IND_WIDYAISWARA) AS EVALUASI_IND_WIDYAISWARA,
					SUM(E.EVALUASI_PRO_WIDYAISWARA) / COUNT(E.EVALUASI_PRO_WIDYAISWARA) AS EVALUASI_PRO_WIDYAISWARA,
					SUM(E.EVALUASI_IND_KELAS) / COUNT(E.EVALUASI_IND_KELAS) AS EVALUASI_IND_KELAS,
					SUM(E.EVALUASI_PRO_KELAS) / COUNT(E.EVALUASI_PRO_KELAS) AS EVALUASI_PRO_KELAS,
					SUM(E.EVALUASI_IND_MAKANAN) / COUNT(E.EVALUASI_IND_MAKANAN) AS EVALUASI_IND_MAKANAN,
					SUM(E.EVALUASI_PRO_MAKANAN) / COUNT(E.EVALUASI_PRO_MAKANAN) AS EVALUASI_PRO_MAKANAN,
					SUM(E.EVALUASI_IND_PENUNJANG) / COUNT(E.EVALUASI_IND_PENUNJANG) AS EVALUASI_IND_PENUNJANG,
					SUM(E.EVALUASI_PRO_PENUNJANG) / COUNT(E.EVALUASI_PRO_PENUNJANG) AS EVALUASI_PRO_PENUNJANG
				FROM
					T_PROGRAM_EVALUASI AS E
				WHERE E.EVALUASI_PROGRAM_ID = {$id}
				GROUP BY E.EVALUASI_PROGRAM_ID";
		return $this->db->query($query);
	}

	function getEvalModul($id){
		$query = "SELECT
				EVALUASI_MODUL_CAT_ID,
				EVALUASI_POINT_NAME,
				(SUM(EVALUASI_MODUL_INDEX))/COUNT(1) AS EVALUASI_INDEX,
				(SUM(EVALUASI_MODUL_PROSEN))/COUNT(1) AS EVALUASI_PROSEN
			FROM
				V_PROGRAM_EVALUASI_MODUL
			WHERE
				EVALUASI_PROGRAM_ID = {$id}
			GROUP BY
			EVALUASI_MODUL_CAT_ID,EVALUASI_POINT_NAME
		ORDER BY EVALUASI_MODUL_CAT_ID ASC";
		return $this->db->query($query);
	}

	function detailRateInstructor($programid,$memberid){
		if($memberid == 0){
			$query = "SELECT
					INSTRUCTOR_ID,
					INSTRUCTOR_NAME,
					INSTRUCTOR_FIRST_TITLE,
					INSTRUCTOR_LAST_TITLE,
					(
						SELECT
							CAST (
								SUM (
									EVALUASI_LIST_INS_RATE_NILAI
								) AS DECIMAL
							) / COUNT (1)
						FROM
							T_PROGRAM_EVALUASI_LIST_INS
						LEFT JOIN T_PROGRAM_EVALUASI ON EVALUASI_ID = EVALUASI_LIST_INS_EVALUASI_ID
						WHERE
							EVALUASI_LIST_INS_INSTRUCTOR_ID = INSTRUCTOR_ID
					) AS NILAI_INDEX,
					(
						SELECT
							(
								CAST (
									SUM (
										EVALUASI_LIST_INS_RATE_NILAI
									) AS DECIMAL
								) / COUNT (1)
							) / 5 * 100
						FROM
							T_PROGRAM_EVALUASI_LIST_INS
						LEFT JOIN T_PROGRAM_EVALUASI ON EVALUASI_ID = EVALUASI_LIST_INS_EVALUASI_ID
						WHERE
							EVALUASI_LIST_INS_INSTRUCTOR_ID = INSTRUCTOR_ID
					) AS NILAI_PROSEN
				FROM
					T_PROGRAM_MATERI
				LEFT JOIN T_REF_INSTRUCTOR ON INSTRUCTOR_ID = PROMA_INSTRUCTOR_ID
				WHERE
					PROMA_PROGRAM_ID = {$programid}
				AND PROMA_STATUS = 1
				GROUP BY
					INSTRUCTOR_ID,
					INSTRUCTOR_NAME,
					INSTRUCTOR_FIRST_TITLE,
					INSTRUCTOR_LAST_TITLE
				ORDER BY
					INSTRUCTOR_NAME ASC, INSTRUCTOR_ID ASC";
		}else{
			$query = "SELECT
					INSTRUCTOR_ID,
					INSTRUCTOR_NAME,
					INSTRUCTOR_FIRST_TITLE,
					INSTRUCTOR_LAST_TITLE,
					(
						SELECT
							CAST (
								SUM (
									EVALUASI_LIST_INS_RATE_NILAI
								) AS DECIMAL
							) / COUNT (1)
						FROM
							T_PROGRAM_EVALUASI_LIST_INS
						LEFT JOIN T_PROGRAM_EVALUASI ON EVALUASI_ID = EVALUASI_LIST_INS_EVALUASI_ID
						WHERE
							EVALUASI_LIST_INS_INSTRUCTOR_ID = INSTRUCTOR_ID
						AND EVALUASI_MEMBER_ID = {$memberid}
					) AS NILAI_INDEX,
					(
						SELECT
							(
								CAST (
									SUM (
										EVALUASI_LIST_INS_RATE_NILAI
									) AS DECIMAL
								) / COUNT (1)
							) / 5 * 100
						FROM
							T_PROGRAM_EVALUASI_LIST_INS
						LEFT JOIN T_PROGRAM_EVALUASI ON EVALUASI_ID = EVALUASI_LIST_INS_EVALUASI_ID
						WHERE
							EVALUASI_LIST_INS_INSTRUCTOR_ID = INSTRUCTOR_ID
						AND EVALUASI_MEMBER_ID = {$memberid}
					) AS NILAI_PROSEN
				FROM
					T_PROGRAM_MATERI
				LEFT JOIN T_REF_INSTRUCTOR ON INSTRUCTOR_ID = PROMA_INSTRUCTOR_ID
				WHERE
					PROMA_PROGRAM_ID = {$programid}
				AND PROMA_STATUS = 1
				GROUP BY
					INSTRUCTOR_ID,
					INSTRUCTOR_NAME,
					INSTRUCTOR_FIRST_TITLE,
					INSTRUCTOR_LAST_TITLE
				ORDER BY
					INSTRUCTOR_NAME ASC, INSTRUCTOR_ID ASC";
		}
		return $this->db->query($query);
		
	}

	function get_evaluasi_participant($id=''){
        $this->db->join('T_PROGRAM', 'PROGRAM_ID = EVALUASI_PROGRAM_ID', 'left');
        $this->db->join('V_REF_MEMBER', 'MEMBER_ID = EVALUASI_MEMBER_ID', 'left');
        $this->db->where('EVALUASI_PROGRAM_ID', $id);
        return $this->db->get('T_PROGRAM_EVALUASI');
    }

    function getEvalPeserta($id=''){
        $this->db->select('EVALUASI_MEMBER_ID,MEMBER_NAME,INSTANSI_NAME,EVALUASI_NILAI_INDEX,EVALUASI_PROSENTASE');
        $this->db->join('V_REF_MEMBER', 'MEMBER_ID = EVALUASI_MEMBER_ID', 'left');
        $this->db->where('EVALUASI_PROGRAM_ID', $id);
        return $this->db->get('T_PROGRAM_EVALUASI');
    }


    function getEvalPesertaModul($id,$memberid){
		$query = "SELECT
				*
				FROM
					V_PROGRAM_EVALUASI_MODUL
				WHERE
					EVALUASI_PROGRAM_ID = {$id}
				AND EVALUASI_MEMBER_ID = {$memberid}			
			ORDER BY EVALUASI_MODUL_CAT_ID ASC";
		return $this->db->query($query);
	}

	function getRefEvalModul(){
		$query = "SELECT
				EVALUASI_ID AS EVALUASI_MODUL_CAT_ID,
				EVALUASI_POINT_NAME AS EVALUASI_POINT_NAME,
				0 AS EVALUASI_INDEX,
				0 AS EVALUASI_PROSEN
			FROM
				T_REF_EVALUASI
			WHERE
				EVALUASI_TYPE = 1";
		return $this->db->query($query);
	}

}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */