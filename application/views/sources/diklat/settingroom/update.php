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
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="" class="col-sm-2 control-label text-right">Nama Program : </label>
                <div class="col-sm-10 control-label">
                    <?php echo $diklat['PROGRAM_NAME']; ?>
                    <input type="hidden" id="PROGRAM_ID" name="PROGRAM_ID" value="<?php echo $diklat['PROGRAM_ID']; ?>">
                    <input type="hidden" id="PROGRAM_START" name="PROGRAM_START" value="<?php echo $diklat['PROGRAM_START']; ?>">
                    <input type="hidden" id="PROGRAM_END" name="PROGRAM_END" value="<?php echo $diklat['PROGRAM_END']; ?>">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="" class="col-sm-2 control-label text-right">Deskripsi Program : </label>
                <div class="col-sm-10 control-label">
                    <?php echo $diklat['PROGRAM_DESCRIPTION']; ?>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0px;">
                <label for="" class="col-sm-2 control-label text-right">
                    Tanggal Pelatihan :
                </label>
                <div class="col-sm-2 control-label" style="margin-right:-50px;">
                   <?php echo date('d M Y',strtotime($diklat['PROGRAM_START'])); ?>
                </div>
                <label for="" class="col-sm-1 control-label" style="margin-right:-50px; margin-left:-50px;">
                   s.d
                </label>
                <div class="col-sm-2 control-label">
                     <?php echo date('d M Y',strtotime($diklat['PROGRAM_END'])); ?>
                </div>
            </div>
            <div class="info-buttons">
                <div class="row">
                    <div class="col-sm-8 control-label">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> Daftar Kamar</h6>
                            </div>
                            <div class="panel-body">
                            <div class="col-lg-12">
                            <div class="row block-inner">
                                <?php $x = 0; foreach($room as $k => $v){ 
                                    $ROOM_STATUS = ($v['ROOMS_IS_FULL'] == 1 && $v['ROOM_ISI'] == 0 ? 1 : 0);
                                ?>
                                    <?php if($v['ROOM_ACTIVE'] == 1){ ?>
                                        <?php if($ROOM_STATUS == 0){ ?>
                                            <div class="col-md-2" style="margin-bottom: 5px;display: block;height: 145px; padding-left: 2px; padding-right: 2px;" >
                                                <a href="javascript:void(0);" class="rooms" id="room_<?php echo $v['ROOMS_ID']; ?>" style="border-radius: 4px;  border: 1px solid #BADA55; padding-left: 5px; padding-right: 5px; <?php echo ($v['ROOM_STATUS'] > 0 ? "background-color:red; color:black;" : "0"); ?> " data-capactity="<?php echo $v['ROOMS_CAPACITY']; ?>" is-active="<?php echo ($v['ROOM_STATUS'] > 0 ? "2" : "0"); ?>" room-id="<?php echo $v['ROOMS_ID']; ?>"  <?php echo ($v['ROOM_STATUS'] == 0 ?  'onclick="chooseRoom(this)"' : ""); ?> room-no="<?php echo $v['ROOMS_NUMBER']; ?>">
                                                <i class=""><?php echo $v['ROOMS_NUMBER']; ?></i>
                                                <span style="margin-top:-8px;"><?php echo substr($v['ROOMS_NAME'],0,17); ?></span>
                                                <?php if($v['ROOM_STATUS'] == 0){
                                                    $list = $v['LIST_ISI'];
                                                ?>
                                                <?php $j = 0; foreach($list as $l => $x){ ?>
                                                    <span class="space space_<?php echo $v['ROOMS_ID']; ?>" id="space_no_<?php echo  $v['ROOMS_ID'].'_'.$j; ?>" isi="<?php echo $x['PROPAR_ID']; ?>" gender="<?php echo $x['MEMBER_GENDER']; ?>"><?php echo substr($x['MEMBER_NAME'],0,17); ?><input type="hidden" name="booking[]" value="<?php echo $v['ROOMS_ID']."|".$x["PROPAR_ID"]; ?>"></span>
                                                <?php $j++; } ?>
                                                <?php for($i=$j; $i < $v['ROOMS_CAPACITY']; $i++){ ?>
                                                    <span class="space space_<?php echo $v['ROOMS_ID']; ?>" id="space_no_<?php echo  $v['ROOMS_ID'].'_'.$i; ?>" isi="0" gender="">...</span>
                                                <?php } ?>
                                                <?php }else{ ?>
                                                    <span >&emsp;</span>
                                                    <span >&emsp;</span>
                                                <?php } ?>
                                                <strong href="javascript:void(0)" class="label label-danger" id="reset_room_<?php echo  $v['ROOMS_ID']; ?>" onclick="resetRoom(<?php echo  $v['ROOMS_ID']; ?>)"><?php echo ($v['ROOM_ISI'] == 0 ? "" : "X"); ?></strong>
                                                </a>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="col-md-2" style="margin-bottom: 5px;display: block;height: 125px; padding-left: 2px; padding-right: 2px;" >
                                                <a href="javascript:void(0);" class="" id="room_<?php echo $v['ROOMS_ID']; ?>" style="border-radius: 4px;  border: 1px solid #BADA55; padding-left: 5px; padding-right: 5px; background-color:red; color:black;" data-capactity="<?php echo $v['ROOMS_CAPACITY']; ?>" is-active="0" room-id="<?php echo $v['ROOMS_ID']; ?>"  room-no="<?php echo $v['ROOMS_NUMBER']; ?>">
                                                <i class=""><?php echo $v['ROOMS_NUMBER']; ?></i>
                                                <span style="margin-top:-8px;"><?php echo substr($v['ROOMS_NAME'],0,17); ?></span>
                                                <span >Isi</span>
                                                <span >&emsp;</span>
                                                <strong href="javascript:void(0)" class="label label-danger" id="reset_room_<?php echo  $v['ROOMS_ID']; ?>" onclick="resetRoom(<?php echo  $v['ROOMS_ID']; ?>)"><?php echo ($v['ROOM_ISI'] == 0 ? "" : "X"); ?></strong>
                                                </a>
                                            </div>
                                        <?php } ?>  
                                    <?php }else{ ?>
                                        <div class="col-md-2" style="margin-bottom: 5px;display: block;height: 125px; padding-left: 2px; padding-right: 2px;" >
                                            <a href="javascript:void(0);" class="" id="room_<?php echo $v['ROOMS_ID']; ?>" style="border-radius: 4px;  border: 1px solid #BADA55; padding-left: 5px; padding-right: 5px; background-color:grey; color:black;" data-capactity="<?php echo $v['ROOMS_CAPACITY']; ?>" is-active="0" room-id="<?php echo $v['ROOMS_ID']; ?>"  room-no="<?php echo $v['ROOMS_NUMBER']; ?>">
                                            <i class=""><?php echo $v['ROOMS_NUMBER']; ?></i>
                                            <span style="margin-top:-8px;"><?php echo substr($v['ROOMS_NAME'],0,17); ?></span>
                                            <span >Non Aktif</span>
                                            <span >&emsp;</span>
                                            <strong href="javascript:void(0)" class="label label-danger" id="reset_room_<?php echo  $v['ROOMS_ID']; ?>" onclick="resetRoom(<?php echo  $v['ROOMS_ID']; ?>)"><?php echo ($v['ROOM_ISI'] == 0 ? "" : "X"); ?></strong>
                                            </a>
                                        </div>
                                    <?php } ?>  
                                <?php } ?>
                            </div>      
                        </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-4 control-label">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> Daftar Peserta</h6></div>
                            <div class="table-responsive" style="display: block; height: 330px; overflow-y: scroll;">
                                <table class="table table-condensed">
                                    <tbody id="list_peserta">
                                    <?php foreach($peserta as $k => $v){ ?>
                                        <tr class="rw_ck" id="rw_ck_<?php echo $v['PROPAR_ID']; ?>" <?php echo ($v['STATUS_BOOKING'] == 1 ? "style='background-color:#dcdcdc;'" : ""); ?>>
                                            <td style="padding: 5px;" width="90%">
                                                <div class="checkbox">
                                                    <label>
                                                        <div class="checker">
                                                        <span >
                                                        <input type="checkbox" class="styled chooseMember" id="member_<?php echo $v['PROPAR_ID']; ?>" value="<?php echo $v['PROPAR_ID']; ?>" isactive="<?php echo ($v['STATUS_BOOKING'] == 1 ? "1" : "0"); ?>" disabled data-text="<?php echo $v['MEMBER_NAME']; ?>" isgender="<?php echo $v['MEMBER_GENDER']; ?>" <?php echo ($v['STATUS_BOOKING'] == 1 ? "checked='checked'" : ""); ?><?php echo ($v['STATUS_BOOKING'] == 1 ? "disabled" : ""); ?> >
                                                        </span>
                                                        </div>
                                                        <?php echo $v['MEMBER_NAME']; ?>
                                                    </label>
                                                </div>
                                            </td>   
                                            <td>
                                                <?php echo $v['MEMBER_GENDER']; ?> 
                                            </td>                                 
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        
                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>
                        <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-xs btn-info" type="button" onclick="GenerateAuto(1)"><i class="icon-shuffle"></i> Mengatur Otomatis</button>
                            <button class="btn btn-xs btn-success" type="button" onclick="resetAllRoom()"><i class="icon-loop"></i> Reset&emsp;&emsp;</button>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                            <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                                <button type="submit" class="btn btn-primary"><i class="icon-disk"></i> Simpan Data &emsp;&emsp;</button>
                                <button type="button" onclick="backForm()"  class="btn btn-danger"><i class="icon-arrow-left"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function($) {
   
});
function removeRoom(ini){
    alert(ini);
}
function chooseRoom(ini){
   var roomid = $(ini).attr('room-id');
   var isactive = $(ini).attr('is-active');
   $('.rooms').css({
       'background-color': '#fafafa'
   });
   $('#rw_ck').css({"background-color":"#dcdcdc"});
   $('.chooseMember').prop("disabled",true);
   if(isactive == 0){
        $("#room_"+roomid).css({"background-color":"#7FFFD4", "color":"black"});        
        $('.rooms').each(function() {
            var ck = $(this).attr('is-active');
            if(ck == 2){
                $(this).css({"background-color":"red", "color":"black"});
                $(this).attr('is-active','2');
            }else{
                $(this).attr('is-active','0');
            }
        });
        $(ini).attr('is-active','1');
        $('.chooseMember').each(function(){
            var memberid = $(this).attr("value");
            var memberstatus = $(this).attr("isactive");
            if(memberstatus == 0){
                $('#rw_ck_'+memberid).css({"background-color":"#ffffff"});
                $('#member_'+memberid).prop("disabled",false);
            }
        });
   } else if(isactive == 1){
        $('.rooms').each(function() {
            var ck = $(this).attr('is-active');
            if(ck == 2){
                $(this).css({"background-color":"red", "color":"black"});
                $(this).attr('is-active','2');
            }else{
                $(this).attr('is-active','0');
            }
        });
        $(ini).attr('is-active','0');        
   }else{
        $("#room_"+roomid).css({"background-color":"red"});
   }

}

$('.chooseMember').click(function() {
    if(this.checked){
        var memberid = $(this).val();
        var name = $(this).attr('data-text');
        var membergender = $(this).attr('isgender');
        var roomid = 0;
        $('.rooms').each(function(){
            if($(this).attr('is-active') == 1){
                roomid = $(this).attr('room-id');
            }
        });
        var i = 0;
        var n = 0;
        var gender = "";
        $('.space_'+roomid).each(function() {            
            if($(this).attr('isi')==0){
                var isoke = 0;
                if(gender == ""){
                    isoke = 1;                    
                }else{
                    if(gender == membergender){
                        isoke = 1;                        
                    }
                }
                if(isoke == 1){
                    var input = "<input type='hidden' name='booking[]' value='"+roomid+"|"+memberid+"'>";
                    $('#space_no_'+roomid+'_'+i).html(name.substring(0,17) + input);
                    $(this).attr('isi',memberid);
                    $(this).attr('gender',membergender);
                    $('#rw_ck_'+memberid).css({"background-color":"#dcdcdc"});
                    $('#member_'+memberid).prop("disabled",true);
                    $('#member_'+memberid).attr("isactive",1);
                    $('#reset_room_'+roomid).html("X");
                    n++;
                    return false;  
                }else{
                    alert("Maaf Laki-laki dan Perempuan tidak diperbolehkan dalam satu kamar");
                    $('#member_'+memberid).prop("checked",false);
                }                           
            }else{
                gender = $(this).attr('gender');
            }
            i++;
        });
        if(n==0){
            $('#member_'+memberid).prop("checked",false);            
        }
    }
});

function resetRoom(roomid){
    $('.space_'+roomid).each(function() {
        $(this).html("").html("...");
        var memberid =  $(this).attr("isi");
        $('#rw_ck_'+memberid).css({"background-color":"#fffff"});
        $('#member_'+memberid).prop("disabled",true);
        $('#member_'+memberid).attr("isactive",0);
        $('#member_'+memberid).prop("checked",true);
        $('#uniform-member_'+memberid).removeClass('disabled');
        $(this).attr("isi",0);
        $(this).attr('gender',"");
    });
    $('#reset_room_'+roomid).html("");
    setTimeout(function(){ 
        $("#room_"+roomid).css({"background-color":"#7FFFD4", "color":"black"});
        $('.rooms[is-active="1"]').attr('is-active','0');
        $("#room_"+roomid).attr('is-active','1');
        $('.chooseMember').each(function(){
            var memberid = $(this).attr("value");
            var memberstatus = $(this).attr("isactive");
            if(memberstatus == 0){
                $('#rw_ck_'+memberid).css({"background-color":"#ffffff"});
                $('#member_'+memberid).prop("disabled",false);
                $('#member_'+memberid).prop("checked",false);
                $('#member_'+memberid).parent().removeClass('checked');
            }
        }); 
    }, 100);
    
}
function GenerateAuto(x){
    var jmlall = $('.chooseMember').length;
    var jmlblmisi = ($('.chooseMember[isactive="0"]').length) * 1;
    if(jmlblmisi > 0){
        $('.chooseMember[isactive="0"]').shuffle().each(function() {
            var memberid = $(this).val();
            var name = $(this).attr('data-text');
            var membergender = $(this).attr('isgender');
            //alert(memberid +' : '+ name);
            $('.rooms').each(function(){
                var roomactive = $(this).attr('is-active');
                var isoke = 0;
                if(roomactive != 2){
                    var i = 0;
                    var n = 0;
                    var gender = "";
                    var roomid = $(this).attr('room-id');
                    var roomno = $(this).attr('room-no');
                    $('.space_'+roomid).each(function() {  
                        if($(this).attr('isi')==0){
                            if(gender == ""){
                                isoke = 1;                    
                            }else{
                                if(gender == membergender){
                                    isoke = 1;                        
                                }
                            }
                            if(isoke == 1){
                                var input = "<input type='hidden' name='booking[]' value='"+roomid+"|"+memberid+"'>";
                                //alert('OKE : ' + roomno + " : " + memberid +' : '+ name + " - " + x + "-" + jmlblmisi);
                                $('#space_no_'+roomid+'_'+i).html(name.substring(0, 17) + input);
                                $(this).attr('isi',memberid);
                                $(this).attr('gender',membergender);
                                $('#rw_ck_'+memberid).css({"background-color":"#dcdcdc"});
                                $('#member_'+memberid).prop("disabled",true);
                                $('#member_'+memberid).attr("isactive",1);
                                $('#member_'+memberid).parent().addClass('checked');
                                $('#reset_room_'+roomid).html("X");
                                n++;    
                                x++;
                                //GenerateAuto(x);      
                                return false;                  
                            }                         
                        }else{
                            gender = $(this).attr('gender');                                                     
                        }
                        i++;
                    });
                }

                if(isoke ==1){
                    return false;    
                }
            });
        });
    }
    
    
}

function stop(text){
    //alert(text);
    return false;
}
function resetAllRoom(){
    $('.rooms').each(function() {
        var ck = $(this).attr('is-active');
        if(ck != 2){            
            resetRoom($(this).attr('room-id'));
        }
    });
    setTimeout(function(){ 
        $('.rooms[is-active="1"]').attr('is-active','0');
        $('.rooms[is-active="0"]').css({"background-color":"#fafafa"});            
    },200);    
}

(function($) {
  $.fn.shuffle = function() {
    // credits: http://bost.ocks.org/mike/shuffle/
    var m = this.length, t, i;

    while (m) {
      i = Math.floor(Math.random() * m--);

      t = this[m];
      this[m] = this[i];
      this[i] = t;
    }

    return this;
  };
}(jQuery));

function backForm(){
    window.open(baseurl+'diklat/settingroom','_self');
}

</script>