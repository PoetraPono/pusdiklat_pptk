<style>
    .input-sm {
        height: 26px;
    }
</style>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li class="active">Detail Data Modul</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Detail Data Modul</h6>
        
    </div>
    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Modul <span class="mandatory">*</span> : </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control wajib" id="SILABUS_NAME" name="SILABUS_NAME" placeholder="Nama Modul" value="<?php echo $modul['SILABUS_NAME'];?>" disabled>
                </div>
            </div>

    
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-8">
                    <textarea type="text" class="form-control" rows="5" disabled placeholder=" Deskripsi" id="SILABUS_DESCRIPTION" name="SILABUS_DESCRIPTION"><?php echo $modul['SILABUS_DESCRIPTION']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right"">Silabus: </label>
                <div class="col-sm-10">
                    <?php if($modul['SILABUS_FILE_PATH'] != ''){ ?>
                    <label class="control-label"">
                    <a href="<?php echo base_url().$modul['SILABUS_FILE_PATH'];?>" download> download</a></label>
                    <?php }else{ ?>
                    <label class="control-label"">-</label>
                    <?php } ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <!-- <button type="submit" class="btn btn-xs btn-success">Simpan</button> -->
                    <a href="<?php echo base_url();?>master/modul" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
   $(".multiple-uploader").pluploadQueue({
    runtimes : 'html5, html4',
    url : '../upload',
    chunk_size : '1mb',
    unique_names : true,
    filters : {
        max_file_size : '10mb',
        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png"},
            //{title : "Zip files", extensions : "zip"}
        ]
    },
    resize : {width : 300, height : 300, quality : 100}
});

//===== WYSIWYG editor =====//

$('.editor').wysihtml5({
    stylesheets: "css/wysihtml5/wysiwyg-color.css"
});

</script>