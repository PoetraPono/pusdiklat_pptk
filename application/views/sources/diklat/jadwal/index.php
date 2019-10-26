<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Data Jadwal</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Jadwal</h6>
<!--		<a class="pull-right btn btn-xs btn-primary" href='--><?php //echo base_url();?><!--pengaturan/hak_akses/create'>Tambah Data</a>-->
	</div>
	<div class="panel-body">
        <div class="fullcalendar"></div>
	</div>
</div>

<script type="text/javascript">
//	$(document).ready(function() {
//		$('#table_1').dataTable( {
//			"processing": true,
//			"serverSide": true,
//			"bServerSide": true,
//			"sAjaxSource": baseurl+"pengaturan/hak_akses/listdataaktif",
//			"aaSorting": [[0, "desc"]],
//			"aoColumns": [
//			{ "bSortable": false, "sClass": "text-center" },
//			{ "sClass": "text-left" },
//			{ "sClass": "text-center" },
//			{ "sClass": "text-center" },
//			{ "sClass": "text-center" },
//			{ "bSortable": false, "sClass": "text-center" }
//			],
//			"fnDrawCallback": function () {
//				set_default_datatable();
//			},
//		});
//		$('#table_2').dataTable( {
//			"processing": true,
//			"serverSide": true,
//			"bServerSide": true,
//			"sAjaxSource": baseurl+"pengaturan/hak_akses/listdatanonaktif",
//			"aaSorting": [[0, "desc"]],
//			"aoColumns": [
//			{ "bSortable": false, "sClass": "text-center" },
//			{ "sClass": "text-left" },
//			{ "sClass": "text-center" },
//			{ "sClass": "text-center" },
//			{ "sClass": "text-center" },
//			{ "bSortable": false, "sClass": "text-center" }
//			],
//			"fnDrawCallback": function () {
//				set_default_datatable();
//			},
//		});
//	});
</script>