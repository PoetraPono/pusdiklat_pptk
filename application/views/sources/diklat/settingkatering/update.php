<style>
  .input-sm { height: 26px; }
</style>

<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href='javascript:void(0);'>Info Diklat</a></li>
    <li><a href='<?php echo base_url()."diklat/program"; ?>'>Program Diklat</a></li>
    <li class="active">Setting Katering</li>
  </ul>
  <div class="visible-xs breadcrumb-toggle">
    <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
  </div>
</div>
<form class="form-horizontal need_validationS" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h6 class="panel-title"><i class="icon-copy"></i>Setting Katering</h6>
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
                <h6 class="panel-title"><i class="icon-table2"></i> Daftar Katering</h6>
              </div>
              <div class="panel-body">
                <div class="tabbable">
                  <ul class="nav nav-pills nav-justified">
                    <?php $n = 0; foreach($listdate as $k => $v){?>
                      <li class="<?php echo ($n ==0 ? 'active':''); ?>"><a href="#<?php echo $k; ?>" data-toggle="tab"> <?php echo $k; ?></a></li>
                    <?php $n++; } ?>                                        
                  </ul>
                  <div class="tab-content pill-content">
                    <?php $n = 1; foreach($listdate as $k => $v){?>
                      <script type="text/javascript">
                        $(document).ready(function(){
                          getListMenu(1,'<?php echo $n; ?>', '<?php echo $listdate[$k][1]['PROCAT_ID']; ?>');
                        });
                        $(document).ready(function(){
                          getListMenu(2,'<?php echo $n; ?>', '<?php echo $listdate[$k][2]['PROCAT_ID']; ?>');
                        });
                        $(document).ready(function(){
                          getListMenu(3,'<?php echo $n; ?>', '<?php echo $listdate[$k][3]['PROCAT_ID']; ?>');
                        });
                      </script>

                      <div class="tab-pane fade <?php echo ($n == 1 ? 'in active':''); ?>" id="<?php echo $k; ?>">
                        <div class="panel panel-default" style="margin-bottom: 5px !important;">
                          <div class="panel-heading"><h6 class="panel-title"><i class="icon-clock"></i> Pagi</h6></div>
                          <div class="panel-body">
                            <div class="form-group" style="margin-bottom: 0px;">
                              <label for="" class="col-sm-2 control-label">Vendor Katering</label>
                              <input type="hidden" name="cat_date[<?php echo $n; ?>]" value="<?php echo $k; ?>">
                              <div class="col-sm-4">
                                <div class="fg-line">
                                  <select class="form-control  wajib" id="vendor_id_<?php echo $n; ?>_1" name="vendor_id[<?php echo $n; ?>][1]" data-placeholder="PILIH VENDOR" onchange="getListMenu(1,'<?php echo $n; ?>')">
                                    <option value="">PILIH VENDOR</option>
                                    <?php foreach($katering as $xx => $vv){
                                      $selected = "";
                                      $selected = ($vv['CATERING_ID']==$listdate[$k][1]['PROCAT_CATERING_ID'])?'selected':'';
                                      echo '<option value="'.$vv['CATERING_ID'].'" '.$selected.'>'.$vv['CATERING_NAME'].'</option>';
                                    } ?>
                                  </select>
                                </div>
                                <small class="help-block"></small>
                              </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;" id="display_menu_<?php echo $n ?>_1">                          
                            </div>
                          </div>
                        </div>

                        <div class="panel panel-default" style="margin-bottom: 5px !important;">
                          <div class="panel-heading"><h6 class="panel-title"><i class="icon-clock"></i> Siang</h6></div>
                          <div class="panel-body">
                            <div class="form-group" style="margin-bottom: 0px;">
                              <label for="" class="col-sm-2 control-label">Vendor Katering</label>                                       
                              <input type="hidden" name="cat_date[<?php echo $n; ?>]" value="<?php echo $k; ?>">
                              <div class="col-sm-4">
                                <div class="fg-line">
                                  <select class="form-control  wajib" id="vendor_id_<?php echo $n; ?>_2" name="vendor_id[<?php echo $n; ?>][2]" data-placeholder="PILIH VENDOR" onchange="getListMenu(2,'<?php echo $n; ?>')">
                                    <option value="">PILIH VENDOR</option>
                                    <?php foreach($katering as $xx => $vv){
                                      $selected = "";
                                      $selected = ($vv['CATERING_ID']==$listdate[$k][2]['PROCAT_CATERING_ID'])?'selected':'';
                                      echo '<option value="'.$vv['CATERING_ID'].'" '.$selected.'>'.$vv['CATERING_NAME'].'</option>';
                                    } ?>
                                  </select>
                                </div>
                                <small class="help-block"></small>
                              </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;" id="display_menu_<?php echo $n ?>_2">                          
                            </div>
                          </div>
                        </div>
                        
                        <div class="panel panel-default" style="margin-bottom: 5px !important;">
                          <div class="panel-heading"><h6 class="panel-title"><i class="icon-clock"></i> Malam</h6></div>
                          <div class="panel-body">
                            <div class="form-group" style="margin-bottom: 0px;">
                              <label for="" class="col-sm-2 control-label">Vendor Katering</label>                                       
                              <input type="hidden" name="cat_date[<?php echo $n; ?>]" value="<?php echo $k; ?>">
                              <div class="col-sm-4">
                                <div class="fg-line">
                                  <select class="form-control  wajib" id="vendor_id_<?php echo $n; ?>_3" name="vendor_id[<?php echo $n; ?>][3]" data-placeholder="PILIH VENDOR" onchange="getListMenu(3,'<?php echo $n; ?>')">
                                    <option value="">PILIH VENDOR</option>
                                    <?php foreach($katering as $xx => $vv){
                                      $selected = "";
                                      $selected = ($vv['CATERING_ID']==$listdate[$k][3]['PROCAT_CATERING_ID'])?'selected':'';
                                      echo '<option value="'.$vv['CATERING_ID'].'" '.$selected.'>'.$vv['CATERING_NAME'].'</option>';
                                    } ?>
                                  </select>
                                </div>
                                <small class="help-block"></small>
                              </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;" id="display_menu_<?php echo $n ?>_3">                          
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
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="<?php echo base_url();?>diklat/settingkatering" class="btn btn-primary">Kembali</a>
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