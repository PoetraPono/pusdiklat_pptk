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
                    <input type="text" class="form-control wajib" id="INSTRUCTOR_NAME" name="INSTRUCTOR_NAME" placeholder="Nama Pengajar"  >
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Gelar Depan :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Title" id="INSTRUCTOR_FIRST_TITLE" name="INSTRUCTOR_FIRST_TITLE">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Gelar Belakang :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder=" Last Title" id="INSTRUCTOR_LAST_TITLE" name="INSTRUCTOR_LAST_TITLE">
                </div>
            </div>

             <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    E mail :
                </label>
                <div class="col-sm-4">
                	 <input type="text" class="form-control" placeholder=" Last Title" id="INSTRUCTOR_EMAIL" name="INSTRUCTOR_EMAIL">
                </div>
            </div>        


            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Alamat <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                	<textarea type="text" rows="3" class="form-control" placeholder="Alamat" id="INSTRUCTOR_ADDRESS" name="INSTRUCTOR_ADDRESS"></textarea>
                </div>
            </div>        

            <div class="form-group">
				<label for="add_phone" class="col-sm-2 control-label text-right">
					Foto :
					</label>
					<div class="col-sm-3">
						<div class="thumbnail thumbnail-boxed">
							<div class="thumb">
								<img alt="" src="<?php echo base_url();?>assets/images/photodefault.png" id="gambar">
									<input type='file' class="styled" name="gambar_path" value="foto_profil.png" accept="image/*"  onchange="readURL(this);"/>
							</div>
						</div>
						<span class="help-block">jenis file yang diijinkan png,jpg & jpeg</span>
					</div>
			</div>

			 <div class="form-group">
                <label class="col-sm-2 control-label text-right"">File CV: </label>
                <div class="col-sm-8">
                    <input type="file" class="styled" name="file_path" id="file_path" accept="application/msword, application/pdf">
                    <span class="help-block">jenis file yang diijinkan doc & pdf</span>
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


	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			var cupu = input.files[0].size;
			if(cupu > 2048000){
				alert("File Terlalu Besar");
			}else {
				reader.onload = function (e) {
					$('#gambar').attr('src', e.target.result);
				}
			}

			reader.readAsDataURL(input.files[0]);
		}
	}


</script>