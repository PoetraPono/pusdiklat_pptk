<?php
$results['sEcho'] = $sEcho;
$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $iTotalRecords;
if(count($datas))
{
	$i=0;
	foreach($datas as $data)
	{
		$act="";
		$status="";
		$act.='<center><div class="btn-group">';
		if($data['INSTANSI_STATUS']==1){
			if($this->access->permission('read')){
				$act = '<a href="'.base_url().'master/instansi/detail/'.$data['INSTANSI_ID'].'" role="button" class="btn btn-xs btn-default btn-icon mki-btn-yellow" data-original-title="Detail" data-toggle="tooltip" data-placement="top"><i class="icon-file6"></i></a>';
			}
			if($this->access->permission('update')){
				$act .= '<a href="'.base_url().'master/instansi/update/'.$data['INSTANSI_ID'].'" role="button" class="btn btn-xs btn-default btn-icon mki-btn-success" data-original-title="Update" data-toggle="tooltip" data-placement="top"><i class="icon-pencil"></i></a>';
			}
			if($this->access->permission('delete')){	
				$act .= '<a href="javascript:void(0);" onClick="deleteRow('.$data['INSTANSI_ID'].');" role="button" class="btn btn-xs btn-default btn-icon mki-btn-danger" data-original-title="Hapus" data-toggle="tooltip" data-placement="top"><i class="icon-close"></i></a>';
			}
			$status = "<span style=black;font-weight:600;'>AKTIF</span>";
		}else{
			if($this->access->permission('update')){
				$act .= '<a href="javascript:void(0);"  onClick="activeRow('.$data['INSTANSI_ID'].');" role="button" class="btn btn-xs btn-default btn-icon mki-btn-success" data-original-title="Aktifkan" data-toggle="tooltip" data-placement="top"><i class="icon-checkmark"></i></a>&nbsp;';
			}
			$status = "<span style='color:#444;font-weight:600;'>NONAKTIF</span>";
		}
		$act.='</div></center>';

		$results['aaData'][$i] = array(
			($i+1),
			$data["INSTANSI_NAME"],
			$data["INSTANSI_ADDRESS"],
			$data["INSTANSI_PHONE"],
			//$status,
			$act
		);
		++$i;
	}
} else {
	for($i=0;$i<6;++$i) {
		$results['aaData'][0][$i] = '';
	}
}
print($callback.'('.json_encode($results).')');