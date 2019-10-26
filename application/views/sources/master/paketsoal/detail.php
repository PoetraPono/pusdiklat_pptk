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
			<label for="add_accname" class="col-sm-2 control-label text-right">Nama Paket Soal : </label>
			<div class="col-sm-10 control-label">
				<?php echo isset($paketsoal['PACKET_NAME'])!=""?$paketsoal['PACKET_NAME']:""; ?>
			</div>
	    </div>
	    <div class="form-group">
	    	<label class="col-sm-2 control-label text-right">List Soal : </label>
	    	<div class="col-lg-10">
			    <div class="table-responsive">
			        <table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th class="text-center" style="min-width: 60px;width: 60px;">Urutan</th>
			                    <th>Soal</th>
			                </tr>
			            </thead>
			            <tbody id="input_there">
			            	<?php 
			            	if(count($detailpaket)>0){
			            		$no = 1;
			            		foreach ($detailpaket as $k => $v) {
				            		echo '<tr id="pilihan_'.$v['DETPACK_QUESTION_ID'].'">
										<td class="nopilihan text-center">'.$no.'</td>
										<td>'.$v['DETPACK_QUESTION_VALUE'].'<input type="hidden" id="idpilihan_'.$no.'" name="idpilihan[]" value="'.$v['DETPACK_QUESTION_ID'].'"></td>
									</tr>';
									$no +=1;
				            	}
				            }else{
					           	echo '<tr><td class="text-center" colspan="3"><i>- tidak ada soal -</i></td></tr>';
							}
				            ?>
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
				<a href="<?php echo base_url();?>master/paketsoal" class="btn btn-xs btn-danger">Kembali</a>
			</div>
		</div>
	</div>
</div>
</form>