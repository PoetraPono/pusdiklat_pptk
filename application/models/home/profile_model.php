<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function getDetailprofile($web_id){
		//$this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
		$this->db->where('USER_ID', $web_id);
		return $this->db->get('V_SYS_USERS');
	}

	function getSysUser($userId){
		return $this->db->get_where('V_SYS_USERS', array('user_id' => $userId));
	}

	
	function update($dataupdate, $idpengguna){
		$this->db->where('USER_ID', $idpengguna);
		return $this->db->update('T_SYS_USERS', $dataupdate);
	}

	function cekPassLama($usrId,$userpass){
		$this->db->select('COUNT(*) AS totalCount', false);
		$this->db->where('USER_ID', $usrId);
		$this->db->where('USER_PASSWORD', passwordEncoder($userpass));
		return $this->db->get('V_SYS_USERS');
	}
}

/* End of file profile_model.php */
/* Location: ./application/models/profile_model.php */