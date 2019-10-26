<?php
class Access_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	public function getAccess($access_id) {
		$this->db->where('ACCESS_DETAIL_ACCESS_ID', $access_id);
		$this->db->where('ACCESS_DETAIL_STATUS', 1);
		return $this->db->get('T_SYS_ACCESS_DETAILS');
	}

	public function getMenuId($module_segment, $menu_segment) {
		$this->db->select('MENU_ID');
		$this->db->where('MENU_URL', $module_segment.'/'.$menu_segment);
		
		$this->db->where('MENU_STATUS', 1);
		return $this->db->get('T_SYS_MENUS');
	}

	public function getMenus($parentid, $access) {
		$this->db->select('MENU_ID, MENU_NAME, MENU_URL, MENU_ICON');
		$this->db->where('MENU_PARENT_ID', $parentid);
		$this->db->where('MENU_ID IN ('.implode(',',$access).')');
		$this->db->where('MENU_STATUS', 1);
		$this->db->order_by('MENU_SORT', 'ASC');
		return $this->db->get('T_SYS_MENUS');
	}
}