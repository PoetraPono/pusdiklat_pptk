<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
		<li class="active">Setting Persyaratan</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Setting Persyaratan Program Diklat</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Program : </label>
                <div class="col-sm-10 control-label">
                    <?php echo $diklat['PROGRAM_NAME']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Deskripsi Program : </label>
                <div class="col-sm-10 control-label">
                    <?php echo $diklat['PROGRAM_DESCRIPTION']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Tanggal Pelatihan :
                </label>
                <div class="col-sm-2 control-label" style="margin-right:-50px;">
                   <?php echo date('d M Y',strtotime($diklat['PROGRAM_START'])); ?>
                </div>
                <label for="" class="col-sm-1 control-label" style="margin-right:-50px;">
                   s.d
                </label>
                <div class="col-sm-2 control-label">
                     <?php echo date('d M Y',strtotime($diklat['PROGRAM_END'])); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jumlah Mata Ajar :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_LESSON']; ?>
                </div>
            </div> 
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Total Jam Pelatihan :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_HOURS']; ?> Jam
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Kuota Peserta :
                </label>
                <div class="col-sm-4 control-label">
                   <?php echo $diklat['PROGRAM_TOTAL_KUOTA']; ?>
                <input type="hidden" name="PROGRAM_ID" value="<?php echo $diklat['PROGRAM_ID']; ?>">
                </div>
            </div>
            <div class="form-group">
                <!-- <label for="" class="col-sm-1 control-label text-right">
                    
                </label> -->
                <div class="col-sm-12 control-label">
                   <div class="panel panel-default">
                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> List Persyaratan</h6></div>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%" class="align-center">#</th>
                                    <th>Persyaratan</th>
                                    <th width="20%">Tipe</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody id="list_requisite">
                                <?php $n = 0; if(count($requisite) > 0){ ?>
                                    <?php foreach ($requisite as $k => $v) { ?>
                                        <tr id="rw_requisite_<?php echo $k; ?>">
                                            <td>
                                                <input type="hidden" class="form-control" name="requisite_id[]" id="requisite_id_<?php echo $k; ?>" value="<?php echo $v['PROREQ_ID']; ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="requisite_name[]" id="requisite_name_<?php echo $k; ?>" value="<?php echo $v['PROREQ_DESC']; ?>">
                                            </td>
                                            <td>
                                                <select class="form-control" name="requisite_type[]" id="requisite_type_<?php echo $k; ?>">
                                                    <option value="0" <?php echo ($v['PROREQ_TYPE'] == 0) ? 'selected':''; ?>>Opsi</option>
                                                    <option value="1" <?php echo ($v['PROREQ_TYPE'] == 1) ? 'selected':''; ?>>Upload</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if($k!=0){ ?>
                                                    <a href="javascript:void(0);" class="icon-cancel-circle2 remove" data-ref="<?php echo $k; ?>" style="color:red;"></a>
                                                <?php } ?>
                                            </td>
                                        </tr>    
                                    <?php $n++; } ?>
                                <?php }else{ ?>
                                 <tr id="rw_requisite_0">
                                    <td>
                                        <input type="hidden" class="form-control" name="requisite_id[]" id="requisite_id_0" value="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="requisite_name[]" id="requisite_name_1">
                                    </td>
                                    <td>
                                        <select class="form-control" name="requisite_type[]" id="requisite_type_1">
                                            <option value="0">Opsi</option>
                                            <option value="1">Upload</option>
                                        </select>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>   
                                 <?php $n++; } ?>                                   
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align:right;">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-default" id="reset" ><i class="icon-loop4"></i> reset</add>
                                        &emsp; <a href="javascript:void(0);" class="btn btn-xs btn-info" id="add_requisite" data-ref="<?php echo $n; ?>"><i class="icon-plus-circle"></i> tambah</add>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                            <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/program" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function($) {
    var drawlist = $('#list_requisite').html();
    $('body').on('click', '#reset', function () {
        $('#list_requisite').html("").html(drawlist);
    });
});
$('#add_requisite').click(function(){
    var ref = $(this).attr('data-ref')*1;
    var list = '<tr id="rw_requisite_'+ref+'">'+
                    '<td>'+
                        '<input type="hidden" class="form-control" name="requisite_id[]" id="requisite_id_'+ref+'" value="0">'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" class="form-control" name="requisite_name[]" id="requisite_name_1">'+
                    '</td>'+
                    '<td>'+
                        '<select class="form-control" name="requisite_type[]" id="requisite_type_1">'+
                            '<option value="0">Opsi</option>'+
                            '<option value="1">Upload</option>'+
                        '</select>'+
                    '</td>'+
                    '<td widt="5%">'+
                        '<a href="javascript:void(0);" class="icon-cancel-circle2 remove" data-ref="'+ref+'" style="color:red;"></a>'+
                    '</td>'+
                '</tr>';
    $('#list_requisite').append(list);
    $(this).attr('data-ref',(ref+1));
});

 $('body').on('click', '.remove', function () {
    var ref = $(this).attr('data-ref')*1;
    $('#rw_requisite_'+ref).remove();
}); 


</script>