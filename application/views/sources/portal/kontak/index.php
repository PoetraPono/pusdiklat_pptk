<style>
   .input-sm {
      height: 26px;
   }
   .btn-xs{
       padding:5px !important;
   }
   .select2-container {
      border: none !important;
      padding: 0 !important;
   }
   /*@media(min-width: 1200px){
      .block>.thumbnail>a>img{
         height: 210px !important;
      }      
   }*/
   @media(min-width: 1201px){
      .block>.thumbnail>a{
         height: 220px !important;
         width: 100% !important;
         overflow: hidden;
      }      
   }
</style>
<div class="breadcrumb-line">
   <ul class="breadcrumb">
      <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
      <li class="active">Data Kontak</li>
   </ul>

   <div class="visible-xs breadcrumb-toggle">
      <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
   </div>
</div>

<div class="panel panel-default">
   <div class="panel-heading">
      <h6 class="panel-title"><i class="icon-copy"></i>Data Kontak</h6>
   </div>
   <div class="tabbable">
      <ul id="myTab" class="nav nav-tabs tab-bricky">
         <li class="active">
            <a href="#aktif" data-toggle="tab" data-id="1">Informasi Kontak</a>
         </li>
         <li class="">
            <a href="#nonaktif" data-toggle="tab" data-id="2">Gambar Lokasi</a>
         </li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active" id="aktif">
            <div class="panel-body">   
               <form class="form-horizontal need_validation" action="" id="mki_form" role="form" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                           <thead class="table table-striped table-bordered table-hover">                
                              <tr>
                                 <th class="text-center" width="40px">#</th>
                                 <th width="35%">Judul Kontak</th>
                                 <th width="55%">Deskripsi</th>
                                 <th class="text-center" width="80px">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $no = 1; foreach ($datakontak as $k => $v) { ?>
                              <tr>
                                 <td class="text-center" ><?php echo $no; ?></td>
                                 <td><input type="text" class="form-control wajib" id="<?php echo $v['CONTACT_ID']; ?>[CONTACT_TITLE]" name="<?php echo $v['CONTACT_ID']; ?>[CONTACT_TITLE]" placeholder="Judul Kontak" value="<?php echo $v['CONTACT_TITLE']?>"></td>
                                 <td><textarea class="form-control wajib" id="<?php echo $v['CONTACT_ID']; ?>[CONTACT_TEXT]" name="<?php echo $v['CONTACT_ID']; ?>[CONTACT_TEXT]" placeholder="Judul Kontak"><?php echo $v['CONTACT_TEXT']?></textarea></td>
                                 <td class="text-center" >
                                 <?php if($v['CONTACT_STATUS']==1){
                                    echo '<a href="'.base_url().'portal/kontak/delete/'.$v['CONTACT_ID'].'" class="btn btn-xs btn-default btn-icon tip" data-original-title="Non Aktifkan" data-placement="top" style="padding:5px"><i class="icon-close"></i></a>';
                                 }else{
                                    echo '<a href="'.base_url().'portal/kontak/active/'.$v['CONTACT_ID'].'" class="btn btn-xs btn-default btn-icon tip" data-original-title="Aktifkan" data-placement="top"><i class="icon-checkmark"></i></a>';
                                 }?>
                                 </td>
                              </tr>
                           <?php $no +=1; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-12">
                  <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                     <button type="submit" class="btn btn-xs btn-success">Simpan</button>
                  </div>
               </div>
               </form>
            </div>
         </div>
         <div class="tab-pane" id="nonaktif">
            <div class="panel-body">
               <form class="form-horizontal need_validation" action="<?php echo base_url().'portal/kontak/saveimg'?>" id="mki_form" role="form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label class="col-sm-12 control-label">Unggah Gambar :</label>
                     <div class="col-sm-12 panel-body" style="padding-top: 0">
                     <table class="table">
                         <tbody id="isi_gambar">
                         </tbody>
                         <tfoot>
                             <tr>
                                 <td colspan="2" ></td>
                                 <td><center>
                                     <input type="hidden" id="jml_gambar" value="0">
                                     <a class="btn btn-icon btn-xs btn-success" onclick="addgambar()"><i class="icon-plus"></i></a>
                                     <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                                    <button id="imgsubmit" type="submit" class="btn btn-icon btn-xs btn-info" style="display:none">Simpan</button>
                                 </center></td>
                             </tr>
                         </tfoot>
                     </table>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-12 control-label">List Gambar :</label>
                     <?php if(count($dataimg)>0){?>
                     <?php foreach ($dataimg as $k => $v) { ?>
                     <div class="col-lg-4">
                        <div class="block">
                           <div class="thumbnail">
                              <a href="<?php echo $v['OFCIMG_FILE']!=""?base_url().$v['OFCIMG_FILE']:'#'; ?>" class="thumb-zoom lightbox" title="<?php echo $v['OFCIMG_FILE']!=""?$v['OFCIMG_FILE']:'-'; ?>">
                                 <img src="<?php echo $v['OFCIMG_FILE']!=""?base_url().$v['OFCIMG_FILE']:'#'; ?>">
                              </a>
                              <div class="caption text-center" style="padding-top: 5px">
                                <!-- <h6>Eugene A. Kopyov <small>UX designer</small></h6> -->
                                <div class="icons-group pull-right">
                                  <?php if($v['OFCIMG_STATUS'] == 1){
                                    echo '<a href="'.base_url().'portal/kontak/deleteIMG/'.$v['OFCIMG_ID'].'" title="" class="tip" data-original-title="Aktifkan"><i class="icon-checkmark"></i></a>';
                                  }else{
                                    echo '<a href="'.base_url().'portal/kontak/activeIMG/'.$v['OFCIMG_ID'].'" title="" class="tip" data-original-title="Non Aktifkan"><i class="icon-close"></i></a>';
                                  }
                                  echo '<a href="'.base_url().'portal/kontak/destroyIMG/'.$v['OFCIMG_ID'].'" title="" class="tip" data-original-title="Hapus File"><i class="icon-remove3"></i></a>';
                                  ?>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     <?php } else{ echo '<div class="col-sm-12"><i>Tidak ada data</i></div>'; }?>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $("document").ready(function(){
      addgambar();
   });
   var $ = jQuery;
   function addgambar(){
       var index = ($('#jml_gambar').val()!=0)?$('#jml_gambar').val():0;
       var hapus = '';
       var number = $('.fgambar').length;
       index =parseInt(index)+1;
       hapus += '<button type="button" class="btn btn-xs btn-default btn-icon btnaksi" data-original-title="Hapus" data-toggle="tooltip" data-placement="top" onclick="hpsgambar(' + index + ')" data-index="' + index + '"><i class="icon-close"></i></button>';
       var newhtml = '';

       newhtml += '<tr class="fgambar" data-index="' + index + '">';
       newhtml += '<td width="30px" class="text-center no_gambar">'+(number+1)+'</td>';
       newhtml += '<td><input type="file" class="styled wajib filenya" id="gambar_path'+index+'"></td>';
       newhtml += '<td width="150px"><center>'+hapus+'</center></td>';
       newhtml += '</tr>';

       $('#jml_gambar').val(index);
       if (index > 1) {
           $("#isi_gambar").append(newhtml);
       } else {
           $("#isi_gambar").html(newhtml);
       }

       number +=1;
       $.validator.addClassRules({
           wajib: {
               required: true
           },
           wajibcheckbox: {
               required: true
           },
           wajibfile: {
               required: true,
               extension: "xls|csv"
           }
       });
       $("#kategori_gambar_"+index).select2('destroy').select2();
       $("#gambar_path"+index+", .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
       $('[data-toggle=tooltip]').tooltip();
       $('[rel=tooltip]').tooltip();
       $("#imgsubmit").css({display:''});
       sort_gambar();
   }
   function hpsgambar(index){
       var has = $('#isi_gambar').find('.fgambar').length;
       if (has==1){
         addgambar();
       }
       $('tr.fgambar[data-index="' + index + '"]').remove(); 
       sort_gambar();
   }
   function sort_gambar(){
       var no = 1;
       $('.no_gambar').each(function () {      
          $(this).html(no);
          no++;
       });
       var no = 0;
       $('.filenya').each(function () {      
          $(this).attr({'name':'gambar_path' + no})
          no++;
       });

   }
</script>