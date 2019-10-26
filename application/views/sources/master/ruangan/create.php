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
        <li><a href='@Url.Action("Index", "Home")'>SI PUSDIKLAT</a></li>
        <li class="active"><a href="<?php echo base_url('master/ruangan') ?>">Tambah Master Ruangan</a></li>
        <li class="active">Tambah Baru</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<form id="mki_form" class="validate form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default mki-panel">
	<div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-quill2"></i>Data Jenis Ruangan</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					* Nama Ruangan
				</label>
				<div class="col-sm-4">
					<input type="text" class="wajib form-control" id="add_name" name="add_name" placeholder="Nama Ruangan">
				</div>
			</div>

			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					* Kapasitas Ruangan
				</label>
				<div class="col-sm-5">
					<input type="text" class="wajib form-control" id="add_capacity" name="add_capacity" placeholder="Jumlah Kapasitas Ruangan">
				</div>
			</div>

			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label mandatory" style="text-align: right">
					* Nama Gedung
				</label>
				<div class="col-sm-5">
					<input type="text" class="wajib form-control" id="add_building" name="add_building" placeholder="Nama Gedung">
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
				<button class="btn btn-default mki-btn-yellow" type="reset"><i class="icon-spinner5"></i> Reset</button>
				<a class="btn btn-default mki-btn-danger" href="<?php echo base_url('master/ruangan');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>
