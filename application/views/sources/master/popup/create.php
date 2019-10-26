<style>
    .input-sm {
        height: 26px;
    }
    .select2-container .select{
    	width: 100%;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='@Url.Action("Index", "Home")'>SI Pusdiklat PPATKT</a></li>
        <li class="active"><a href="<?php echo base_url('master/popup') ?>">Popup</a></li>
        <li class="active">Master Popup</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<form id="mki_form" class="need_validation form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default mki-panel">
	<div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-quill2"></i>Master Popup</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group ">
				<label class="col-sm-2 control-label text-right">Unggah Gambar:</label>
				<div class="col-md-6">
					<input type="file" class="styled form-control required" id="gambar_path" name="gambar_path" placeholder="Gambar" accept="image/*">
                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
				</div>
			</div>

			
			<div class="form-group ">
				<label class="col-sm-2 control-label text-right">Deskripsi:</label>
				<div class="col-sm-6">
					<textarea rows="5" cols="5" class="form-control" name="POPUP_DESC" placeholder="Deskripsi"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Popup Show/Hide: </label>
				<div class="col-sm-6" >
					<label class="radio-inline">
						<input type="radio" name="POPUP_SHOW" class="styled"  value="1">
						Show
					</label>

					<label class="radio-inline">
						<input type="radio" name="POPUP_SHOW" class="styled" value="0">
						Hide
					</label>
					
				</div>
			</div>

		</div>
		
		<br>
		<hr>

		<div class="form-actions text-left">
			<div class="row">
			<div class="col-md-12">
			<label class="col-sm-3"></label>
			<div class="col-sm-9">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
				<button class="btn btn-default mki-btn-info" type="submit"><i class="icon-download2"></i> Simpan</button>
				<!-- <button class="btn btn-default mki-btn-yellow" type="reset"><i class="icon-spinner5"></i> Reset</button> -->
				<a class="btn btn-default mki-btn-danger" href="<?php echo base_url('master/popup');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>
