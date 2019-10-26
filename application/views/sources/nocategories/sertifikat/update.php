<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url();?>nocategories/sertifikat'>Sertifikat</a></li>
		<li class="active">Tambah Sertifikat</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Sertifikat</h6>
	</div>
	<form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
		<div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label text-right">Nama Pesert <span class="mandatory">*</span> : </label>
                    <div class="col-sm-4">
                        <select id="add_accld" class="wajib select2" name="add_accld" data-placeholder="Pilih Nama Peserta">
                            <option></option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                            <option value="1">Nama Peserta</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label text-right">Nama Diklat <span class="mandatory">*</span> : </label>
                    <div class="col-sm-4">
                        <select id="add_accld" class="wajib select2" name="add_accld" data-placeholder="Pilih Nama Diklat">
                            <option></option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                            <option value="1">Nama Diklat</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label text-right"">Pilih File: </label>
                    <div class="col-sm-10">
                        <input type="file" class="styled">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                        <a href="<?php echo base_url();?>nocategories/sertifikat" class="btn btn-xs btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
		</div>
	</form>
</div>
