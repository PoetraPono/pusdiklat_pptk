<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url(); ?>'>SI PUSDIKLAT</a></li>
        <li class="active">Master /Ruangan</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default mki-panel">
    <div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-users2"></i>Master/Ruangan</h6>
        <?php if($this->access->permission('create')){ ?>
            <a class="pull-right btn btn-xs btn-default mki-btn-info" href='<?php echo base_url();?>master/ruangan/create'><i class="icon-file-plus"></i>Input Baru</a>
        <?php } ?>
    </div>

    <div class="panel-body">
        <div class="datatable">
            <table class="table table-bordered" id="tabble1">
                <thead>
                    <tr>
                        <th class="text-center" width="10px;">No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas Ruangan</th>
                        <th>Nomor Ruangan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    var $ = jQuery;
    var tabl1;
    var tabl2;
    $(document).ready(function() {
        $('#tabble1').dataTable( {
            "order": [[3, "DESC" ]],
            "aoColumns": [
                { "sClass": "alignCenter","bSortable": false },
                null,
                null,
                null,
                { "sClass": "alignCenter","bSortable": true },
                { "sClass": "alignCenter", "bSortable": false }
            ],
            "processing": true,
            "bServerSide": true,
            "sAjaxSource": baseurl+"master/ruangan/listdata/1",
            "fnServerData": function( sUrl, aoData, fnCallback, oSettings ) {
                oSettings.jqXHR = $.ajax({
                    "url": sUrl,
                    "data": aoData,
                    "success": fnCallback,
                    "dataType": "jsonp",
                    "cache": false
                });
            },
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "paginate": {
                    "first":      "Awal",
                    "last":       "Akhir",
                },
                "emptyTable": "Data tidak tersedia",
                "info": "Menampilkan: _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan: 0 Data",
                "infoFiltered": "",
                "lengthMenu": "Menampilkan: _MENU_ Data",
                "search": "Pencarian: ",
                "zeroRecords": "Pencarian Tidak Ditemukan",
                "sProcessing": "Proses Pengambilan Data",
            },
            "fnDrawCallback": function (e) { 
                $("select").select2();
                $('[data-toggle="tooltip"]').tooltip(); 
            },
            "destroy":true
        });
        $('#btnaktif').click(function() {
            var rowId = $(this).attr('rowid');
            if(rowId>0) {
                $.ajax({
                   url : "<?php echo base_url(); ?>master/ruangan/aktif/"+rowId,
                   dataType:"json",
                   success:function(result){
                        $('#konfirm_aktif').modal('hide');
                        if(result.update>0) {
                            $('#tabble1').DataTable().ajax.reload();
                            $('#tabble2').DataTable().ajax.reload();

                            $('#btnaktif').attr({'rowid':0});
                        }
                        show_notif_force(result.status, result.title, result.message);
                   }
                });
            }
        });
        $('#btnhapus').click(function() {
            var rowId = $(this).attr('rowid');
            if(rowId>0) {
                $.ajax({
                   url : "<?php echo base_url(); ?>master/ruangan/hapus/"+rowId,
                   dataType:"json",
                   success:function(result){
                        $('#konfirm_hapus').modal('hide');
                        if(result.update>0) {
                            $('#tabble1').DataTable().ajax.reload();
                            $('#tabble2').DataTable().ajax.reload();

                            $('#btnhapus').attr({'rowid':0});
                        }
                        show_notif_force(result.status, result.title, result.message);
                   }
                });
            }
        });
    });
</script>