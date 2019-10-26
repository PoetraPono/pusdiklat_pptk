<style type="text/css">
    .newsstyle{overflow: hidden;}
</style>
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li><a href="<?php echo base_url("nocategories/news") ?>">Berita</a></li>
        <li class="active">Detail Berita</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-file6"></i>Detail Berita</h6>
        
    </div>
    <div class="panel-body">
        <form id="mki_form" class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Tanggal:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo date('d M Y',strtotime($news['NEWS_DATE'])); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Judul:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $news['NEWS_TITLE']; ?>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Kategori:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $news['CATEGORY_NAME']; ?>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Gambar:
                </label>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block">
                        <div class="thumbnail">
                            <a href="<?php echo base_url().$news['NEWS_IMAGE_PATH']; ?>" class="thumb-zoom lightbox" title="news Image">
                                <img src="<?php echo base_url().$news['NEWS_IMAGE_PATH']; ?>">
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
                    <?php echo $news['NEWS_CONTENT']; ?>
                </div>
                <!-- <div class="col-sm-10">
                    <textarea class="ckeditor" id="upd_content" name="upd_content"></textarea>
                </div> -->
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Tag:
                </label>
                <div class="col-sm-10 control-label text-left">
                    <?php echo $news['NEWS_TAGS']; ?>
                </div>
            </div>
            <br>
            <hr>
            <div class="form-actions text-left">
                <a href="<?php echo base_url("portal/news") ?>" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
});
</script>