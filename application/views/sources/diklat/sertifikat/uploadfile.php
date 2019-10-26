<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
		<li class="active">Sertifikat</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i> Upload File </h6>
		
	</div>
	<div class="panel-body">
        <!-- <form class="form-horizontal need_validation" action="" id="upload_form" role="form" method="post" enctype="multipart/form-data"> -->
            
            <div class="form-group">
                <!-- <label for="" class="col-sm-1 control-label text-right">
                    
                </label> -->
                <div class="col-sm-12 control-label">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-table2"></i> List Peserta Diklat</h6>
                        </div>
                        <?php if($peserta == 1){ ?>
                        <div class="panel-body">
                            <div class="callout callout-success fade in" style="margin-bottom: -5px;">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <h5 >Jumlah peserta terseleksi : <span id="jml_peserta"></span> </h5>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th width="5%" rowspan="<?php echo (count($partisipan) == 0) ? '1':'2'; ?>" class="align-center" style="text-align:center;">No</th>
                                        <th width="20%" rowspan="<?php echo (count($partisipan) == 0) ? '1':'2'; ?>">Nama</th>
                                        <th width="20%" rowspan="<?php echo (count($partisipan) == 0) ? '1':'2'; ?>" style="text-align:center;">NIP</th>
                                        <th width="20%" rowspan="<?php echo (count($partisipan) == 0) ? '1':'2'; ?>" style="text-align:center;">Tanggal Daftar</th>
                                        <th width="35%" rowspan="<?php echo (count($partisipan) == 0) ? '1':'2'; ?>" style="text-align:center;">Aksi</th>
                                    </tr>                              
                                        <th style="text-align:center;" ></th>
                                    </tr>

                                </thead>
                                <tbody>
                                <?php $n = 1; if (count($partisipan )> 0) {?>
                                <?php foreach ($partisipan as $data ) {?>
                                    <form class="form-horizontal need_validation" action="" id="upload_form" role="form" method="post" enctype="multipart/form-data">
                                        <tr class="rw_participant">
                                            <td class="align-center" style="text-align:center; vertical-align: top;"><?php echo $n?></td>
                                            <td class="align-left" style="text-align:left; vertical-align: top;">
                                            <?php echo $data['MEMBER_NAME']?>
                                                <input type="hidden" value="<?php echo $data['PROPAR_MEMBER_ID'];?>" name="PROPAR_MEMBER_ID">
                                            </td>
                                            <td class="align-center" style="text-align:center; vertical-align: top;"><?php echo $data['MEMBER_NIK']?></td>
                                            <td class="align-center" style="text-align:center; vertical-align: top;"><?php echo $data['PROPAR_SUBMIT_DATE']?></td>
                                            <td class="align-center" style="text-align:left; vertical-align: top;">
                                            <?php 
                                            if ($data['SERTIFIKAT_TYPE'] == 2) { 
                                                if ($data['SERTIFIKAT_PATH_DOWNLOAD'] != '') {?>
                                                    
                                                        <div class="col-sm-8">
                                                            <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">

                                                            <input type="file" class="form-control" name="gambar_path" accept="application/pdf">
                                                            <span class="help-block">jenis file yang diijinkan pdf</span>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button type="submit" class="btn btn-warning btn-icon"><i class="icon-upload2" ria-hidden="true" data-toggle="tooltip" title="Upload Sertifikat"></i></button>
                                                            <a  href="<?php echo base_url();?><?php echo $data['SERTIFIKAT_PATH_DOWNLOAD'];?>" class="btn btn-sm btn-info btn-icon" download="sertifikat_<?php echo $data['PROPAR_ID'];?>"><i class="icon-download2" aria-hidden="true" data-toggle="tooltip" title="Download Sertifikat"></i></a> 
                                                            </div>
                                                    
                                                    <?php }else{ ?>
                                                    
                                                        <div class="col-sm-8">
                                                             <input type="file" class="form-control" name="gambar_path" accept="application/pdf">
                                                             <span class="help-block">jenis file yang diijinkan pdf</span>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-sm btn-warning btn-icon"><i class="icon-upload2"></i></button>
                                                        </div>
                                                    
                                            <?php }?>
                                            <?php }else{ ?>
                                              <a  href="<?php echo base_url();?>diklat/sertifikat/download/<?php echo $data['PROPAR_ID'];?>" target="blank" class="btn btn-info btn-icon" download="sertifikat_<?php echo $data['PROPAR_ID'];?>"><i class="icon-download2" aria-hidden="true" data-toggle="tooltip" title="Download Sertifikat" ></i></a> 
                                                            </div>
                                                             <?php }?>
                                            </td> 

                                        </tr>
                                    </form>
                            
                                    <?php $n++; } ?>
                                <?php } ?>
                            
                               <!--  <tr><td collspan="6"></td></tr> -->
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
                 <div class="form-group">
                <div class="col-sm-10">
                <br/>
                    <a href="<?php echo base_url();?>diklat/sertifikat" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
            </div>
            <br>
           
        <!-- </form> -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function($) {
    var jml = $('.rw_participant').length;
    $('#jml_peserta').html(jml);
    /*$('body').on('click', '#reset', function () {
        $('#list_requisite').html("").html(drawlist);
    });*/
});
$("#selectAll").click(function(event) {
    $('.ck').prop("checked", false);
    $('.ck').parent().removeClass("checked");
    if(this.checked){
        for (var i = 0; i < $('#kuota').val(); i++) {
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
        if(cek > ($('#kuota').val()*1)){
            alert("Jumlah peserta yang dipilih melebii kuota yang tersedia!");
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