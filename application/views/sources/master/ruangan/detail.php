<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url(); ?>'>SI PUSDIKLAT</a></li>
        <li><a href=" <?php echo base_url('master/ruangan') ?>" class="active">Master</a></li>
        <li class="active">Detail</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>

<div class="panel panel-default mki-panel">
    <div class="panel-heading mki-panel-heading">
        <h6 class="panel-title"><i class="icon-file6"></i>Detail</h6>
    </div>
    <form id="mki_form" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <div class="form-horizontal">
            <div class="panel-body">
                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Nama Ruangan
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $room["ROOM_NAME"] ?>
                    </div>

                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Kapasitas Ruangan
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $room["ROOM_CAPACITY"] ?>
                    </div>

                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Nama Gedung
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $room["ROOM_BUILDING"] ?>
                    </div>    
                </div>
                <hr>
                <div class="form-actions text-left">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-9">
                        <a class="btn btn-default mki-btn-primary" href="<?php echo base_url('master/ruangan');?>"><i class="icon-exit2"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>