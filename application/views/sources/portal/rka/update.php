<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url().'portal/rka';?>'>Pusdiklat PPATK</a></li>
		<li class="active">Update Informasi RKA</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Update Informasi RKA</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Judul <span class="mandatory">*</span> : </label>
                <div class="col-sm-10">
                    <textarea rows="2" type="text" class="form-control wajib" placeholder="Judul Pengadaan" id="RKA_TITLE" name="RKA_TITLE"><?php echo $RKA['RKA_TITLE']; ?></textarea>
                </div>
            </div>
			<div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tanggal <span class="mandatory">*</span> : </label>
                <div class="col-sm-6">
                	<div class="row">
                		<div class="col-md-5">
			                <input class="form-control from-date wajib" type="text" placeholder="Tanggal Mulai" name="RKA_DATE" id="RKA_DATE" min="2000-01-01" value="<?php echo date('m/d/Y', strtotime($RKA['RKA_DATE'])); ?>">
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <textarea rows="20" type="text" class="form-control wajib ckeditor wajib" placeholder="Deskripsi" id="RKA_DESCRIPTION" name="RKA_DESCRIPTION"><?php echo $RKA['RKA_DESCRIPTION']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Unggah Berkas <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <input type="file" class="styled" id="RKA_FILE_PATH" name="RKA_FILE_PATH" accept="application/msword, application/pdf">
                    <span class="help-block">jenis file yang diijinkan doc & pdf</span>
					<input type="hidden" name="filess" id="filess" value="<?php echo $RKA['RKA_FILE_PATH']!=""?$RKA['RKA_FILE_PATH']:'No file selected'; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>portal/rka" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
	</div>
</div>
<script type="text/javascript">
	$('#RKA_DATE').datepicker('destroy').datepicker({
	    minDate: "-1Y",
	    maxDate: "+5Y",
	    showOtherMonths: true
	});
    $(document).ready(function(){
        var file_name = /[^/]*$/.exec($('#filess').val())[0];
        $('#uniform-RKA_FILE_PATH').find('.filename').html(file_name);
    });
</script>