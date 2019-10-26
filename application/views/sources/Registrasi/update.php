<style>
	.input-sm {
		height: 26px;
	}
	.callout{
		margin:0 0 10px;
		padding:10px;
	}
	label{
		color: red;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Update Data</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Update Data</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal" action="#" role="form">
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 1:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" value="Data 1">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 2:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" value="Data 2">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 3:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="placeholder" value="Data 3">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 4:</label>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-4">
							<input type="text" class="form-control" value="Data">
							<span class="help-block">Info data 1</span>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="Data">
							<span class="help-block text-center">Info data 2</span>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="Data">
							<span class="help-block text-right">Info data 3</span>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Data 5:</label>
				<div class="col-sm-10">
					<textarea rows="5" cols="5" class="form-control">Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5 Data 5</textarea>
				</div>
			</div>

			<div class="form-actions text-right">
				<input type="submit" value="Submit form" class="btn btn-primary">
			</div>

		</form>
	</div>
</div>