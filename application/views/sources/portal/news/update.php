<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li><a href="<?php echo base_url("nocategories/news") ?>">News</a></li>
        <li class="active">Update News</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-pencil4"></i>Update News</h6>
        
    </div>
    <div class="panel-body">
        <form id="mki_form" class="form-horizontal validate" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Tanggal:
                </label>
                <div class="col-sm-3">
                    <input placeholder="Pilih Tanggal" class="form-control datepicker" type="text" name="upd_date" id="upd_date" min="2000-01-01" value="<?php echo date('m/d/Y',strtotime($news['NEWS_DATE'])); ?>">
                </div>
            </div>
           
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Judul:<span class="mandatory">*</span>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control required" placeholder="Judul News" name="upd_title" id="upd_title" value="<?php echo $news['NEWS_TITLE']; ?>">
                </div>
            </div>

             <!--  <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Penerbit:<span class="mandatory">*</span>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control required" name="upd_publisher" id="upd_publisher" value="<?php echo $news['NEWS_PUBLISHER']; ?>">
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Kategori:<span class="mandatory">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control input-sm wajib" name="category_id" id="category_id">
                        <option value="">-- Pilih --</option>
                        <?php 
                            foreach ($category as $k => $v) {
                                $select = ($v['CATEGORY_ID'] == $news['NEWS_CATEGORY_ID']) ? "selected" : "";
                                echo '<option value="'.$v['CATEGORY_ID'].'" '.$select.'>'.$v['CATEGORY_NAME'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Unggah Gambar:
                    <?php 
                    $imgfile = "";
                    if($news['NEWS_IMAGE_PATH']!="" and $news['NEWS_IMAGE_PATH']!= null ){ ?>
                            <?php $split = explode("/",$news['NEWS_IMAGE_PATH']);$imgfile = $split[count($split)-1];?>
                    
                    <?php } ?>
                </label>
                <div class="col-sm-8">
                <input type="file" class="styled form-control" id="gambar_path" name="gambar_path" placeholder="Gambar" value="" accept="image/*">
                <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
                <input type="hidden" name="filessss" id="filessss" value="<?php echo $imgfile; ?>">
                
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                   Konten:
                    </label>
                <div class="col-sm-10">
                    <textarea class="ckeditor" rows="12" id="upd_content" name="upd_content"><?php echo $news['NEWS_CONTENT']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">
                    Tags:
                </label>
                <div class="col-sm-10">
                    <input type="text" id="upd_tag" name="upd_tag" class="tags" value="<?php echo $news['NEWS_TAGS']; ?>" placeholder="Tags">
                </div>
            </div>
            <br><hr>
            <div class="form-actions text-left">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <input type="submit" value="Simpan Perubahan" class="btn btn-success">
                <a href="<?php echo base_url("portal/news") ?>" type="submit" class="btn btn-primary">Kembali</a>
            </div>

        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var name = $('#filessss').val();
        $('#uniform-gambar_path').find('.filename').html(name);
    })
</script>