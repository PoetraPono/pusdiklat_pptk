<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>master/paketsoal'>Paket Soal</a></li>
        <li class="active">Master</li>
    </ul>
    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>
</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
<div class="panel panel-default" style="margin-bottom: 5px !important">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Master Paket Soal</h6>
	</div>

	<div class="panel-body">
	    <div class="form-group">
			<label for="add_accname" class="col-sm-2 control-label text-right">Nama Paket Soal <span class="mandatory">*</span> : </label>
			<div class="col-sm-10">
				<input type="text" class="form-control wajib" id="add_judul" name="add_judul" placeholder="Nama Paket Soal">
			</div>
	    </div>
	    <div class="form-group">
	    	<label class="col-sm-2 control-label text-right">List Soal <span class="mandatory">*</span> : </label>
	    	<div class="col-lg-10">
			    <div class="table-responsive">
			        <table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th class="text-center" style="min-width: 60px;width: 60px;">Urutan</th>
			                    <th>Soal</th>
			                    <th class="text-center" style="min-width: 80px;width: 80px;">Aksi</th>
			                </tr>
			            </thead>
			            <tbody id="input_there">
			            	<tr><td class="text-center" colspan="3"><i>- tidak ada soal -</i></td></tr>
			            </tbody>
			            <!-- <footer>
			            	<tr>
			            		<th colspan="2"></th>
			            		<th class="text-center">
			            			<button type="button" class="btn btn-default btn-icon btn-sm" onclick="getlistsoal();"><i class="icon-plus"></i></button>
			            		</th>
			            	</tr>
			            </footer> -->
			        </table>
			    </div>
			</div>
	   </div>
		<div class="form-group">
	    	<div class="col-lg-2">
	    	</div>
			<div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
				<button type="submit" class="btn btn-xs btn-success">Simpan</button>
				<a href="<?php echo base_url();?>master/paketsoal" class="btn btn-xs btn-danger">Kembali</a>
			</div>
		</div>
	</div>
</div>
</form>

<div class="panel panel-default"  id="listsoalpanel">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>List soal - Pencarian soal</h6>
    </div>

	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="dataaktif">
		    <thead>
		        <tr>
		            <th class="text-center" style="width: 5px">No</th>
		            <th>Soal</th>
		            <th class="text-center" style="min-width:90px;width:90px">Aksi</th>
		        </tr>
		    </thead>
		</table>
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

<div id="alert_nosoal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-warning"></i> Penyimpanan gagal! </h4>
                </div>

                <div class="modal-body with-padding">
                    <p>Harap pilih minimal satu pertanyaan untuk menyimpan paket soal.</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default mki-btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
	$("form").submit(function(e) { e.preventDefault(); }).validate({
        //rules: {},
        submitHandler: function(form) { 
        	if($(".nopilihan").length>0){
        		$('#konfirmasipenyimpanan').modal('show');
				$('#setujukonfirmasibutton').on('click', function () {
					form.submit();
				});
	            //return false;
        	}else{
	            $("#alert_nosoal").modal('show');
	            //alert("Tidak ada soal yang dipilih! Mohon untuk pilih soal yang tertera di tabel daftar soal");
        	}
            return false;
        }
    });
	function upup(id){
		$("#pilihan_"+id).insertBefore($("#pilihan_"+id).prev());
		sortpilihan();
	}
	function downdown(id){
		$("#pilihan_"+id).insertAfter($("#pilihan_"+id).next());
		sortpilihan();
	}

	function catch_this(id){
		var no = ($(".nopilihan").length>0)?($(".nopilihan").length+1):1;
		var html = '';
			html += '<tr id="pilihan_'+id+'">'+
						'<td class="nopilihan text-center">'+no+'</td>'+
						'<td>'+($("#value_"+id).html())+'<input type="hidden" id="idpilihan_'+no+'" name="idpilihan[]" value="'+id+'"></td>'+
						'<td class="text-center">'+
							'<button type="button" class="btn btn-default btn-icon btn-xs" data-original-title="Hapus" data-placement="top" onclick="del_soal('+id+');"><i class="icon-close"></i></button>'+
							'<button type="button" class="btn btn-default btn-icon btn-xs" data-original-title="Ke atas" data-placement="top" onClick="upup('+id+')"><i class="icon-arrow-up8"></i></button>'+
							'<button type="button" class="btn btn-default btn-icon btn-xs" data-original-title="Ke bawah" data-placement="top" onClick="downdown('+id+')"><i class="icon-arrow-down8"></i></button>'+
						'</td>'+
					'</tr>';
		if(no>1){
			$("#input_there").append(html);
		}else{
			$("#input_there").html(html);
		}
		document.getElementById('btnval_'+id).disabled = true;
	}

	$(document).ready(function(){
		getlistsoal();
	});

	function del_soal(id){
		$("#pilihan_"+id).remove();
		if($('#btnval_'+id).length){
			document.getElementById('btnval_'+id).disabled = false;
		}
		if($(".nopilihan").length==0){
			$("#input_there").html('<tr><td class="text-center" colspan="3"><i>- tidak ada soal -</i></td></tr>');
		}
	}
	function getlistsoal(){
		$('#dataaktif').dataTable({
	        "processing"	: true,
	        "serverSide"	: true,
	        "bServerSide"	: true,
	        "sAjaxSource"	: baseurl+"master/paketsoal/listsoal",
	        "aaSorting"		: [[0, "desc"]],
	        "aoColumns"		: [
		        { "bSortable"	: false, "sClass": "text-center" },
		        { "sClass"		: "text-left" },
		        { "bSortable"	: false, "sClass": "text-center" }
	        ],
	        "fnDrawCallback": function () {
	            set_default_datatable();
	            var jmldata = ($(".nopilihan").length)!=0?($(".nopilihan").length+1):0;
	            for (var i = 1; i < jmldata; i++) {
					var value = $("#idpilihan_"+i).val();
					if($('#btnval_'+value).length){
						document.getElementById('btnval_'+value).disabled = true;
					}
	            }
	        },
	    });
	}

	function sortpilihan(){
		var no = 1;
		$('.nopilihan').each(function () {      
			$(this).html(no);
			no++;
		});
		// jQuery(this).prev("li").attr("id","newId");
	}
</script>