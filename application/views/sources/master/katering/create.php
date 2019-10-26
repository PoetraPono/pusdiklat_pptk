<style>
    .input-sm {
        height: 26px;
    }
    .select2-container .select{
    	width: 100%;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='@Url.Action("Index", "Home")'>SI Pusdiklat PPATKT</a></li>
        <li class="active"><a href="<?php echo base_url('master/katering') ?>">Tambah Master Katering</a></li>
        <li class="active">Tambah Baru</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<form id="mki_form" action="<?php echo base_url('master/katering/create') ?>" class="validate form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
<div class="panel panel-default mki-panel">
	<div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-quill2"></i>Data Katering</h6>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					Nama Katering <span class="mandatory">*</span>
				</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="add_name" placeholder="Nama Katering">
				</div>
			</div>

			<!-- <div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					* Harga Satuan
				</label>
				<div class="col-sm-5">
					<input type="text" class="wajib form-control" id="add_price" name="add_price" placeholder="Harga Satuan">
				</div>
			</div> -->
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label" style="text-align: right">
					Upload Menu <span class="mandatory">*</span>
				</label>
				<div class="col-sm-4">
					<input type="file" class="form-control styled" id="file_menu" name="file_menu" accept="image/*, application/pdf">
					<span class="help-block">jenis file yang diijinkan png, jpg, jpeg & pdf</span>
				</div>
			</div>

			<div class="col-sm-12 control-label">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h6 class="panel-title"><i class="icon-table2"></i> Daftar Menu</h6>
						<h6 class="panel-title" style="float: right;">
							<a href="#" onclick="addRow()" class="btn btn-icon btn-success">Tambah</a>
							
						</h6>						
					</div>
					<div class="table-responsive">
									
	                        <table class="table table-condensed form no-Footer">
	                        	<thead>
	                        		<tr role="row">
	                                    <th class="text-center" style="width: 20px;"><label>Nama Menu</label></th>
	                                    <th class="text-center" style="width: 20px;"><label>Kategori</label></th>
	                                </tr>
	                        	</thead>
	                        	<tbody id="myTable">
	                        		<tr>
	                        		<td><input type="hidden" name="menu_id[]" class="form-control" style="width: 300px"></td>
	                                    <td style="width: 20px;"><input type="text" name="menu_name[]" class="form-control" style="width: 300px">
	                                    </td>                        
	                                    <td style="width: 20px;">
	                                        <select name="kategori[]" class="form-control" style="width: 300px">
												<?php
													$query = $this->db->query("SELECT CAT_MENU_ID, CAT_MENU_NAME FROM T_REF_MENU_CATEGORY")->result();
														foreach ($query as $q) {
															if ($kategori == $q->CAT_MENU_NAME) {
																echo "<option value=".$q->CAT_MENU_ID." selected>".$q->CAT_MENU_NAME."</option>";		
															}else {
																echo "<option value=".$q->CAT_MENU_ID.">".$q->CAT_MENU_NAME."</option>";
															}
														}			
												?>									
											</select>
	                                    </td>
	                                    <td style="width: 20px;"><a href="javascript:void(0)" onclick="deleteRow(this)" class="btn btn-icon btn-danger"> Hapus</a>
	                                    </td>  
	                                </tr>
	                        	</tbody>
							</table>  
					</div>
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
				<button class="btn btn-default btn-xs btn-primary" type="submit"><i class="icon-download2"></i> Simpan</button>
				<a class="btn btn-default btn-xs btn-danger" href="<?php echo base_url('master/katering');?>"><i class="icon-exit2"></i> Batal</a>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
function addRow() {
	var table = document.getElementById("myTable");
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = table.rows[0].cells.length;
	for(var i=0; i<colCount; i++) {
		var newcell = row.insertCell(i);
		newcell.innerHTML = table.rows[0].cells[i].innerHTML;
	}
}

function deleteRow(ini) {
	
	var table = document.getElementById("myTable");
	var rowCount = table.rows.length;
	if (rowCount<=1) {
		alert("Minimum Menu Adalah 1 Item.");
		return false;
	} else {
		$(ini).parent().parent().remove();
		return false;
	}
}
</script>