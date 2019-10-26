<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='@Url.Action("Index", "Home")'>SI PUSDIKLAT PPATK</a></li>
        <li class="active"><a href="<?php echo base_url('master/ruangan') ?>">Master Ruangan</a></li>
        <li class="active">Ubah Ruangan</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>
</div>

<form id="mki_form" class="form-horizontal need_validation" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default">
	<div class="panel-heading">
        <h6 class="panel-title"><i class="icon-pencil4"></i>Ubah Ruangan</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					Nama Ruangan <span class="mandatory">*</span>
				</label>
				<div class="col-sm-4">
					<input type="text" class="wajib form-control" id="update_name" name="update_name" placeholder="Code" value="<?php echo $room['ROOM_NAME']!=''?$room['ROOM_NAME']:''; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					Nama Gedung <span class="mandatory">*</span>
				</label>
				<div class="col-sm-8">
					<input type="text" class="wajib form-control" id="update_building" name="update_building" placeholder="Nama Gedung" value="<?php echo $room['ROOM_BUILDING']!=''?$room['ROOM_BUILDING']:''; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					 Kapasitas Ruangan <span class="mandatory">*</span>
				</label>
				<div class="col-sm-8">
					<input type="number" class="wajib form-control" id="update_capacity" name="update_capacity" placeholder="Kapasitas Ruangan" value="<?php echo $room['ROOM_CAPACITY']!=''? $room['ROOM_CAPACITY']:''; ?>">
				</div>
			</div>
		</div>
		<br>
		<hr>
		<div class="form-actions text-left">
			<div class="row">
			<div class="col-md-12">
			<label class="col-sm-3"></label>
			<div class="col-sm-9">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
				<button class="btn btn-default mki-btn-info" type="submit"><i class="icon-download2"></i> Simpan</button>
				<button class="btn btn-default mki-btn-yellow" type="reset"><i class="icon-spinner5"></i> Reset</button>
				<a class="btn btn-default mki-btn-danger" href="<?php echo base_url('master/ruangan');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>