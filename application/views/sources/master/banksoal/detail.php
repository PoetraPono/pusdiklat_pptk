<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>master/banksoal'>Bank Soal</a></li>
        <li class="active">Master</li>
    </ul>
    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>
</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Master Bank Soal</h6>
	</div>

	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group" id="boxQuestioner">
				<label for="" class="col-sm-2 control-label text-right">
					Pertanyaan :
				</label>
				<div class="col-sm-10 control-label">
					<?php echo $soal['QUESTION_VALUE']!=""?$soal['QUESTION_VALUE']:"-"; ?>
				</div>
			</div>
			<div class="form-group" id="boxQuestioner">
				<label for="" class="col-sm-2 control-label text-right">
					Jawaban :
				</label>
				<div class="col-sm-10">
					<?php foreach ($jawaban as $key => $value) {
						$checked = $value['OPTION_ANSWER']!=""?"checked":"-";
						echo '<label class="radio" style="padding-left:10px;">
							<input type="radio" class="styled" '.$checked.' readonly>'.($value['OPTION_VALUE']!=""?$value['OPTION_VALUE']:"-").'</label>';
						}
					?>
				</div>
			</div>
			<hr/>
			<div class="form-group">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
					<a href="<?php echo base_url();?>master/banksoal" class="btn btn-xs btn-danger">Kembali</a>
				</div>
			</div>
		</form>
	</div>
</div>