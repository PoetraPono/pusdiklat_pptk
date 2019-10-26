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
        <li class="active"><a href="<?php echo base_url('portal/layanan') ?>">Detail Layanan</a></li>
        <li class="active">Ubah Baru</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<form id="mki_form" class="validate form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default mki-panel">
	<div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-quill2"></i>Daftar Layanan</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					Nama Layanan *
				</label>
				<div class="col-sm-4 control-label">
					<?php echo $layanan['SERVICE_NAME']?>
				</div>
			</div>
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					LINK *
				</label>
				<div class="col-sm-4 control-label">
					<?php echo $layanan['SERVICE_LINK']?>
				</div>
			</div>

			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					Deskripsi *
				</label>
				<div class="col-sm-5 control-label">
					<?php echo $layanan['SERVICE_DESC']?>
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
				<!-- <button class="btn btn-default mki-btn-info" type="submit"><i class="icon-download2"></i> Simpan</button> -->
				<!-- <button class="btn btn-default mki-btn-yellow" type="reset"><i class="icon-spinner5"></i> Reset</button> -->
				<a class="btn btn-default mki-btn-danger" href="<?php echo base_url('portal/layanan');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>
