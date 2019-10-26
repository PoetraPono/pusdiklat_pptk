<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Data Silabus</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Silabus</h6>
		<a class="pull-right btn btn-xs btn-primary" href='<?php echo base_url();?>diklat/Silabus/create'>Tambah Data</a>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="tabbable">
					<ul id="myTab" class="nav nav-tabs tab-bricky">
						<li class="active">
							<a href="#aktif" data-toggle="tab" data-id="1">
								Silabus Aktif
							</a>
						</li>
						<li>
							<a href="#nonaktif" data-toggle="tab" data-id="2">
								Silabus Nonaktif
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane in active" id="aktif">
							<div class="datatable">
								<table class="table table-striped table-bordered" id="table_1">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Nama Silabus</th>
											<th class="text-center">Status</th>
											<th class="text-center" style="min-width:90px;width:90px">Aksi</th>
										</tr>
									</thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/update" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Edit" data-placement="top"><i class="icon-pencil"></i></a>
                                            <a href="<?php base_url()?>Silabus/delete" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top"><i class="icon-close"></i></a></td>
                                    </tr>
                                    </tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="nonaktif">
							<div class="datatable">
								<table class="table table-striped table-bordered table-hover" id="table_2">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Nama Silabus</th>
											<th class="text-center">Status</th>
											<th class="text-center" style="min-width:90px;width:90px">Aksi</th>
										</tr>
									</thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Mark</td>
                                        <td>Aktif</td>
                                        <td><a href="<?php base_url()?>Silabus/detail/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Lihat" data-placement="top"><i class="icon-file6"></i></a>
                                            <a href="<?php base_url()?>Silabus/aktif/" role="button" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark3"></i></a></td>
                                    </tr>
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>