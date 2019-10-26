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
					Pertanyaan <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-10">
					<table style="width:100%;" class="table table-hover" id="boxQuestions"></table>
					<table style="width:100%;" class="table table-hover">
						<tr>
							<td colspan="2" style="vertical-align:top;margin-bottom:10px;padding-top:8px;">
							<a role="button" id="addQuestion" class="btn btn-xs btn-primary btn-icon tip" data-original-title="Tambah Pertanyaan" data-placement="top" style="padding-left:4px;padding-right:8px;"><i class="icon-plus"></i> &nbsp; <small>Tambah Pertanyaan</small></a>
							</td>
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
	var qid = 0;
	$(document).ready(function() {
		addQuestion();

		$('#addQuestion').click(function() {
			addQuestion();
		});

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

	function setAnswer(_this, qId) {
		var ans = 0;
		var i = 0;
		$('.addAnswer_'+qId).each(function() {
			if($(this).prop('checked')) {
				ans = i;
			}
			++i;
		});

		$('#addAnswer_'+qId).val(ans);
	}

	function delOption(_this) {
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

	function doDelOption() {
		var neightboard = $(option_this).parent().parent().parent().find('tr');
		var myAdder = $(option_this).parent().parent().parent().parent().parent().find('.addOption');
		$(option_this).parent().parent().remove();
		$('#delConfirm').modal('hide');
		if(neightboard.length<3) {
			myAdder.click();
		}
	}

	function addOption(_this) {
		var par = $(_this).parents('table').prev().find('tbody');
		var ref_id = par.attr('ref-id');
		var opti = '';
		opti = '	<tr>'+
						'<td width="56px" class="" style="vertical-align:top;">'+
							'<a onClick="delOption(this);" role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a>'+
							'<label class="radio-inline addAnswer" style="padding-left:10px;">'+
								'<input type="radio" class="styled addAnswer_'+ref_id+'" name="addAnswer_'+ref_id+'" onChange="setAnswer(this, '+ref_id+');">'+
							'</label>'+
						'</td>'+
						'<td width="*" style="padding-bottom:6px;">'+
							'<input type="text" class="form-control fieldOption" name="addOption_'+ref_id+'[]" placeholder="Jawaban...">'+
						'</td>'+
					'</tr>';
		par.append(opti);
		$(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
	}

	function delQuestion(_this) {
		question_this = _this;

		var q = $(question_this).parents('.boxQuestionList').find('.addFieldQuestion').val();

		if(q!='') {
			$('.text_alert').html("Anda yakin menghapus pertanyaan ini?");
			$('#btnConfirm').attr({'onClick':'doDelQuestion()'});
			$('#delConfirm').modal('show');
		} else {
			doDelQuestion();
		}
	}

	function doDelQuestion() {
		$(question_this).parents('.boxQuestionList').remove();
		$('#delConfirm').modal('hide');
		if($('.boxQuestionList').length==0) {
			addQuestion();
		}
	}


	function addQuestion() {
		var quest = '	<tr class="boxQuestionList" style="border-bottom:1px solid #cccccc;padding-top:10px;">'+
							'<td width="26px" class="" style="vertical-align:top;margin-bottom:10px;padding-top:8px;">'+
								'<a role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top" onClick="delQuestion(this);"><i class="icon-close"></i></a>'+
							'</td>'+
							'<td width="*" style="padding-top:8px;">'+
								'<textarea rows="2" class="form-control addFieldQuestion" name="addQuestion['+qid+']" placeholder="Pertanyaan..." style="margin-bottom:6px;"></textarea>'+
								'<table class="col-md-12">'+
									'<tbody ref-id="'+qid+'">'+
										'<tr>'+
											'<td width="56px" class="" style="vertical-align:top;">'+
												'<a onClick="delOption(this);" role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a>'+
												'<label class="radio-inline addAnswer" style="padding-left:10px;">'+
													'<input type="radio" class="styled addAnswer_'+qid+'" name="addAnswer_'+qid+'" onChange="setAnswer(this, '+qid+');">'+
												'</label>'+
											'</td>'+
											'<td width="*" style="padding-bottom:6px;">'+
												'<input type="text" class="form-control fieldOption" name="addOption_'+qid+'[]" placeholder="Jawaban...">'+
											'</td>'+
										'</tr>'+
										'<tr>'+
											'<td width="56px" class="" style="vertical-align:top;">'+
												'<a onClick="delOption(this);" role="button" class="btn btn-xs btn-danger btn-icon tip" data-original-title="Hapus" data-placement="top"><i class="icon-close"></i></a>'+
												'<label class="radio-inline addAnswer" style="padding-left:10px;">'+
													'<input type="radio" class="styled addAnswer_'+qid+'" name="addAnswer_'+qid+'" onChange="setAnswer(this, '+qid+');">'+
												'</label>'+
											'</td>'+
											'<td width="*" style="padding-bottom:6px;">'+
												'<input type="text" class="form-control fieldOption" name="addOption_'+qid+'[]" placeholder="Jawaban...">'+
											'</td>'+
										'</tr>'+
									'</tbody>'+
								'</table>'+
								'<table class="col-md-10">'+
									'<tr>'+
										'<td colspan="2" class="" style="vertical-align:top;margin-bottom:10px;padding-top:8px;padding-bottom:10px;">'+
											'<a onClick="addOption(this);" role="button" class="btn btn-xs btn-warning btn-icon tip addOption" data-original-title="Tambah Pilihan" data-placement="top" style="padding-left:4px;padding-right:8px;"><i class="icon-plus"></i> &nbsp; <small>Tambah Pilihan</small></a>'+
											'<input type="hidden" id="addAnswer_'+qid+'" name="addAnswer_'+qid+'">'+
										'</td>'+
									'</tr>'+
								'</table>'+
							'</td>'+
						'</tr>';
		$('#boxQuestions').append(quest);
		$(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
		++qid;
	}
</script>
