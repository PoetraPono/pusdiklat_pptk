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
        <li class="active">Penilaian</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Penilaian Testing & Kuisioner untuk <?php echo $type_text; ?></h6>
	</div>
	
	<div class="panel-body">
		<form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">
					List Peserta :
				</label>
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center" style="width: 10px;">No</th>
									<th>Nama Peserta</th>
									<th class="text-center" style="width: 65px">Nilai</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach ($participant as $k => $v) {
										echo '<tr>';
										echo '<td class="text-center" style="width: 10px;">'.$no.'</td>';
										echo '<td>'.$v['MEMBER_NAME'].'</td>';
										echo '<td style="width: 80px"><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control text-right spinner-default" name="value['.$v['PROPAR_ID'].']" value="'.(isset($v['SCORE'])!=""?$v['SCORE']:0).'" style="padding-right:24px" min=0 max=100 maxlength="3"></td>';
										echo '</tr>';
										$no +=1;
									}
								?>
							</tbody>
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
<script type="text/javascript">
	$(document).ready(function(){
		$( ".spinner-default" ).spinner();
		$(".spinner-default").change(function(){
			if($(this).val()==""){
				return $(this).val(0);
			}else if($(this).val()>100){
				return $(this).val(100);
			}
		});
	});
</script>