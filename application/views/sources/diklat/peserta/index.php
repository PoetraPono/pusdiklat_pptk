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
        <li class="active">Peserta</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-user"></i>Daftar Peserta Diklat</h6>
        <!-- <a class="pull-right btn btn-xs btn-primary" href='<?php echo base_url();?>diklat/peserta/create'>Tambah Data</a> -->
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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Instansi</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">No Telp.</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Jml Keikutsertaan</th>
                                    <th class="text-center" style="min-width:90px;width:90px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"diklat/peserta/listdataaktif",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
            { "bSortable": false, "sClass": "text-center" },
            { "sClass": "text-left" },
            { "sClass": "text-center" },
            { "sClass": "text-center" },
            { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-center" },
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
        /*$('#datanonaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"diklat/peserta/listdatanonaktif",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
            { "bSortable": false, "sClass": "text-center" },
            // { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-center" },
            { "bSortable": false, "sClass": "text-center" }
            ],
            "fnDrawCallback": function () {
                set_default_datatable();
            },
        });*/
    });
</script>
