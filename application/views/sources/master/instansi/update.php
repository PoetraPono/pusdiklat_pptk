

<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Ubah Data Instansi</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Ubah Data Instansi</h6>
		
	</div>
	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Nama Instansi <span class="mandatory">*</span> : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control wajib" id="update_name" name="update_name" placeholder="Nama Instansi" value="<?php echo $instansi['INSTANSI_NAME']!=''?$instansi['INSTANSI_NAME']:''; ?>">
				</div>
			</div>
			 <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Sektor <span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">                        
                        <select id="update_category" class="select2 wajib" name="update_category" data-placeholder="Pilih Bidang Pelatihan">
                            <?php if(count($listcategory)>0){ ?>
                                    <option value=""> - Pilih Sektor -</option>
                                       <?php foreach ($listcategory as $sect) { ?>
                                           <?php 
                                           $select = ($sect['INSTANSI_CATEGORY_ID'] == $instansi['INSTANSI_CATEGORY']) ? "selected" : "";
                                            echo '<option value="'.$sect['INSTANSI_CATEGORY_ID'].'" '.$select.'>'.$sect['INSTANSI_CATEGORY_NAME'].'</option>';
                                           ?>
                                          <?php } ?> 
                                     <?php }else{ ?>                                 
                                        <option value=""> Data Sektor Kosong!</option>
                                    
                            <?php } ?>
                        </select> 
                    </div><small class="help-block"></small>
                </div>
            </div>
			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Alamat : </label>
				<div class="col-sm-4">
					<textarea type="text" class="form-control " id="update_address" name="update_address" placeholder="Alamat Instansi"><?php echo $instansi['INSTANSI_ADDRESS']!=''?$instansi['INSTANSI_ADDRESS']:''; ?></textarea>
				</div>
			</div>

			<!-- <div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Total Peserta : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control " id="update_part" name="update_part" placeholder="Total Peserta" value="<?php echo $instansi['INSTANSI_PARTICIPANTS']!=''?$instansi['INSTANSI_PARTICIPANTS']:''; ?>">
				</div>
			</div> -->


			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">No Telp : </label>
				<div class="col-sm-4">
					<input type="text" class="form-control " id="update_phone" name="update_phone" placeholder="No Handphone Instnsi" value="<?php echo $instansi['INSTANSI_PHONE']!=''?$instansi['INSTANSI_PHONE']:''; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">Nama PIC</label>
				<div class="col-sm-4">
					<input type="text" class="form-control " id="update_pic_name" name="update_pic_name" placeholder="Nama Pic" value="<?php echo $instansi['INSTANSI_PIC_NAME']!=''?$instansi['INSTANSI_PIC_NAME']:''; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="add_accname" class="col-sm-2 control-label text-right">No Telp PIC</label>
				<div class="col-sm-4">
					<input type="text" class="form-control " id="update_pic_phone" name="update_pic_phone" placeholder="Nomor Pic" value="<?php echo $instansi['INSTANSI_PIC_PHONE']!=''?$instansi['INSTANSI_PIC_PHONE']:''; ?>">
				</div>
			</div>

			<div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>master/instansi" class="btn btn-xs btn-primary">Kembali</a>
                </div>
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