<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Edit Data Katering</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Edit Data Katering</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal need_validation" action="<?php echo base_url('master/katering/update_') ?>" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="add_accname" class="col-sm-3 control-label text-right">Nama Katering <span class="mandatory">*</span> : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control wajib" id="add_accname" name="add_accname" value="<?php echo $katering['CATERING_NAME']; ?>">
					<input type="hidden" class="form-control wajib" id="id_katering" name="id_katering" value="<?php echo $katering['CATERING_ID']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="config_code" class="col-sm-3 control-label " style="text-align: right">
					Upload Menu 				</label>
				<div class="col-sm-4">
					<input type="file" class="form-control styled" id="file_menu" name="file_menu" accept="image/*, application/pdf" placeholder="Harga Satuan">
					<span class="help-block">jenis file yang diijinkan png, jpg, jpeg & pdf</span>
					<span><a href="<?php echo base_url().$katering["CATERING_FILE_PATH"];?>"  download> download menu</a></span>
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
								<table id="myTable" class="table table-condensed form no-Footer">
								<?php
	                         			foreach ($cat_menu as $m) {                        
	                   			?>
									<tr>
										<td><label>Nama</label></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><input type="hidden" name="menu_id[]" class="form-control" style="width: 300px" value="<?php echo $m->CAT_MENU_ID?>"></td>
										<td><input type="text" name="menu_name[]" class="form-control" style="width: 300px" value="<?php echo $m->CAT_MENU_NAME?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><label>Kategori</label></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td style="width:300px;">
											<select name="kategori[]" class="form-control" style="width: 300px">
												<?php  
													$menu = $this->db->query("SELECT CAT_MENU_ID, CAT_MENU_NAME FROM T_REF_MENU_CATEGORY WHERE CAT_MENU_ID = $m->CAT_MENU_ID")->row();
													echo "<option value=".$menu->CAT_MENU_ID.">".$menu->CAT_MENU_NAME."</option>";
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
										<td><a href="javascript:void(0)" onclick="deleteRow(this)" class="btn btn-icon btn-danger"> Hapus</a></td>
									</tr>
								<?php
                        		}
                            	?>	
								</table>									 
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
        </form>
    </div>
</div>
<script type="text/javascript">
		function addRow() {
	var table = document.getElementById("myTable");
	var rowCount = table.rows.length;
	if(rowCount < 5){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Menu Adalah 5 Item.");			   
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