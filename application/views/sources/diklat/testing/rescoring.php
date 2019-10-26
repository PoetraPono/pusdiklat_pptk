<style>
    .input-sm {
        height: 26px;
    }
    table>tbody>tr>td{
        vertical-align: top !important;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li><a href='<?php echo base_url();?>diklat/testing'>Testing & Kuisioner</a></li>
        <li class="active">Pengaturan</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Pengaturan Testing & Kuisioner</h6>
    </div>

    <div class="panel-body">
        <form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
            <div class="tabbable">
                
                <div class="tab-content">
                    <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 40px;">No</th>
                                        <th>Soal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        if(count($paketsoal)>0){
                                            foreach ($paketsoal as $k => $v) {
                                                echo '<tr>';
                                                echo '<td class="text-center" style="width: 10px;"><input type="hidden" name="question[]" value="'.$v['QUESTION_ID'].'" >'.$no.'</td>';
                                                echo '<td>'.$v['QUESTION_VALUE'].'<br>';
                                                    foreach ($v['OPTIONS'] as $kk => $vv) {
                                                        $checked = $vv['OPTION_VALUE']==$v['OPTION_ANSWER']?"checked":"-";
                                                        echo '<label class="radio radio-inline" style="padding-left:10px;">
                                                            <input type="radio" id="opsi_'.$v['QUESTION_ID'].'_'.$vv['OPTION_ID'].'" name="opsi_'.$v['QUESTION_ID'].'" value="'.$vv['OPTION_ID'].'" class="styled" '.$checked.'>'.chr(65+$kk).'. '.($vv['OPTION_VALUE']!=""?$vv['OPTION_VALUE']:"-").'</label><br/>';
                                                    }
                                                    echo '</td>';
                                                echo '</tr>';
                                                $no +=1;
                                            }
                                              //echo '<tr><td colspan=2 class="text-left"><a href="'.base_url().'diklat/testing/rescoring/'.$diklat['PROGRAM_ID'].'" class="btn btn-xs btn-success"><i class="icon-pencil"></i> Update Jawaban & rescoring</a></td></tr>';
                                        }else{
                                            echo '<tr><td colspan=2 class="text-center"><i>- tidak ada data -</i></td></tr>';
                                        }
                                    ?>
                                    <tr><td colspan="2"><input type="hidden" name="program_id" value="<?php echo $diklat['PROGRAM_ID'];?>"><button type="submit" class="btn btn-xs btn-success"><i class="icon-pencil"></i> Simpan Jawaban & Rescoring</button>
                                    <a href="<?php echo base_url().'diklat/testing/detail/'.$diklat['PROGRAM_ID'];?>" class="btn btn-xs btn-danger">Kembali</a>
                                    </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                        
                </div>
            </div>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">

        </form>
    </div>
</div>

<script type="text/javascript">
    function startTest(id){
        $.ajax({
            url       : "<?php echo base_url('diklat/testing/start/');?>/"+id,
            type      : "GET",
            dataType  : "JSON",
            success: function(data){
                location.reload();
            }
        });        
    }

    function endTest(id){
        $.ajax({
            url       : "<?php echo base_url('diklat/testing/end/');?>/"+id,
            type      : "GET",
            dataType  : "JSON",
            success: function(data){
                location.reload();
            }
        });        
    }
</script>