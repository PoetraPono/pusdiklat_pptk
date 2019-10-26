    <div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li><a href="<?php echo base_url("portal/publikasi") ?>">Publikasi</a></li>
        <li class="active">Tambah Publikasi</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Tambah Publikasi</h6>
        
    </div>
    <div class="panel-body">
        <form id="mki_form" class="form-horizontal validate" method="post" enctype="multipart/form-data" novalidate="novalidate">

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Judul Publikasi:<span class="mandatory">*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control required" placeholder="Judul Publikasi" name="PUBLIKASI_TITLE" id="PUBLIKASI_TITLE" value="<?php echo $publikasi['PUBLIKASI_TITLE'];?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Tipe Publikasi:</label>
                <div class="col-sm-10">
                    <select data-placeholder="Pilih Type Publikasi" class="clear-results" tabindex="2" name="PUBLIKASI_TYPE" id="PUBLIKASI_TYPE">
                        <option value=""></option> 
                        <?php foreach($types as $type) { 
                            $select = ($type["TYPE_ID"] == $publikasi['PUBLIKASI_TYPE'] ? "selected" :"");
                            ?>
                            <option value="<?php echo $type['TYPE_ID']; ?>" <?php echo $select; ?>><?php echo $type['TYPE_NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Unggah Gambar:</label>
                <div class="col-sm-6">
                    <div class="block">
                        <div class="thumbnail">
                            <a href="<?php echo base_url().$publikasi['PUBLIKASI_FILE_PATH']; ?>" class="thumb-zoom lightbox" title="publikasi Image">
                                <img src="<?php echo base_url().$publikasi['PUBLIKASI_FILE_PATH']; ?>" >
                            </a>
                        </div>
                    </div>
                    <input type="file" class="styled form-control" id="gambar_path" name="gambar_path" placeholder="Unggah Gambar"  accept="image/*">
                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Konten:</label>
                <div class="col-sm-10">
                    <textarea class="ckeditor" rows="12" id="PUBLIKASI_CONTENT" name="PUBLIKASI_CONTENT" ><?php echo $publikasi['PUBLIKASI_CONTENT']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">Unggah Lampiran:</label>
                <div class="col-sm-4">
                    <input type="file" class="styled form-control" id="file_path" name="file_path" placeholder="Unggah Lampiran" accept=".doc,.docx,.pdf">
                    <span class="help-block">jenis file yang diijinkan doc & pdf</span>
                </div>
                <?php if($publikasi['PUBLIKASI_FILE_LAMPIRAN'] != ""){ ?>
                <div class="col-sm-2 control-label">     
                      <a href="<?php echo base_url().$publikasi['PUBLIKASI_FILE_LAMPIRAN']; ?>" title="publikasi Image" download="<?php echo $publikasi['PUBLIKASI_FILE_LAMPIRAN']; ?>">download lampiran</a>
                </div>
                <?php } ?>
            </div>
          

            <br><hr>
            <div class="form-actions text-left">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <input type="submit" value="Simpan" class="btn btn-success">
                <a href="<?php echo base_url("portal/publikasi") ?>" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
</script>