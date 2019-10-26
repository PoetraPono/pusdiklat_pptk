<style>
    .input-sm {
        height: 26px;
    }
</style>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/sertifikat"; ?>'>Sertifikat</a></li>
        <li class="active">Setting Data Sertifikat</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Setting Data Sertifikat</h6>
        
    </div>
    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tipe Sertifikat <span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                                <select id="SERTIFIKAT_TYPE" class="select2 wajib" name="SERTIFIKAT_TYPE" data-placeholder="Pilih Jenis Diklat">
                                    <option value="1" <?php echo ($sertifikat['TYPE'] == 1 ? "selected" : ""); ?>>Internal</option>
                                    <option value="2" <?php echo ($sertifikat['TYPE'] == 2 ? "selected" : ""); ?>>Eksternal</option>
                                </select>
                    </div><small class="help-block"></small>
                </div>
            </div> 

            <!-- <div class="form-group ttd">
                <label for="" class="col-sm-2 control-label text-right">Nama Program<span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        <?php if(count($program)>0){ ?>
                            <select id="SERTIFIKAT_PROGRAM_ID" class="select2 wajib" name="SERTIFIKAT_PROGRAM_ID" data-placeholder="Pilih Nama program">
                                <option value="0"> Pilih Program</option>
                                   <?php foreach ($program as $data) { 
                                    $select = ($data['PROGRAM_ID'] == $sertifikat['SERTIFIKAT_PROGRAM_ID']) ? "selected" : "";
                                    ?>
                                       <?php 
                                        echo '<option value="'.$data['PROGRAM_ID'].'" '.$select.'>'.$data['PROGRAM_NAME'].'</option>';
                                       ?>
                                      <?php } ?> 
                                </select>
                                 <?php }else{ ?>
                                 <select class="tag-select" disabled>
                                    <option value="0"> Data Program Kosong!</option>
                                </select>
                        <?php } ?>
                    </div><small class="help-block"></small>
                </div>
            </div> -->

            <div class="form-group ttd">
                <label for="" class="col-sm-2 control-label text-right">Penanda Tangan 1<span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        <?php if(count($sig)>0){ ?>
                            <select id="SERTIFIKAT_SIGNATURE1" class="select2 wajib" name="SERTIFIKAT_SIGNATURE1" data-placeholder="Pilih Nama program">
                                <option value="0"> Pilih Penandatangan</option>
                                   <?php foreach ($sig as $data) { 
                                    $select = ($data['SIGNATURE_ID'] == $sertifikat['SERTIFIKAT_SIGNATURE1']) ? "selected" : "";
                                    ?>
                                       <?php 
                                        echo '<option value="'.$data['SIGNATURE_ID'].'" '.$select.'>'.$data['SIGNATURE_NAME'].' ('.$data['SIGNATURE_JABATAN'].')</option>';
                                       ?>
                                      <?php } ?> 
                                </select>
                                 <?php }else{ ?>
                                 <select class="tag-select" disabled>
                                    <option value="0"> Data  Kosong!</option>
                                </select>
                        <?php } ?>
                    </div><small class="help-block"></small>
                </div>
            </div>

            <div class="form-group ttd" >
                <label for="" class="col-sm-2 control-label text-right">Penanda Tangan 2<span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        <?php if(count($sig)>0){ ?>
                            <select id="SERTIFIKAT_SIGNATURE2" class="select2 wajib" name="SERTIFIKAT_SIGNATURE2" >
                                <option value="0"> Pilih Penandatangan</option>
                                   <?php foreach ($sig as $data) { 
                                    $select = ($data['SIGNATURE_ID'] == $sertifikat['SERTIFIKAT_SIGNATURE2']) ? "selected" : "";
                                    ?>
                                       <?php 
                                        echo '<option value="'.$data['SIGNATURE_ID'].'" '.$select.'>'.$data['SIGNATURE_NAME'].' ('.$data['SIGNATURE_JABATAN'].')</option>';
                                       ?>
                                      <?php } ?> 
                                </select>
                                 <?php }else{ ?>
                                 <select class="tag-select" disabled>
                                    <option value="0"> Data  Kosong!</option>
                                </select>
                        <?php } ?>
                    </div><small class="help-block"></small>
                </div>
            </div>
 
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/sertifikat" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var val = $('#SERTIFIKAT_TYPE').val();
        if(val == 1){
            $('.ttd').show();
        }else{
            $('.ttd').hide();
        }
    });

    $('#SERTIFIKAT_TYPE').change(function(){
        var val = $(this).val();
        $('.ttd').hide();
        if(val == 1){
        // alert("sdfsdf");
            $('.ttd').show();
        }else{
            $('.ttd').hide();
        }
    });

</script>
