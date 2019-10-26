<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>SI PUSDIKLAT PPATK</a></li>
        <li><a href='<?php echo base_url();?>master/katering'>Master Katering</a></li>
        <li class="active">Detail Katering</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Detail Katering</h6>
    </div>
    <form id="mki_form" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <div class="panel-body">
            <div class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Nama Katering : </label>
                    <div class="col-sm-2 control-label text-left"><?php echo $katering["CATERING_NAME"];?></div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Menu : </label>
                    <div class="col-sm-2 control-label text-left styled"><a href="<?php echo base_url().$katering["CATERING_FILE_PATH"];?>" download> download</a></div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label text-right">Status</label>
                    <div class="col-sm-10 content_view_value">
                        <?php
                            $status = '';
                            if($katering['CATERING_STATUS']==1){
                                $status ='<label class="control-label text-right" style="color:green;">Aktif</label>';
                            }elseif($katering['CATERING_STATUS']==0){
                                $status ='<label class="control-label text-right" style="color:red;">Tidak Aktif</label>';
                            }
                            echo $status; 
                        ?>
                    </div>
                </div>

                <div class="col-sm-12 control-label">
                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> Daftar Menu</h6></div>
                    <div class="table-responsive">          
                        <table class="table table-condensed no-Footer">
                            <thead>
                                <tr role="row">
                                    <th class="text-center" style="width: 20px;"><label>Nama Menu</label></th>
                                    <th class="text-center" style="width: 20px;"><label>Kategori</label></th>
                                </tr>
                            </thead>
                            <?php
                                foreach ($cat_menu as $m) {                        
                            ?>
                            <tbody>
                                <tr>
                                    <td style="width: 20px;"><?php echo $m->CAT_MENU_NAME?></td>                        
                                    <td style="width: 20px;">
                                        <?php
                                            $query = $this->db->query("SELECT CAT_MENU_NAME FROM T_REF_MENU_CATEGORY WHERE CAT_MENU_ID = '$m->CAT_MENU_CAT_ID'")->result();
                                            foreach($query as $q){
                                                echo $q->CAT_MENU_NAME;
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>  
                            <?php
                                }
                            ?>                      
                        </table>
                    </div>
                </div>
            <br>
                <hr>
                <div class="form-actions text-left">
            <div class="row">
            <div class="col-md-12">
            <label class="col-sm-3"></label>
            <div class="col-sm-9">
                <a class="btn btn-default btn-xs btn-danger" href="<?php echo base_url('master/katering');?>"><i class="icon-exit2"></i> Batal</a>
            </div>
            </div>
            </div>
        </div>
            </div>
        </div>
    </form>
</div>