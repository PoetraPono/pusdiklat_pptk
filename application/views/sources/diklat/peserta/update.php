<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Ubah Data Peserta </li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Ubah Data Peserta</h6>
		
	</div>
	<div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul id="myTab" class="nav nav-tabs tab-bricky">
                        <li class="active">
                            <a href="#biodata" data-toggle="tab" data-id="1">
                                Biodata Peserta
                            </a>
                        </li>
                        <li>
                            <a href="#akun" data-toggle="tab" data-id="3">
                                Akun Peserta
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane in active" id="biodata">
                            <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">Nama Lengkap<span class="mandatory">*</span> : </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" id="MEMBER_NAME" name="MEMBER_NAME" placeholder="Nama Peserta" value="<?php echo $peserta['MEMBER_NAME'];?>">
                                        <input type="hidden" class="form-control wajib" id="MEMBER_ID" name="MEMBER_ID" placeholder="Nama Peserta" value="<?php echo $peserta['MEMBER_ID'];?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                       NIK  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" placeholder="NIK" id="MEMBER_NIK" name="MEMBER_NIK" value="<?php echo $peserta['MEMBER_NIK'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                       Nomor Induk Pegawai <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" placeholder="NIP" id="MEMBER_NIP" name="MEMBER_NIP" value="<?php echo $peserta['MEMBER_NIP'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                       Tempat Lahir  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" placeholder="Tempat Lahir" id="MEMBER_TEMPAT_LAHIR" name="MEMBER_TEMPAT_LAHIR" value="<?php echo $peserta['MEMBER_TEMPAT_LAHIR'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                       Tanggal Lahir  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="datepicker form-control wajib" placeholder="Tanggal Lahir" id="MEMBER_TGL_LAHIR" name="MEMBER_TGL_LAHIR" value="<?php echo ($peserta['MEMBER_TGL_LAHIR'] != "" ? date('m/d/Y', strtotime($peserta['MEMBER_TGL_LAHIR'])):"");?>">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Jenis Kelamin  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <select class="form-control wajib" placeholder="Jenis Kelamin" id="MEMBER_GENDER" name="MEMBER_GENDER" >
                                            <option value="" style="color: #aaa">- Pilih Jenis Kelamin -</option>
                                          <?php foreach($gender as $data) { ?>
                                            <?php $selected = $peserta['MEMBER_GENDER']==$data['GENDER_ID']?'selected':'';?>
                                            <option <?php echo $selected;?> value="<?php echo $data['GENDER_ID']; ?>"><?php echo $data['GENDER_NAME']; ?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Telepon  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" placeholder="Phone" id="MEMBER_PHONE" name="MEMBER_PHONE" value="<?php echo $peserta['MEMBER_PHONE'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Email <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control wajib" placeholder="e-mail" id="MEMBER_EMAIL" name="MEMBER_EMAIL" value="<?php echo $peserta['MEMBER_EMAIL'];?>">
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Instansi <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <select class="form-control wajib" placeholder="Instansi" id="MEMBER_INSTANSI_ID" name="MEMBER_INSTANSI_ID" >
                                            <option value="" style="color: #aaa">- Pilih Instansi -</option>
                                              <?php foreach($sector as $s) { ?>
                                                <optgroup label="<?php echo $s['INSTANSI_CATEGORY_NAME']; ?>">
                                                  <?php foreach($instansi as $data) { 
                                                    if($s['INSTANSI_CATEGORY_ID'] == $data['INSTANSI_CATEGORY']){?>
                                                    <?php $selected = $peserta['MEMBER_INSTANSI_ID']==$data['INSTANSI_ID']?'selected':'';?>
                                                <option <?php echo $selected;?> value="<?php echo $data['INSTANSI_ID']; ?>"><?php echo $data['INSTANSI_NAME']; ?></option>
                                                  <?php } } ?>
                                                </optgroup>
                                              <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Jabatan <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <select class="form-control wajib" placeholder="Jabatan" id="MEMBER_JABATAN_ID" name="MEMBER_JABATAN_ID" >
                                           <option value="" style="color: #aaa">- Pilih Jabatan -</option>
                                          <?php foreach($jabatan as $data) { ?>
                                            <?php $selected = $peserta['MEMBER_JABATAN_ID']==$data['JABATAN_ID']?'selected':'';?>
                                            <option <?php echo $selected;?> value="<?php echo $data['JABATAN_ID']; ?>"><?php echo $data['JABATAN_NAME']; ?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Alamat Kantor <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <textarea type="text" class="form-control wajib" placeholder="Alamat Kantor" id="MEMBER_ADDRESS" name="MEMBER_ADDRESS" ><?php echo $peserta['MEMBER_ADDRESS'];?> </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Provinsi <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                       <select class="form-control wajib" placeholder="Kabupaten" id="MEMBER_PROV_CODE" name="MEMBER_PROV_CODE" >
                                           <?php foreach($provinsi as $data) { ?>
                                            <?php $selected = $peserta['MEMBER_PROV_CODE']==$data['PROVINSI_CODE']?'selected':'';?>
                                            <option <?php echo $selected;?> value="<?php echo $data['PROVINSI_CODE']; ?>"><?php echo $data['PROVINSI_NAME']; ?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                        Kabupaten <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <select class="form-control wajib" placeholder="Kabupaten" id="MEMBER_KAB_CODE" name="MEMBER_KAB_CODE" >
                                             <?php foreach($kabupaten as $data) { ?>
                                                <?php $selected = $peserta['MEMBER_KAB_CODE']==$data['KABUPATEN_KODE']?'selected':'';?>
                                                <option <?php echo $selected;?> value="<?php echo $data['KABUPATEN_KODE']; ?>"><?php echo $data['KABUPATEN_NAME']; ?></option>
                                              <?php } ?>
                                        </select>
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
                            </form>
                        </div>
                        <div class="tab-pane" id="akun">
                           <div class="form-horizontal">
                               <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">Username<span class="mandatory">*</span> : </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control wajib" id="MEMBER_USERNAME" name="MEMBER_USERNAME" placeholder="Nama Peserta" value="<?php echo $peserta['MEMBER_USERNAME'];?>" disabled>
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="" class="col-sm-2 control-label text-right">
                                       Password  <span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control wajib" placeholder="NIK" id="MEMBER_PASSWORD" name="MEMBER_PASSWORD" value="<?php echo $peserta['MEMBER_PASSWORD'];?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-10">
                                        <!-- <a href="javascript:void(0)" onclick="doChangeUsername(<?php echo $peserta['MEMBER_ID'];?>)" class="btn btn-xs btn-info">Change Username</a> -->
                                        <a href="javascript:void(0)" onclick="doChange(<?php echo $peserta['MEMBER_ID'];?>)" class="btn btn-xs btn-success">Change Password</a>
                                        <a href="javascript:void(0)" onclick="doReset(<?php echo $peserta['MEMBER_ID'];?>)" class="btn btn-xs btn-warning">Reset Password</a>
                                        <a href="<?php echo base_url();?>diklat/peserta" class="btn btn-xs btn-primary">Kembali</a>
                                    </div>
                                </div>
                            </div>
                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
	</div>
</div>
 <div id="konfirmasireset" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h4 class="modal-title"><i class="icon-warning"></i> Konfirmasi</h4>
                </div>

                <div class="modal-body with-padding">
                    <p id="text_alert">Anda yakin akan me-reset password peserta ini ?</p>
                    <p id="text_alert">Password akan dikirimkan ke email peserta !</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-success" id="setujureset"> Yakin</button>
                    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
     <div id="konfirmasichange" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h4 class="modal-title"><i class="icon-warning"></i> Masukkan Password Baru</h4>
                </div>

                <div class="modal-body with-padding form-horizontal">
                     <div class="form-group">
                        <label for="" class="col-sm-4 control-label text-right">
                           Password Baru<span class="mandatory">*</span> :
                        </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control wajib" placeholder="input password baru" id="new_password" name="new_password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label text-right">
                           Konfirmasi Password<span class="mandatory">*</span> :
                        </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control wajib" placeholder="konfirmasi password baru" id="confirm_password" name="confirm_password" value="" >
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-success" id="setujuchange"> Yakin</button>
                    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div id="konfirmasichangeusername" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h4 class="modal-title"><i class="icon-warning"></i> Masukkan Username Baru</h4>
                </div>

                <div class="modal-body with-padding form-horizontal">
                     <div class="form-group">
                        <label for="" class="col-sm-4 control-label text-right">
                           Username Baru<span class="mandatory">*</span> :
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control wajib" placeholder="input username baru" id="new_username" name="new_username" onblur="cekUsername(this)" value="">
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-success" id="setujuchangeusername"> Yakin</button>
                    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $("#MEMBER_PROV_CODE").change(function(){
        getkota();
      })

  function getkota(){
        var code = $("#MEMBER_PROV_CODE").val();
        $.ajax({
            url : "<?php echo base_url('diklat/peserta/json_regencies');?>"+"/"+code,
            type: "GET",
            dataType: "html",
            success: function(data){
              
              if(data.length>1){
                $("#MEMBER_KAB_CODE").html("<option value=\"\">- Pilih Kota -</option>"+data);
              }else{
                $("#MEMBER_KAB_CODE").html("<option value=\"\">- Pilih provinsi dahulu -</option>"+data);
              }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
  }

  function doReset(id){
    $('#konfirmasireset').modal('show');
    $("#setujureset").prop("disabled", false);
    $("#setujureset").click(function() {
        $("#setujureset").prop("disabled", true);
        $.ajax({
            url : "<?php echo base_url('diklat/peserta/reset_password');?>"+"/"+id,
            type: "GET",
            dataType: "html",
            success: function(data){
              if(data == "ok"){
                $.jGrowl("Password berhasil di reset !", {
                  theme: "growl-success",
                  header: "Berhasil"
                });
              }else{
                $.jGrowl(data, {
                  theme: "growl-error",
                  header: "Gagal"
                });
              }
              $('#konfirmasireset').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
                $('#konfirmasireset').modal('hide');
            }
        });
    });
  }
  function doChange(id){
    $('#konfirmasichange').modal('show');
    $("#setujuchange").prop("disabled", false);
    $("#setujuchange").click(function() {
        $("#setujuchange").prop("disabled", true);
        password = $("#new_password").val();
        C_password = $("#confirm_password").val();
        if(password != C_password){
            $("#setujuchange").prop("disabled", false);
            alert("Konfirmasi password tidak cocok!");
            return false;
        }
        $.ajax({
            url : "<?php echo base_url('diklat/peserta/change_password');?>"+"/"+id+"/"+password,
            type: "GET",
            dataType: "html",
            success: function(data){
              if(data == "ok"){
                $("#new_password").val("");
                $("#confirm_password").val("");
                $.jGrowl("Password berhasil di ganti !", {
                  theme: "growl-success",
                  header: "Berhasil"
                });
              }else{
                $.jGrowl(data, {
                  theme: "growl-error",
                  header: "Gagal"
                });
              }
              $('#konfirmasichange').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
                $('#konfirmasichange').modal('hide');
            }
        });
    });
  }

  function doChangeUsername(id){
    $('#konfirmasichangeusername').modal('show');
    $("#setujuchangeusername").prop("disabled", false);
    $("#setujuchangeusername").click(function() {
        $("#setujuchangeusername").prop("disabled", true);
        var username = $("#new_username").val();
        $.ajax({
            url : "<?php echo base_url('diklat/peserta/change_username');?>"+"/"+id+"/"+username,
            type: "GET",
            dataType: "html",
            success: function(data){
              if(data == "ok"){
                $("#new_username").val("");
                $("#MEMBER_USERNAME").val(username);
                $.jGrowl("Username berhasil di ganti !", {
                  theme: "growl-success",
                  header: "Berhasil"
                });
              }else{
                $.jGrowl(data, {
                  theme: "growl-error",
                  header: "Gagal"
                });
              }
              $('#konfirmasichangeusername').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
                $('#konfirmasichangeusername').modal('hide');
            }
        });
    });
  }

  function cekUsername(ini){
    var val = $(ini).val();
     var username = $("#new_username").val();
        $.ajax({
            url : "<?php echo base_url('diklat/peserta/check_username');?>"+"/"+username,
            type: "GET",
            dataType: "html",
            success: function(data){
              if(data == "ok"){
                
              }else{
                $.jGrowl(data, {
                  theme: "growl-error",
                  header: "Gagal"
                });
                $("#new_username").focus();
              }
              
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
                //$('#konfirmasichangeusername').modal('hide');
            }
        });
  }
//       
</script>