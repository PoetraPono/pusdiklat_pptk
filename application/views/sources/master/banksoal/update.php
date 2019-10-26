<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>master/banksoal'>Testing & Kuisioner</a></li>
        <li class="active">Pengaturan</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Pengaturan Testing & Kuisioner</h6>
	</div>

	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group" id="boxQuestioner">
				<label for="" class="col-sm-2 control-label text-right">
					Pertanyaan :
				</label>
				<div class="col-sm-10">
					<table style="width:100%;" class="table table-hover" id="boxQuestions">
						<tr class="boxQuestionList" style="border-bottom:1px solid #cccccc;padding-top:10px;">
							<td width="*" style="padding-top:8px;">
								<textarea rows="2" class="form-control addFieldQuestion" name="addQuestion" placeholder="Pertanyaan..." sty="margin-bottom:6px;"><?php echo $soal['QUESTION_VALUE']!=""?$soal['QUESTION_VALUE']:"-"; ?></textarea>
								<table class="col-md-12" style="margin-top: 6px;">
									<tbody>
										<?php foreach ($jawaban as $key => $value) { ?>
											<?php $checked = $value['OPTION_ANSWER']!=""?"checked":"-"; ?>
											<tr class="jwbn">
												<td width="56px" class="" style="vertical-align:top;">
													<a onClick="delOption(this);" role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a>
													<label class="radio-inline" style="padding-left:10px;">
														<input type="radio" class="styled addAnswer" name="addAnswer" onChange="setAnswer(this);" <?php echo $checked ?>>
													</label>
												</td>
												<td width="*" style="padding-bottom:6px;">
													<input type="text" class="form-control fieldOption" name="addOption[]" placeholder="Jawaban.." value="<?php echo $value['OPTION_VALUE']!=""?$value['OPTION_VALUE']:""; ?>">
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<table class="col-md-10">
									<tr>
										<td colspan="2" class="" style="vertical-align:top;margin-bottom:10px;padding-top:8px;padding-bottom:10px;">
											<a onClick="addOption(this);" role="button" class="btn btn-xs btn-warning btn-icon tip addOptiondata-original-title="Tambah Pilihan" data-placement="top" style="padding-left:4px;padding-right:8px;"><i class="icon-plus"></i> &nbsp; <small>Tambah Pilihan</small></a>
											<input type="hidden" id="addAnswer" name="addAnswer">
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table style="width:100%;" class="table table-hover">
						<tr>
							<td colspan="2" style="vertical-align:top;margin-bottom:10px;padding-top:8px;"></td>
						</tr>
					</table>
				</div>
			</div>
			<hr />
			<div class="form-group">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-9">
					<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
					<button type="submit" class="btn btn-xs btn-success">Simpan</button>
					<a href="<?php echo base_url();?>master/banksoal" class="btn btn-xs btn-danger">Kembali</a>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="delConfirm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header btn-info">
				<h4 class="modal-title"><i class="icon-warning"></i> Konfirmasi</h4>
			</div>

			<div class="modal-body with-padding">
				<p class="text_alert">Anda yakin data ini?</p>
			</div>

			<div class="modal-footer">
				<a type="button" class="btn btn-xs btn-primary" id="btnConfirm" onClick="doDelQuestion();"> Yakin</a>
				<button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var question_this;
	var option_this;
	$(document).ready(function() {
		$( ".from-date-new" ).datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			showOtherMonths: true,
			onClose: function( selectedDate ) {
				$( ".to-date-new" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( ".to-date-new" ).datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			showOtherMonths: true,
			onClose: function( selectedDate ) {
				$( ".from-date-new" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});

	function setAnswer() {
		var ans = 0;
		var i = 0;
		$('.addAnswer').each(function() {
			if($(this).prop('checked')) {
				ans = i;
			}
			++i;
		});

		$('#addAnswer').val(ans);
	}

	function delOption(_this) {
		if($(".jwbn").length >2){		
			option_this = _this;
			var o = $(_this).parent().parent().find('.fieldOption').val();
			if(o!='') {
				$('.text_alert').html("Anda yakin menghapus jawaban ini?");
				$('#btnConfirm').attr({'onClick':'doDelOption()'});
				$('#delConfirm').modal('show');
			} else {
				doDelOption();
			}
		}
	}

	function doDelOption() {
		if($(".jwbn").length >2){		
			var neightboard = $(option_this).parent().parent().parent().find('tr');
			var myAdder = $(option_this).parent().parent().parent().parent().parent().find('.addOption');
			$(option_this).parent().parent().remove();
			$('#delConfirm').modal('hide');
			if(neightboard.length<3) {
				myAdder.click();
			}
		}
	}

	function addOption(_this) {
		var par = $(_this).parents('table').prev().find('tbody');
		var opti = '';
		opti = '	<tr class="jwbn">'+
						'<td width="56px" class="" style="vertical-align:top;">'+
							'<a onClick="delOption(this);" role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a>'+
							'<label class="radio-inline" style="padding-left:10px;">'+
								'<input type="radio" class="styled addAnswer" name="addAnswer" onChange="setAnswer(this);">'+
							'</label>'+
						'</td>'+
						'<td width="*" style="padding-bottom:6px;">'+
							'<input type="text" class="form-control fieldOption" name="addOption[]" placeholder="Jawaban..">'+
						'</td>'+
					'</tr>';
		par.append(opti);
		$(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
	}
</script>
