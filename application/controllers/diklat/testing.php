<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller{

	function __construct(){
		parent:: __construct();
		$this->load->model('diklat/testing_model');
		$this->load->model('diklat/diklat_model');
		$this->load->helper('xml');
		$this->load->helper('text');
	}

	public function index(){
		$data = array();
		$this->template->display('diklat/testing/index', $data);
	}

	public function listdataaktif(){

		$status="";
		$default_order = "PROGRAM_ID";
		$limit = 10;

		$order_field 	= array(
			'PROGRAM_ID',
			'PROGRAM_NAME',
			'',
			'PROGRAM_START',
			'PROGRAM_END',
			'PROGRAM_TOTAL_KUOTA',
			''
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
			$hassetpre = $this->testing_model->getlistTesting($row['PROGRAM_ID'], 1)->row_array();
			$hassetpost = $this->testing_model->getlistTesting($row['PROGRAM_ID'], 2)->row_array();
			// echo json_encode($hassetpre);die;

			$aksi = "";
			$status = "";
			$pretest = "-";
			$posttest = "-";

			$aksi .= '<a href="'.base_url().'diklat/testing/detail/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Detail" data-placement="top"><i class="icon-file6"></i></a> ';
			if($hassetpre && $hassetpost){
				if($hassetpre['PROTEST_CONDITION']==1){
					$pretest = 'OFFLINE';
					$aksi .= '<a href="'.base_url().'diklat/testing/score/'.$row["PROGRAM_ID"].'/1" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Masukkan Nilai Pre-Test" data-placement="top"><i class="icon-medal2"></i></a> ';
				}else{
					$pretest = 'ONLINE';
					if($hassetpre['PROTEST_IS_START'] == 1 && date('Ymd', time()) == date('Ymd', strtotime($row['PROGRAM_START']))){
						$pretest = '<span class="blink" style="color:green;">On Going</span>';
					}
				}
				if($hassetpost['PROTEST_CONDITION']==1){
					$posttest = 'OFFLINE';
					$aksi .= '<a href="'.base_url().'diklat/testing/score/'.$row["PROGRAM_ID"].'/2" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Masukkan Nilai Post-Test" data-placement="top"><i class="icon-medal2"></i></a> ';
				}else{
					$posttest = 'ONLINE';
					if($hassetpost['PROTEST_IS_START'] == 1 && date('Ymd', time()) == date('Ymd', strtotime($row['PROGRAM_END']))){
						$posttest = '<span class="blink" style="color:green;">On Going</span>';
					}
				}
				$aksi .= (date('Ymd', time()) <= date('Ymd', strtotime($row['PROGRAM_START'])) && $hassetpre['PROTEST_IS_START'] == 0) ? '<a href="'.base_url().'diklat/testing/update/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit Testing" data-placement="top"><i class="icon-pencil"></i></a> ':'';
				$aksi .= (date('Ymd', time()) <= date('Ymd', strtotime($row['PROGRAM_END'])) && $hassetpre['PROTEST_IS_START'] != 1) ? '<a href="'.base_url().'diklat/testing/start/'.$row["PROGRAM_ID"].'/1" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Mulai Pre-Test" data-placement="top"><i class="icon-play3"></i></a> ':'';
				$aksi .= (date('Ymd', time()) <= date('Ymd', strtotime($row['PROGRAM_END'])) && $hassetpre['PROTEST_IS_START'] == 1) ? '<a href="'.base_url().'diklat/testing/end/'.$row["PROGRAM_ID"].'/1" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Selesai Pre-Test" data-placement="top"><i class="icon-stop2"></i></a> ':'';
				$aksi .= (date('Ymd', time()) == date('Ymd', strtotime($row['PROGRAM_END'])) && $hassetpost['PROTEST_IS_START'] != 1) ? '<a href="'.base_url().'diklat/testing/start/'.$row["PROGRAM_ID"].'/2" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Mulai Post-Test" data-placement="top"><i class="icon-play3"></i></a> ':'';
				$aksi .= (date('Ymd', time()) == date('Ymd', strtotime($row['PROGRAM_END'])) && $hassetpost['PROTEST_IS_START'] == 1) ? '<a href="'.base_url().'diklat/testing/end/'.$row["PROGRAM_ID"].'/2" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Selesai Post-Test" data-placement="top"><i class="icon-stop2"></i></a> ':'';
				$aksi .= '<a href="'.base_url().'diklat/testing/printPDF/'.$row["PROGRAM_ID"].'" target="_blank" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download Hasil Tes" data-placement="top"><i class="icon-file-pdf"></i></a>';
				$status = '<i class="icon-checkmark tip" data-original-title="Sudah diatur" data-placement="top" style="color:green;"></i>';
			}else{
				$aksi .= '<a href="'.base_url().'diklat/testing/create/'.$row["PROGRAM_ID"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Membuat Testing/Kuisioner" data-placement="top"><i class="icon-wrench2"></i></a> ';				
				$status = '<i class="icon-minus tip" data-original-title="Belum diatur" data-placement="top" style="color:#aaa;font-size:10px;"></i>';
			}
			
			$aaData[] = array(
				'<center>'.$no.'</center>',
				$row["PROGRAM_NAME"],
				$row["SECTOR_NAME"],
				date('d M Y',strtotime($row["PROGRAM_START"])),
				date('d M Y',strtotime($row["PROGRAM_END"])),
				$row["PROGRAM_TOTAL_KUOTA"],
				$pretest,
				$posttest,
				$status,
				$aksi
				
			);
			$no++;
		}
		$data['aaData'] = $aaData;
		//print_r($data);die();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function create($pId=0){
		$pIdFilter = filter_var($pId, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('create')) {

			$data = array();
			$data['diklat'] = $this->diklat_model->getDetail($pId)->row_array();
			if($pId==$pIdFilter && count($data['diklat'])>0) {
				if($post = $this->input->post()) {
					//echo json_encode($post);die;
					for($x=1; $x<=2; $x++){
						$datetest = ($x==1) ? date("Y-m-d", strtotime($post['start_date'])) : date("Y-m-d", strtotime($post['end_date']));
						$protest = array(
							'PROTEST_PROGRAM_ID'	=> isset($data['diklat']['PROGRAM_ID'])!=""?$data['diklat']['PROGRAM_ID']:"",
							'PROTEST_TYPE'			=> $x,
							'PROTEST_CONDITION'		=> $post['addTypeTesting']!=""?$post['addTypeTesting']:null,
							'PROTEST_PACKET_NAME'	=> $post['addPacketName']!=""?$post['addPacketName']:null,
							'PROTEST_DATE'			=> $datetest,
							'PROTEST_CREATE_BY'		=> $this->session->userdata('user_id'),
							'PROTEST_CREATE_DATE'	=> date('Y-m-d H:i:s'),
							'PROTEST_STATUS'		=> 1
						);
						$createid = $this->testing_model->createTesting($protest);
						if($createid){
							if($post['addPacket']!=""){
								$datasoal = $this->diklat_model->getlist_soalonpaket($post['addPacket'])->result_array();
								if(count($datasoal)>0){
									foreach ($datasoal as $k => $v) {
										$sotest = array(	
											'QUESTION_PROTEST_ID'	=> $createid,
											'QUESTION_VALUE'		=> $v['DETPACK_QUESTION_VALUE'],
											'QUESTION_SORT'			=> $v['DETPACK_SORT'],
											'QUESTION_CREATE_BY'	=> $this->session->userdata('user_id'),
											'QUESTION_CREATE_DATE'	=> date('Y-m-d H:i:s'),
											'QUESTION_STATUS'		=> 1
										);
										$createsoal = $this->testing_model->createsoal($sotest);
										if($createsoal){
											$dataoption = $this->diklat_model->getlist_optiononpaket($v['DETPACK_QUESTION_ID'])->result_array();
											if(count($dataoption)){
												foreach ($dataoption as $kk => $vv) {
													$optest = array(
														'OPTION_QUESTION_ID'	=> $createsoal,
														'OPTION_VALUE'			=> $vv['OPTION_VALUE'],
														'OPTION_SORT'			=> $vv['OPTION_SORT'],
														'OPTION_ANSWER'			=> $vv['OPTION_ANSWER'],
														'OPTION_STATUS'			=> 1,
													);
													$createoption = $this->testing_model->createoption($optest);
												}
											}
										}
									}
								}
							}
						}						
					}
					
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Pembuatan Testing & Kuisioner berhasil!',
						'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/testing/');
				} else {
					$hassetpre 	= $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 1)->row_array();
					$hassetpost = $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 2)->row_array();
					
					if($hassetpre){$data['hassetpre']='disabled';}else{$data['hassetpre']='';};
					if($hassetpost){$data['hassetpost']='disabled';}else{$data['hassetpost']='';};
					
					$data['paketsoal'] = $this->diklat_model->getlist_paketsoal()->result_array();
					//echo "<pre>"; print_r($data); die;
					$this->template->display('diklat/testing/create', $data);
				}
			} else {
				$this->access->redirect('404');
			}
		} else {
			$this->access->redirect('404');
		}
	}

	function update($pId=0,$type=0){
		$pIdFilter = filter_var($pId, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('update')) {
			$data = array();
			$data['diklat'] = $this->diklat_model->getDetail($pId)->row_array();
			$data['Kuisioner'] = $this->testing_model->getlistTesting($pId,$type)->row_array();
			//echo "<pre>"; print_r($data); die;
			if($pId==$pIdFilter && count($data['diklat'])>0) {
				if($post = $this->input->post()) {
					for($x=1; $x<=2; $x++){
						$kuisioner = $this->testing_model->getlistTesting($pId,$x)->row_array();
						$datetest = ($x==1) ? date("Y-m-d", strtotime($post['start_date'])) : date("Y-m-d", strtotime($post['end_date']));
						$protest = array(
							'PROTEST_PROGRAM_ID'	=> isset($data['diklat']['PROGRAM_ID'])!=""?$data['diklat']['PROGRAM_ID']:"",
							'PROTEST_CONDITION'		=> $post['addTypeTesting']!=""?$post['addTypeTesting']:null,
							'PROTEST_PACKET_NAME'	=> $post['addTypeTesting']!=1?($post['addPacketName']!=""?$post['addPacketName']:null):null,
							'PROTEST_DATE'			=> $datetest,
							'PROTEST_CREATE_BY'		=> $this->session->userdata('user_id'),
							'PROTEST_CREATE_DATE'	=> date('Y-m-d H:i:s'),
							'PROTEST_STATUS'		=> 1
						);
						//print_r($protest);
						$updatecheck = $this->testing_model->updateTesting($data['diklat']['PROGRAM_ID'],$x,$protest);
						//echo $updatecheck;die;
						// $updatecheck = 3;
						if($updatecheck){
							if($post['addPacket']!="" && $post['addTypeTesting']==2){
								if($post['addPacket']!="current"){
									$listsoal = $this->testing_model->getlist_soal($kuisioner['PROTEST_ID'])->result_array();
									foreach ($listsoal as $key => $value) {
										$this->testing_model->delete_option($value['QUESTION_ID']);
									}
									
									$this->testing_model->delete_soal($kuisioner['PROTEST_ID']);
									
									$datasoal = $this->diklat_model->getlist_soalonpaket($post['addPacket'])->result_array();
									if(count($datasoal)>0){
										foreach ($datasoal as $k => $v) {
											$sotest = array(	
												'QUESTION_PROTEST_ID'	=> $kuisioner['PROTEST_ID'],
												'QUESTION_VALUE'		=> $v['DETPACK_QUESTION_VALUE'],
												'QUESTION_SORT'			=> $v['DETPACK_SORT'],
												'QUESTION_CREATE_BY'	=> $this->session->userdata('user_id'),
												'QUESTION_CREATE_DATE'	=> date('Y-m-d H:i:s'),
												'QUESTION_STATUS'		=> 1
											);
											$createsoal = $this->testing_model->createsoal($sotest);
											if($createsoal){
												$dataoption = $this->diklat_model->getlist_optiononpaket($v['DETPACK_QUESTION_ID'])->result_array();
												if(count($dataoption)){
													foreach ($dataoption as $kk => $vv) {
														$optest = array(
															'OPTION_QUESTION_ID'	=> $createsoal,
															'OPTION_VALUE'			=> $vv['OPTION_VALUE'],
															'OPTION_SORT'			=> $vv['OPTION_SORT'],
															'OPTION_ANSWER'			=> $vv['OPTION_ANSWER'],
															'OPTION_STATUS'			=> 1,
														);
														$createoption = $this->testing_model->createoption($optest);
													}
												}
											}else{
												$notify = array(
														'title' 	=> 'Gagal!',
														'message'	=> 'Gagal menginput beberapa soal, silahkan coba lagi pada menu update',
														'status' 	=> 'error'
													);
												$this->session->set_flashdata('notify', $notify);
												redirect(base_url().'diklat/testing');									
											}
										}
									}
								}
							}else{
								$listsoal = $this->testing_model->getlist_soal($kuisioner['PROTEST_ID'])->result_array();
								foreach ($listsoal as $key => $value) {
									$this->testing_model->delete_option($value['QUESTION_ID']);
								}
								$this->testing_model->delete_soal($data['Kuisioner']['PROTEST_ID']);
							}
							//echo $x."-";
						}
						
					}
					//echo "Kadieu"; die;
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Pembuatan Testing & Kuisioner berhasil!',
						'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/testing/');
				} else {
					$hassetpre 	= $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 1)->row_array();
					$hassetpost = $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 2)->row_array();
					
					if($hassetpre){
						$data['hassetpre']=$type==1?'selected':'disabled';
					}else{
						$data['hassetpre']='';
					};
					if($hassetpost){
						$data['hassetpost']=$type==2?'selected':'disabled';
					}else{
						$data['hassetpost']='';
					};
					$data['Kuisioner'] = $this->testing_model->getlistTesting($pId,$type)->row_array();
					// echo json_encode($data['Kuisioner']);die;
					$data['paketsoal'] = $this->diklat_model->getlist_paketsoal()->result_array();
					$this->template->display('diklat/testing/update', $data);
				}
			} else {
				$this->access->redirect('404');
			}
		} else {
			$this->access->redirect('404');
		}
	}

	function score($pId=0, $type=0){
		$pIdFilter = filter_var($pId, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('create')) {
			$data = array();
			$data['diklat'] = $this->diklat_model->getDetail($pId)->row_array();
			$data['participant'] = $this->testing_model->getListParticipant($pId)->result_array();
			if($pId==$pIdFilter && count($data['diklat'])>0) {
				if($post = $this->input->post()) {
					if(count($post['value'])>0){
						foreach ($data['participant'] as $k => $v) {
							$this->testing_model->deleteScore($v['PROPAR_ID'], $type);
						}
						foreach ($post['value'] as $propar_id => $val) {
							$saving = array(
								'PROSCR_PROPAR_ID'		=> $propar_id,
								'PROSCR_PROTEST_TYPE'	=> $type,
								'PROSCR_VALUE'			=> $val,
								'PROSCR_CREATE_BY'		=> $this->session->userdata('user_id'),
								'PROSCR_CREATE_DATE'	=> date('Y-m-d H:i:s'),
								'PROSCR_STATUS'			=> 1
							);
							$createid = $this->testing_model->createScore($saving);
							if(!$createid){
								$notify = array(
										'title' 	=> 'Gagal!',
										'message'	=> 'Penginputan nilai Testing & Kuisioner gagal, silahkan coba lagi',
										'status' 	=> 'error'
									);
								$this->session->set_flashdata('notify', $notify);
								redirect(base_url().'diklat/testing');
							}
						}
					}
					$notify = array(
						'title' 	=> 'Berhasil!',
						'message' 	=> 'Penginputan nilai Testing & Kuisioner berhasil!',
						'status' 	=> 'success'
						);
					$this->session->set_flashdata('notify', $notify);
					redirect(base_url().'diklat/testing/');
				} else {
					$data['type_text'] 	= $type!=""?$type==1?'Pre-Test':'Post-Test':'';
					foreach ($data['participant'] as $key => $value) {
						$score 	= $this->testing_model->getlistScore($value['PROPAR_ID'], $type)->row_array();
						if($score){
							$data['participant'][$key]['SCORE'] = $score['PROSCR_VALUE'];
						}
					}
					// echo json_encode($data['participant']);die;
					$this->template->display('diklat/testing/score', $data);
				}
			} else {
				$this->access->redirect('404');
			}
		} else {
			$this->access->redirect('404');
		}
	}


	function setting($pId=0) {
		$pIdFilter = filter_var($pId, FILTER_SANITIZE_NUMBER_INT);
		if($this->access->permission('create')) {
			if($pId==$pIdFilter) {
				$data = array();
				$data['diklat'] = $this->diklat_model->getDetail($pId)->row_array();
				if(count($data['diklat'])>0) {
					if($data['diklat']['PROGRAM_TEST_STATUS']==1) {
						$question = $this->testing_model->getQuestion($pId)->result_array();
						$data['question'] = array();
						$i=0;
						foreach($question as $q) {
							$data['question'][$i] = $q;
							$data['question'][$i]['options'] = $this->testing_model->getQuestionOption($q['QUESTION_ID'])->result_array();
							++$i;
						}
						$data['participant'] = $this->testing_model->getListParticipant($pId)->result_array();
						// echo '<pre>'; print_r($data); die();
						$this->template->display('diklat/testing/view', $data);
					} else {
						if($post = $this->input->post()) {
							// echo json_encode($post);
							// die;
							$program = array(
									'PROGRAM_TEST_STATUS'	=> 1,
									'PROGRAM_TEST_TYPE'		=> $post['addTypeTesting'],
									'PROGRAM_TEST_START'	=> $post['addDateStart'],
									'PROGRAM_TEST_END'		=> $post['addDateEnd']
								);

							$updProg = $this->testing_model->updateProgram($pId, $program);

							$q=1;
							foreach($post['addQuestion'] as $kQ => $vQ) {
								$question = array(
										'QUESTION_PROGRAM_ID'	=> $pId,
										'QUESTION_VALUE'		=> $vQ,
										'QUESTION_SORT'			=> $q,
										'QUESTION_CREATE_BY'	=> $this->session->userdata('user_id'),
										'QUESTION_CREATE_DATE'	=> date('Y-m-d H:i:s'),
										'QUESTION_STATUS'		=> 1
									);

								$questionId = $this->testing_model->addQuestion($question);

								$o=1;
								foreach($post['addOption_'.$kQ] as $kO => $vO) {
									$option = array(
											'QUEOPTION_QUESTION_ID'	=> $questionId,
											'QUEOPTION_VALUE'		=> $vO,
											'QUEOPTION_SORT'		=> $o,
											'QUEOPTION_IM_ANSWER'	=> ($kO==$post['addAnswer_'.$kQ]?1:0),
											'QUEOPTION_STATUS'		=> 1
										);
									$this->testing_model->addQuestionOption($option);
									++$o;
								}
								++$q;
							}

							$notify = array(
								'title' 	=> 'Berhasil!',
								'message' 	=> 'Proses setting Testing & Kuisioner berhasil!',
								'status' 	=> 'success'
								);
							$this->session->set_flashdata('notify', $notify);
							redirect(base_url().'diklat/testing/'.$pId);
						} else {
							//echo "kesini";die;
							$this->template->display('diklat/testing/create', $data);
						}
					}
				} else {
					$this->access->redirect('404');
				}
			} else {
				$this->access->redirect('404');
			}
		} else {
			$this->access->redirect('404');
		}
	}


	function detail($id=0){
		if($this->access->permission('read')) {
			$data = array();
			$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
			$hassetpre 	= $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 1)->row_array();
			$hassetpost = $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 2)->row_array();
			
			$data['paketsoal_pre'] = array();
			if(isset($hassetpre['PROTEST_CONDITION'])){			
				if($hassetpre['PROTEST_CONDITION']==2){
					$data['paketsoal_pre'] = $this->testing_model->getlist_soal($hassetpre['PROTEST_ID'])->result_array();
					foreach ($data['paketsoal_pre'] as $k => $v) {
						$options = $this->testing_model->getlist_option($v['QUESTION_ID'])->result_array();
						foreach ($options as $kk => $vv) {
							$data['paketsoal_pre'][$k]['OPTIONS'][]['OPTION_VALUE'] = $vv['OPTION_VALUE'];
							if($vv['OPTION_ANSWER']==1){
								$data['paketsoal_pre'][$k]['OPTION_ANSWER'] = $vv['OPTION_VALUE'];
							}
						}
					}
				}
			}

			$data['paketsoal_post'] = array();
			if(isset($hassetpost['PROTEST_CONDITION'])){			
				if($hassetpost['PROTEST_CONDITION']==2){
					$data['paketsoal_post'] = $this->testing_model->getlist_soal($hassetpre['PROTEST_ID'])->result_array();
					foreach ($data['paketsoal_post'] as $k => $v) {
						$options = $this->testing_model->getlist_option($v['QUESTION_ID'])->result_array();
						foreach ($options as $kk => $vv) {
							$data['paketsoal_post'][$k]['OPTIONS'][]['OPTION_VALUE'] = $vv['OPTION_VALUE'];
							if($vv['OPTION_ANSWER']==1){
								$data['paketsoal_post'][$k]['OPTION_ANSWER'] = $vv['OPTION_VALUE'];
							}
						}
					}
				}
			}
			// echo json_encode($data['paketsoal_post']);die;

			$data['participant'] = $this->testing_model->getListParticipant($id)->result_array();
			foreach ($data['participant'] as $key => $value) {
				$score_pre 	= $this->testing_model->getlistScore($value['PROPAR_ID'], 1)->row_array();
				$score_post = $this->testing_model->getlistScore($value['PROPAR_ID'], 2)->row_array();
				if($score_pre){
					$data['participant'][$key]['SCORE_PRE'] = $score_pre['PROSCR_VALUE'];
				}else{
					$data['participant'][$key]['SCORE_PRE'] = '';
				}
				if($score_post){
					$data['participant'][$key]['SCORE_POST'] = $score_post['PROSCR_VALUE'];
				}else{
					$data['participant'][$key]['SCORE_POST'] = '';
				}
			}
			
			$data['pretest'] = $hassetpre;
			$data['posttest']= $hassetpost;
			$data['whoismaxpost'] = $this->testing_model->high_post_test()->result_array();
			$data['whoismaxpre'] = $this->testing_model->high_pre_test()->result_array();
			
			$data['maxposttest'] = $this->testing_model->maximum_post_test()->result_array();
			$data['minpretest'] = $this->testing_model->minimum_pre_test()->result_array();
			
			$data['coba']=$id;
			//echo "<pre>"; print_r($data);die;
			$this->template->display('diklat/testing/detail', $data);
		} else {
			$this->access->redirect('404');
		}

	}
	function json_listsoalpaket($id=0){
		$datasoal = $this->diklat_model->getlist_soalonpaket($id)->result_array();
		foreach ($datasoal as $k => $v) {
			$datasoal[$k]['list_option'] = $this->testing_model->getlist_optionsoal($v['DETPACK_QUESTION_ID'])->result_array();
		}
		
		echo json_encode($datasoal);
	}
	function json_listsoalpaket_current($id=0){
		$datasoal = $this->testing_model->getlist_soal($id)->result_array();
		foreach ($datasoal as $k => $v) {
			$datasoal[$k]['list_option'] = $this->testing_model->getlist_option($v['QUESTION_ID'])->result_array();
		}
		echo json_encode($datasoal);
	}

	function start($id=0,$type=0){
		$this->testing_model->startEndTes($id,$type,1);
		$hasil = 1;
		redirect(base_url().'diklat/testing');
		
	}
	function end($id=0,$type=0){
		$this->testing_model->startEndTes($id,$type,2);
		$hasil = 1;
		redirect(base_url().'diklat/testing');
	}

	function startview($id=0,$type=0){
		$this->testing_model->startEndTes($id,$type,1);
		$hasil = 1;
		echo $hasil;
		//redirect(base_url().'diklat/testing');
		
	}
	function endview($id=0,$type=0){
		$this->testing_model->startEndTes($id,$type,2);
		$hasil = 1;
		echo $hasil;
		//redirect(base_url().'diklat/testing');
	}


	public function printPDF($id){

		$this->load->library('pdf');
		$diklat = $this->diklat_model->getDetail($id)->row_array();
		$participant = $this->testing_model->getListParticipant($id)->result_array();
		
		foreach ($participant as $key => $value) {
			$score_pre 	= $this->testing_model->getlistScore($value['PROPAR_ID'], 1)->row_array();
			$score_post = $this->testing_model->getlistScore($value['PROPAR_ID'], 2)->row_array();
			if($score_pre){
				$participant[$key]['SCORE_PRE'] = $score_pre['PROSCR_VALUE'];
			}else{
				$participant[$key]['SCORE_PRE'] = '';
			}
			if($score_post){
				$participant[$key]['SCORE_POST'] = $score_post['PROSCR_VALUE'];
			}else{
				$participant[$key]['SCORE_POST'] = '';
			}
		}
		$tgl_pelatihan = "";
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
    	$hassetpre 	= $this->testing_model->getlistTesting($diklat['PROGRAM_ID'], 1)->row_array();
    	$hassetpost = $this->testing_model->getlistTesting($diklat['PROGRAM_ID'], 2)->row_array();
    	$jenis_tes = ($hassetpre['PROTEST_CONDITION'] == 1 ? "Manual" : "Online");
    	$htmlpdf = "";
    	// $htmlpdf .= '<h2 style="text-transform: uppercase;text-align:center"><small>DATA KAMAR</small></h2>';
    	// $htmlpdf .= '<br>';
    	$htmlpdf .= '<h3 style="text-align:center;">HASIL PRE-TEST & POST-TEST</h3><br/><br/>';
    	$htmlpdf .= '<table style="border-top: 1px solid black; border-bottom: 1px solid black;width:100%">
    					<tbody>
    						<tr>
    							<td valign="top" width="25%">Nama Program</td>
    							<td valign="top" width="2%">:</td>
    							<td valign="top">'. (($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-") .'</td>
    						</tr>
    						<tr>
    							<td valign="top">Deskripsi Program</td>
    							<td valign="top">:</td>
    							<td valign="top">'. (($diklat['PROGRAM_DESCRIPTION']!="")?$diklat['PROGRAM_DESCRIPTION']:"-") .'</td>
    						</tr>
    						<tr>
    							<td valign="top">Tanggal Pelatihan</td>
    							<td valign="top">:</td>
    							<td valign="top">'. $tgl_pelatihan .'</td>
    						</tr>
    						<tr>
    							<td valign="top">Jenis Tes</td>
    							<td valign="top">:</td>
    							<td valign="top">'. $jenis_tes .'</td>
    						</tr>
    					</tbody>
    				</table>';
    	$htmlpdf .= '<br>';
    	
		$htmlpdf .= '<table style="border: 1px solid black;border-collapse:collapse;width:100%">
						<thead>
							<tr>
								<th style="border: 1px solid black;padding:5px;text-align:center">No.</th>
								<th style="border: 1px solid black;padding:5px;text-align:center">Nama Peserta</th>
								<th style="border: 1px solid black;padding:5px;text-align:center">Instansi</th>
								<th style="border: 1px solid black;padding:5px;text-align:center">Pre-Test</th>
								<th style="border: 1px solid black;padding:5px;text-align:center">Post-Test</th>
								<th style="border: 1px solid black;padding:5px;text-align:center">Perkembangan</th>
							</tr>
						</thead>
						<tbody>';
    	$no = 1;
	    foreach ($participant as $k => $v) {
			if ((empty($v['SCORE_PRE']) || empty($v['SCORE_POST']))) {
				//$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
			$sub_total = 0;
			}
			elseif (is_numeric($v['SCORE_PRE']) && is_numeric($v['SCORE_POST'])) {
				$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
			}
			
			$htmlpdf .= '<tr style="vertical-align:top;">
    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$no.'</td>    					
    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v['MEMBER_NAME'].'</td>    					
    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:left">'.$v['INSTANSI_NAME'].'</td>    					
    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$v['SCORE_PRE'].'</td>    					
    					<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.$v['SCORE_POST'].'</td> 
						<td valign="top" style="border: 1px solid black;padding:5px;text-align:center">'.round($sub_total, 3).'</td> 
						</tr>';
			$no++;
	    }
	    $htmlpdf .= '</tbody></table>';
    	
     	$headerhtml = '<table style="width:100%;"><tr><td width="50%" style="text-align:left;"><img syle="" src="'.base_url().'assets/images/IFFII.png" width="100px"></img></td><td width="50%" style="text-align:right;"><img syle="" src="'.base_url().'assets/images/logo_lama.png" width="80px"></img></td></tr></table>';
	    	$this->pdf->pdf->SetHTMLHeader($headerhtml);
    	$this->pdf->pdf->SetTitle('Hasil Tes Program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-"));
        $this->pdf->pdf->WriteHTML($htmlpdf, 2);
        $this->pdf->pdf->Output('Hasil Tes Program - '.(($diklat['PROGRAM_NAME']!="")?$diklat['PROGRAM_NAME']:"-").' '.time().'.pdf', 'I');

    }

    function rescoring($id=0){
		if($this->access->permission('create')) {
			$data = array();
			if($post = $this->input->post()) {
				echo "<pre>"; print_r($post); 
				$question = $post['question'];
				for ($i=0; $i < count($question); $i++) { 
					$this->testing_model->update_pretest($question[$i], $post['opsi_'.$question[$i]]);
					//$this->testing_model->update_posttest($posttest['PROTEST_ID'], $i, $post['opsi_'.$question[$i]]);
				}
				
				$participanttest = $this->testing_model->getlistTestingParticipant($post['program_id'])->result_array();
				print_r($participanttest);
				foreach ($participanttest as $k => $v) {
					echo $v['PROSCR_ID'];
					$this->testing_model->ReScoring($v['PROSCR_ID'],count($question));
				}
				//die;
				redirect(base_url().'diklat/testing/detail/'.$post['program_id']);
			}else{
				$data['diklat'] = $this->diklat_model->getDetail($id)->row_array();
				$hassetpre 	= $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 1)->row_array();
				$hassetpost = $this->testing_model->getlistTesting($data['diklat']['PROGRAM_ID'], 1)->row_array();
				
				$data['paketsoal'] = array();
				if(isset($hassetpre['PROTEST_CONDITION'])){			
					if($hassetpre['PROTEST_CONDITION']==2){
						$data['paketsoal'] = $this->testing_model->getlist_soal($hassetpre['PROTEST_ID'])->result_array();
						foreach ($data['paketsoal'] as $k => $v) {
							$options = $this->testing_model->getlist_option($v['QUESTION_ID'])->result_array();
							foreach ($options as $kk => $vv) {
								$data['paketsoal'][$k]['OPTIONS'][$kk]['OPTION_VALUE'] = $vv['OPTION_VALUE'];
								$data['paketsoal'][$k]['OPTIONS'][$kk]['OPTION_ID'] = $vv['OPTION_ID'];
								if($vv['OPTION_ANSWER']==1){
									$data['paketsoal'][$k]['OPTION_ANSWER'] = $vv['OPTION_VALUE'];
								}
							}
						}
					}
				}
			}
			//echo "<pre>"; print_r($data);die;
			$this->template->display('diklat/testing/rescoring', $data);
		} else {
			$this->access->redirect('404');
		}

	}


}