<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Edit Data Tes Manual</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Edit Data Tes Manual</h6>
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
                        Nama Tes Manual <span class="mandatory">*</span> :
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control wajib" placeholder="Tes Manual">
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
                        <a href="<?php echo base_url();?>tes/tes_manual" class="btn btn-xs btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>