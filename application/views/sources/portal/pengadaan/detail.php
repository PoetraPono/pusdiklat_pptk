<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url().'portal/pengadan';?>'>Pusdiklat PPATK</a></li>
		<li class="active">Detail Data Pengadaan Barang dan Jasa</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Data Pengadaan Barang dan Jasa</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Judul: </label>
                <div class="col-sm-10 control-label">
                    <?php echo $ANNOUN['ANNOUN_TITLE']!=""?$ANNOUN['ANNOUN_TITLE']:'-'; ?>
                </div>
            </div>
			<div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Tanggal: </label>
                <div class="col-sm-6">
                	<div class="row">
                		<div class="col-md-10 control-label">
			                <?php echo $ANNOUN['ANNOUN_DATE_START']!=""?dateEnToId(date('Y-m-d', strtotime($ANNOUN['ANNOUN_DATE_START'])),'d F Y'):'-'; ?>
			                &nbsp;s/d&nbsp;
                			<?php echo $ANNOUN['ANNOUN_DATE_END']!=""?dateEnToId(date('Y-m-d', strtotime($ANNOUN['ANNOUN_DATE_END'])),'d F Y'):'-'; ?>
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Deskripsi:
                </label>
                <div class="col-sm-10 control-label">
					<?php echo $ANNOUN['ANNOUN_DESCRIPTION']!=""?$ANNOUN['ANNOUN_DESCRIPTION']:'-'; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Unggah Gambar:
                </label>
                <div class="col-sm-4">
					<div class="block">
				    	<div class="thumbnail">
							<a href="<?php echo $ANNOUN['ANNOUN_IMG_PATH']!=""?base_url().$ANNOUN['ANNOUN_IMG_PATH']:'#'; ?>" class="thumb-zoom lightbox" title="<?php echo $ANNOUN['ANNOUN_TITLE']!=""?$ANNOUN['ANNOUN_TITLE']:'-'; ?>">
						    	<img src="<?php echo $ANNOUN['ANNOUN_IMG_PATH']!=""?base_url().$ANNOUN['ANNOUN_IMG_PATH']:'#'; ?>">
					    	</a>
				    	</div>
					</div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <a href="<?php echo base_url();?>portal/pengadaan" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>