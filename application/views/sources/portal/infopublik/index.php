<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI Pusdiklat PPATK</a></li>
        <li class="active">Informasi Publik</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Informasi Publik</h6>
        <a class="pull-right btn btn-xs btn-primary" href='<?php echo base_url();?>portal/infopublik/create'>Tambah Informasi Publik</a>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul id="myTab" class="nav nav-tabs tab-bricky">
                        <li class="active">
                            <a href="#aktif" data-toggle="tab" data-id="1">Informasi Publik Aktif</a>
                        </li>
                        <li class="">
                            <a href="#nonaktif" data-toggle="tab" data-id="2">Informasi Publik Nonaktif</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="aktif">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataaktif">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5px">No</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center" style="min-width:90px;width:90px">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="nonaktif">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="datanonaktif">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5px">No</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Tanggal</th>
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"portal/infopublik/listdata/1",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
            { "bSortable": false, "sClass": "text-center" },
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
        $('#datanonaktif').dataTable( {
            "processing": true,
            "serverSide": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"portal/infopublik/listdata/0",
            "aaSorting": [[0, "desc"]],
            "aoColumns": [
            { "bSortable": false, "sClass": "text-center" },
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
    });
</script>
