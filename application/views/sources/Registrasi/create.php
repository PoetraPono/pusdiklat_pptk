<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Tambah Data</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal" action="#" role="form">
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 1:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 2:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 3:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="placeholder">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 4:</label>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-4">
							<input type="text" class="form-control">
							<span class="help-block">Info data 1</span>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control">
							<span class="help-block text-center">Info data 2</span>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control">
							<span class="help-block text-right">Info data 3</span>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 5:</label>
				<div class="col-sm-10">
					<textarea rows="5" cols="5" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-actions text-right">
				<input type="submit" value="Submit form" class="btn btn-primary">
			</div>

		</form>
	</div>
</div>