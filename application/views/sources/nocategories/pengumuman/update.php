<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url();?>nocategories/pengumuman'>Pengumuman</a></li>
		<li class="active">Tambah Pengumuman</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Pengumuman</h6>
	</div>
	<form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
		<div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label text-right">Kategori <span class="mandatory">*</span> : </label>
                    <div class="col-sm-4">
                        <select id="add_accld" class="wajib select2" name="add_accld" data-placeholder="Pilih Kategori">
                            <option></option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                            <option value="1">Pilih Kategori</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="add_username" class="col-sm-2 control-label text-right">
                        Nama Pengumuman <span class="mandatory">*</span> :
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control wajib" placeholder="Pengumuman">
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
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                        <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                        <a href="<?php echo base_url();?>nocategories/pengumuman" class="btn btn-xs btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
		</div>
	</form>
</div>
