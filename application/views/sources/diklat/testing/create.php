<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>diklat/testing'>Testing & Kuisioner</a></li>
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
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">
					Jenis Testing <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" value="PRE-TEST" readonly="readonly">
				</div>
				<label class="col-sm-2 control-label text-right" style="margin-left: -50px;">
					Tanggal <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="start_date" value="<?php echo $diklat['PROGRAM_START']; ?>" readonly="readonly">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">
					Jenis Testing <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" value="POST-TEST" readonly="readonly">
				</div>
				<label class="col-sm-2 control-label text-right" style="margin-left: -50px;">
					Tanggal <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="end_date" value="<?php echo $diklat['PROGRAM_END']; ?>" readonly="readonly">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">
					Type Testing <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-4">
					<select id="addTypeTesting" class="select2 wajib" name="addTypeTesting" data-placeholder="-- Pilih Type Testing --">
						<option></option>
						<option value="1">Offline</option>
						<option value="2">Online</option>
					</select>
				</div>
			</div>
			<div class="form-group" id="boxpaketsoal" style="display:none;">
				<label class="col-sm-2 control-label text-right">
					Nama Paket <span class="mandatory">*</span> :
				</label>
				<div class="col-sm-8">
					<select id="addPacket" class="select2 wajib" name="addPacket" data-placeholder="-- Pilih Paket Soal --">
						<?php if(count($paketsoal)>0){
							echo '<option></option>';
							foreach ($paketsoal as $k => $v) {
								echo '<option value="'.$v['PACKET_ID'].'">'.$v['PACKET_NAME'].'</option>';
							}
						} else {
							echo '<option>tidak ada data</option>';
						} ?>
						<input type="hidden" name="addPacketName" id="addPacketName" value="">
					</select>
				</div>
			</div>
			<div class="form-group" id="listsoal" style="display:none;">
		    	<label class="col-sm-2 control-label text-right">List Soal : </label>
		    	<div class="col-lg-10">
				    <div class="table-responsive">
				        <table class="table table-bordered">
				            <thead>
				                <tr>
				                    <th class="text-center" style="min-width: 40px;width: 40px;">No</th>
				                    <th>Soal</th>
				                </tr>
				            </thead>
				            <tbody id="input_there">
				            	
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
			<hr />
			<div class="form-group">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-9">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
					<button type="submit" class="btn btn-xs btn-success">Simpan</button>
					<a href="<?php echo base_url();?>diklat/testing" class="btn btn-xs btn-danger">Kembali</a>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- global -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("select").select2('destroy').select2({
		    	allowClear: true,
		    	width: "100%"
			});
		});

		$('#addJenisTesting').change(function(){
			if($(this).val()==1){
				$('#datetest').val("<?php echo ($diklat['PROGRAM_START'])!=''?date('d-m-Y', strtotime($diklat['PROGRAM_START'])):''; ?>");
			}else if($(this).val()==2){
				$('#datetest').val("<?php echo ($diklat['PROGRAM_END'])!=''?date('d-m-Y', strtotime($diklat['PROGRAM_END'])):''; ?>");
			}else{
				$('#datetest').val("");
			}
		});
		$('#addTypeTesting').change(function(){
			if($(this).val()==2){
				$("#addPacket").val("");
				$("#addPacket").select2('destroy').select2({
			    	allowClear: true,
			    	width: "100%"
				});
				$('#boxpaketsoal').css({'display':''});
			}else{
				$('#listsoal').css({'display':'none'});				
				$('#boxpaketsoal').css({'display':'none'});
			}
		});
	</script>

<!-- showdetail: paket soal -->
	<script type="text/javascript">
		$('#addPacket').change(function(){
			if($('#addPacket').val()!=""){
				$('#listsoal').css({'display':''});
				$("#addPacketName").val("");
				$("#addPacketName").val($.trim($('#addPacket').select2('data').text));
			}else{
				$('#listsoal').css({'display':'none'});				
				$("#addPacketName").val("");
			}
			get_listsoal($(this).val());
		});
		function get_listsoal(id=0){
			$.ajax({
	            url : "<?php echo base_url('diklat/testing/json_listsoalpaket').'/'?>"+id,
	            type: "GET",
	            dataType: "JSON",
	            success: function(data){
		            var nomor = 1;
		            var table = "";
	                $.each(data, function(index) {
		            	table += "<tr>";
		            	
		            	table += "<td>"+(data[index].DETPACK_SORT+1)+"</td>";
		            	table += "<td>"+data[index].DETPACK_QUESTION_VALUE+"</td>";
		            	table += "</tr>";
		            	var opsi = data[index].list_option;
		            	for (var i = 0; i < opsi.length; i++) {
		            		table += "<tr>";
		            	
			            	table += "<td></td>";
			            	var checked = (opsi[i].OPTION_ANSWER == 1) ? "checked" : "";
			            	table += '<td><label class="radio radio-inline" style="padding-left:10px;"><input type="radio" class="styled" disabled '+checked+'>'+String.fromCharCode(65+i)+ '. ' + opsi[i].OPTION_VALUE+'</label></td>';
			            	table += "</tr>";
		            	}
	                
	                });
	                $('#input_there').html(table);
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Mohon untuk refresh halaman kembali');
	            }
	        });
		}
	</script>