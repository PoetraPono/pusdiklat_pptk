<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Edit Data Materi</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Edit Data Materi</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Nama Materi <span class="mandatory">*</span> : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control wajib" id="add_accname" name="add_accname" value="">
				</div>
			</div>
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/materi" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

</script>