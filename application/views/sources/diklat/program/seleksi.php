<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
		<li class="active">Seleksi Peserta</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Seleksi Peserta Diklat</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Program : </label>
                <div class="col-sm-10 control-label">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">

                    <?php echo $diklat['PROGRAM_NAME']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Deskripsi Program : </label>
                <div class="col-sm-10 control-label">
                    <?php echo $diklat['PROGRAM_DESCRIPTION']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Tanggal Pelatihan :
                </label>
                <div class="col-sm-2 control-label" style="margin-right:-50px;">
                   <?php echo date('d M Y',strtotime($diklat['PROGRAM_START'])); ?>
                </div>
                <label for="" class="col-sm-1 control-label" style="margin-right:-50px;">
                   s.d
                </label>
                <div class="col-sm-2 control-label">
                     <?php echo date('d M Y',strtotime($diklat['PROGRAM_END'])); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jumlah Mata Ajar :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_LESSON']; ?>
                </div>
            </div> 
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Total Jam Pelatihan :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_HOURS']; ?> Jam
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Kuota Peserta :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_KUOTA']; ?>
                <input type="hidden" name="PROGRAM_ID" value="<?php echo $diklat['PROGRAM_ID']; ?>">
                <input type="hidden" id="kuota" value="<?php echo $diklat['PROGRAM_TOTAL_KUOTA']; ?>">
                <input type="hidden" id="isnewclass" value="<?php echo ($statusApprove >= $diklat['PROGRAM_TOTAL_KUOTA'] ? 1 : 0); ?>">
                <input type="hidden" id="jmlclass" value="<?php echo count($group); ?>">
                <input type="hidden" id="jml_peserta" value="<?php echo $statusApprove; ?>">
                
                </div>
            </div>
            <div class="form-group">
                <!-- <label for="" class="col-sm-1 control-label text-right">
                    
                </label> -->
                <div class="col-sm-12 control-label">
                   <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-table2"></i> List Peserta</h6>
                    </div>
                    <?php if($statusApprove != 0){ ?>
                    <div class="panel-body">
                            <div class="callout callout-success fade in" style="margin-bottom: -5px;">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <h5 >Jumlah peserta terseleksi : <span id=""><?php echo $statusApprove; ?>
                                    <?php echo (count($group) > 1? " dan terbagi dalam ".count($group)." kelas":""); ?> 
                                </span> </h5>
                            </div>
                    </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>" class="align-center" style="text-align:center;">No</th>
                                    <th width="20%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>">Nama</th>
                                    <th width="20%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>">Instansi</th>
                                    <th width="10%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>" style="text-align:center;">NIK</th>
                                    <th width="15%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>" style="text-align:center;">Tanggal Daftar</th>
                                    <th width="35%" colspan="<?php echo count($requisite); ?>" style="text-align:center;">Persyaratan</th>
                                    <th width="5%" rowspan="<?php echo (count($requisite) == 0) ? '1':'2'; ?>" style="text-align:center;">
                                        <input type="checkbox" class="styled" id="selectAll" value="1"></input>
                                        <?php if($statusApprove != 0){ ?>
                                        <?php } ?>
                                    </th>
                                </tr>
                                <?php $n = 1; if(count($requisite) > 0){ ?>
                                    <tr>
                                    <?php foreach ($requisite as $r => $vr) { ?>
                                        <th style="text-align:center;" ><?php echo $vr['PROREQ_DESC']; ?></th>
                                    <?php } ?>
                                    </tr>
                                <?php } ?>
                            </thead>
                            <tbody>
                                 <?php $n = 1; $x=0; if(count($participant) > 0){ ?>
                                    <?php foreach ($participant as $k => $v) { ?>
                                   
                                        <tr class="rw_participant">
                                            <td class="align-center" style="text-align:center;"><?php echo $n; ?></td>
                                            <td class="align-left"><?php echo $v['MEMBER_NAME']; ?></td>
                                            <td class="align-left"><?php echo $v['INSTANSI_NAME']; ?></td>
                                            <td class="align-center" style="text-align:center;"><?php echo $v['MEMBER_NIK']; ?></td>
                                            <td class="align-center" style="text-align:center;"><?php echo date('d-m-Y H:m', strtotime($v['PROPAR_SUBMIT_DATE'])); ?></td>
                                            <?php if(isset($v['MEMBER_REQUISITE'])){ foreach($v['MEMBER_REQUISITE'] as $m) { ?>
                                                <td style="text-align:center;">
                                                <?php if($m['status'] == 0){ ?>
                                                    <?php echo '<i class="icon-close" style="color:red;"></i>'; ?>
                                                <?php }else{ ?>
                                                     <?php echo '<i class="icon-checkmark" style="color:green;"></i>'; ?>
                                                     <?php echo ($m['file'] != "") ? '<a href="'.$this->config->item('path_web').$m['file'].'" class="tip" data-original-title="Download Persyaratan" data-placement="top"download><i class="icon-file-download"></i></a>':''; ?>
                                                <?php } ?>
                                                </td>
                                            <?php } 
                                                }else{ ?>
                                             <td class="align-center" style="text-align:center;"></td>
                                            <?php } ?>
                                            <td class="align-center" style="text-align:center;">
                                                <?php if($v['PROPAR_STATUS'] == 0){ ?>
                                                <input type="checkbox" onclick="selectCK()" class="styled ck ck_<?php echo $k; ?>" id="select_<?php echo $x; ?>" name="dataApproved[]" value="<?php echo $v['PROPAR_ID']; ?>">
                                                <?php $x++; }else{ ?>
                                                    <a href="<?php echo base_url()."diklat/program/kartupeserta/".$v['PROPAR_PROGRAM_ID']."/".$v['PROPAR_MEMBER_ID'];?>" target="_blank" class="tip" data-original-title="Download Kartu Peserta" data-placement="top"><i class="icon-vcard" ></i></a>
                                                <?php } ?>
                                        </tr></td>
                                    
                                    <?php $n++; } ?>
                                <?php }else{ ?>
                                <tr><td collspan="6"></td></tr>
                                <?php } ?>
                            </tbody>
                          
                           <!--  <tfoot>
                                <tr>
                                    <td colspan="6" style="text-align:right;">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-default" id="reset" ><i class="icon-loop4"></i> reset</add>
                                        &emsp; <a href="javascript:void(0);" class="btn btn-xs btn-info" id="add_requisite" data-ref="<?php echo $n; ?>"><i class="icon-plus-circle"></i> tambah</add>
                                    </td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-10">
                    <a href="javscript:void(0);" class="btn btn-xs btn-success" id="btnapprove" onclick="approvedata()">Approve</a>
                 <?php if($statusApprove != 0){ ?>
                     <?php } ?>
                    <a href="<?php echo base_url();?>diklat/program" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function($) {
    var jml = $('.ck').length;
    //alert(jml);
    if(jml == 0){
        $("#btnapprove").hide();
    }else{
        $("#btnapprove").show();
    }
    //$('#jml_peserta').html(jml);
    /*$('body').on('click', '#reset', function () {
        $('#list_requisite').html("").html(drawlist);
    });*/

});

function approvedata(){
    var jml = 0;
    $('.ck').each(function() {
        if(this.checked){
            jml++;
        }
    });
    //alert(jml);
    if(jml == 0){
        alert("Peserta belum ada yang terpilih.");
        return false;
    }else{
        // /return false;
        if($("#isnewclass").val()*1 == 1){
            $("#text_alert").html("Kuota peserta telah terpenuhi, anda yakin akan membuat kelas baru dan menyimpan data ini?");
        }
        $("#mki_form").submit();
    }
}
$("#selectAll").click(function(event) {
    $('.ck').prop("checked", false);
    $('.ck').parent().removeClass("checked");
    var k = $('#kuota').val()*1;
    var n = $('#jml_peserta').val()*1 % k;
    var x = (k-n == 0) ? k : k-n; 
    if(this.checked){
        for (var i = 0; i < x; i++) {
            if($('#select_'+i).length > 0){
                $('#select_'+i).prop("checked", true);
                $('#select_'+i).parent().addClass("checked");
            }
        }
    }
});

$(".ck").click(function(event) {
    if(!this.checked){
        $('#selectAll').prop("checked", false);
        $('#selectAll').parent().removeClass("checked");
    }else{
        var un = 0;
        var cek = 0;
        $('.ck').each(function() {
            if(!this.checked){
                un++;
            }else{
                cek++;
            }
        });
        var k = $('#kuota').val()*1;
        var n = $('#jml_peserta').html()*1;
        var x = (k-n == 0) ? k : k-n; 
        if(cek > x){
            alert("Jumlah peserta yang dipilih melebihi kuota yang tersedia!");
            
            $(this).prop("checked", false);
            $(this).parent().removeClass("checked");
        }else{
            if(un == 0){
                $('#selectAll').prop("checked", true);
                $('#selectAll').parent().addClass("checked");
            }
        }        
    }
});
$()

</script>