<style>
    .input-sm {
        height: 26px;
    }
</style>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li class="active">Detail Data Pengajar</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Detail Data Penajar</h6>
        
    </div>
    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                     Nama Pengajar :
                </label>
                <div class="col-sm-9 control-label">
                     <?php echo $pengajar["INSTRUCTOR_NAME"] ?>
                </div>
             </div>

             <div class="form-group">
                <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                     Title :
                </label>
                <div class="col-sm-9 control-label">
                    <?php echo $pengajar['INSTRUCTOR_FIRST_TITLE']?>
                </div>
             </div>

              <div class="form-group">
                <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                     Last Title :
                </label>
                <div class="col-sm-9 control-label">
                    <?php echo $pengajar['INSTRUCTOR_LAST_TITLE']?>
                </div>
             </div>

             <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    E mail <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-9 control-label">
                     <?php echo $pengajar['INSTRUCTOR_EMAIL']; ?>
                </div>
            </div>   

            <div class="form-group">
                <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                    Alamat <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-9">
                     <?php echo $pengajar['INSTRUCTOR_ADDRESS']; ?>
                   
                </div>
            </div>        

            <div class="form-group">
                    <label class="col-sm-2 control-label text-right">
                    Gambar:
                    </label>
                    <div class="col-lg-4 col-md-8 col-sm-8">
                        <div class="block">
                            <div class="thumbnail">
                                <a href="<?php echo base_url().$pengajar['INSTRUCTOR_IMAGE_PATH']; ?>" class="thumb-zoom lightbox" title="Slider Image">
                                    <img src="<?php echo base_url().$pengajar['INSTRUCTOR_IMAGE_PATH']; ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

             <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    File CV:
                   
                </label>
                <div class="col-sm-8 control-label">
                     <?php 
                    echo $download = $pengajar["INSTRUCTOR_CV_PATH"] != '' ? '<a href="'.base_url().$pengajar["INSTRUCTOR_CV_PATH"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download CV" download data-placement="top"><i class="icon-download"></i> Download CV </a>':'-';
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    
                    <a href="<?php echo base_url();?>diklat/pengajar" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
});

 $(document).ready(function(){
        var name = $('#filessss').val();
        $('#uniform-gambar_path').find('.filename').html(name);
    })
    
</script>