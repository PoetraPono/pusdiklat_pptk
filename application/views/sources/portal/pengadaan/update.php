<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url().'portal/pengadaan';?>'>Pusdiklat PPATK</a></li>
		<li class="active">Update Data Pengadaan Barang dan Jasa</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Update Data Pengadaan Barang dan Jasa</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Judul <span class="mandatory">*</span> : </label>
                <div class="col-sm-10">
                    <textarea rows="2" type="text" class="form-control wajib" placeholder="Judul Pengadaan" id="ANNOUN_TITLE" name="ANNOUN_TITLE"><?php echo $ANNOUN['ANNOUN_TITLE']; ?></textarea>
                </div>
            </div>
			<div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tanggal <span class="mandatory">*</span> : </label>
                <div class="col-sm-6">
                	<div class="row">
                		<div class="col-md-5">
			                <input class="form-control from-date wajib" type="text" placeholder="Tanggal Mulai" name="ANNOUN_DATE_START" id="ANNOUN_DATE_START" min="2000-01-01" value="<?php echo date('m/d/Y', strtotime($ANNOUN['ANNOUN_DATE_START'])); ?>">
                		</div>
                		<div class="col-md-1 text-center control-label">s/d</div>
                		<div class="col-md-5">
		                    <input class="form-control datepicker from-date wajib" type="text" placeholder="Tanggal Selesai" name="ANNOUN_DATE_END" id="ANNOUN_DATE_END" min="2000-01-01" value="<?php echo date('m/d/Y', strtotime($ANNOUN['ANNOUN_DATE_END'])); ?>">
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <textarea rows="20" type="text" class="form-control wajib ckeditor wajib" placeholder="Deskripsi" id="ANNOUN_DESCRIPTION" name="ANNOUN_DESCRIPTION"><?php echo $ANNOUN['ANNOUN_DESCRIPTION']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Unggah Gambar <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <input type="file" class="styled" id="ANNOUN_IMG_PATH" name="ANNOUN_IMG_PATH" accept="image/x-png,image/gif,image/jpeg">
                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
					<input type="hidden" name="filess" id="filess" value="<?php echo $ANNOUN['ANNOUN_IMG_PATH']!=""?$ANNOUN['ANNOUN_IMG_PATH']:'No file selected'; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>portal/pengadaan" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
	</div>
</div>
<script type="text/javascript">
	$('#ANNOUN_DATE_END').datepicker('destroy').datepicker({
	    minDate: "<?php echo ($ANNOUN['ANNOUN_DATE_START']!=''?date('m/d/Y', strtotime($ANNOUN['ANNOUN_DATE_START'])):'-1Y'); ?>",
	    maxDate: "+5Y",
	    showOtherMonths: true
	});
	$('#ANNOUN_DATE_START').datepicker('destroy').datepicker({
	    minDate: "-1Y",
	    maxDate: "<?php echo ($ANNOUN['ANNOUN_DATE_END']!=''?date('m/d/Y', strtotime($ANNOUN['ANNOUN_DATE_END'])):'5Y'); ?>",
	    showOtherMonths: true
	});

	$('#ANNOUN_DATE_END').change(function(){
		$('#ANNOUN_DATE_START').datepicker('destroy').datepicker({
		    minDate: "-1Y",
		    maxDate: $('#ANNOUN_DATE_END').val(),
		    showOtherMonths: true,
		});
	});
	$('#ANNOUN_DATE_START').change(function(){
		$('#ANNOUN_DATE_END').datepicker('destroy').datepicker({
			minDate: $('#ANNOUN_DATE_START').val(),
		    maxDate: "+5Y",
		    showOtherMonths: true,
		});
	});
	$(document).ready(function(){
		var file_name = /[^/]*$/.exec($('#filess').val())[0];
		$('#uniform-ANNOUN_IMG_PATH').find('.filename').html(file_name);
	});
</script>