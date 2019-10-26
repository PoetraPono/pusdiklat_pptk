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
        <li class="active"><a href="<?php echo base_url('master/pidana') ?>">Tambah Master Sasaran Diklat</a></li>
        <li class="active">Tambah Baru</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<form id="mki_form" class="validate form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default mki-panel">
	<div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-quill2"></i>Daftar pidana</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					Bidang
				</label>
				<div class="col-sm-4">
					<select data-placeholder="Pilih Kategori" class="clear-results required" tabindex="4" name="TINDAK_PIDANA_SECTOR_ID" id="">
						<option value=""></option> 
						<?php foreach($bidang as $data) { ?>
							<option value="<?php echo $data['SECTOR_ID']; ?>"><?php echo $data['SECTOR_NAME']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					Sasaran Diklat *
				</label>
				<div class="col-sm-4">
					<input type="text" class="wajib form-control" id="" name="TINDAK_PIDANA_NAME" placeholder="Nama Sasaran Diklat">
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
				<a class="btn btn-default mki-btn-danger" href="<?php echo base_url('master/sasarandiklat');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>
