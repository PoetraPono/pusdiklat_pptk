<style>
  .input-sm { height: 26px; }
</style>

<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href='javascript:void(0);'>Info Diklat</a></li>
    <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
    <li class="active">List Absensi </li>
  </ul>
  <div class="visible-xs breadcrumb-toggle">
    <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
  </div>
</div>
<form class="form-horizontal need_validationS" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h6 class="panel-title"><i class="icon-copy"></i>List Absensi </h6>
    </div>
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h6 class="panel-title"><i class="icon-file6"></i>Detail Program Diklat</h6>
        </div>
        <div class="panel-body form-horizontal ">
          <div class="form-group" style="margin-bottom: 0px;">
            <label for="" class="col-sm-2 control-label text-right">Nama Program :</label>
            <div class="col-sm-10 control-label">
              <?php echo $diklat['PROGRAM_NAME']; ?>
              <input type="hidden" id="PROGRAM_ID" name="PROGRAM_ID" value="<?php echo $diklat['PROGRAM_ID']; ?>">
              <input type="hidden" id="PROGRAM_START" name="PROGRAM_START" value="<?php echo $diklat['PROGRAM_START']; ?>">
              <input type="hidden" id="PROGRAM_END" name="PROGRAM_END" value="<?php echo $diklat['PROGRAM_END']; ?>">
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <label for="" class="col-sm-2 control-label text-right">Deskripsi Program :</label>
            <div class="col-sm-10 control-label">
              <?php echo $diklat['PROGRAM_DESCRIPTION']; ?>
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <label for="" class="col-sm-2 control-label text-right">Tanggal Pelatihan :</label>
            <div class="col-sm-5 control-label" style="margin-right:-50px;">
              <?php echo date('d M Y',strtotime($diklat['PROGRAM_START'])); ?> s.d <?php echo date('d M Y',strtotime($diklat['PROGRAM_END'])); ?>
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <label for="" class="col-sm-2 control-label text-right">Total Kuota :</label>
            <div class="col-sm-5 control-label" style="margin-right:-50px;">
              <?php echo ($diklat['PROGRAM_TOTAL_KUOTA']!="")?$diklat['PROGRAM_TOTAL_KUOTA']." Peserta":"-"; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="info-buttons" style="margin-top: -30px;">
        <div class="row">
          <div class="col-sm-12 control-label">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-table2"></i> Absensi</h6>
              </div>
              <div class="panel-body">
                <div class="tabbable">
                  <ul class="nav nav-pills nav-justified">
                    <?php $n = 0; foreach($listdate as $k => $v){?>
                      <li class="<?php echo ($n ==0 ? 'active':''); ?>"><a href="#<?php echo $k; ?>" data-toggle="tab"> <?php echo $v['date']; ?></a></li>
                    <?php $n++; } ?>                                        
                  </ul>

                  <div class="tab-content pill-content">
                    <?php $n = 0; foreach($listdate as $k => $v){?>
                     
                      <div class="tab-pane fade <?php echo ($n == 0 ? 'in active':''); ?>" id="<?php echo $k; ?>">
                        <div class="panel panel-default" style="margin-bottom: 5px !important;">
                          <div class="panel-heading"><h6 class="panel-title"><i class="icon-clock"></i> Daftar Absensi</h6></div>
                          <div class="panel-body">
                            <div class="tabbable">
                                <ul id="myTab" class="nav nav-tabs tab-bricky">
                                    <!-- <li class="active">
                                        <a href="#aktif" data-toggle="tab" data-id="1">Daftar Sertifikat</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="aktif">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataaktif">

                                                <thead style="background-color: gray; ">
                                                    <tr>
                                                        <th class="text-center" style="width: 10px;">No</th>
                                                        <th class="text-center">NIK </th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center" id="status" >Tanggal Absen</th>
                                                        <!-- <th class="text-center" style="min-width:90px;width:180px">Aksi</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; foreach($v['prosen'] as $x => $z){?>
                                                      <tr>
                                                        <td class="text-center"><?php echo $no; ?></td>
                                                        <td class="text-left"><?php echo  $z['MEMBER_NIK']; ?></td>
                                                        <td class="text-left"><?php echo  $z['MEMBER_NAME']; ?></td>
                                                        <td class="text-center"><?php echo date("Y-m-d | H:i:s", strtotime($z['ABSENCE_DATE'])); ?></td>
                                                      </tr>
                                                    <?php $no++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                          </div>
                        </div>

                       

                      </div>
                    <?php $n++; } ?>    
                  </div>
                </div>
              </div>
            </div>                        
          </div>                    
        </div>
      </div>            
      <div class="form-actions text-left">
          <div class="col-sm-12">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4">
              <!-- <button type="submit" class="btn btn-success">Simpan</button> -->
              <a href="<?php echo base_url();?>diklat/absensi" class="btn btn-primary" >Kembali</a>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function getListMenu(wkt, id, procat_id = 0){
    // alert($(ini).val);
    var vendor_id = $("#vendor_id_"+id+"_"+wkt).val();
    $.ajax({
      url       : "<?php echo base_url('diklat/settingkatering/json_getmenus');?>/"+vendor_id+"/"+procat_id,
      type      : "GET",
      dataType  : "JSON",
      success: function(data){
        var sameheader = "";
        var menulist = "";
        $.each(data, function(index) {
            header  ='<div class="col-sm-3" ><table class="table table-condensed">'+
                        '<thead><tr><th colspan="2">'+index+'</th></tr></thead>'+
                        '<tbody>';
            var isi = "";
            if(data[index].length>0){            
              $.each(data[index], function(index2){
                  isi += '<tr><td style="padding: 5px;" width="90%"><div class="checkbox">'+
                          '<label><input type="checkbox" class="styled" '+ data[index][index2]['CHECKED'] +' name="detail_id['+id+']['+wkt+']['+data[index][index2]['ID']+']" value="'+data[index][index2]['ID']+'">'+data[index][index2]['NAME']+'</label>'+
                          '</div></td></tr>';
              });
            }else{
              isi += '<tr><td><i>- tidak ada data -</i></td></tr>'
            }
            footer  ='</tbody></table></div>';
            menulist += header+isi+footer;
        });
        $("#display_menu_"+id+"_"+wkt).html(menulist);
        $(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });

      },
      error: function (jqXHR, textStatus, errorThrown){}
    });
  }
</script>