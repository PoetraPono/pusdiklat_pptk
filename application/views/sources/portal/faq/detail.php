<style>
    .input-sm {
        height: 26px;
    }
</style>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li class="active">Detail Data FAQ</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Detail Data FAQ</h6>
        
    </div>
    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Pertanyaan <span class="mandatory">*</span> : </label>
                <div class="col-sm-8">
                    <textarea disabled rows="2" type="text" class="form-control wajib" placeholder="Pertanyaan" id="FAQ_QUESTION" name="FAQ_QUESTION"><?php echo $modul['FAQ_QUESTION'];?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Jawaban  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-8">
                    <textarea disabled rows="20" type="text" class="form-control wajib" placeholder="Jawaban" id="FAQ_ANSWER" name="FAQ_ANSWER"><?php echo $modul['FAQ_ANSWER'];?></textarea>
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">File Lampiran:</label>
                
                <?php if($modul['FAQ_FILE_PATH'] != ""){ ?>
                <div class="col-sm-2 control-label">     
                      <a href="<?php echo base_url().$modul['FAQ_FILE_PATH']; ?>" title="diklat" download="faq_pusdiklat_apuppt">download lampiran</a>
                </div>
                <?php } ?>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Photo:</label>
                <div class="col-sm-4">
                    <?php if($modul['FAQ_IMAGE_PATH'] != ""){ ?>
                    <div class="block">
                        <div class="thumbnail">
                            <a href="<?php echo base_url().$modul['FAQ_IMAGE_PATH']; ?>" class="thumb-zoom lightbox" title="publikasi Image">
                                <img src="<?php echo base_url().$modul['FAQ_IMAGE_PATH']; ?>" >
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <!-- <button type="submit" class="btn btn-xs btn-success">Simpan</button> -->
                    <a href="<?php echo base_url();?>portal/faq" class="btn btn-xs btn-primary">Kembali</a>
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
            {title : "Image files", extensions : "jpg,gif,png,pdf,doc"},
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