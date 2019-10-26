<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/diklat_model','');		
		$this->load->model('report_model','');
		$this->load->model('home/auth_model','');
	}

	public function index(){
		$data = array();
		$program = $this->diklat_model->getListProgram()->result_array();
	    $datas = array();
	    foreach ($program as $k => $v) {
			$datas[$k]['title'] = $v['PROGRAM_NAME'];
			$datas[$k]['url'] = base_url().'diklat/program/update/'.$v['PROGRAM_ID'];
			$datas[$k]['start'] = date('Y-m-d', strtotime($v['PROGRAM_START']));
			$datas[$k]['end'] = date('Y-m-d', strtotime($v['PROGRAM_END']));
	    }
	   	$data['program'] = $datas;
	   	$sector = $this->report_model->listSector()->result_array();

	   	$series1 = array('name' => 'Bidang', 'colorByPoint'=>true);
	   	foreach ($sector as $k => $v) {
	   		$series1['data'][$k]['name'] = $v['SECTOR_NAME']; 
	   		$series1['data'][$k]['y'] = $v['JML']; 
	   		$series1['data'][$k]['drilldown'] = $v['SECTOR_NAME'];	   		
	   	}

	   	$drilldown1 = array();
	   	foreach ($sector as $k => $v) {
	   		$drilldown1['series'][$k]['id'] = $v['SECTOR_NAME'];
	   		$drilldown1['series'][$k]['name'] = $v['SECTOR_NAME'];
	   		$sasaran = $this->report_model->listSasaran($v['SECTOR_ID'])->result_array();
	   		foreach ($sasaran as $n => $z) {
	   			$drilldown1['series'][$k]['data'][$n] = array($z['TINDAK_PIDANA_NAME'],(int)$z['JML']); 		
	   		}
	   		
	   	}
	   	$data['series1'] = $series1;
	   	$data['drilldown1'] = $drilldown1;
	   	//echo json_encode($data); die;
		$this->template->display('home/dashboard', $data);
	}


    public function getChats()
    {
        header('Content-Type: application/json');
    	// echo json_encode("test");
        if ($this->input->is_ajax_request()) {
        	if($this->input->post('chatWith')!=""){    		
	            $CS = $this->db->get_where('V_REF_MEMBER', array('MEMBER_ID' => $this->input->post('chatWith')), 1)->row_array();
	            // echo json_encode($CS);die;
	            $chats = $this->db
	                ->select('CHAT.*, V_SYS_USERS.USER_NAME, V_REF_MEMBER.MEMBER_NAME')
	                ->from('T_POR_CHATS AS CHAT')
	                ->join('V_SYS_USERS', 'CHAT.CHAT_USER_ID = V_SYS_USERS.USER_ID', 'LEFT')
	                ->join('V_REF_MEMBER', 'CHAT.CHAT_MEMBER_ID = V_REF_MEMBER.MEMBER_ID', 'LEFT')
	                ->where('(CHAT_USER_ID = '. $this->session->userdata('user_id') .' AND CHAT_MEMBER_ID = '. $CS['MEMBER_ID'] .' AND CHAT_STATUS != 0 OR CHAT_STATUS!=null)')
	                ->order_by('CHAT.CHAT_DATE', 'desc')
	                ->limit(100)
	                ->get()
	                ->result();
	            // echo json_encode($chats);die;

	            $result = array(
	                'user_name' => $CS['MEMBER_NAME'],
	                'chats' => $chats
	            );
	            echo json_encode($result);
        	}
        }
    }

    public function sendMessage()
    {
    	if($this->input->post('message', true)!=''){		
	        $this->db->insert('T_POR_CHATS', array(
	            'CHAT_MESSAGE' 	=> htmlentities($this->input->post('message', true)),
	            'CHAT_USER_ID'	=> $this->session->userdata('user_id'),
	            'CHAT_MEMBER_ID'=> $this->input->post('chatWith'),
	            'CHAT_DATE' 	=> date('Y-m-d H:i:s'),
	            'CHAT_SENDER' 	=> 2,
	            'CHAT_STATUS'	=> 2
	        ));
    	}
    }
    public function getnotifchats(){
    	$result = 0;
    	if($this->session->userdata('logged_in')){
	    	$chats = $this->db
		        ->select('CHAT_ID')
		        // ->from('dbo.T_POR_CHATS')
				->from('T_POR_CHATS')
		        ->where('(CHAT_USER_ID = '. $this->session->userdata('user_id') .' AND CHAT_STATUS = 2 AND CHAT_SENDER = 1)')
		        ->count_all_results();
		    $result = $chats;
    	}
    	echo json_encode($result);
    }
    public function readchat()
    {
    	// echo json_encode($this->session->userdata('user_id'));
    	if($this->input->post('datafriend')!='')
    	{
			$status = $this->db
				->where('CHAT_SENDER', 1)
				->where('CHAT_USER_ID', $this->session->userdata('user_id'))
				->where('CHAT_MEMBER_ID', $this->input->post('datafriend'))
				->update('T_POR_CHATS', array('CHAT_STATUS'	=> 1));
			
			echo json_encode(0);
		}else{
			echo json_encode(0);
		}
	}
	public function getlist_members(){
		echo json_encode($this->auth_model->getlist_chats()->result_array());
	}

	public function profil(){
		$data = array();
		$program = $this->auth_model->getProfile($this->session->userdata('user_id'))->result_array();
		$this->template->display('home/profil', $data);
	}

	public function updateprofil(){
		$data = array();
		$program = $this->auth_model->getProfile($this->session->userdata('user_id'))->result_array();
		$this->template->display('home/profil', $data);
	}

}