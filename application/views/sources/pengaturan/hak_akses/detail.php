<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Detail Data Hak Akses</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Data Hak Akses</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Nama Hak Akses <span class="mandatory">*</span> : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control wajib" id="add_accname" name="add_accname" value="<?php echo $getDetail["ACCESS_NAME"];?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width="*">Modul &amp; Menu</th>
								<th style="text-align:center;" width="80px">Read</th>
								<th style="text-align:center;" width="80px">Create</th>
								<th style="text-align:center;" width="80px">Update</th>
								<th style="text-align:center;" width="80px">Delete</th>
								<th style="text-align:center;" width="80px">Approve</th>
								<th style="text-align:center;" width="80px">Print</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($datamenus as $key => $menu) {

                                $padding = ($menu["MENU_LEVEL"] == 2)?'padding-left:30px;':(($menu["MENU_LEVEL"] == 3)?'padding-left:60px;':'');
								$cekedread = '';
								$cekedcreate = '';
								$cekedupdate = '';
								$cekeddelete = '';
								$cekedapprove = '';
								$cekedprint = '';

								for ($i=0; $i < count($dataakses); $i++) { 
									
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_READ"] == 1){
										$cekedread = "checked"; 
									}
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_CREATE"] == 1){
										$cekedcreate = "checked"; 
									}
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_UPDATE"] == 1){
										$cekedupdate = "checked"; 
									}
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_DELETE"] == 1){
										$cekeddelete = "checked"; 
									}
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_APPROVE"] == 1){
										$cekedapprove = "checked"; 
									}
									if($dataakses[$i]["ACCESS_DETAIL_MENU_ID"] == $menu["MENU_ID"] && $dataakses[$i]["ACCESS_DETAIL_CAN_PRINT"] == 1){
										$cekedprint = "checked"; 
									}

								}
								?>
								<tr>
									<td>
										<div class="checkbox" style="<?php echo $padding; ?>padding-top:0px;padding-bottom:0px;min-height:auto;">
											<label style="height:18px;">
												<input type="checkbox" disabled="disabled" name="all[]" class="all child<?php echo $menu['MENU_PARENT_ID']; ?>" id="all_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" >
												<i class="input-helper"></i><?php echo $menu["MENU_NAME"]; ?>
											</label>
										</div>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="read[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> read<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="read" id="read_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekedread;?>>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="create[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> create<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="create" id="create_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekedcreate;?>>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="update[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> update<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="update" id="update_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekedupdate;?>>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="delete[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> delete<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="delete" id="delete_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekeddelete;?>>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="approve[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> approve<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="approve" id="approve_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekedapprove;?>>
									</td>
									<td align="center">
										<input type="checkbox" disabled="disabled" name="print[]" class="child<?php echo $menu['MENU_PARENT_ID']; ?> print<?php echo $menu['MENU_PARENT_ID']; ?> ck<?php echo $menu['MENU_ID']; ?> cekbox" data-type="print" id="print_<?php echo $menu['MENU_ID']; ?>" data-parent="<?php echo $menu['MENU_PARENT_ID']; ?>" value="<?php echo $menu['MENU_ID']; ?>" <?php echo $cekedprint;?>>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-actions text-left">
					<a href="<?php echo base_url();?>pengaturan/hak_akses/update/<?php echo $getDetail["ACCESS_ID"];?>" class="btn btn-xs btn-success">Edit Data</a>
					<a href="<?php echo base_url();?>pengaturan/hak_akses" class="btn btn-xs btn-primary">Kembali</a>
				</div>

			</form>
		</div>
	</div>
	<script type="text/javascript">
		var $ = jQuery;
		$(document).ready(function(){

		});

		$(".all").click(function(){
			var ref = $(this).val();
			var dataparent = $(this).attr('data-parent');
			var action = false;
			if(this.checked){
				action = true;
			}		
			$(".child"+ref).each(function(){			
				if($(this).attr('data-parent') == ref){
					$(this).prop('checked', action);
				}
			});	
			$('#read_'+ref).prop('checked', action);
			$('#create_'+ref).prop('checked', action);
			$('#update_'+ref).prop('checked', action);
			$('#delete_'+ref).prop('checked', action);
			$('#approve_'+ref).prop('checked', action);
			$('#print_'+ref).prop('checked', action);
			var count = $(".child"+ref).length;
			if(count == 0){			
				var countcek = 0;
				var countall = $(".child"+dataparent).length;			
				$(".child"+dataparent).each(function(){
					if(this.checked){
						countcek++;
					}
				});
				if(countcek>0){
					$('#all_'+dataparent).prop('checked',true);
					$('#read_'+dataparent).prop('checked', true);
					$('#create_'+dataparent).prop('checked', true);
					$('#update_'+dataparent).prop('checked', true);
					$('#delete_'+dataparent).prop('checked', true);
					$('#approve_'+dataparent).prop('checked', true);
					$('#print_'+dataparent).prop('checked', true);
				}else{
					$('#all_'+dataparent).prop('checked',false);
					$('#read_'+dataparent).prop('checked', false);
					$('#create_'+dataparent).prop('checked', false);
					$('#update_'+dataparent).prop('checked', false);
					$('#delete_'+dataparent).prop('checked', false);
					$('#approve_'+dataparent).prop('checked', false);
					$('#print_'+dataparent).prop('checked', false);
				}
			}		
		});

$('.cekbox').click(function(){
	var ref = $(this).val();
	var dataparent = $(this).attr('data-parent');
	var type = $(this).attr('data-type');
	var action = false;
	if(this.checked){
		action = true;			
	}
	$("."+type+ref).each(function(){			
		if($(this).attr('data-parent') == ref){
			$(this).prop('checked', action);
		}
	});	
	if(this.checked){
		action = true;
		$("#"+type+'_'+dataparent).prop('checked', true);
		if(type!='read'){
			$("#read_"+ref).prop('checked', true);
			$("#read_"+dataparent).prop('checked', true);
			$(".read"+ref).each(function(){			
				if($(this).attr('data-parent') == ref){
					$(this).prop('checked', action);
				}
			});	
		}
	}else{
		var n = 0;			
		$("."+type+dataparent).each(function(){
			if(this.checked){
				n++;
			}
		});
		if(n==0){
			$("#"+type+'_'+dataparent).prop('checked', false);
		}
	}
	cekuncekheader(ref,dataparent);
});


function cekuncekheader(ref,dataparent){
	var n = 0;
	$(".ck"+ref).each(function(){			
		if(this.checked){
			n++;
		}
	});	
	if(n<6){
		$('#all_'+ref).prop('checked',false);
		$(".all").each(function(){			
			if($(this).attr('data-parent') == ref){
				$(this).prop('checked', false);
			}
		});	
	}else{			
		$('#all_'+ref).prop('checked',true);
		$(".all").each(function(){	
			if($(this).attr('data-parent') == ref){
				$(this).prop('checked', true);
			}
		});	
		
	}
	var m = 0;
	$(".ck"+dataparent).each(function(){			
		if(this.checked){
			m++;
		}
	});	
	if(m<6){
		$('#all_'+dataparent).prop('checked',false);
	}else{			
		$('#all_'+dataparent).prop('checked',true);			
	}		
}

</script>