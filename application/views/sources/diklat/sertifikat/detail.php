<style>
    .input-sm {
        height: 26px;
    }
</style>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li class="active">Detail Data Diklat</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Detail Data Diklat</h6>
        
    </div>
    
    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tipe Sertifikat <span class="mandatory">*</span> : </label>
                <div class="col-sm-4">
                    <?php echo $sertifikat['SERTIFIKAT_TYPE']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Nama Program :
                </label>
                <div class="col-sm-4">
                   <?php echo $sertifikat['PROGRAM_NAME']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Tanda Tangan 1  :
                </label>
                <div class="col-sm-4">
                     <?php echo $sertifikat['SIGNATURE_NAME1']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                     Tanda Tangan 2  :
                </label>
                <div class="col-sm-4">
                   <?php echo $sertifikat['SIGNATURE_NAME2']; ?>
                </div>
            </div>

             
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <a href="<?php echo base_url();?>diklat/sertifikat" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>

