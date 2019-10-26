<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Detail Data Tes Manual</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Data Tes Manual</h6>
	</div>
    <form id="mki_form" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <div class="panel-body">
            <div class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Kategori : </label>
                    <div class="col-sm-2 control-label text-left"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Nama Tes Manual : </label>
                    <div class="col-sm-2 control-label text-left"></div>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">file : </label>
                    <div class="col-sm-2 control-label text-left"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <a href="<?php echo base_url();?>tes/tes_manual/update" class="btn btn-xs btn-success">Edit Data</a>
                        <a href="<?php echo base_url();?>tes/tes_manual" class="btn btn-xs btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>