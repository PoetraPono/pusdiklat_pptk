<?php
//echo '<pre>';
//print_r($program);
//die;
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
    .input-sm {
        height: 26px;
    }
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
        <li class="active">Diklat</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->

<!-- Bordered datatable inside panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-copy"></i>Diklat</h6>
        <!-- <a class="pull-right btn btn-xs btn-primary" href='<?php echo base_url();?>diklat/program/create'>Tambah Data</a> -->
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <input id="idnya" type="hidden" value="<?php echo $program['PROGRAM_ID'];?>"/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Detail Program Diklat</h6>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">Nama Diklat : </label>
                                <div class="col-sm-4 control-label text-left " id="progname"><?php echo $program['PROGRAM_NAME']?></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">Deskripsi Diklat : </label>
                                <div class="col-sm-10 control-label text-left"><?php echo $program['PROGRAM_DESCRIPTION']?></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">Jadwal Diklat : </label>
                                <div class="col-sm-1 control-label text-left"><?php echo $program['PROGRAM_START']; ?></div>
                                <label class="col-sm-1 control-label text-right" style="margin-left:-40px;">s.d : </label>
                                <div class="col-sm-2 control-label text-left"><?php echo $program['PROGRAM_END']; ?></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">#</th>
                                    <!-- <th colspan="2" class="text-center">Modul</th>
                                    <th colspan="2" class="text-center">Widyaiswara</th>
                                    <th colspan="2" class="text-center">Kelas</th>
                                    <th colspan="2" class="text-center">Makanan</th>
                                    <th colspan="2" class="text-center">Penunjang Lainnya</th> -->
                                    <?php $arrindex = array(); $arrindex['name'] = 'Indeks'; $arrindex['data'] = array(); $arrpros = array(); $arrpros['name'] = 'prosentase'; $arrpros['data'] = array(); $arrmodul = array(); foreach($modul as $k => $v){?>
                                        <th colspan="2" class="text-center"><?php echo $v['EVALUASI_POINT_NAME']?></th>
                                    <?php array_push($arrmodul,$v["EVALUASI_POINT_NAME"]); } ?>
                                    <th colspan="2" class="text-center">Total</th>
                                </tr>
                                <tr>
                                    <?php foreach($modul as $k => $v){?>
                                        <th class="text-center">Indeks</th>
                                        <th class="text-center">Prosentase (%)</th>
                                    <?php } ?>
                                    <th class="text-center">I</th>
                                    <th class="text-center">P (%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($all) > 0){ ?>
                                    <tr>
                                        <td>Rata-rata Keseluruhan</td>
                                        <!--<td class="text-center"><?php echo $all['EVALUASI_IND_MODUL']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_PRO_MODUL']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_IND_WIDYAISWARA']; ?></td>
                                        <td class="text-center"><a href="javascipt:void();" onclick="showDetail(<?php echo $program['PROGRAM_ID']?>,0)"><?php echo $all['EVALUASI_PRO_WIDYAISWARA']; ?></a></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_IND_KELAS']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_PRO_KELAS']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_IND_MAKANAN']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_PRO_MAKANAN']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_IND_PENUNJANG']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_PRO_PENUNJANG']; ?></td> -->
                                        <?php foreach($modul as $k => $v){ array_push($arrindex['data'],$v['EVALUASI_INDEX']); array_push($arrpros['data'],$v['EVALUASI_PROSEN']); ?>
                                            <td class="text-center"><?php echo $v['EVALUASI_INDEX']; ?></td>
                                            <?php if($v['EVALUASI_MODUL_CAT_ID'] == 2){ ?>
                                                <td class="text-center"><a href="javascipt:void();" onclick="showDetail(<?php echo $program['PROGRAM_ID']?>,0)"><?php echo $v['EVALUASI_PROSEN']; ?></a></td>
                                            <?php }else{ ?>
                                            <td class="text-center"><?php echo $v['EVALUASI_PROSEN']; ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                        <td class="text-center"><?php echo $all['EVALUASI_NILAI_INDEX']; ?></td>
                                        <td class="text-center"><?php echo $all['EVALUASI_PROSENTASE']; ?></td>
                                    </tr>
                                    <?php }else{ ?>
                                    <tr><td class="text-center" colspan="13">Tidak ada data evaluasi</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Daftar Evaluasi Program Diklat</h6>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataaktif">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center">No</th>
                                    <th rowspan="2" class="text-center">Nama Peserta</th>
                                    <th rowspan="2" class="text-center">Instansi</th>
                                    <?php foreach($modul as $k => $v){?>
                                        <th colspan="3" class="text-center"><?php echo $v['EVALUASI_POINT_NAME']?></th>
                                    <?php } ?>
                                    <!-- <th rowspan="2" class="text-center">Instansi</th>
                                    <th colspan="2" class="text-center">Modul</th>
                                    <th colspan="2" class="text-center">Widyaiswara</th>
                                    <th colspan="2" class="text-center">Kelas</th>
                                    <th colspan="2" class="text-center">Makanan</th>
                                    <th colspan="2" class="text-center">Penunjang Lainnya</th> -->
                                    <th colspan="2" class="text-center">Total</th>
                                </tr>
                                 <tr>
                                    <?php foreach($modul as $k => $v){?>
                                        <th class="text-center">Indeks</th>
                                        <th class="text-center">Prosentase (%)</th>
                                        <th class="text-center">S</th>
                                    <?php } ?>
                                    <th class="text-center">I</th>
                                    <th class="text-center">P (%)</th>
                                </tr>
                                </thead>
                                <tbody id="listPeserta">
                                    <?php $no = 1;  foreach($peserta as $k => $v){?>
                                        <tr>
                                         <td class="text-center"><?php echo $no; ?></td>
                                         <td class="text-left"><?php echo $v['MEMBER_NAME']?></td>
                                         <td class="text-left"><?php echo $v['INSTANSI_NAME']?></td>
                                         <?php foreach($v['evalmodul'] as $c => $y){?>
                                            <td class="text-center"><?php echo $y['EVALUASI_MODUL_INDEX']?></td>
                                             <?php if($y['EVALUASI_MODUL_CAT_ID'] == 2){ ?>
                                                <td class="text-center"><a href="javascipt:void();" onclick="showDetail(<?php echo $program['PROGRAM_ID']?>,<?php echo $v['EVALUASI_MEMBER_ID']; ?>)"><?php echo $y['EVALUASI_MODUL_PROSEN']; ?></a></td>
                                            <?php }else{ ?>
                                            <td class="text-center"><?php echo $y['EVALUASI_MODUL_PROSEN']; ?></td>
                                            <?php } ?>
                                            <td class="text-center"><a href="javascript:void(0);" class="tip" onclick="showComment(this)" data-komentar="<?php echo $y['EVALUASI_MODUL_NOTED']; ?>" data-placement="top"><i class="icon-bubble4"></i></a></td>
                                        <?php } ?>
                                         <td class="text-center"><?php echo $v['EVALUASI_NILAI_INDEX']?></td>
                                         <td class="text-center"><?php echo $v['EVALUASI_PROSENTASE']?></td>
                                         </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Grafik Evaluasi Program Diklat</h6>
                    </div>
                    <div class="panel-body">
                        <div id="chartnya"></div>
                    </div>
                </div>
                <div class="form-actions text-left">
                    <a href="<?php echo base_url();?>diklat/evaluasi" class="btn btn-xs btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    $arrseries = array();
    array_push($arrseries, $arrpros);
    array_push($arrseries, $arrindex);
    //echo "<pre>"; echo json_encode($arrseries); die;
?>
<div id="modalShowInst" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h4 class="modal-title"><i class="icon-info"></i> Hasil Evaluasi Pengajar</h4>
            </div>

            <div class="modal-body with-padding">
                <table class="table table-striped table-bordered table-hover" id="dataaktifsss">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Pengajar</th>
                        <th class="text-center">Nilai Index</th>
                        <th class="text-center">Nilai Prosentase</th>
                    </tr>
                    </thead>
                    <tbody id="listInst">
                       
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                
                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="modalShowComment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h4 class="modal-title"><i class="icon-info"></i> Saran/Komentar</h4>
            </div>

            <div class="modal-body with-padding">
                <p id="textComment">
                    
                </p>
            </div>

            <div class="modal-footer">
                
                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var id = $('#idnya').val();
        $('#dataaktif').dataTable( {
            "bDestroy" : true,  
            //"processing": true,
            //"serverSide": true,
            //"bServerSide": true,
            //"sAjaxSource": baseurl+"diklat/evaluasi/listdataavaluasi/" + id,
            //"sAjaxSource": baseurl+"diklat/program/listdataaktif",
            //"aaSorting": [[0, "desc"]],
            /*"aoColumns": [
                { "bSortable": false, "sClass": "text-center" },
                { "sClass": "text-left" },
                { "sClass": "text-left" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" },
                { "sClass": "text-center" }
            ],*/
            "fnDrawCallback": function () {
                set_default_datatable();
            },
        });
        Highcharts.chart('chartnya', {            
            title: {
                text: 'Grafik Evaluasi Program'
            },
            subtitle: {
                text: $("#progname").html()
            },
            xAxis: {
                categories: <?php echo json_encode($arrmodul); ?>,
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'Point'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },
            series: <?php echo json_encode($arrseries); ?>,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    });

    function showDetail(id,mid){
        $.ajax({
          url       : "<?php echo base_url('diklat/evaluasi/showdetail');?>/"+id+"/"+mid,
          type      : "GET",
          dataType  : "JSON",
          success: function(data){
            var html = '';
                          
            $.each(data, function(index) {
                html+= '<tr>';
                html+= '<td class="text-center">'+(index+1)+'</td>';
                html+= '<td class="text-left">'+data[index]['INSTRUCTOR_NAME']+'</td>';
                html+= '<td class="text-center">'+(data[index]['NILAI_INDEX']*1).toFixed(2)+'</td>';
                html+= '<td class="text-center">'+(data[index]['NILAI_PROSEN']*1).toFixed(2)+'</td>';
                html+= '</tr>';
               
            });
            $("#listInst").html("").append(html);
            $('#modalShowInst').modal('show');
          },
          error: function (jqXHR, textStatus, errorThrown){}
        });
    }

    function showComment(ini){       
        $("#textComment").html("").append($(ini).attr('data-komentar'));
        $('#modalShowComment').modal('show');
    }

    
</script>
