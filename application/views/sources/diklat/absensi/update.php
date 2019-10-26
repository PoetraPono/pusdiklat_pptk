<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Edit Data Absensi</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Edit Data Absensi</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Diklat <span class="mandatory">*</span> : </label>
                <div class="col-sm-4">
                    <select id="add_accld" class="wajib select2" name="add_accld" data-placeholder="Pilih Nama Diklat">
                        <!--							<option></option>-->
                        <!--							--><?php //if(count($accList)>0){?>
                        <!--							--><?php //foreach ($accList as $acc) {?>
                        <!--							<option value="--><?php //echo $acc["access_id"];?><!--">--><?php //echo $acc["access_name"];?><!--</option>-->
                        <!--							--><?php //} ?>
                        <!--							--><?php //} ?>
                        <option value=""></option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                        <option value="1">Nama Diklat</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jadwal Dari<span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="datepicker form-control wajib" placeholder="Jadwal Dari">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Sampai <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                    <input type="text" class="datepicker form-control wajib" placeholder="Sampai">
                </div>
            </div>
            <div class="form-group">
                <label for="password_again" class="col-sm-2 control-label text-right">
                    Pengajar <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <select data-placeholder="Pilih Nama Pengajar" class="select-multiple wajib" multiple="multiple" tabindex="2">
                        <option value="1">Jajang Nurjaman</option>
                        <option value="2">Jajang Nurjaman</option>
                        <option value="3">Jajang Nurjaman</option>
                        <option value="4">Jajang Nurjaman</option>
                        <option value="5">Jajang Nurjaman</option>
                        <option value="6">Jajang Nurjaman</option>
                        <option value="7">Jajang Nurjaman</option>
                        <option value="8">Jajang Nurjaman</option>
                        <option value="9">Jajang Nurjaman</option>
                        <option value="10">Jajang Nurjaman</option>
                        <option value="11">Jajang Nurjaman</option>
                        <option value="12">Jajang Nurjaman</option>
                        <option value="13">Jajang Nurjaman</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/absensi" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
    </div>
	</div>
<script type="text/javascript">
    var $ = jQuery;
</script>