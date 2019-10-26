<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url().'diklat/program';?>'>Info Diklat</a></li>
        <li class="active">Absensi Diklat</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Daftar Absensi</h6>
        <!-- <a class="pull-right btn btn-xs btn-primary" href='<?php echo base_url();?>diklat/program/create'>Tambah Data</a> -->
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataaktif">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Program</th>
                                    <th class="text-center">Bidang Program</th>
                                    <th class="text-center">Tanggal Mulai</th>
                                    <th class="text-center">Tanggal Selesai</th>
                                    <th class="text-center">Data Absensi</th>
                                    <th class="text-center">Kuota Peserta</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="min-width:70px;width:70px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- upload file absensi -->
    <div id="modaluploadabsen" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-file-check"></i>Upload Absensi</h4>
                </div>

                <!-- Form inside modal -->
                <form id="absenform" class="form-horizontal validate" method="post" action="<?php echo base_url('diklat/absensi/uploadabsen');?>" enctype="multipart/form-data">
                    <div class="modal-body with-padding">
                        <div class="form-group" style="margin-bottom: 0">
                            <label class="col-sm-12">
                                Upload Absensi
                            </label>
                            <div class="col-sm-12">
                                <input type="file" class="styled" id="fileabsenpath" name="fileabsenpath" accept="application/pdf">
                                <span class="help-block">jenis file yang diijinkan pdf</span>
                                <input type="hidden" id="programid" name="programid">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">

                        <button id="btnmod_simpan" type="button" class="btn btn-default"> Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function uploadabsen(id=0){
            $('#modaluploadabsen').modal('show');
            $('#btnmod_simpan').click(function(){
                $('#programid').val(id);
                $('#absenform').submit();
            });
        }
    </script>
<script type="text/javascript">
    $(document).ready(function() {

        // $('.dataTables_filter [type=search]').change(function(){
        //     alert();
        // });
        // $("#new_fullname").keypress(function(event){
        //     var inputValue = event.which;
        //     // allow letters and whitespaces only.
        //     if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        //         event.preventDefault(); 
        //     }
        // });
        $('#dataaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"diklat/absensi/listdataaktif",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
                { "bSortable": false, "sClass": "text-center" },
                { "sClass": "text-left" },
                { "sClass": "text-left", "bVisible": false },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center", "bVisible": false },
                { "bSortable": false, "bVisible": false, "sClass": "text-center" },
                { "bSortable": false, "sClass": "text-center" }
            ],
            "fnDrawCallback": function () {
                set_default_datatable();
                $('.dataTables_filter [type=search]').keypress(function(event){
                    var inputValue = event.which;
                    if(!(inputValue >= 64 && inputValue <= 90) && !(inputValue >= 97 && inputValue <= 122) && !(inputValue >= 32 && inputValue <= 33) && !(inputValue >= 35 && inputValue <= 38) && !(inputValue >= 40 && inputValue <= 57) && inputValue != 32 && inputValue != 0) { 
                        event.preventDefault(); 
                    }
                });
            },
        });
    });
</script>
