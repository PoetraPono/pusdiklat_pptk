<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url().'portal/ppid';?>'>Pusdiklat PPATK</a></li>
		<li class="active">Tambah Data Informasi PPID</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data Informasi PPID</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Judul <span class="mandatory">*</span> : </label>
                <div class="col-sm-10">
                    <textarea rows="2" type="text" class="form-control wajib" placeholder="Judul Pengadaan" id="PPID_TITLE" name="PPID_TITLE"></textarea>
                </div>
            </div>
			<div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tanggal <span class="mandatory">*</span> : </label>
                <div class="col-sm-6">
                	<div class="row">
                		<div class="col-md-5">
		                    <input class="form-control datepicker from-date wajib" type="text" placeholder="Tanggal" name="PPID_DATE" id="PPID_DATE" min="2000-01-01" value="">
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <textarea rows="20" type="text" class="form-control wajib ckeditor wajib" placeholder="Deskripsi" id="PPID_DESCRIPTION" name="PPID_DESCRIPTION"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Unggah Berkas <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <input type="file" class="styled wajib" id="PPID_FILE_PATH" name="PPID_FILE_PATH" accept="application/msword, application/pdf">
                    <span class="help-block">jenis file yang diijinkan doc & pdf</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>portal/ppid" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
	</div>
</div>
<script type="text/javascript">
	$('#PPID_DATE').datepicker('destroy').datepicker({
	    minDate: "-1Y",
	    maxDate: "+5Y",
	    showOtherMonths: true
	});
</script>