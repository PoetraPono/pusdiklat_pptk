<?php
//echo '<pre>';
//print_r($gallery);
//die;
?>

<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
		<li><a href='<?php echo base_url();?>portal/gallery'>Gallery</a></li>
		<li class="active">Detail Gallery</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Gallery</h6>
	</div>

	<!-- Page tabs -->
	<div class="tabbable page-tabs">
		<ul class="nav nav-tabs">
			
			
		</ul>
		<div class="tab-content">

			<form id="mki_form" class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
            

	            <div class="form-group">
	                <label class="col-sm-1 control-label text-right">
	                    Nama :
	                </label>
	                <div class="col-sm-10 control-label text-left">
	                    <?php echo $gallery['GALLERIES_TITLE']; ?>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-1 control-label text-right">
	                    Tanggal :
	                </label>
	                <div class="col-sm-10 control-label text-left">
	                    <?php echo date('d M Y',strtotime($gallery['GALLERIES_DATE'])); ?>
	                </div>
	            </div>
	           <div class="form-group">
	                <label class="col-sm-1 control-label text-right">
	                    Deskripsi :
	                </label>
	                <div class="col-sm-10 control-label text-left">
	                    <?php echo $gallery['GALLERIES_DESC']; ?>
	                </div>
	            </div>
	            <div class="form-group">
	           		 <?php
						// echo "</pre>";
						// print_r($gallerydetail);
						$i = 0;
						foreach ($gallerydetail as $row){
							$idgallerydetail 		= $row["GALLERY_LIST_ID"];
							$gallerydetailgalleryid = $row["GALLERY_LIST_GALLERY_ID"];
							$gallerydetaildesc	= $row["GALLERY_LIST_IMAGE_DESC"];
							$gallerydetailfilepath 	= $row["GALLERY_LIST_IMAGE_PATH"];
						
					?>
					<div class="col-sm-3">
						<div class="block">
							<div class="thumbnail thumbnail-boxed">
								<div class="thumb">
									<img alt="" src="<?php echo base_url().$gallerydetailfilepath;?>" style="height: 190px">

									<div class="thumb-options">
												<span>
													<p style="color: #fff"><?php echo $gallerydetaildesc;?></p>
                                                   
												</span>
									</div>
								</div>
								<div class="caption">
									<p class="caption-title"><?php echo $gallerydetaildesc;?></p>
								</div>
							</div>
						</div>
					</div>

					<?php
							//$no++;
							$i++;
					}
					if($i==0){
						echo"<br><center><h4>Tidak Ada Foto Detail</h4></center>";
					}
					?>
					</div>
	            <div class="form-actions text-left">
	                <a href="<?php echo base_url("portal/gallery") ?>" type="submit" value="Simpan News" class="btn btn-primary">Kembali</a>
	            </div>

			

	        </form>
		</div>
	</div>
</div>

<!-- Form modal -->
<div id="form_modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Upload Foto</h4>
			</div>

			<!-- Form inside modal -->
			<form action="#" role="form" method="post" enctype="multipart/form-data">

				<div class="modal-body with-padding">

					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-primary">
									<div class="multiple-uploader with-header">Your browser doesn't support native upload.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--				<div class="modal-footer">-->
				<!--					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>-->
				<!--					<button type="submit" class="btn btn-primary">Submit form</button>-->
				<!--				</div>-->
			</form>
		</div>
	</div>
</div>
<!-- /form modal -->

<div id="form_edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Edit Description</h4>
            </div>

            <form id="form" action="" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <input type="hidden"  name="gallery_detail_id"  class="form-control">
                        <label class="control-label text-right">Foto Description<span class="mandatory">*</span>: </label>
                        <div class="">
                            <textarea rows="3" cols="8" class="form-control input-sm wajib" id="GALLERY_LIST_IMAGE_DESC" name="GALLERY_LIST_IMAGE_DESC" placeholder="Gallery Detail Description"></textarea>
<!--                            <input type="text" class="form-control input-sm wajib" id="gallery_detail_description" name="gallery_detail_description" placeholder="Gallery Detail Description">-->
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <button id="btnSave" type="button" class="btn btn-xs btn-primary" onclick="_save()"><i class="fa fa-eye"></i>Simpan</button>
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

//    var id = "<?php //echo $idgallery?>//";

	function _add()
	{
		$('#form_modal').modal('show'); // show bootstrap modal
//        alert(id);
	}

    function _edit(id)
    {
//        save_method = 'update';
//        $('#form')[0].reset(); // reset form on modals
//        $('.form-group').removeClass('has-error'); // clear error class
//        $('.help-block').empty(); // clear error string
//        $('#form_edit').modal('show'); // show bootstrap modal
//        $('.modal-title').text('Edit Descriptiom'); // Set Title to Bootstrap modal title
        //$('[name="kode_pst"]').prop('readonly', true);
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('portal/gallery/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="GALLERY_LIST_IMAGE_DESC"]').val(data.gallery_detail_description);
                $('[name="GALLERY_LIST_ID"]').val(data.gallery_detail_id);
                $('#form_edit').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Descriptiom'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

	var id = "<?php echo $idgallery;?>";

	$(".multiple-uploader").pluploadQueue({
		runtimes : 'html5, html4',
		url : baseurl + 'portal/gallery/upload/' + (id),
		chunk_size : '2mb',
		unique_names : true,
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png,jpeg"},
				//{title : "Zip files", extensions : "zip"}
			]
		}
//		resize : {quality : 90}
	});

    function _save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        url = "<?php echo site_url('portal/gallery/updatedes')?>";

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#form_edit').modal('hide');
                    location.reload();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

    function _delete(id)
    {
        $('#konfirmasihapus').modal('show'); // show bootstrap modal
//        $('.modal-title').text('Are you sure delete this data?'); // Set Title to Bootstrap modal title

        $('#setujukonfirmasi').click(function(){

            $.ajax({
                url: "<?php echo site_url('portal/gallery/ajax_delete')?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    //if success reload ajax table
                    $('#konfirmasihapus').modal('hide');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        });
    }

</script>