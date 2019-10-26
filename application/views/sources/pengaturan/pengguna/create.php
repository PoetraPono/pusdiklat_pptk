<style>
	.input-sm {
		height: 26px;
	}
</style>
<link href="<?php echo base_url();?>assets/js/plugins/strength-password/jquery.pwstrength.css" rel="stylesheet" type="text/css">
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url();?>pengaturan/pengguna'>Pengaturan Pengguna</a></li>
		<li class="active">Tambah Pengguna</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Pengguna</h6>
	</div>
	<form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label text-right">Hak Akses <span class="mandatory">*</span> : </label>
					<div class="col-sm-4">
						<select id="add_accld" class="wajib select2" name="add_accld" data-placeholder="Pilih Hak Akses">
							<option></option>
							<?php if(count($accList)>0){?>
							<?php foreach ($accList as $acc) {?>
							<option value="<?php echo $acc["ACCESS_ID"];?>"><?php echo $acc["ACCESS_NAME"];?></option>
							<?php } ?>
							<?php } ?>
						</select> 
					</div>
				</div>
				<div class="form-group">
					<label for="add_username" class="col-sm-2 control-label text-right">
						Username <span class="mandatory">*</span> : 
					</label>
					<div class="col-sm-10">
						<input type="text" class="form-control input-sm wajib" id="add_username" name="add_username" placeholder="username">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label text-right">
						Password <span class="mandatory">*</span> : 
					</label>
					<div class="col-sm-10">
						<input type="password" class="form-control input-sm" data-indicator="pwindicator" id="password" name="password" placeholder="password">
						<span id="pwindicator">
		                    <div class="label" id="status_password"></div>
		                </span>
					</div>

				</div>
				<div class="form-group">
					<label for="password_again" class="col-sm-2 control-label text-right">
						Re-password <span class="mandatory">*</span> : 
					</label>
					<div class="col-sm-10">
						<input type="password" class="form-control input-sm wajib" id="password_again" name="password_again" placeholder="ketik ulang password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
					</div>
					<div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
						<button type="button" class="btn btn-success" onclick="validations()">Simpan</button>
						<a href="<?php echo base_url();?>pengaturan/pengguna" class="btn btn-primary">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="<?php echo base_url();?>assets/js/plugins/strength-password/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  	$(document).ready(function(){
    	$('#password').pwstrength();
	});
  	function validations(){
  		var status = $('#status_password').html()
  		if (status=='lemah' || status=='sangat lemah' || status=='') {
  		}else{
  			$('#mki_form').submit();
  		}
  	}
</script>