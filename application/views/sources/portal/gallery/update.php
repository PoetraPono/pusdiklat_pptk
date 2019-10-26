<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url();?>portal/gallery'>Gallery</a></li>
		<li class="active">Tambah Gallery</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Gellery</h6>
	</div>
	<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="gallery_name" class="col-sm-2 control-label text-right">
						Nama Gallery <span class="mandatory">*</span> :
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control wajib" id="GALLERIES_TITLE" name="GALLERIES_TITLE" placeholder="Gallery Name" value="<?php echo $getDetail['GALLERIES_TITLE']!=''?$getDetail['GALLERIES_TITLE']:''; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="gallery_date" class="col-sm-2 control-label text-right">
						Tanggal <span class="mandatory">*</span> :
					</label>
					<div class="col-sm-5">
						<input type="text" class="datepicker form-control wajib" id="GALLERIES_DATE" name="GALLERIES_DATE" placeholder="Gallery Date" min="2000-01-01" value="<?php echo date('m/d/Y',strtotime($getDetail['GALLERIES_DATE'])); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="gallery_name" class="col-sm-2 control-label text-right">
						Deskrpsi <span class="mandatory">*</span> :
					</label>
					<div class="col-sm-8">
						<textarea type="text" class="form-control wajib" id="GALLERIES_DESC" name="GALLERIES_DESC" placeholder="Deskripsi Gallery" ><?php echo $getDetail['GALLERIES_DESC']; ?></textarea> 
					</div>
				</div>
				<div class="form-group">
					<label for="add_phone" class="col-sm-2 control-label text-right">
						Gallery File Path :
					</label>
					<div class="col-sm-8">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Image</th>
									<th width="200px">Jenis</th>
									<th width="100px">Aksi</th>
								</tr>
							</thead>
							<tbody id="list_image">
							<?php
							$i = 0;
							foreach ($gallerydetail as $row){
								$idgallerydetail 		= $row["GALLERY_LIST_ID"];
								$gallerydetailgalleryid = $row["GALLERY_LIST_GALLERY_ID"];
								$gallerydetailtype	= $row["GALLERY_LIST_IMAGE_TYPE"];
								$gallerydetailfilepath 	= $row["GALLERY_LIST_IMAGE_PATH"];
							?>
							<tr class="list_image">
								<td colspan="2">
									<a href="<?php echo base_url().$gallerydetailfilepath; ?>" class="lightbox">
									<img src="<?php echo base_url().$gallerydetailfilepath; ?>" alt="" class="img-media">
									</a>
								</td>
								<!-- <td><select class="form-control" id="image_type_1" name="image_type[]">
									<option value="1">Photo Biasa</option>
									<option value="2">Photo 360&deg;</option>
									</select>
								</td> -->
								<td><a href="<?php echo base_url()."portal/gallery/deletelist/".$gallerydetailgalleryid."/".$idgallerydetail; ?>" class="btn btn-xs btn-default btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a></td>
							</tr>
							<?php } ?>
								<tr class="list_image">
									<td><input type='file' class="styled" name="gbr-image[]" id="gbr-image_1" accept="image/*"></td>
									<td><select class="form-control" id="image_type_1" name="image_type[]"><option value="1">Photo Biasa</option><option value="2">Photo 360&deg;</option></select></td>
									<td></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"><span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span></td>
									<td ><a href="javascript:void(0);" class="btn btn-xs btn-success btn-icon tip" id="plus_imgae" onclick="plusimage()"><i class="icon-plus"></i> Tambah &nbsp;</a></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
					</div>
					<div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
						<button type="submit" class="btn btn-xs btn-primary">Simpan</button>
						<a href="<?php echo base_url();?>portal/gallery" class="btn btn-xs btn-danger">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">

function plusimage(){
	
	var no = $(".list_image").length;
	var data = '<tr class="list_image" id="image_'+(no+1)+'">'+
									'<td><input type="file" class="styled" name="gbr-image[]" id="gbr-image_'+(no+1)+'" accept="image/*"></td>'+
									'<td><select class="form-control" id="image_type_1" name="image_type[]"><option value="1">Photo Biasa</option><option value="2">Photo 360&deg;</option></select></td>'+
									'<td style="text-align:center"><a href="javascript:void(0)" onclick="deleterows('+(no+1)+')" class="btn btn-xs btn-default btn-icon tip"><i class="icon-close"></i></a></td>'+
								'</tr>';
		$("#list_image").append(data);
		$(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
}

function deleterows(ini){
	$("#image_"+ini).remove();
}

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
				alert("Ukuran File Terlalu Besar");
			}else {
				reader.onload = function (e) {
					$('#gambar').attr('src', e.target.result);
				}
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

</script>