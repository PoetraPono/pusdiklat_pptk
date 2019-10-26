<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Tambah Data Diklat</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data Diklat</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Diklat <span class="mandatory">*</span> : </label>
                <div class="col-sm-4">
                    <?php echo $diklat['PROGRAM_NAME']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jadwal Dari<span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                   <?php echo date('d M Y',strtotime($diklat['PROGRAM_START'])); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Sampai <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                     <?php echo date('d M Y',strtotime($diklat['PROGRAM_END'])); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Kouta <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-4">
                   <?php echo $diklat['PROGRAM_TOTAL_HOURS']; ?>
                </div>
            </div>

             <div class="form-group">
			    <label for="nama_katering" class="col-sm-2 control-label text-right">Katering<span class="field-required">*</span></label>
			      <div class="col-sm-6">
			         <?php echo $katering['CATERING_NAME']; ?>
			     </div>
			 </div> 

            <div class="form-group">
                <label for="nama_materi" class="col-sm-2 control-label text-right">
                    Materi <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-10">
                    <select id="nama_materi" class="select-multiple wajib" multiple="multiple" name="nama_materi" data-placeholder="Pilih Nama Materi">
                        <option></option>
                        <option value="1">Nama Materi 1</option>
                        <option value="2">Nama Materi 2</option>
                        <option value="3">Nama Materi 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="panel-group" id="panel">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right"">Pilih File: </label>
                <div class="col-sm-10">
                    <input type="file" class="styled">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                    <a href="<?php echo base_url();?>diklat/diklat2" class="btn btn-xs btn-primary">Kembali</a>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
    $('#nama_materi').change(function(){

        var value = $('#nama_materi').val();
        //$('#panel').empty();
        $('.positions').each(function() {
            if($.inArray($(this).attr('rel'), value)) {
                $(this).remove();
            }
        });

// //        $.ajax({
// //            url: "<?php //echo site_url('master/proposal/posisi')?>//",
// //            type: "POST",
// //            dataType: "JSON",
// //            data : {id : value+""},
// //            success: function (data) {
// //                var obj = new Object(data);
// //                for (var i = 0; i < Object.keys(data).length; i++) {
// //                    if($('.position-'+ data[i]['function_id']).length==0) {
//                         var innerpanel = "<div class='col-sm-offset-2 panel panel-primary positions position-1' rel='1'>" +
//                             "<div class='panel-heading'>" +
//                             "<h6 class='panel-title'>" +
//                             "<a data-toggle='collapse' href='#1'> Nama Materi </a>" +
//                             "</h6>" +
//                             "</div>" +
//                             "<div id='1' class='panel-collapse collapse'>" +
//                             "<div id='aa" + "' class='panel-body'>" +
//                             "<div class='form-group'>" +
//                             "<label class='col-sm-1 control-label text-right'>" +
//                             "Pegawai " +
//                             "</label>" +
//                             "<div class='col-sm-11'>" +
//                             "<select class='select-pegawai select-pegawai-idelem-" + " wajib employee' multiple='multiple' name='project_team_employee_id[]' data-placeholder='Pilih Nama Pegawai'>" +
//                             "<option value='1'>Nama Pengajar" + "</option>" +
//                             "<option value='2'>Nama Pengajar" + "</option>" +
//                             "<option value='3'>Nama Pengajar" + "</option>" +
//                             "<option value='4'>Nama Pengajar" + "</option>" +
//                             "<option value='5'>Nama Pengajar" + "</option>" +
//                             "<option value='6'>Nama Pengajar" + "</option>" +
//                             "</select>" +
//                             "</div>" +
//                             "</div>" +
//                             "<div class='col-sm-12'>" +
//                             "<div class='panel-group panel-" + "'>" +
//                             "</div>" +
//                             "</div>" +
//                             "</div>" +
//                             "</div>" +
//                             "</div>";

//                         $('#panel').append(innerpanel);

//                         $(".select-pegawai-idelem-").select2({
//                             width: "100%"
//                         });
// //                    }
// //                }
// //            }
// //        });
//     });

    $('#panel').delegate('.select-pegawai', 'change', function() {
        var rel = $(this).parents('.positions');
        //alert(rel.attr('rel'));
        var val = $(this).val();
        //alert(val.replace(",","|"));
        var value = rel.attr('rel');
//        alert(val);
//        alert(value);

        $('.uraian-'+value).each(function() {
            //alert($(this).attr('rel'));
            if($.inArray($(this).attr('rel'), val)) {
                $(this).remove();
            }
        });
        //alert(encodeURI(val));
    //     $.ajax({
    //         url: "<?php echo site_url('master/proposal/pegawai')?>",
    //         type: "POST",
    //         dataType: "JSON",
    //         data : {id : val+""},
    //         success: function (data) {
    //             var obj = new Object(data);
    //             var select =$('#aa' + value);
    //             for (var i = 0; i < Object.keys(data).length; i++) {
    //                 if($('.uraian-'+value+'-'+ data[i]['employee_id']).length==0) {
    //                     var forurian = "<div class='panel panel-primary uraian-"+value+" uraian-"+value+"-" + data[i]['employee_id'] + "' rel='" + data[i]['employee_id'] + "'>" +
    //                         "<div class='panel-heading'>" +
    //                         "<h6 class='panel-title'>" +
    //                         "<a data-toggle='collapse' href='" + '#bb' + "" + data[i]['employee_id'] + ""+value+"'>" + data[i]['employee_fullname'] + "</a>" +
    //                         "</h6>" +
    //                         "</div>" +
    //                         "<div id='bb" + data[i]['employee_id'] + ""+value+"' class='panel-collapse collapse'>" +
    //                         "<div class='panel-body'>" +
    //                         "<div class'form-group'>" +
    //                         "<label for='project_team_employee_status' class='col-sm-2 control-label text-right'>" +
    //                         "Status Kepegawaian :" +
    //                         "</label>" +
    //                         "<div class='col-sm-10'>" +
    //                         "<select id='project_team_employee_status' class='pull-right project_team_employee_status-"+ data[i]['employee_id'] +" select2' name='project_team_employee_status[]' data-placeholder='Pilih Status Kepegawaian'>" +
    //                         "<option value='Tetap' selected>Tetap</option>" +
    //                         "<option value='Kontrak'>Kontrak</option>" +
    //                         "</select>" +
    //                         "</div>" +
    //                         "</div>" +
    //                         "<br/>" +
    //                         "<input type='hidden' name='project_team_function_id[]' value='" + value + "'>" +
    //                         "<br/>" +
    //                         "<div class='table-responsive'>" +
    //                         "<table class='table table-striped table-bordered table-hover' id='dataaktif"+ data[i]['employee_id'] +"'>" +
    //                         "<thead>" +
    //                         "<tr>" +
    //                         "<th class='text-center'>Pilih</th>" +
    //                         "<th class='text-center' style='min-width:400px;width:400px'>Project Name</th>" +
    //                         "<th class='text-center'>Posisi</th>" +
    //                         "<th class='text-center'>Waktu</th>" +
    //                         "<th class='text-center'>Durasi</th>" +
    //                         "</tr>" +
    //                         "</thead>" +
    //                         "</table>" +
    //                         "</div>" +
    //                         "</div>" +
    //                         "</div>" +
    //                         "</div>";
    //                     select.append(forurian);
    //                     $(".project_team_employee_status-"+data[i]['employee_id']).select2({
    //                         width: "100%"
    //                     });
    //                     table(data[i]['employee_id']);
    //                 }
    //             }
    //         }
    //     });
    // });
</script>