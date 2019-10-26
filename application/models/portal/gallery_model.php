
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}

	function insert_log($id) {
		/*$this->db->query("
			INSERT INTO T_POR_GALLERY
			(
				NEWS_TITLE,
				GALLERIES_TITLE,
				GALLERIES_DESC,
				GALLERIES_CREATE_BY,
				GALLERIES_CREATE_DATE,
				GALLERIES_STATUS,
				GALLERIES_LOG_ID
				
				
			)
			SELECT
				NEWS_TITLE,
				GALLERIES_TITLE,
				GALLERIES_DESC,
				GALLERIES_CREATE_BY,
				GALLERIES_CREATE_DATE,
				GALLERIES_STATUS,
				GALLERIES_ID
			FROM T_POR_GALLERY WHERE GALLERIES_ID = ".$id."
		");*/
	}


	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('GALLERIES_STATUS',1);
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
			$this->db->order_by('GALLERIES_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_POR_GALLERY',$limit,$offset);
	}

	function count_all($search='', $fields='')
	{	
		$this->db->where('GALLERIES_STATUS',1);
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
		$this->db->from('T_POR_GALLERY');
		return $this->db->count_all_results(); 
	}

	function get_paged_listnonaktif($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('GALLERIES_STATUS',0);
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
			$this->db->order_by('GALLERIES_ID','DESC');
		} else {
			$this->db->order_by($order_column,$order_type);
		}

		return $this->db->get('T_POR_GALLERY',$limit,$offset);
	}

	function count_allnonaktif($search='', $fields='')
	{	
		$this->db->where('GALLERIES_STATUS',0);
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
		$this->db->from('T_POR_GALLERY');
		return $this->db->count_all_results(); 
	}

	function getDetail($galleryId){
//        $this->db->select("gallery_id, gallery_name, gallery_date, gallery_is_in_front, gallery_file_path, employe.employee_fullname as createname, gallery_create_date, gallery_update_date");
        // $this->db->join('view_sys_users', 'user_id = gallery_create_by', 'inner');
//		 $this->db->join('master_employees as employee', 'employee.employee_id = gallery_update_by', 'inner');
		$this->db->where('GALLERIES_ID', $galleryId);
		return $this->db->get('T_POR_GALLERY');
	}


    function getGalleryDetail($galleryId){
        // $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
        $this->db->where('GALLERY_LIST_GALLERY_ID', $galleryId);
        return $this->db->get('T_POR_GALLERY_LIST');
    }

    function getGalleryDetails($galleryId){
        // $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
        $this->db->where('GALLERY_LIST_GALLERY_ID', $galleryId);
        return $this->db->get('T_POR_GALLERY_LIST');
    }

    function getId(){
        // $this->db->join('master_employees', 'employee_id = user_employee_id', 'inner');
        $this->db->order_by('GALLERIES_ID','DESC');
        $this->db->limit(1);
        return $this->db->get('T_POR_GALLERY');
    }

	// function getListAcc(){
	// 	return $this->db->get_where('SYS_ACCESS', array('ACCESS_ACCESS' => 1));
	// }

	// function ListAcc(){
	// 	return $this->db->get_where('SYS_ACCESS', array('ACCESS_ACCESS' => 1));
	// }

	function add($datacreate){
		$this->db->insert('T_POR_GALLERY_LIST', $datacreate);
		return $this->db->insert_id();
	}

	function addgallery($datacreate){
		$this->db->insert('T_POR_GALLERY', $datacreate);
		return $this->db->insert_id();
	}

	function add_images($datacreate){
		$this->db->insert('T_POR_GALLERY_LIST', $datacreate);
		return $this->db->insert_id();
	}


	function update($dataupdate, $idgallery){
		$this->db->where('GALLERIES_ID', $idgallery);
		return $this->db->update('T_POR_GALLERY', $dataupdate);
	}

	function updategallery($datagallery, $id){
		$this->db->where('GALLERY_LIST_ID', $id);
		return $this->db->update('T_POR_GALLERY_LIST',$datagallery);
	}

    function updategallerydes($id, $datagallery){
        $this->db->where('GALLERY_LIST_GALLERY_ID', $id);
        return $this->db->update('T_POR_GALLERY_LIST',$datagallery);
    }

	function getSysUser($galleryId){
		return $this->db->get_where('trx_gallerys', array('gallery_id' => $galleryId));
	}

	function deletefoto($id){
        $this->db->where('GALLERY_LIST_ID', $id);
        return $this->db->delete("T_POR_GALLERY_LIST");
	}

	function deletegallery($galleryId, $dataupdate){
		$this->db->set('GALLERIES_STATUS',0);
		$this->db->where('GALLERIES_ID', $galleryId);
		return $this->db->update('T_POR_GALLERY', $dataupdate);
	}

	function aktifgallery($galleryId, $dataupdate){
		$this->db->set('GALLERIES_STATUS',1);
		$this->db->where('GALLERIES_ID', $galleryId);
		return $this->db->update('T_POR_GALLERY',  $dataupdate);
	}

	function deletelist($id){		
		$this->db->where('GALLERY_LIST_ID', $id);
		$this->db->delete('T_POR_GALLERY_LIST');
	}
}

/* End of file pengguna_model.php */
/* Location: ./application/models/pengguna_model.php */