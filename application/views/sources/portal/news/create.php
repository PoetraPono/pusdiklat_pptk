<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li><a href="<?php echo base_url("portal/news") ?>">News</a></li>
        <li class="active">Tambah News</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Tambah News</h6>
        
    </div>
    <div class="panel-body">
        <form id="mki_form" class="form-horizontal validate" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Tanggal:</label>
                <div class="col-sm-3">
                    <input class="form-control datepicker from-date" type="text" placeholder="Pilih Tanggal" name="new_date" id="new_date" min="2000-01-01" value="<?php echo date("m/d/Y") ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Judul:<span class="mandatory">*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control wajib" placeholder="Judul News" name="new_title" id="new_title">
                </div>
            </div>
<!-- 
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Penerbit:<span class="mandatory">*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control required" placeholder="Judul News" name="new_publisher" id="new_publisher">
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Kategori:<span class="mandatory">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control input-sm wajib" name="category_id" id="category_id">
                        <option value="">-- Pilih --</option>
                        <?php 
                            foreach ($category as $k => $v) {
                                echo '<option value="'.$v['CATEGORY_ID'].'">'.$v['CATEGORY_NAME'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Unggah Gambar:</label>
                <div class="col-sm-6">
                    <input type="file" class="styled form-control" id="gambar_path" name="gambar_path" placeholder="Unggah Gambar" accept="image/*">
                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Isi News:</label>
                <div class="col-sm-10">
                    <textarea class="ckeditor" rows="12" id="new_content" name="new_content"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Tags:</label>
                <div class="col-sm-10">
                    <input type="text" id="new_tag" name="new_tag" class="tags" value="" placeholder="Tags">
                </div>
            </div>
            <br><hr>
            <div class="form-actions text-left">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <input type="submit" value="Simpan News" class="btn btn-success">
                <a href="<?php echo base_url("portal/news") ?>" type="submit" value="Simpan Himbauan" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
</script>