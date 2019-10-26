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
<form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-copy"></i>Setting Modul & Pengajar Program Diklat</h6>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-file6"></i>Detail Program Diklat</h6>
                </div>
                <div class="panel-body">
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
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label for="" class="col-sm-2 control-label text-right">
                            Jumlah Mata Ajar :
                        </label>
                        <div class="col-sm-4 control-label">
                            <?php echo $diklat['PROGRAM_TOTAL_LESSON']; ?>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label for="" class="col-sm-2 control-label text-right">
                            Total Jam Pelatihan :
                        </label>
                        <div class="col-sm-4 control-label">
                            <?php echo $diklat['PROGRAM_TOTAL_HOURS']; ?> Jam
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label for="" class="col-sm-2 control-label text-right">
                            Jumlah Peserta :
                        </label>
                        <div class="col-sm-4 control-label">
                            <?php echo $jmlpeserta; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-buttons" style="margin-top: -30px;">
                <div class="row">
                    <div class="col-sm-12 control-label">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> Daftar Kelas</h6>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="row block-inner">
                                        <?php $x = 0; foreach($kelas as $k => $v){ 
                                        $color = "";
                                        $isactive = "";
                                        if($v['ROOM_STATUS'] == 1){
                                             $color = "red";
                                             $isactive = 2;
                                        }else{
                                            if($v['ROOM_ISI'] == 1){
                                                $color = "#7FFFD4";
                                                $isactive = 1;
                                            }else{
                                                $color = "#fafafa";
                                                $isactive = 0;
                                            }
                                        }
                                        ?>
                                        <div class="col-md-2" style="margin-bottom: 5px;display: block;height: 125px; padding-left: 2px; padding-right: 2px;" >
                                            <a href="javascript:void(0);" class="rooms" id="room_<?php echo $v['ROOM_ID']; ?>" style="border-radius: 4px;  border: 1px solid #BADA55; padding-left: 5px; padding-right: 5px; background-color:<?php echo $color; ?>;" data-capactity="<?php echo $v['ROOM_CAPACITY']; ?>" is-active="0<?php //echo ($v['ROOM_STATUS'] > 0 ? "2" : "0"); ?>" room-id="<?php echo $v['ROOM_ID']; ?>"  onclick="chooseRoom(this)" <?php //echo ($v['ROOM_STATUS'] == 0 ?  'onclick="chooseRoom(this)"' : ""); ?> room-no="<?php echo $v['ROOM_NAME']; ?>">
                                            <i class="" style="font-size:18px;"><?php echo $v['ROOM_NAME']; ?></i>
                                            <span >(<?php echo "Kapasitas : ".$v['ROOM_CAPACITY']; ?>)</span>
                                            <span >&emsp;</span>
                                            <span >&emsp;</span>
                                            <input type="hidden" id="classroom_<?php echo $v['ROOM_ID']; ?>" value="<?php echo ($isactive==1 ? $v['ROOM_ID'] : 0); ?>" name="classroom[]"/>
                                            </a>
                                        </div>
                                        
                                        <?php } ?>
                                    </div>      
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            <div class="form-actions text-left">
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                <a href="<?php echo base_url();?>diklat/settingkelas" class="btn btn-xs btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</form>
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
    if(isactive == 0){
        $("#room_"+roomid).css({"background-color":"#7FFFD4", "color":"black"});        
        $("#classroom_"+roomid).val(roomid);        
        $(ini).attr('is-active','1');      
        
   } else if(isactive == 1){
        $("#room_"+roomid).css({"background-color":"#fafafa", "color":"black"}); 
        $("#classroom_"+roomid).val(0);            
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
                    alert("Maaf Laki-laki dan Perempuan tidak diperbolehkan dalam satu ruangan");
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