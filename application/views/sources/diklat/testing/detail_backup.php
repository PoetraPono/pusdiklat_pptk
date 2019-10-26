<style>
    .input-sm {
        height: 26px;
    }
    table>tbody>tr>td{
        vertical-align: top !important;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>diklat/testing'>Testing & Kuisioner</a></li>
        <li class="active">Pengaturan</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Pengaturan Testing & Kuisioner</h6>
    </div>

    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
            <div class="tabbable">
                <ul id="myTab" class="nav nav-tabs tab-bricky">
                    <li class="active">
                        <a href="#pretest" data-toggle="tab" data-id="1">Pre-Test</a>
                    </li>
                    <li class="">
                        <a href="#posttest" data-toggle="tab" data-id="2">Post-Test</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pretest">
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                Tanggal Testing :
                            </label>
                            <div class="col-sm-4 control-label">
                                <?php echo isset($pretest['PROTEST_DATE'])!=""?dateEnToId(date('Y-m-d',strtotime($pretest['PROTEST_DATE'])),'d M Y'):'-'; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                Type Testing :
                            </label>
                            <div class="col-sm-4 control-label">
                                <?php echo isset($pretest['PROTEST_CONDITION'])!=""?($pretest['PROTEST_CONDITION']==1?'Offline':'Online'):'-'; ?>
                            </div>
                        </div>
                        <?php $condition = isset($pretest['PROTEST_CONDITION'])!=""?($pretest['PROTEST_CONDITION']==1?'Offline':'Online'):'-';
                        if($condition=='Online'){?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">
                                    Nama Paket Soal :
                                </label>
                                <div class="col-sm-8 control-label">
                                    <?php echo isset($pretest['PROTEST_PACKET_NAME'])!=""?$pretest['PROTEST_PACKET_NAME']:'-'; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="panel-group block" style="margin-bottom: 0 !important;">
                                    <?php if($condition=='Online'){ ?>                                        
                                        <div class="panel panel-default" style="border:0 !important;">
                                            <div class="panel-heading" style="border:1px solid #ddd">
                                                <h6 class="panel-title" style="padding: 8px 20px 8px !important">
                                                    <a data-toggle="collapse" href="#pre-group1">List Soal</a>
                                                </h6>
                                            </div>
                                            <div id="pre-group1" class="panel-collapse collapse">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 40px;">No</th>
                                                                <th>Soal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $no = 1;
                                                                if(count($paketsoal_pre)>0){
                                                                    foreach ($paketsoal_pre as $k => $v) {
                                                                        echo '<tr>';
                                                                        echo '<td class="text-center" style="width: 10px;">'.$no.'</td>';
                                                                        echo '<td>'.$v['QUESTION_VALUE'].'<br>';
                                                                            foreach ($v['OPTIONS'] as $kk => $vv) {
                                                                                $checked = $vv['OPTION_VALUE']==$v['OPTION_ANSWER']?"checked":"-";
                                                                                echo '<label class="radio radio-inline" style="padding-left:10px;">
                                                                                    <input type="radio" class="styled" '.$checked.' readonly>'.chr(65+$kk).'. '.($vv['OPTION_VALUE']!=""?$vv['OPTION_VALUE']:"-").'</label><br/>';
                                                                            }
                                                                            echo '</td>';
                                                                        echo '</tr>';
                                                                        $no +=1;
                                                                    }
                                                                      echo '<tr><td colspan=2 class="text-left"><a href="'.base_url().'diklat/testing/rescoring/'.$diklat['PROGRAM_ID'].'" class="btn btn-xs btn-success"><i class="icon-pencil"></i> Update Jawaban</a></td></tr>';
                                                                }else{
                                                                    echo '<tr><td colspan=2 class="text-center"><i>- tidak ada data -</i></td></tr>';
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                  
                                </div>
                            </div>                        
                        </div>
                        <?php
                         if($condition=='Online' && date('Ymd', time()) <= date('Ymd', strtotime($diklat['PROGRAM_END']))){?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">
                                    
                                </label>
                                <div class="col-sm-8 control-label">
                                    <?php if($pretest['PROTEST_IS_START'] != 1){ ?>
                                        <a href="javascript:void(0);" onclick="startTest(<?php echo $diklat['PROGRAM_ID'];?>,1)" class="btn btn-xs btn-info"><i class="icon-play3"></i> Mulai Pre Tes</a>
                                    <?php }else if($pretest['PROTEST_IS_START'] == 1){ ?>
                                        <a href="javascript:void(0);" onclick="endTest(<?php echo $diklat['PROGRAM_ID'];?>,1)" class="btn btn-xs btn-danger"><i class="icon-stop2"></i> Selesai Pre Tes</a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div> 
                    <div class="tab-pane" id="posttest">
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                Tanggal Testing :
                            </label>
                            <div class="col-sm-4 control-label">
                                <?php echo isset($posttest['PROTEST_DATE'])!=""?dateEnToId(date('Y-m-d',strtotime($posttest['PROTEST_DATE'])),'d M Y'):""; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                Type Testing :
                            </label>
                            <div class="col-sm-4 control-label">
                                <?php echo isset($posttest['PROTEST_CONDITION'])!=""?($posttest['PROTEST_CONDITION']==1?'Offline':'Online'):'-'; ?>
                            </div>
                        </div>
                        <?php $condition = isset($posttest['PROTEST_CONDITION'])!=""?($posttest['PROTEST_CONDITION']==1?'Offline':'Online'):'-';
                        if($condition=='Online'){?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">
                                    Nama Paket Soal :
                                </label>
                                <div class="col-sm-8 control-label">
                                    <?php echo isset($posttest['PROTEST_PACKET_NAME'])!=""?$posttest['PROTEST_PACKET_NAME']:'-'; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="panel-group block" style="margin-bottom: 0 !important;">
                                    <?php if($condition=='Online'){ ?>                                        
                                        <div class="panel panel-default" style="border:0 !important;">
                                            <div class="panel-heading" style="border:1px solid #ddd">
                                                <h6 class="panel-title" style="padding: 8px 20px 8px !important">
                                                    <a data-toggle="collapse" href="#post-group1">List Soal</a>
                                                </h6>
                                            </div>
                                            <div id="post-group1" class="panel-collapse collapse">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 40px;">No</th>
                                                                <th>Soal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $no = 1;
                                                                if(count($paketsoal_post)>0){
                                                                    foreach ($paketsoal_post as $k => $v) {
                                                                        echo '<tr>';
                                                                        echo '<td class="text-center" style="width: 10px;">'.$no.'</td>';
                                                                        echo '<td>'.$v['QUESTION_VALUE'].'<br>';
                                                                            foreach ($v['OPTIONS'] as $kk => $vv) {
                                                                                $checked = $vv['OPTION_VALUE']==$v['OPTION_ANSWER']?"checked":"-";
                                                                                echo '<label class="radio radio-inline" style="padding-left:10px;">
                                                                                    <input type="radio" class="styled" '.$checked.' readonly>'.chr(65+$kk).'. '.($vv['OPTION_VALUE']!=""?$vv['OPTION_VALUE']:"-").'</label><br/>';
                                                                                // echo '- '.$vv['OPTION_VALUE'].'<br>';
                                                                            }
                                                                            echo '</td>';
                                                                        echo '</tr>';
                                                                        $no +=1;
                                                                    }
                                                                }else{
                                                                    echo '<tr><td colspan=2 class="text-center"><i>- tidak ada data -</i></td></tr>';
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>                                    
                                </div>
                            </div>                        
                        </div>
                        <?php
                         if($condition=='Online' && date('Ymd', time()) == date('Ymd', strtotime($diklat['PROGRAM_END']))){?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">
                                    
                                </label>
                                <div class="col-sm-8 control-label">
                                    <?php if($posttest['PROTEST_IS_START'] != 1){ ?>
                                        <a href="javascript:void(0);" onclick="startTest(<?php echo $diklat['PROGRAM_ID'];?>,2)" class="btn btn-xs btn-info"><i class="icon-play3"></i> Mulai Post Tes</a>
                                    <?php }else if($posttest['PROTEST_IS_START'] == 1){ ?>
                                        <a href="javascript:void(0);" onclick="endTest(<?php echo $diklat['PROGRAM_ID'];?>,2)" class="btn btn-xs btn-danger"><i class="icon-stop2"></i> Selesai Post Tes</a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr />

            <div class="form-group">
                <div class="col-md-12">
                <h5>Hasil Pre Test & Post Test Peserta</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center" style="width: 40px;">No</th>
                                <th rowspan="2">Nama Peserta</th>
                                <th rowspan="2">Instansi</th>
                                <th class="text-center" colspan="3" class="text-center">Nilai</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 100px">Pre-Test</th>
                                <th class="text-center" style="width: 100px">Post-Test</th>
								<th class="text-center" style="width: 100px">Perkembangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
								$sub_total=0;
                                if(count($participant)>0){
                                    foreach ($participant as $k => $v) {
                                        echo '<tr>';
                                        echo '<td class="text-center" style="width: 10px;">'.$no.'</td>';
                                        echo '<td>'.$v['MEMBER_NAME'].'</td>';
                                        echo '<td>'.$v['INSTANSI_NAME'].'</td>';
                                        echo '<td style="width: 80px;text-align:center;">'.$v['SCORE_PRE'].'</td>';
                                        echo '<td style="width: 80px;text-align:center;">'.$v['SCORE_POST'].'</td>';
										/*
										if (is_numeric($v['SCORE_PRE']) && is_numeric($v['SCORE_POST'])) {
											$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
										}
										echo '<td style="width: 80px;text-align:center;">'.round($sub_total, 3).' %</td>';
										
										if (is_null($v['SCORE_PRE'])) {
											//$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
											$subtotal = 0;
										}else{
											$subtotal=$v['SCORE_PRE'];
										}
										
										*/
										/*
										if ((empty($v['SCORE_PRE']) && empty($v['SCORE_POST']))) {
											//$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
											//$sub_total = 0;
										}
										*/
										if ((empty($v['SCORE_PRE']) && empty($v['SCORE_POST']))) {
											//$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
											$sub_total = 0;
										}
										elseif (is_numeric($v['SCORE_PRE']) && is_numeric($v['SCORE_POST'])) {
											$sub_total = ((($v['SCORE_POST']-$v['SCORE_PRE'])/$v['SCORE_PRE']) * 100);
										}
										echo '<td style="width: 80px;text-align:center;">'.round($sub_total, 3).' %</td>';
                                        echo '</tr>';
                                        $no +=1;
                                    }
                                }else{
                                    echo '<tr><td colspan=3 class="text-center"><i>- tidak ada data -</i></td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <a href="<?php echo base_url();?>diklat/testing" class="btn btn-xs btn-danger">Kembali</a>
                    <a href="<?php echo base_url();?>diklat/testing/printPDF/<?php echo $diklat['PROGRAM_ID']?>" class="btn btn-xs btn-primary"  target="_blank">Download Hasil Tes</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function startTest(id,type){
        $.ajax({
            url       : "<?php echo base_url('diklat/testing/startview/');?>/"+id+"/"+type,
            type      : "GET",
            dataType  : "JSON",
            success: function(data){
                location.reload();
            }
        });        
    }

    function endTest(id,type){
        $.ajax({
            url       : "<?php echo base_url('diklat/testing/endview/');?>/"+id+"/"+type,
            type      : "GET",
            dataType  : "JSON",
            success: function(data){
                location.reload();
            }
        });         
    }
</script>