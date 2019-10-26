<?php
class Global_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function get_all_menu($access_id) {
		$query = 'SELECT
					MP.MENU_ID,
					MP.MENU_PARENT_ID,
					MP.MENU_NAME,
					(
						SELECT
							COUNT (MX.MENU_ID)
						FROM
							SYS_MENUS MX
						WHERE
							MX.MENU_PARENT_ID = MP.MENU_ID
					) AS MENU_ANAK,
					LEVEL as MENU_LEVEL
				FROM
				  SYS_MENUS MP
				START WITH
				  MP.MENU_PARENT_ID = 0
				CONNECT BY
				  PRIOR MP.MENU_ID=MP.MENU_PARENT_ID
				ORDER SIBLINGS by MP.MENU_SORT ASC
				';

		return $this->db->query($query); 
	}
	
	public function get_notifikasi() {
		$this->db->where('NOTIF_USER_ID',  $this->session->userdata('user_id'));
		//$this->db->where('notif_type', 1);
		$this->db->where('NOTIF_IS_COUNT', 1);
		$this->db->order_by('NOTIF_DATE', 'DESC');
		return $this->db->get('V_SYS_NOTIF');
	}
	public function get_history($table_name,$table_id) {
		$this->db->where('HISTORY_TABLE_NAME', $table_name);
		$this->db->where('HISTORY_TABLE_ID', $table_id);
		$this->db->order_by('HISTORY_ID', 'ASC');
		return $this->db->get('V_SYS_HISTORIES');
	}
	public function getMenus($access) {
		$this->db->select('T_SYS_MENUS.*');
		$this->db->where('MENU_ID IN', '(select ACCESS_DETAIL_MENU_ID from T_SYS_ACCESS_DETAILS where ACCESS_DETAIL_ACCESS_ID = '.$access.')', false);
		$this->db->where('MENU_STATUS', 1);
		$this->db->order_by('MENU_SORT', 'ASC');
		return $this->db->get('T_SYS_MENUS');
	}
	public function getbreadcrumb($menu_id) {
		$query = "CALL getbreadcrumb(".$menu_id.")";
		return $this->db->query($query);
	}
	public function getMenuIsParent($menu_id) {
		$this->db->where('MENU_PARENT_ID', $menu_id , false);
		$this->db->where('MENU_STATUS', 1);
		$this->db->from('T_SYS_MENUS');
		return $this->db->count_all_results(); 
	}
	function getThisMenu($menu_segment) {
		$this->db->select('MENU_ID,MENU_PARENT_ID,MENU_NAME');
		$this->db->where('MENU_URL', $menu_segment);
		$this->db->where('MENU_STATUS', 1);
		return $this->db->get('T_SYS_MENUS');
	}
	
	
}