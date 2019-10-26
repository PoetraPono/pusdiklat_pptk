<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
		<li class="active">Setting Modul & Pengajar</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Setting Modul & Pengajar Program Diklat</h6>
		
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
                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> List Nodul & Pengajar</h6></div>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%" class="align-center">#</th>
                                    <th width="45">Modul</th>
                                    <th width="45">Pengajar</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody id="list_requisite">
                                <?php $n = 0; if(count($proma) > 0){ ?>
                                    <?php foreach ($proma as $k => $v) { ?>
                                        <tr id="rw_materi_<?php echo $k; ?>">
                                            <td>
                                                <input type="hidden" class="form-control" name="materi_id[]" id="materi_id_<?php echo $n; ?>" value="<?php echo $v['PROMA_ID']; ?>">
                                            </td>
                                            <td>
                                                <select data-placeholder="Pilih Modul ..." class="select2 wajib" tabindex="2" name="materi_modul_id[]" id="materi_modul_id_<?php echo $n; ?>">
                                                <option value=""></option>
                                                <?php foreach($modul as $kv => $m){ ?>
                                                    <option value="<?php echo $m['SILABUS_ID']; ?>" <?php echo ($m['SILABUS_ID'] == $v['PROMA_MATERI_ID'] ? 'selected':'');?>><?php echo $m['SILABUS_NAME']; ?></option>
                                                <?php } ?>
                                        </select>
                                            </td>
                                            <td>
                                                <select data-placeholder="Pilih Pengajar ..." class="select2 wajib" tabindex="2" name="materi_instructor_id[]" id="materi_instructor_id_<?php echo $n; ?>">
                                                    <option value=""></option>
                                                    <?php foreach($instructor as $kv => $i){ ?>
                                                        <option value="<?php echo $i['INSTRUCTOR_ID']; ?>" <?php echo ($i['INSTRUCTOR_ID'] == $v['PROMA_INSTRUCTOR_ID'] ? 'selected':'');?>><?php echo $i['INSTRUCTOR_NAME']." ".$i['INSTRUCTOR_LAST_TITLE']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if($n!=0){ ?>
                                                    <a href="javascript:void(0);" class="icon-cancel-circle2 remove" data-ref="<?php echo $k; ?>" style="color:red;"></a>
                                                <?php } ?>
                                            </td>
                                        </tr>    
                                    <?php $n++; } ?>
                                <?php }else{ ?>
                                 <tr id="rw_materi_0">
                                    <td>
                                        <input type="hidden" class="form-control" name="materi_id[]" id="materi_id_0" value="0">
                                    </td>
                                    <td>
                                        <select data-placeholder="Pilih Modul ..." class="select2 wajib" tabindex="2" name="materi_modul_id[]" id="materi_modul_id_0">
                                            <option value=""></option>
                                            <?php foreach($modul as $k => $v){ ?>
                                                <option value="<?php echo $v['SILABUS_ID']; ?>"><?php echo $v['SILABUS_NAME']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select data-placeholder="Pilih Pengajar ..." class="select2 wajib" tabindex="2" name="materi_instructor_id[]" id="materi_instructor_id_0">
                                            <option value=""></option>
                                            <?php foreach($instructor as $k => $v){ ?>
                                                <option value="<?php echo $v['INSTRUCTOR_ID']; ?>"><?php echo $v['INSTRUCTOR_NAME']." ".$v['INSTRUCTOR_LAST_TITLE']; ?></option>
                                            <?php } ?>
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
    //$(".select2").select2({allowClear: true,width: "100%"});
    //$("#materi_instructor_id_0").select2({allowClear: true,width: "100%"});
    //$("#materi_modul_id_0").select2({allowClear: true,width: "100%"});
});
$('#add_requisite').click(function(){
    var ref = ($(this).attr('data-ref')*1)+1;
    var list = '<tr id="rw_requisite_'+ref+'">'+
                    '<td>'+
                        '<input type="hidden" class="form-control" name="materi_id[]" id="materi_id_'+ref+'" value="0">'+
                    '</td>'+
                    '<td>'+
                         '<select data-placeholder="Pilih Modul ..." class="select2 wajib" name="materi_modul_id[]" id="materi_modul_id_'+ref+'">'+
                            $('#materi_modul_id_0').html()+
                        '</select>'+
                    '</td>'+
                    '<td>'+
                        '<select data-placeholder="Pilih Modul ..." class="select2 wajib" name="materi_instructor_id[]" id="materi_instructor_id_'+ref+'">'+
                            $('#materi_instructor_id_0').html()+
                        '</select>'+
                    '</td>'+
                    '<td widt="5%">'+
                        '<a href="javascript:void(0);" class="icon-cancel-circle2 remove" data-ref="'+ref+'" style="color:red;"></a>'+
                    '</td>'+
                '</tr>';
    $('#list_requisite').append(list);
    $("#materi_modul_id_"+ref).select2({width: "100%"});
    $("#materi_modul_id_"+ref+" option").prop("selected", false);
    $("#materi_modul_id_"+ref).select2('val', 'All');
    $("#materi_instructor_id_"+ref).select2({width: "100%"});
    $("#materi_instructor_id_"+ref+" option").prop("selected", false);
    $("#materi_instructor_id_"+ref).select2('val', 'All');

    $(this).attr('data-ref',(ref+1));
});

 $('body').on('click', '.remove', function () {
    var ref = $(this).attr('data-ref')*1;
    $('#rw_materi_'+ref).remove();
}); 


</script>