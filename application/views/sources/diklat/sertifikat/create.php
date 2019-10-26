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
                                    <option value="" hidden="hidden"> - Pilih Tipe Sertifikat-</option>
                                    <option value="1">Internal PPATK</option>
                                    <option value="2">Eksternal</option>
                              </select>
                    </div><small class="help-block"></small>
                </div>
            </div>


            <div class="form-group ttd">
                <label for="" class="col-sm-2 control-label text-right">Penandatangan 1<span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        <select id="SERTIFIKAT_SIGNATURE1" class="select2 wajib" name="SERTIFIKAT_SIGNATURE1" data-placeholder="Pilih Penanddatangan">
                            <?php if(count($sig)>0){ ?>
                                <option value="" hidden="hidden"> - Pilih Penandatangan-</option>
                                   <?php foreach ($sig as $data) { ?>
                                       <?php 
                                        echo '<option value="'.$data['SIGNATURE_ID'].'">'.$data['SIGNATURE_NAME'].' ('.$data['SIGNATURE_JABATAN'].')</option>';
                                       ?>
                                      <?php } ?> 
                                 <?php }else{ ?>                                 
                                    <option value=""> Data Sasaran Kosong!</option>
                            <?php } ?>
                            </select>
                    </div><small class="help-block"></small>
                </div>
            </div>

            <div class="form-group ttd">
                <label for="" class="col-sm-2 control-label text-right">Penandatangan 2<span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        <select id="SERTIFIKAT_SIGNATURE2" class="select2 wajib" name="SERTIFIKAT_SIGNATURE2" >
                            <?php if(count($sig)>0){ ?>
                                <option value="" hidden="hidden"> - Pilih Penandatangan-</option>
                                   <?php foreach ($sig as $data) { ?>
                                       <?php 
                                        echo '<option value="'.$data['SIGNATURE_ID'].'">'.$data['SIGNATURE_NAME'].' ('.$data['SIGNATURE_JABATAN'].')</option>';
                                       ?>
                                      <?php } ?> 
                                 <?php }else{ ?>                                 
                                    <option value=""> Data Sasaran Kosong!</option>
                            <?php } ?>
                            </select>
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
        $('.ttd').show();
        // $('.nama_kategori').hide();
    });


     $('#SERTIFIKAT_TYPE').change(function(){
        var val = $(this).val();
        $('.ttd').hide();
        if(val == 1){
            $('.ttd').show();
        }
    });
    // $('#categori_type').change(function(){
    //  var val = $(this).val();
    //  $('.nama_kategori').hide();
    //  if(val == 2){
    //      $('.nama_kategori').show();
    //  }
    // });

</script>
