<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Ubah Data STUDI KASUS</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Ubah Data Studi Kasus</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Studi Kasus <span class="mandatory">*</span> : </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control wajib" id="STUDI_KASUS_NAME" name="STUDI_KASUS_NAME" placeholder="Nama STUDI KASUS"  value="<?php echo $modul['STUDI_KASUS_NAME'];?>">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-8">
                    <textarea type="text" rows="5" class="form-control" placeholder=" Deskripsi" id="STUDI_KASUS_DESCRIPTION" name="STUDI_KASUS_DESCRIPTION"><?php echo $modul['STUDI_KASUS_DESCRIPTION'];?></textarea>
                </div>
            </div>

            <!-- <div class="form-group">
                <label class="col-sm-2 control-label text-right"">File: </label>
                <div class="col-sm-4">
                    <input type="file" class="styled" name="file_path" id="file_path" >
                </div>
                <?php if($modul['STUDI_KASUS_FILE_PATH'] != ''){ ?>
                    <label class="col-sm-2 control-label"">
                    <a href="<?php echo base_url().$modul['STUDI_KASUS_FILE_PATH'];?>" download> download file</a></label>
                    </label>
                    <?php } ?>
            </div> -->
            
            
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>master/studikasus" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
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