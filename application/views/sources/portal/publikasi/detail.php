<style type="text/css">
    .newsstyle{overflow: hidden;}
</style>
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li><a href="<?php echo base_url("nocategories/news") ?>">Publikasi</a></li>
        <li class="active">Detail Publikasi</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-file6"></i>Detail Publikasi</h6>
        
    </div>
    <div class="panel-body">
        <form id="mki_form" class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                     Judul Publikasi:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $publikasi['PUBLIKASI_TITLE']; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Tipe Publikasi:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $types['TYPE_NAME']; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Gambar:
                </label>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block">
                        <div class="thumbnail">
                            <a href="<?php echo base_url().$publikasi['PUBLIKASI_FILE_PATH']; ?>" class="thumb-zoom lightbox" title="publikasi Image">
                                <img src="<?php echo base_url().$publikasi['PUBLIKASI_FILE_PATH']; ?>" >
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Isi Kontent:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $publikasi['PUBLIKASI_CONTENT']; ?>
                </div>
                <!-- <div class="col-sm-10">
                    <textarea class="ckeditor" id="upd_content" name="upd_content"></textarea>
                </div> -->
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Unggah Lampiran:</label>
                <?php if($publikasi['PUBLIKASI_FILE_LAMPIRAN'] != ""){ ?>
                <div class="col-sm-2 control-label">     
                      <a href="<?php echo base_url().$publikasi['PUBLIKASI_FILE_LAMPIRAN']; ?>" title="publikasi Image" download="<?php echo $publikasi['PUBLIKASI_FILE_LAMPIRAN']; ?>">download lampiran</a>
                </div>
                <?php } ?>
            </div>

            <br>
            <hr>
            <div class="form-actions text-left">
                <a href="<?php echo base_url("portal/publikasi") ?>" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
});
</script>