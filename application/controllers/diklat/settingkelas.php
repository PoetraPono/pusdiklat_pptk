<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingkelas extends CI_Controller{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('diklat/diklat_model');
        $this->load->model('diklat/settingkelas_model');
        $this->load->helper('xml');
        $this->load->helper('text');
    }

    function index(){
        $data = array();
        $this->template->display('diklat/settingkelas/index', $data);
    }

    public function listdataaktif(){
        $status="";
        $default_order = "PROGRAM_ID";
        $limit = 10;

        $order_field 	= array(
            'PROGRAM_ID',
            'PROGRAM_NAME',
            'TINDAK_PIDANA_NAME',
            'PROGRAM_START',
            'PROGRAM_END',
            'JML_PESERTA'
        );
        $order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
        $order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
        $sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
        $search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
        $search     = xss_remover($search);
        $limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
        $start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
        $data['sEcho'] = $this->input->get('sEcho');
        $data['iTotalRecords'][] = $this->settingkelas_model->count_all($search,$order_field);
        $data['iTotalDisplayRecords'][] = $this->settingkelas_model->count_all($search,$order_field);


        $aaData = array();
        $getData 	= $this->settingkelas_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();
        $no = (($start == 0) ? 1 : $start + 1);
        foreach ($getData as $row) {
            $cekdata = $this->settingkelas_model->checkStatusSetting($row["PROGRAM_ID"])->row_array();
            $jmlpeserta = $this->diklat_model->getStatusApproveParticipant($row["PROGRAM_ID"]);
            $status = ($cekdata['JML_BOOKING'] > 0 ? '<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>' : '<i class="icon-close tip" data-original-title="Belum diatur" data-placement="top" style="color:red;"></i>');

            $aaData[] = array(
                '<center>'.$no.'</center>',
                $row["PROGRAM_NAME"],
                $row["SECTOR_NAME"],
                date('d M Y',strtotime($row["PROGRAM_START"])),
                date('d M Y',strtotime($row["PROGRAM_END"])),
                $row["JML_PESERTA"],
                //$jmlpeserta,
                $status,
                '<a href="'.base_url().'diklat/settingkelas/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Atur Ruangan" data-placement="top"><i class="icon-pencil"></i></a>
				');
            $no++;
        }
        $data['aaData'] = $aaData;
//        print_r($data);die();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update($id){
        if($this->access->permission('create')){
            if($post = $this->input->post()){
                $room = $post['classroom'];
                $insDb = 0;
                $this->settingkelas_model->deleteData($post['PROGRAM_ID']);
                for ($i=0; $i < count($room); $i++) {
                    if($room[$i] != 0){
                        $datacreate = array(
                            'CLASSROOM_PROGRAM_ID' => $post['PROGRAM_ID'],
                            'CLASSROOM_TYPE' => 1,
                            'CLASSROOM_ROOM_ID' => $room[$i],
                            'CLASSROOM_START_DATE' => $post['PROGRAM_START'],
                            'CLASSROOM_END_DATE' => $post['PROGRAM_END'],
                            'CLASSROOM_STATUS' => 1
                        );
                        $insDb = $this->settingkelas_model->createData($datacreate);
                        $insDb++;
                    }                    
                }
                if($insDb > 0){
                    $notify = array(
                        'title' 	=> 'Berhasil!',
                        'message' 	=> 'Perubahan data Berhasil',
                        'status' 	=> 'success'
                    );
                    $this->session->set_flashdata('notify', $notify);

                    redirect(base_url().'diklat/settingkelas/');
                }else{
                    $notify = array(
                        'title' 	=> 'Gagal!',
                        'message'	=> 'Perubahan data gagal, silahkan coba lagi',
                        'status' 	=> 'error'
                    );
                    $this->session->set_flashdata('notify', $notify);
                    redirect(base_url().'diklat/settingkelas');
                }

            } else {
                $data = array();
                $data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
                $data['kelas'] = $this->settingkelas_model->getListKelas($id,$data['diklat']['PROGRAM_START'],$data['diklat']['PROGRAM_END'])->result_array();
                $data['proma'] = array();
                $data['jmlpeserta'] = $this->diklat_model->getStatusApproveParticipant($id);
                //echo "<pre>"; print_r($data); die;
                $this->template->display('diklat/settingkelas/update', $data);
            }
        }else{
            $this->access->redirect('404');
        }
    }
}