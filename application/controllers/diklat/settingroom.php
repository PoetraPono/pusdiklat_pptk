<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingroom extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/settingroom_model');
		$this->load->model('diklat/diklat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/settingroom/index', $data);
	}

	public function update($id){
		if($this->access->permission('create')){	
			if($post = $this->input->post()){
				//echo "<pre>"; print_r($post); die;
				$booking = $post['booking'];
				$insDb = 0;
				$this->settingroom_model->deleteData($post['PROGRAM_ID']);
				for ($i=0; $i < count($booking); $i++) { 
					$dts = explode("|", $booking[$i]);
					$datacreate = array(
						'PROROOM_PROGRAM_ID' => $post['PROGRAM_ID'],
						'PROROOM_PARTICIPANT_ID' => $dts[1],
						'PROROOM_ROOM_ID' => $dts[0],
						'PROROOM_START' => $post['PROGRAM_START'].' 14:00:00',
						'PROROOM_END' => $post['PROGRAM_END'].' 12:00:00',
						'PROROOM_STATUS' => 1
					);
					$insDb = $this->settingroom_model->createData($datacreate);	
					$this->settingroom_model->setfullRoom($dts[0]);					
				}
				if($insDb > 0){
					$notify = array(
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Perubahan data Berhasil',
							'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);

					redirect(base_url().'diklat/settingroom/');
				}else{
					$notify = array(
							'title' 	=> 'Gagal!',
							'message'	=> 'Perubahan data gagal, silahkan coba lagi',
							'status' 	=> 'error'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/settingroom');
				}

			} else {
				$data = array();
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
				$data['peserta'] = $this->settingroom_model->getListPeserta($id)->result_array();
				$room = $this->settingroom_model->getListRoom($id,$data['diklat']['PROGRAM_START'],$data['diklat']['PROGRAM_END'])->result_array();
				$data['proma'] = array();
				foreach ($room as $k => $v) {
					if($v['ROOM_ISI'] > 0){
						$list = $this->settingroom_model->getIsiRoom($id,$v['ROOMS_ID'])->result_array();
						$room[$k]['LIST_ISI'] = $list;
					}else{
						$room[$k]['LIST_ISI'] = array();
					}
				}
				$data['room'] = $room;
				// echo "<pre>"; print_r($data['room']); die;
				$this->template->display('diklat/settingroom/update', $data);
			}
		}else{
			$this->access->redirect('404');
		}
	}

	public function detail($id=0){
		if($this->access->permission('read')){
			$data["peserta"] =  $this->settingroom_model->getDetail($id)->row_array();
			$data["diklat"] =  $this->settingroom_model->getListProgramParticipant($id)->result_array();
			$this->template->display('diklat/settingroom/detail', $data);
		}
	}

	public function listdataaktif(){
		$status="";
		$default_order = "PROGRAM_ID";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'SECTOR_NAME',
			'PROGRAM_START',
			'PROGRAM_END',
			'JML_PESERTA'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->settingroom_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->settingroom_model->count_all($search,$order_field);


		$aaData = array();
		$getData 	= $this->settingroom_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();	
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
			$cekdata = $this->settingroom_model->checkStatusSetting($row["PROGRAM_ID"])->row_array();
			$jmlpeserta = $this->diklat_model->getStatusApproveParticipant($row["PROGRAM_ID"]);
			$jmlpart = ($cekdata["JML_PARTICIPANT"] == 0 ? -1 : $cekdata["JML_PARTICIPANT"]);
			$jmlbook = ($cekdata["JML_BOOKING"] == 0 ? -2 : $cekdata["JML_BOOKING"]);
			$print = "";
			if ($jmlbook > 0) {
				$print .= '<a href="'.base_url().'diklat/settingroom/printPDF/'.$row["PROGRAM_ID"].'" target="_blank" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Unduh PDF" data-placement="top"><i class="icon-file-pdf"></i></a>';
			}
			$status = ($jmlpart == $jmlbook ? '<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>' : '<i class="icon-close tip" data-original-title="Belum diatur" data-placement="top" style="color:red;"></i>');
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				$row["JML_PESERTA"],
				$status,
				'<a href="'.base_url().'diklat/settingroom/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Atur Ruangan" data-placement="top"><i class="icon-pencil"></i></a>
				'.$print);
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete($id = 0){
			$res = array();
			$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			if($this->access->permission('delete')) {
				if($id==$idFilter) {
					$del = $this->settingroom_model->delete($id);
					if($del>0) {
						$res = array(
							'update'	=> $del,
							'title' 	=> 'Berhasil!',
							'message' 	=> 'Data berhasil dihapus',
							'status' 	=> 'success'
						);
					} else {
						$res = array(
							'update'	=> $del,
							'title' 	=> 'Gagal!',
							'message' 	=> 'Data gagal dihapus, coba lagi!',
							'status' 	=> 'error'
						);
					}
				} else {
					$res = array(
							'update'	=> $del,
							'title' 	=> 'Gagal!',
							'message' 	=> 'Data gagal dihapus, coba lagi!',
							'status' 	=> 'error'
						);
				}

				redirect(base_url().'diklat/settingroom');
			}
			echo json_encode($res);
		}

	public function aktif($id = 0){

		$idFilter = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			if($id==$idFilter) {
				$act = $this->settingroom_model->aktif($id);
				if($act>0){
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Data berhasil diaktifkan',
						'status' 	=> 'success'
					);
				}else{
					$res = array(
						'update'	=> $act,
						'title' 	=> 'Gagal!',
						'message' 	=> 'Data gagal diaktifkan, coba lagi!',
						'status' 	=> 'error'
					);					
				}
			} else {
				$res = array(
					'update'	=> $act,
					'title' 	=> 'Gagal!',
					'message' 	=> 'Data gagal diaktifkan, coba lagi!',
					'status' 	=> 'error'
				);
			}


				redirect(base_url().'diklat/settingroom');
		echo json_encode($res);
		}else{
			$this->access->redirect('404');
		}
	}

	public function printPDF($id){

		$this->load->library('pdf');

		$diklat = $this->diklat_model->getDetail($id)->row_array();

		$begin = new DateTime($diklat['PROGRAM_START']);
		$end = new DateTime($diklat['PROGRAM_END']);
		$listdate = array();
		$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
		
		foreach($daterange as $date){
		    array_push($listdate, $date->format("Y-m-d"));
		}
		array_push($listdate, $diklat['PROGRAM_END']);
		// echo "<pre>";
		// print_r($listdate);
		// die;

		$proroom = $this->settingroom_model->getlist_proroom($id)->result_array();
		$jmlpeserta = $this->diklat_model->getStatusApproveParticipant($id);
		// echo "<pre>";
		// print_r($roomsdet);
		// die();
    	if($diklat['PROGRAM_START']!="" and $diklat['PROGRAM_END']!=""){
    		if($diklat['PROGRAM_START']==$diklat['PROGRAM_END']){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");
    		}elseif($diklat['PROGRAM_START']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_END'], "d F Y");    			
    		}elseif($diklat['PROGRAM_END']==""){
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y");    			
    		}else{
				$tgl_pelatihan = dateEnToId($diklat['PROGRAM_START'], "d F Y"). " s.d " .dateEnToId($diklat['PROGRAM_END'], "d F Y");
    		}
    	}
    	
    	$fd = $diklat['PROGRAM_START']." s.d ".$diklat['PROGRAM_END'];
    	$listdate = array($tgl_pelatihan);
    	//print_r($tgl_pelatihan); die;
    	$htmlpdf = "";
    	$htmlpdf .= '<h2 style="text-transform: uppercase;text-align:center"><small>DAFTAR PENGATURAN KAMAR</small></h2>';
    	$htmlpdf .= '<br>';
    	$htmlpdf .= '<br>';
    	$htmlpdf .= '<table style="border-top: 1px solid black; border-bottom: 1px solid black;width:100%">
    					<tbody>
    						<tr style="vertical-align:top;">
    							<td style="vertical-align:top;">Nama Program</td>
    							<td style="vertical-align:top;">:</td>
    							<td style="vertical-align:top;">'. (($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-") .'</td>
    						</tr>
    						<tr style="vertical-align:top;">
    							<td style="vertical-align:top;">Deskripsi Program</td>
    							<td style="vertical-align:top;">:</td>
    							<td style="vertical-align:top;">'. (($diklat['PROGRAM_DESCRIPTION']!="")?$diklat['PROGRAM_DESCRIPTION']:"-") .'</td>
    						</tr>
    						<tr style="vertical-align:top;">
    							<td >Tanggal Pelatihan</td>
    							<td>:</td>
    							<td>'. $tgl_pelatihan .'</td>
    						</tr>
    						<tr style="vertical-align:top;">
    							<td>Jumlah Peserta</td>
    							<td>:</td>
    							<td>'. $jmlpeserta .'</td>
    						</tr>
    					</tbody>
    				</table>';
    	$htmlpdf .= '<br>';
    	//$htmlpdf .= '<h3 style="margin-bottom:5px;border-bottom:1px solid black">DAFTAR KAMAR</h3>';

    	foreach ($listdate as $date) {
		    $htmlpdf .= '<h4 style="margin-bottom:5px;margin-top:20px">Tanggal : '.$date.'</h4>';
		    $htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%">
	    					<thead>
	    						<tr>
	    							<th style="border: 1px solid black;padding:5px;text-align:left">Nama Kamar</th>
	    							<th style="border: 1px solid black;padding:5px;text-align:left">List Peserta</th>
	    						</tr>
	    					</thead>
	    					<tbody>';
		    		//echo "<pre>"; print_r($proroom); die;
		    foreach ($proroom as $k => $v) {	
		    	//if($date == date("Y-m-d", strtotime($v['PROROOM_START']))){
		    		//if($v['PROROOM_PROGRAM_ID']!= ''){
		    			$room_member = $this->settingroom_model->getlist_detailroom($id,$v['PROROOM_ROOM_ID'])->result_array();

			    		$htmlpdf .= '<tr style="vertical-align:top;">
			    					<td valign="top" style="border: 1px solid black;padding:5px;"><span style="font-size:10px;">'.$v['ROOMS_NAME'].'</span><br>'.'Nomor  '.$v['ROOMS_NUMBER'].'<br>'.'<span style="font-size:10px;">Kapasitas  '.$v['ROOMS_CAPACITY'].'  Orang</span>'.'

			    					</td>
			    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:left;"><ol style="margin:0;-webkit-padding-start: 20px;">';
			    		foreach ($room_member as $kk => $vv) {
			    			$htmlpdf .= '<li>'.$vv['MEMBER_NAME'].'</li>'; 
				    	}				
		    			$htmlpdf .=	'</ol></td></tr>';

		    		//}
		    	//}
		    }
		    $htmlpdf .= '</tbody></table>';
    	}
     	$headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
	    $this->pdf->pdf->SetHTMLHeader($headerhtml);
    	$this->pdf->pdf->SetTitle('Penagturan Kamar Program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
        $this->pdf->pdf->WriteHTML($htmlpdf, 2);
        $this->pdf->pdf->Output('Penagturan Kamar program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

    }
}