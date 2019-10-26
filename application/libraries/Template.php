<?php
class Template {

	protected $_ci;

	function __construct(){
		$this->_ci = &get_instance();
		$this->_ci->load->model('global_model','',TRUE);
		$this->_ci->load->model('home/auth_model','',TRUE);
		$this->_ci->load->helper('global_helper','',TRUE);
	}
	function ordered_menu($array,$parent_id = 0)
	{
		$temp_array = array();
		foreach($array as $element)
		{
			if($element['MENU_PARENT_ID']==$parent_id)
			{
				$element['SUBS'] = $this->ordered_menu($array,$element['MENU_ID']);
				$temp_array[] = $element;
			}
		}
		return $temp_array;
	}
	function get_html_sub_menu($array,$parent_id = 0)
	{
		//if($parent_id==0)

		$menu_html = '<ul class="">';
		
		
		foreach($array as $element)
		{
			if($element['MENU_PARENT_ID']==$parent_id)
			{

				$getMenuIsParent = $this->_ci->global_model->getMenuIsParent($element['MENU_ID']);
				$datamenu =  $this->_ci->global_model->getThisMenu($this->_ci->uri->segment(1)."/".$this->_ci->uri->segment(2))->row_array();
				if(count($datamenu)>0){
					$menu_html .= '<li class="'.(($datamenu["MENU_ID"]==$element["MENU_ID"])?"active":"").'"><a href="'.(($element['MENU_URL']!="javascript:void(0);")?base_url().$element['MENU_URL']:"javascript:void(0);").'">'.(($element['MENU_ICON']!=null|| $element['MENU_ICON']!="")?'<i class="'.$element['MENU_ICON'].'"></i>':'').' <span class="title"> '.$element['MENU_NAME'].' </span>'.(($getMenuIsParent>0)?'':"").' '.(($datamenu["MENU_ID"]==$element["MENU_ID"])?'<span class="selected"></span>':"").'</a>';
					$menu_html .= $this->get_html_sub_menu($array,$element['MENU_ID']);

					$menu_html .= '</li>';
				}else{
					$menu_html .= '<li class=""><a href="'.(($element['MENU_URL']!="javascript:void(0);")?base_url().$element['MENU_URL']:"javascript:void(0);").'">'.(($element['MENU_ICON']!=null|| $element['MENU_ICON']!="")?'<i class="'.$element['MENU_ICON'].'"></i>':'').' <span class="title"> '.$element['MENU_NAME'].' </span>'.(($getMenuIsParent>0)?'':"").'</a>';
					$menu_html .= $this->get_html_sub_menu($array,$element['MENU_ID']);

					$menu_html .= '</li>';
				}
				
			}
		}
		$menu_html .= '</ul>';
		
		return $menu_html;
	}
	function get_html_menu($array,$parent_id = 0)
	{
		
		$menu_html = '<ul class="navigation">';	
		
		foreach($array as $element)
		{
			if($element['MENU_PARENT_ID']==$parent_id)
			{

				$getMenuIsParent = $this->_ci->global_model->getMenuIsParent($element['MENU_ID']);
				$datamenu =  $this->_ci->global_model->getThisMenu($this->_ci->uri->segment(1)."/".$this->_ci->uri->segment(2))->row_array();
				if(count($datamenu)>0){
					$menu_html .= '<li class="'.(($datamenu["MENU_ID"]==$element["MENU_ID"] || $datamenu["MENU_PARENT_ID"]==$element["MENU_ID"])?"active":"").'"><a href="'.(($element['MENU_URL']!="javascript:void(0);")?base_url().$element['MENU_URL']:"javascript:void(0);").'">'.(($element['MENU_ICON']!=null|| $element['MENU_ICON']!="")?'<i class="'.$element['MENU_ICON'].'"></i>':'').' <span class="title"> '.$element['MENU_NAME'].' </span>'.(($getMenuIsParent>0)?'':"").' '.(($datamenu["MENU_ID"]==$element["MENU_ID"] || $datamenu["MENU_PARENT_ID"]==$element["MENU_ID"])?'<span class="selected"></span>':"").'</a>';
					if($getMenuIsParent>0){
						$menu_html .= $this->get_html_sub_menu($array,$element['MENU_ID']);	

					}
					$menu_html .= '</li>';
				}else{
					$menu_html .= '<li class=""><a href="'.(($element['MENU_URL']!="javascript:void(0);")?base_url().$element['MENU_URL']:"javascript:void(0);").'">'.(($element['MENU_ICON']!=null|| $element['MENU_ICON']!="")?'<i class="'.$element['MENU_ICON'].'"></i>':'').' <span class="title"> '.$element['MENU_NAME'].' </span>'.(($getMenuIsParent>0)?'':"").'</a>';
					if($getMenuIsParent>0){
						$menu_html .= $this->get_html_sub_menu($array,$element['MENU_ID']);	
					}
					$menu_html .= '</li>';
				}
				
			}
		}
		$menu_html .= '</ul>';

						//echo "<pre>";
		 $menu_html = str_replace('<ul class=""></ul>',"",$menu_html);
		
		return $menu_html;
	}
	function get_html_notifikasi($array)
	{
		$menu_html = '<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
		<i class="clip-notification-2"></i>
		<span class="badge"> '.count($array).'</span>
	</a>';
	$menu_html .= '<ul class="dropdown-menu notifications">';	
	$menu_html .='<li><span class="dropdown-menu-title"> Anda Memiliki '.count($array).' notifikasi</span></li>';
	$menu_html .='<li><div class="drop-down-wrapper"><ul>';
	if(count($array)>0){
		foreach($array as $element)
		{
			$menu_html .='<li><a href="'.base_url().$element["NOTIF_LINK"].'">
			<span class="message"> '.$element["NOTIF_MESSAGE"].'</span>
			<span class="time"> '.timeToTextNotif($element["NOTIF_DATE"]).'</span>
		</a>
	</li>';
}

}

$menu_html .='</ul></div></li>';
$menu_html .='<li class="view-all">
<a href="'.base_url().'home/notifikasi'.'">
	Lihat Semua Notifikasi <i class="fa fa-arrow-circle-o-right"></i>
</a>
</li></ul>';


return $menu_html;
}
	function display($template, $data=null, $ignore=null){
		$accessid = $this->_ci->session->userdata('user_access_id');
		$data_user = $userdata = $this->_ci->auth_model->getUser($this->_ci->session->userdata('user_username'))->row_array();
		$data["photo"] = "defaultphoto.png";
		// $data["photo"] = (($data_user["employee_photo"]==null || $data_user["employee_photo"] == "")?"defaultphoto.png":$data_user["employee_photo"]);

		$menu = $this->_ci->global_model->getMenus($accessid)->result_array();
		$html_menu = $this->get_html_menu($menu,0);
		$data["menu"] = $html_menu;
		$datamenu =  $this->_ci->global_model->getThisMenu($this->_ci->uri->segment(1)."/".$this->_ci->uri->segment(2))->row_array();
		$datanotif =  $this->_ci->global_model->get_notifikasi()->result_array();
		$data['chats_lists'] = $this->_ci->auth_model->getlist_chats()->result_array();
        	
				//$data["currentmenu"] = 29;
				//$data["currentmenuparent"] = 2;
		$data["breadcrumb"] = "";
		$data["notif"] = $this->get_html_notifikasi($datanotif);
		$data["statusproses"] = $this->_ci->session->flashdata('statusproses');
		$data["message"] = $this->_ci->session->flashdata('message');
		if(count($datamenu)>0){
			$data["currentmenu"] = $datamenu["MENU_NAME"];
			$data["currentmenuparent"] = ($datamenu["MENU_PARENT_ID"]==0)?$datamenu["MENU_ID"]:$datamenu["MENU_PARENT_ID"];
			//$breadcrumb = $this->_ci->global_model->getbreadcrumb($datamenu["MENU_ID"])->row_array();
			$data["breadcrumb"] = "";
		}
		$data['csrf'] = array(
			'name' => $this->_ci->security->get_csrf_token_name(),
			'hash' => $this->_ci->security->get_csrf_hash()
		);
		$data['_content'] = $this->_ci->load->view('/sources/'.$template, $data, TRUE);
		$this->_ci->load->view('/template_render', $data);
	}
	function single($template, $data=null){
				//$config = $this->_ci->config->config['template'];
		$data['csrf'] = array(
			'name' => $this->_ci->security->get_csrf_token_name(),
			'hash' => $this->_ci->security->get_csrf_hash()
		);
		// echo json_encode($data['csrf']);die;
		$this->_ci->load->view('/structures/single/'.$template, $data);
	}
	function printout($data=null){
				//$config = $this->_ci->config->config['template'];
		// $data['csrf'] = array(
		// 	'name' => $this->_ci->security->get_csrf_token_name(),
		// 	'hash' => $this->_ci->security->get_csrf_hash()
		// );

		$this->_ci->load->view('/structures/print_header', $data);
		$this->_ci->load->view('/structures/print_footer');
	}
}

?>
