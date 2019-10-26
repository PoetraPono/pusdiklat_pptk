<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Tambah Data Pengajar</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data Penajar</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Pengajar <span class="mandatory">*</span> : </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" id="INSTRUCTOR_NAME" name="INSTRUCTOR_NAME" placeholder="Nama Pengajar" value="<?php echo $pengajar['INSTRUCTOR_NAME'];?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Gelar Depan :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Title" id="INSTRUCTOR_FIRST_TITLE" name="INSTRUCTOR_FIRST_TITLE" value="<?php echo $pengajar['INSTRUCTOR_FIRST_TITLE'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Gelar Belakang :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder=" Last Title" id="INSTRUCTOR_LAST_TITLE" name="INSTRUCTOR_LAST_TITLE" value="<?php echo $pengajar['INSTRUCTOR_LAST_TITLE'];?>">
                </div>
            </div>

             <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    E mail :
                </label>
                <div class="col-sm-4">
                	 <input type="text" class="form-control" placeholder=" Last Title" id="INSTRUCTOR_EMAIL" name="INSTRUCTOR_EMAIL" value="<?php echo $pengajar['INSTRUCTOR_EMAIL'];?>">
                </div>
            </div>        


            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Alamat <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                	<textarea type="text" class="form-control" placeholder="Alamat" id="INSTRUCTOR_ADDRESS" name="INSTRUCTOR_ADDRESS" ><?php echo $pengajar['INSTRUCTOR_ADDRESS']; ?></textarea>
                </div>
            </div>        
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Unggah Gambar:
                </label>
                
                <div class="col-sm-6">
                <input type="file" class="styled form-control" id="gambar_path" name="gambar_path" placeholder="Gambar" value="" accept="image/*">
                <span class="help-block">jenis file yang diijinkan png,jpg & jpeg</span>
                
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    
                    <?php 
                    $imgfile = "";
                    if($pengajar['INSTRUCTOR_IMAGE_PATH']!="" and $pengajar['INSTRUCTOR_IMAGE_PATH']!= null ){ ?>
                            <?php $split = explode("/",$pengajar['INSTRUCTOR_IMAGE_PATH']);$imgfile = $split[count($split)-1];?>
                    
                    <?php } ?>
                </label>
                <div class="col-sm-4">
                    <div class="block">
                        <div class="thumbnail">
                            <a href="<?php echo base_url().$pengajar['INSTRUCTOR_IMAGE_PATH']; ?>" class="thumb-zoom lightbox" title="Slider Image">
                                <img src="<?php echo base_url().$pengajar['INSTRUCTOR_IMAGE_PATH']; ?>" >
                            </a>
                        </div>
                    </div>
                    
                    <input type="hidden" name="filessss" id="filessss" value="<?php echo $imgfile; ?>">
                </div>                
            </div>
            

			 <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Unggah CV:
                    <?php 
                    $filecv = "";
                    if($pengajar['INSTRUCTOR_CV_PATH']!="" and $pengajar['INSTRUCTOR_CV_PATH']!= null ){ ?>
                            <?php $split = explode("/",$pengajar['INSTRUCTOR_CV_PATH']);$filecv = $split[count($split)-1];?>
                    
                    <?php } ?>
                </label>
                <div class="col-sm-6">
                <input type="file" class="styled form-control" id="file_path" name="file_path" accept="application/msword, application/pdf">
                <span class="help-block">jenis file yang diijinkan doc & pdf</span>
                <input type="hidden" name="files" id="files" value="<?php echo $filecv; ?>">
                
                </div>
                <div class="col-sm-2 control-label">
                
                  <?php 
                    echo $download = $pengajar["INSTRUCTOR_CV_PATH"] != '' ? '<a href="'.base_url().$pengajar["INSTRUCTOR_CV_PATH"].'" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Download CV" download data-placement="top"><i class="icon-download"></i> Download CV </a>':'-';
                    ?>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/pengajar" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var name = $('#filessss').val();
        $('#uniform-gambar_path').find('.filename').html(name);
    })

    $(document).ready(function(){
        var name = $('#files').val();
        $('#uniform-gambar_path').find('.filename').html(name);
    })
</script>