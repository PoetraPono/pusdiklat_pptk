<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='javascript:void(0);'>Info Diklat</a></li>
        <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
		<li class="active">Tambah Data Program Diklat</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Tambah Data Program Diklat</h6>
		
	</div>
	<div class="panel-body">
        <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Nama Program <span class="mandatory">*</span>  </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control wajib" id="PROGRAM_NAME" name="PROGRAM_NAME" placeholder="Nama Diklat" >
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Deskripsi Program <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-8">
                    <textarea class="form-control wajib" id="PROGRAM_DESCRIPTION" name="PROGRAM_DESCRIPTION" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Jenis Diklat <span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                            <select id="PROGRAM_TYPE" class="select2 wajib" name="PROGRAM_TYPE" data-placeholder="Pilih Jenis Diklat">
                                    <option value="1">Internal</option>
                                    <option value="2">Eksternal</option>
                                    <option value="3">Internal & Eksternal</option>
                                </select>
                    </div><small class="help-block"></small>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Bidang Program <span class="mandatory">*</span>  </label>
                <div class="col-sm-4">
                    <div class="fg-line">
                        
                        <select id="PROGRAM_SECTOR_ID" class="select2 wajib" name="PROGRAM_SECTOR_ID" data-placeholder="Pilih Bidang Pelatihan">
                            <?php if(count($bidang)>0){ ?>
                                    <option value=""> - Pilih Bidang Pelatihan -</option>
                                       <?php foreach ($bidang as $sect) { ?>
                                           <?php 
                                            echo '<option value="'.$sect['SECTOR_ID'].'">'.$sect['SECTOR_NAME'].'</option>';
                                           ?>
                                          <?php } ?> 
                                     <?php }else{ ?>                                 
                                        <option value=""> Data Bidang Kosong!</option>
                                    
                            <?php } ?>
                        </select> 
                    </div><small class="help-block"></small>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">Sasaran Diklat <span class="mandatory">*</span>  </label>
                <div class="col-sm-8" id="list_sasaran">
                    <textarea class="form-control wajib" id="PROGRAM_SASARAN" name="PROGRAM_SASARAN" rows="4"></textarea>
                    <!-- <select data-placeholder="KOTA/KABUPATEN" class="select2 wajib" tabindex="9" name="PROGRAM_SASARAN_ID" id="new_sasaran" placeholder="Sasaran Diklat">
                        <option value=""></option>
                    </select> -->
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jadwal dari<span class="mandatory">*</span> :
                </label>
                <div class="col-sm-2">
                    <input type="text" class="datepicker form-control wajib" id="PROGRAM_START" name="PROGRAM_START" placeholder="tanggal mulai">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Sampai <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-2">
                    <input type="text" class="datepicker form-control wajib" id="PROGRAM_END" name="PROGRAM_END" placeholder="tanggal selesai">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Mata Ajar <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control wajib" placeholder="jumlah mata ajar" id="PROGRAM_TOTAL_LESSON" name="PROGRAM_TOTAL_LESSON">
                </div>
            </div>
             <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Jam Pelatihan <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control wajib" placeholder="total jam" id="PROGRAM_TOTAL_HOURS" name="PROGRAM_TOTAL_HOURS">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Kuota Peserta<span class="mandatory">*</span> :
                </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control wajib" placeholder="jumlah kuota" id="PROGRAM_TOTAL_KUOTA" name="PROGRAM_TOTAL_KUOTA">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right"">File Lampiran</label>
                <div class="col-sm-4">
                    <input type="file" class="styled" name="attach_path" id="attach_path" accept="application/msword, application/pdf">
                    <span class="help-block">jenis file yang diijinkan doc & pdf</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right"">Photo</label>
                <div class="col-sm-4">
                    <input type="file" class="styled" name="gambar_path" id="gambar_path" accept="image/*">
                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label text-right">
                    Pre Requisite <span class="mandatory">*</span> :
                </label>
                <div class="col-sm-8">
                    <textarea class="form-control wajib" id="PROGRAM_RQUISITE" name="PROGRAM_RQUISITE" rows="4"></textarea>
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
        /*$("#new_negara").change(function(){
            getprovinsi();
        })*/
        $("#PROGRAM_SECTOR_ID").change(function(){
            getsasaran();
        })

        function getsasaran(){
            $.ajax({
                url : "<?php echo base_url('diklat/program/json_sasaran');?>/"+ $("#PROGRAM_SECTOR_ID").val(),
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    var getlist = '<option value="" selected></option>';
                    $.each(data, function(index) {
                        getlist += '<option value="'+ data[index].TINDAK_PIDANA_ID +'">'+ data[index].TINDAK_PIDANA_NAME +'</option>';
                    });
                    $("#new_sasaran").html(getlist);
                    $("#new_sasaran").select2('destroy').select2({
                        placeholder: "Select a State",
                        allowClear: true,
                        width: "100%"
                    });
                },
                error: function (jqXHR, textStatus, errorThrown){}
            });
        }
    </script>

<script type="text/javascript">
    $('#nama_materi').change(function(){

        var value = $('#nama_materi').val();
        //$('#panel').empty();
        $('.positions').each(function() {
            if($.inArray($(this).attr('rel'), value)) {
                $(this).remove();
            }
        });

//        $.ajax({
//            url: "<?php //echo site_url('master/proposal/posisi')?>//",
//            type: "POST",
//            dataType: "JSON",
//            data : {id : value+""},
//            success: function (data) {
//                var obj = new Object(data);
//                for (var i = 0; i < Object.keys(data).length; i++) {
//                    if($('.position-'+ data[i]['function_id']).length==0) {
                        var innerpanel = "<div class='col-sm-offset-2 panel panel-primary positions position-1' rel='1'>" +
                            "<div class='panel-heading'>" +
                            "<h6 class='panel-title'>" +
                            "<a data-toggle='collapse' href='#1'> Nama Materi </a>" +
                            "</h6>" +
                            "</div>" +
                            "<div id='1' class='panel-collapse collapse'>" +
                            "<div id='aa" + "' class='panel-body'>" +
                            "<div class='form-group'>" +
                            "<label class='col-sm-1 control-label text-right'>" +
                            "Pegawai " +
                            "</label>" +
                            "<div class='col-sm-11'>" +
                            "<select class='select-pegawai select-pegawai-idelem-" + " wajib employee' multiple='multiple' name='project_team_employee_id[]' data-placeholder='Pilih Nama Pegawai'>" +
                            "<option value='1'>Nama Pengajar" + "</option>" +
                            "<option value='2'>Nama Pengajar" + "</option>" +
                            "<option value='3'>Nama Pengajar" + "</option>" +
                            "<option value='4'>Nama Pengajar" + "</option>" +
                            "<option value='5'>Nama Pengajar" + "</option>" +
                            "<option value='6'>Nama Pengajar" + "</option>" +
                            "</select>" +
                            "</div>" +
                            "</div>" +
                            "<div class='col-sm-12'>" +
                            "<div class='panel-group panel-" + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>";

                        $('#panel').append(innerpanel);

                        $(".select-pegawai-idelem-").select2({
                            width: "100%"
                        });
//                    }
//                }
//            }
//        });
    });

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
        $.ajax({
            url: "<?php echo site_url('master/proposal/pegawai')?>",
            type: "POST",
            dataType: "JSON",
            data : {id : val+""},
            success: function (data) {
                var obj = new Object(data);
                var select =$('#aa' + value);
                for (var i = 0; i < Object.keys(data).length; i++) {
                    if($('.uraian-'+value+'-'+ data[i]['employee_id']).length==0) {
                        var forurian = "<div class='panel panel-primary uraian-"+value+" uraian-"+value+"-" + data[i]['employee_id'] + "' rel='" + data[i]['employee_id'] + "'>" +
                            "<div class='panel-heading'>" +
                            "<h6 class='panel-title'>" +
                            "<a data-toggle='collapse' href='" + '#bb' + "" + data[i]['employee_id'] + ""+value+"'>" + data[i]['employee_fullname'] + "</a>" +
                            "</h6>" +
                            "</div>" +
                            "<div id='bb" + data[i]['employee_id'] + ""+value+"' class='panel-collapse collapse'>" +
                            "<div class='panel-body'>" +
                            "<div class'form-group'>" +
                            "<label for='project_team_employee_status' class='col-sm-2 control-label text-right'>" +
                            "Status Kepegawaian :" +
                            "</label>" +
                            "<div class='col-sm-10'>" +
                            "<select id='project_team_employee_status' class='pull-right project_team_employee_status-"+ data[i]['employee_id'] +" select2' name='project_team_employee_status[]' data-placeholder='Pilih Status Kepegawaian'>" +
                            "<option value='Tetap' selected>Tetap</option>" +
                            "<option value='Kontrak'>Kontrak</option>" +
                            "</select>" +
                            "</div>" +
                            "</div>" +
                            "<br/>" +
                            "<input type='hidden' name='project_team_function_id[]' value='" + value + "'>" +
                            "<br/>" +
                            "<div class='table-responsive'>" +
                            "<table class='table table-striped table-bordered table-hover' id='dataaktif"+ data[i]['employee_id'] +"'>" +
                            "<thead>" +
                            "<tr>" +
                            "<th class='text-center'>Pilih</th>" +
                            "<th class='text-center' style='min-width:400px;width:400px'>Project Name</th>" +
                            "<th class='text-center'>Posisi</th>" +
                            "<th class='text-center'>Waktu</th>" +
                            "<th class='text-center'>Durasi</th>" +
                            "</tr>" +
                            "</thead>" +
                            "</table>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                        select.append(forurian);
                        $(".project_team_employee_status-"+data[i]['employee_id']).select2({
                            width: "100%"
                        });
                        table(data[i]['employee_id']);
                    }
                }
            }
        });
    });
</script>