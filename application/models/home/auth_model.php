<?php
class Auth_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	public function checkUsername($username) {
		$this->db->select('USER_NAME, USER_STATUS');
		$this->db->where('USER_NAME', $username);
		$this->db->where('USER_STATUS', 1);
		return $this->db->get('V_SYS_USERS');
	}

	public function getAuth($username, $password) {
		$this->db->where('USER_NAME', $username);
		//$this->db->where('USER_PASSWORD', $password);
		$this->db->where('USER_STATUS', 1);
		$this->db->from('V_SYS_USERS');
		return $this->db->count_all_results(); 
	}
	function getUser($username) {
		$this->db->select('USER_ID, USER_NAME, ACCESS_ID, ACCESS_NAME ,USER_LAST_LOGIN,USER_IP_ADDRESS');
		// $this->db->join('master_employees', 'employee_USER_ID = USER_ID and employee_status = 1', 'inner');
		// $this->db->join('sys_access', 'ACCESS_ID = USER_ACCESS_ID and ACCESS_STATUS = 1', 'inner');
		$this->db->where('USER_NAME', $username);
		$this->db->where('USER_STATUS', 1);
		return $this->db->get('V_SYS_USERS');
	}
	
	function getUserDefaultMenu($username) {
		$this->db->select('MENU_URL,MENU_NAME,MENU_ICON');
		$this->db->join('t_sys_ACCESS', 'ACCESS_ID = USER_ACCESS_ID and ACCESS_STATUS = 1', 'inner');
		$this->db->join('T_SYS_MENUS', 'MENU_ID = ACCESS_DEFAULT_MENU_ID and MENU_STATUS = 1', 'inner');
		$this->db->where('USER_NAME', $username);
		$this->db->where('USER_STATUS', 1);
		return $this->db->get('T_SYS_USERS');
	}
	function setLastLogin($userId){
		$ipaddress = $this->input->ip_address();
		$ipaddress = (($ipaddress=='::1')?'127.0.0.1':$ipaddress);
		$this->db->set('USER_LAST_LOGIN', date('Y-m-d H:i:s', time()));
		$this->db->set("USER_ONLINE", 1);
		$this->db->set("USER_IP_ADDRESS", $ipaddress);
		$this->db->where("USER_ID", $userId);
		$this->db->update("T_SYS_USERS");
	}

	function getlist_chats(){
		$this->db->select('M.*, (SELECT COUNT(CHAT_ID) FROM T_POR_CHATS WHERE CHAT_MEMBER_ID = M.CHAT_MEMBER_ID AND CHAT_STATUS = 2 AND CHAT_SENDER=1 AND CHAT_USER_ID = '.$this->session->userdata('user_id').') AS NOTIF_CHAT');
		return $this->db->get('V_LISTCHAT_MEMBER M');
	}

	function getProfile($id){
		$this->db->where('USER_ID', $id);
		return $this->db->get('V_SYS_USERS');
	}
}