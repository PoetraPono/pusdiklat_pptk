<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Tambah Data Diklat</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data Diklat</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Peserta <span class="mandatory">*</span> : </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" id="MEMBER_NAME" name="MEMBER_NAME" placeholder="Nama Peserta" >
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Username <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" placeholder="Username" id="MEMBER_USERNAME" name="MEMBER_USERNAME">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Password  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" placeholder="Password" id="MEMBER_PASSWORD" name="MEMBER_PASSWORD">
                </div>
            </div>

             <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                   Nik  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" placeholder="Nik" id="MEMBER_NIK" name="MEMBER_NIK">
                </div>
            </div>

          
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    E Mail  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" placeholder="e-mail" id="MEMBER_EMAIL" name="MEMBER_EMAIL">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Handphone  <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control wajib" placeholder="Phone" id="MEMBER_PHONE" name="MEMBER_PHONE">
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                            <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/peserta" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
    $('#nama_materi').change(function(){

        var value = $('#nama_materi').val();
        //$('#panel').empty();
        $('.positions').each(function() {
            if($.inArray($(this).attr('rel'), value)) {
                $(this).remove();
            }
        });

//       
</script>