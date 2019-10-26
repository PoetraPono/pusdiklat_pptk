<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url().'portal/lakip';?>'>Pusdiklat PPATK</a></li>
		<li class="active">Detail Data Informasi LAKIP</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Data Informasi LAKIP</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Judul: </label>
                <div class="col-sm-10 control-label">
                    <?php echo $LAKIP['LAKIP_TITLE']!=""?$LAKIP['LAKIP_TITLE']:'-'; ?>
                </div>
            </div>
			<div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tanggal: </label>
                <div class="col-sm-6">
                	<div class="row">
                		<div class="col-md-10 control-label">
			                <?php echo $LAKIP['LAKIP_DATE']!=""?dateEnToId(date('Y-m-d', strtotime($LAKIP['LAKIP_DATE'])),'d F Y'):'-'; ?>
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi:
                </label>
                <div class="col-sm-10 control-label">
					<?php echo $LAKIP['LAKIP_DESCRIPTION']!=""?$LAKIP['LAKIP_DESCRIPTION']:'-'; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Unggahan Berkas:
                </label>
                <div class="col-sm-10 control-label">
					<a target="_blank" href="<?php echo $LAKIP['LAKIP_FILE_PATH']!=""?base_url().$LAKIP['LAKIP_FILE_PATH']:'#'; ?>"><?php echo $LAKIP['LAKIP_FILE_PATH']!=""?basename($LAKIP['LAKIP_FILE_PATH']):'-'; ?>
			    	</a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <a href="<?php echo base_url();?>portal/lakip" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>