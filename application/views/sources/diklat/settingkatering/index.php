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
        <li class="active">Pengaturan Katering</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Daftar Pengaturan Katering</h6>
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
                                    <th class="text-center">Jumlah Peserta</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="min-width:50px;width:50px">Aksi</th>
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
            "sAjaxSource": baseurl+"diklat/settingkatering/listdataaktif",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
                { "bSortable": false, "sClass": "text-center" },
                { "sClass": "text-left" },
                { "sClass": "text-left", "bVisible": false },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "bSortable": false, "sClass": "text-center" },
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
       /* $('#datanonaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"diklat/program/listdatanonaktif",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
            { "bSortable": false, "sClass": "text-center" },
            { "sClass": "text-left" },
            { "sClass": "text-left" },
            { "sClass": "text-center" },
            { "sClass": "text-center" },
            { "sClass": "text-center" },
            { "bSortable": false, "sClass": "text-center" }
            ],
            "fnDrawCallback": function () {
                set_default_datatable();
            },
        });*/
    });
</script>
