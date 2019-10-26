<style>
	.input-sm {
		height: 26px;
	}
    .select2-container {
        border: none !important;
        padding: 0 !important;
    }
    .btn-xs {
        padding:5px !important;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Data Profil</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Profil</h6>
	</div>
	<div class="tabbable">
		<ul id="myTab" class="nav nav-tabs tab-bricky">
			<?php if(count($getlists)>0){
                foreach ($getlists as $k => $v) {
                    $active = '';
                    if($k==0){
                        $active = 'class="active"';
                    }
                    echo '<li '.$active.'><a href="#menu'.$v['PROFIL_ID'].'" data-toggle="tab" data-id="'.$v['PROFIL_ID'].'">'.$v['PROFIL_NAME'].'</a></li>';
                }
            } ?>
		</ul>
		<div class="tab-content">
            <?php if(count($getlists)>0){
                foreach ($getlists as $k => $v) {
                    $active = '';
                    if($k==0){
                        $active = 'in active';
                    } ?>
                    <div class="tab-pane <?php echo $active; ?>" id="menu<?php echo $v['PROFIL_ID'];?>">
                        <form class="form-horizontal need_validation" action="<?php echo base_url("/portal/profil/about_save").'/'.$v['PROFIL_ID']; ?>" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <?php if($v['PROFIL_ID']!=7){?>
                                <div class="col-sm-12">
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                                    <textarea rows="3" cols="10" class="form-control ckeditor input-sm wajib" id="description" name="description" placeholder="Project Fiturs"><?php echo $v['PROFIL_DESC'];?></textarea>
                                </div>
                                <?php }else{ ?>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <video width="100%" controls>
                                        <source src="<?php echo base_url().$v['PROFIL_LINK'] ?>">
                                            <?php //echo base_url().$v['PROFIL_LINK'];?>
                                        Your browser does not support HTML5 video.
                                    </video>
                                </div>
                                <label class="control-label col-sm-2 col-sm-offset-1">Download File:</label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="old_videos" value="<?php echo $v['PROFIL_LINK']; ?>">
                                    <input type="file" class="styled" id="videos" name="videos" accept="video/mp4">
                                    <span class="help-block">jenis file yang diijinkan mp4</span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                            <?php if($v['PROFIL_ID']==5){ ?>
                                <label class="col-sm-12 control-label">Gambar Sarana dan Prasarana :</label>
                                <div class="col-sm-12 panel-body" style="padding-top: 0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-right" width="5px">No</th>
                                                <th class="" width="">Kategori</th>
                                                <th class="" width="">Unggah Gambar</th>
                                                <th class="text-center" width="90px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="isi_gambar">
                                            <tr><td colspan="4"><i>Tidak ada Gambar</i></td></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td colspan="2" ><span class="mandatory">* jenis file yang diijinkan png, jpg & jpeg</span></td>
                                                <td><center>
                                                    <input type="hidden" id="jml_gambar" value="0">
                                                    <a class="btn btn-icon btn-xs btn-success" onclick="addgambar()"><i class="icon-plus"></i></a>
                                                    <a id="reset_gambar" class="btn btn-icon btn-xs btn-info" onclick="getgambar()" style="display:none"><i class="icon-loop4"></i></a>
                                                </center></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <script type="text/javascript">
                                    var $ = jQuery;
                                    $(document).ready(function(){
                                        getgambar();
                                    });
                                    function getgambar(){
                                        $.ajax({
                                            url : "<?php echo base_url('portal/profil/json_getimages/5'); ?>",
                                            type: "GET",
                                            dataType: "JSON",
                                            success: function(data){
                                                // alert(JSON.stringify(data));
                                                var nomor = 1;
                                                $.each(data, function(index) {
                                                    $("#reset_gambar").css({display:'none'});
                                                    var hapus = '';
                                                    hapus += '<button type="button" class="btn btn-xs btn-default btn-icon btnaksi" data-original-title="Hapus" data-toggle="tooltip" data-placement="top" onclick="hpsgambar(' + index + ')" data-index="' + index + '"><i class="icon-close"></i></button>';
                                                    var newhtml = '';
                                                    var file_name = /[^/]*$/.exec(data[index].IMG_PATH)[0];
                                                    newhtml += '<tr class="fgambar" data-index="' + index + '">';

                                                    newhtml += '<td class="text-center no_gambar">'+ nomor +'</td>';
                                                    newhtml += '<td><select data-placeholder="PILIH KATEGORI" class="form-control required" tabindex="1" name="kategori_gambar['+ index +']" id="kategori_gambar_'+ index +'">'+
                                                            '<option value=1 '+ (data[index].IMG_CATEGORY==1?'selected':'') +'>Olahraga</opion>'+
                                                            '<option value=2 '+ (data[index].IMG_CATEGORY==2?'selected':'') +'>Kamar</opion>'+
                                                            '<option value=3 '+ (data[index].IMG_CATEGORY==3?'selected':'') +'>Prasarana Lain</opion>'+
                                                        '</select>';
                                                    newhtml += '<td>'+
                                                        '<input type="file" class="styled" id="gambar_path'+ index +'" name="gambar_path'+ index +'" accept="images">'+
                                                        '<input type="hidden" name="filessss_'+ index +'" id="filessss_'+ index +'" value="'+ file_name +'">'+
                                                        '<input type="hidden" name="filename_'+ index +'" id="filename_'+ index +'" value="'+ data[index].IMG_DESCRIPTION +'">'+
                                                    '</td>';
                                                    newhtml += '<td><center>'+hapus+'</center></td>';
                                                    newhtml += '</tr>';

                                                    $('#jml_gambar').val(index);

                                                    if (index != 0) {
                                                        $("#isi_gambar").append(newhtml);
                                                    } else {
                                                        $("#isi_gambar").html(newhtml);
                                                    }
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
                                                    $("#gambar_path"+ index +", .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });
                                                    $('[data-toggle=tooltip]').tooltip();
                                                    $('[rel=tooltip]').tooltip();
                                                    var name = $('#filessss_'+ index).val();
                                                    $('#uniform-gambar_path'+ index).find('.filename').html(name);
                                                    nomor +=1;
                                                    sort_gambar();
                                                });
                                                /*document.getElementById("id-terakhir").value = baristerakhir;*/
                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {
                                                alert('Mohon untuk refresh halaman kembali');
                                            }
                                        });
                                    }
                                    function addgambar(){
                                        $("#reset_gambar").css({display:''});
                                        var index = ($('#jml_gambar').val()!=0)?$('#jml_gambar').val():0;
                                        var hapus = '';
                                        var number = $('.fgambar').length;
                                        index =parseInt(index)+1;
                                        hapus += '<button type="button" class="btn btn-xs btn-default btn-icon btnaksi" data-original-title="Hapus" data-toggle="tooltip" data-placement="top" onclick="hpsgambar(' + index + ')" data-index="' + index + '"><i class="icon-close"></i></button>';
                                        var newhtml = '';

                                        newhtml += '<tr class="fgambar" data-index="' + index + '">';
                                        newhtml += '<td class="text-center no_gambar">'+(number+1)+'</td>';
                                        newhtml += '<td><select data-placeholder="PILIH KATEGORI" class="form-control required" tabindex="1" name="kategori_gambar['+ index +']" id="kategori_gambar_'+ index +'">'+
                                            '<option value=1>Olahraga</opion>'+
                                            '<option value=2>Kamar</opion>'+
                                            '<option value=3>Prasarana Lain</opion>'+
                                        '</select>';
                                        newhtml += '<td><input type="file" class="styled" id="gambar_path'+index+'" name="gambar_path'+index+'" accept="images"></td>';
                                        newhtml += '<td><center>'+hapus+'</center></td>';
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
                                        sort_gambar();
                                    }
                                    function hpsgambar(index){
                                        $("#reset_gambar").css({display:''});
                                        var has = $('#isi_gambar').find('.fgambar').length;
                                        if (has==1){
                                            $('#jml_gambar').val("");
                                            $("#isi_gambar").html('<tr><td colspan="4"><i>Tidak ada gambar</i></td></tr>');
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
                                    }
                                </script>
                            <?php } ?>
                            <?php if($v['PROFIL_ID']==6){?>
                                    <div class="thumbnail">
                                        <a href="<?php echo base_url() . $v['PROFIL_LINK']; ?>" class="thumb-zoom lightbox" title="Gambar Struktur Organisasi">
                                            <img src="<?php echo base_url() . $v['PROFIL_LINK']; ?>">
                                        </a>
                                    </div>
                                <label class="control-label col-sm-2 col-sm-offset-1">Upload Photo:</label>
                                <div class="col-sm-4">
                                    <input type="hidden" name="old_images" value="<?php echo $v['PROFIL_LINK']; ?>">
                                    <input type="file" class="styled" id="images" name="images" accept="images">
                                    <span class="help-block">jenis file yang diijinkan png, jpg & jpeg</span>
                                </div>
                            <?php } ?>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                                    <button type="submit" class="btn btn-xs btn-success">Simpan <?php echo $v['PROFIL_NAME'];?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php }
            } ?>			
		</div>
	</div>
</div>