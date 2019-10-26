<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingkatering extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/settingkatering_model');
		$this->load->model('diklat/diklat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/settingkatering/index', $data);
	}

	
	public function listdataaktif(){

		$status="";
		$default_order = "PROGRAM_NAME";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'PROGRAM_NAME',
			'PROGRAM_START',
			'PROGRAM_END',
			'PROGRAM_TOTAL_KUOTA'
			);
		$order_key 	= ($this->input->get('iSortCol_0')=="0")?"0":$this->input->get('iSortCol_0');
		$order 		= (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort 		= (!$this->input->get('sSortDir_0'))?'asc':$this->input->get('sSortDir_0');
		$search 	= (!$this->input->get('sSearch'))?'':strtoupper($this->input->get('sSearch'));
		$search 	= xss_remover($search);
		$limit 		= (!$this->input->get('iDisplayLength'))?$limit:$this->input->get('iDisplayLength');
		$start 		= (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
		$data['sEcho'] = $this->input->get('sEcho');
		$data['iTotalRecords'][] = $this->diklat_model->count_all($search,$order_field);
		$data['iTotalDisplayRecords'][] = $this->diklat_model->count_all($search,$order_field);

		$aaData = array();
		$getData 	= $this->diklat_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field)->result_array();	
		$no = (($start == 0) ? 1 : $start + 1);
		foreach ($getData as $row) {
            $cek = $this->diklat_model->getlist_procat($row["PROGRAM_ID"])->result_array();
            $jmlpeserta = $this->diklat_model->getStatusApproveParticipant($row["PROGRAM_ID"]);
            $print = (count($cek) > 0 ) ? ' <a href="'.base_url().'diklat/settingkatering/printPDF/'.$row["PROGRAM_ID"].'" target="_blank" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Unduh PDF" data-placement="top"><i class="icon-file-pdf"></i></a>':'';
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				$jmlpeserta,
				(count($cek) == 0 ) ? '<i class="icon-close tip" data-original-title="Belum diatur" data-placement="top" style="color:red;"></i>':'<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>',
				'<a href="'.base_url().'diklat/settingkatering/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Atur Katering" data-placement="top"><i class="icon-pencil"></i></a>'.$print
				);
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update($id){
        if($this->access->permission('create')){
            if($post = $this->input->post()){
            	// echo json_encode($post);die;
				if(isset($post['cat_date'])){
					$getlist_procat = $this->diklat_model->getlist_procat($id)->result_array();
					
					/* HAPUS DATANYA DULU */
						if(count($getlist_procat)>0){
							foreach ($getlist_procat as $k => $v) {
								$this->diklat_model->delete_catdet($v['PROCAT_ID']);
							}
						}
						$this->diklat_model->delete_cat($id);
					/* /HAPUS */

					echo "<pre>";
					$ccreate = array();
					foreach ($post['cat_date'] as $k => $v) {
						foreach ($post['vendor_id'][$k] as $kk => $vv) {
							if($vv != ""){							
								$ccreate = array(
									'PROCAT_PROGRAM_ID'		=> isset($post['PROGRAM_ID'])?$post['PROGRAM_ID']:'',
									'PROCAT_CATERING_ID'	=> $vv,
									'PROCAT_DATE'			=> $v,
									'PROCAT_TIME'			=> $kk,
									'PROCAT_STATUS'			=> 1
								);
								// print_r($ccreate);echo '<br><hr>';
								$idcat = $this->diklat_model->create_cat($ccreate);
								// $idcat = $kk;
								if($idcat){
									foreach($post['detail_id'][$k][$kk] as $kkk => $vvv){
										$ccreated = array(
											'DET_PROCAT_ID'		=>$idcat,
											'DET_PROCAT_DATE'	=>$v,
											'DET_CAT_MENU_ID'	=>$vvv,
											'DET_STATUS'		=>1
										);
										// print_r($ccreated);echo "<hr>";
										$idcatdet = $this->diklat_model->create_catdet($ccreated);
									}
								}else{
									$notify = array(
				                        'title' 	=> 'Gagal!',
				                        'message'	=> 'Perubahan data gagal, silahkan coba lagi',
				                        'status' 	=> 'error'
				                    );
				                    $this->session->set_flashdata('notify', $notify);
				                    redirect(base_url().'diklat/settingkatering');
								}
							}
						}
					}
					// die;
                    $notify = array(
                        'title' 	=> 'Berhasil!',
                        'message' 	=> 'Perubahan data Berhasil',
                        'status' 	=> 'success'
                    );
                    $this->session->set_flashdata('notify', $notify);
                    redirect(base_url().'diklat/settingkatering');
				}else{
                    $notify = array(
                        'title' 	=> 'Gagal!',
                        'message'	=> 'Perubahan data gagal, silahkan coba lagi',
                        'status' 	=> 'error'
                    );
                    $this->session->set_flashdata('notify', $notify);
                    redirect(base_url().'diklat/settingkatering');
                }

            } else {

                $data = array();
                $data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
                $data['katering'] = $this->settingkatering_model->getListVendor()->result_array();
                
                $begin = new DateTime($data['diklat']['PROGRAM_START']);
				$end = new DateTime($data['diklat']['PROGRAM_END']);
				$listdate = array();
				$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
				
				foreach($daterange as $date){
				    array_push($listdate, $date->format("Y-m-d"));
				}
				array_push($listdate, $data['diklat']['PROGRAM_END']);

				// echo "<pre>";print_r($listdate);die;

                $data['procat'] = $this->diklat_model->getlist_procat($id)->result_array();
 				$data['listdate'] = array();
 				foreach ($listdate as $val) {
                 	$data['listdate'][$val][1]['PROCAT_CATERING_ID'] = "";
                 	$data['listdate'][$val][1]['PROCAT_ID'] = "";
                	$data['listdate'][$val][2]['PROCAT_CATERING_ID'] = "";
                	$data['listdate'][$val][2]['PROCAT_ID'] = "";
                	$data['listdate'][$val][3]['PROCAT_CATERING_ID'] = "";		                	
                	$data['listdate'][$val][3]['PROCAT_ID'] = "";		                	
	                foreach ($data['procat'] as $k => $v) {
	                	if($val == date("Y-m-d", strtotime($v['PROCAT_DATE']))){
		                	if($v["PROCAT_TIME"]==1){
			                	$data['listdate'][$val][1]['PROCAT_CATERING_ID'] = $v['PROCAT_CATERING_ID'];
			                	$data['listdate'][$val][1]['PROCAT_ID'] = $v['PROCAT_ID'];
		                	}elseif($v["PROCAT_TIME"]==2){
			                	$data['listdate'][$val][2]['PROCAT_CATERING_ID'] = $v['PROCAT_CATERING_ID'];
			                	$data['listdate'][$val][2]['PROCAT_ID'] = $v['PROCAT_ID'];
		                	}elseif($v["PROCAT_TIME"]==3){
			                	$data['listdate'][$val][3]['PROCAT_CATERING_ID'] = $v['PROCAT_CATERING_ID'];		                		
			                	$data['listdate'][$val][3]['PROCAT_ID'] = $v['PROCAT_ID'];
		                	}
	                	}
	 				}  

                    // echo "<pre>";print_r($data['procat']);die;          	
                }
                // echo json_encode($data['diklat']);
                
                $this->template->display('diklat/settingkatering/update', $data);
            }
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

		$procat = $this->diklat_model->getlist_procat($id)->result_array();
		// echo json_encode($procat);die;
    	// echo $id;
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
    	$htmlpdf = "";
    	$htmlpdf .= '<h2 style="text-transform: uppercase;text-align:center">MENU KATERING</h2>';
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
    						<tr>
    							<td>Tanggal Pelatihan</td>
    							<td>:</td>
    							<td>'. $tgl_pelatihan .'</td>
    						</tr>
    						<tr>
    							<td>Total Kuota</td>
    							<td>:</td>
    							<td>'. (($diklat['PROGRAM_TOTAL_KUOTA']!="")?$diklat['PROGRAM_TOTAL_KUOTA']:"-") .'</td>
    						</tr>
    					</tbody>
    				</table>';
    	$htmlpdf .= '<br>';
    	$htmlpdf .= '<h3 style="margin-bottom:5px;border-bottom:1px solid black">DAFTAR KATERING</h3>';

    	foreach ($listdate as $date) {
		    $htmlpdf .= '<h4 style="margin-bottom:5px;margin-top:20px">Tanggal : '.dateEnToId($date, "d F Y").'</h4>';
		    $htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%">
	    					<thead>
	    						<tr>
	    							<th style="border: 1px solid black;padding:5px;text-align:left">Waktu Makan</th>
	    							<th style="border: 1px solid black;padding:5px;text-align:left">List Menu</th>
	    						</tr>
	    					</thead>
	    					<tbody>';
		    foreach ($procat as $k => $v) {
		    	// echo json_encode($v); die;
		    	if($date == date("Y-m-d", strtotime($v['PROCAT_DATE']))){
		    		if($v['PROCAT_TIME']==1){
		    			$catdet = $this->diklat_model->getlist_catdet($v['PROCAT_ID'])->result_array();
			    		$htmlpdf .= '<tr style="vertical-align:top;">
			    					<td style="border: 1px solid black;padding:5px;text-align:left">Makan Pagi</td>
			    					<td style="border: 1px solid black;padding:5px"><ol style="margin:0;-webkit-padding-start: 20px;">';
			    		foreach ($catdet as $kk => $vv) {
			    			$htmlpdf .= '<li>'.$vv['DET_CAT_MENU_NAME'].'</li>';
				    	}				
		    			$htmlpdf .=	'</ol></td></tr>';
		    		}
		    		if($v['PROCAT_TIME']==2){
		    			$catdet = $this->diklat_model->getlist_catdet($v['PROCAT_ID'])->result_array();
			    		$htmlpdf .= '<tr style="vertical-align:top;">
		    							<td style="border: 1px solid black;padding:5px;text-align:left">Makan Siang</td>
		    							<td style="border: 1px solid black;padding:5px"><ol style="margin:0;-webkit-padding-start: 20px;">';
			    		foreach ($catdet as $kk => $vv) {
			    			$htmlpdf .= '<li>'.$vv['DET_CAT_MENU_NAME'].'</li>';
				    	}				
		    			$htmlpdf .=	'</ol></td></tr>';
		    		}
		    		if($v['PROCAT_TIME']==3){
		    			$catdet = $this->diklat_model->getlist_catdet($v['PROCAT_ID'])->result_array();
			    		$htmlpdf .= '<tr style="vertical-align:top;">
		    							<td style="border: 1px solid black;padding:5px;text-align:left">Makan Malam</td>
		    							<td style="border: 1px solid black;padding:5px"><ol style="margin:0;-webkit-padding-start: 20px;">';
			    		foreach ($catdet as $kk => $vv) {
			    			$htmlpdf .= '<li>'.$vv['DET_CAT_MENU_NAME'].'</li>';
				    	}				
		    			$htmlpdf .=	'</ol></td></tr>';
		    		}
		    	}
		    }
		    $htmlpdf .= '</tbody></table>';
    	}
    	// echo $htmlpdf;die;
        $headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
        $this->pdf->pdf->SetHTMLHeader($headerhtml);
    	$this->pdf->pdf->SetTitle('Katering Program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
        $this->pdf->pdf->WriteHTML($htmlpdf, 2);
        $this->pdf->pdf->Output('Katering program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

    }
    function json_getmenus($id=0, $procat_id=0){
    	$menu 		= $this->diklat_model->getMenuDetail($id)->result_array();
    	$checked 	= $this->diklat_model->getlist_catdet($procat_id)->result_array();
    	$checked 	= array_column($checked, "DET_CAT_MENU_ID");

    	$menu_cat = $this->diklat_model->getMenuCat()->result_array();
    	$menu_col = array_column($menu_cat, "CAT_MENU_NAME");
    	$result = array();
    	for ($i=0; $i < count($menu_col); $i++) { 
			$result[$menu_col[$i]] = "";
	    	$no = 0;
    		foreach ($menu as $key => $value) {
    			if ($value['CAT_MENU_CAT_NAME']==$menu_col[$i]){
    				$ischecked = "";
    				if(in_array($value['CAT_MENU_ID'], $checked)){
	    				$ischecked = "checked";
    				}
	    			$result[$menu_col[$i]][$no]['ID'] = $value['CAT_MENU_ID'];
	    			$result[$menu_col[$i]][$no]['NAME'] = $value['CAT_MENU_NAME'];
	    			$result[$menu_col[$i]][$no]['CHECKED'] = $ischecked;
    				$no +=1;
    				// DET_CAT_MENU_ID
    			}
    		}
    	}

    	echo json_encode($result);
    }
	
}