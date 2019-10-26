
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/modules/data.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/modules/drilldown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/highcharts/modules/offline-exporting.js"></script>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Beranda</li>
    </ul>

    <div class="visible-xs breadcrumb-toggle">
        <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
    </div>

</div>
<!-- /breadcrumbs line -->
<!-- /breadcrumbs line -->
<div class="row">
   <div class="col-md-8">
   <div id="full-event-calendar"></div>
   <?php require_once('calendar_data.js') ?>
   </div>
   <div class="col-md-4">
       <!-- Vertical bars -->
       <div class="panel panel-default">
           <div class="panel-heading">
               <h6 class="panel-title"><i class="icon-file"></i> Noted</h6>
           </div>
           <div class="panel-body">
                <?php foreach ($program as $k => $v) {
                  echo '<p style="text-align:left;"> <b>'.date('d-m-Y', strtotime($v['start'])).' s.d '.date('d-m-Y', strtotime($v['end'])).'</b></p>';
                  echo '<p style="text-align:left; margin-top: -10px;"> '.$v['title'].'.</p>';
                } ?>
           </div>
       </div>
       <!-- /vertical bars -->
   </div>
</div>
</br>
<div class="row">
    <div class="col-md-12">      
        <!-- Vertical bars -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-stats2"></i>Grafik Program Diklat berdasarkan Bidang Program</h6>
            </div>
            <div class="panel-body">
                <div id="grafik1"></div>
            </div>
        </div>
        
    </div>
    
</div>


<!-- /info blocks -->
<script type="text/javascript">
var calendarEvents= <?php echo json_encode($program); ?>;
$(function () {
    var chart = new Highcharts.chart('grafik1', {
        chart: {
            type: 'column',
            events: {
                drilldown: function (e) {
                    //chart.setTitle({ text: "Jenis Peradilan " + e.point.name });
                    chart.setTitle(null, {
                        text: e.point.name
                    });
                },
                drillup: function (e) {
                    chart.setTitle(null, {
                        text: ""
                    });
                }
            }
        },
        title: {
            text: 'Grafik Program Diklat berdasarkan Bidang Program'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah Program'
            }

        },
        legend: {
            enabled: false
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

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
        },

        series: [<?php echo json_encode($series1); ?>],
        drilldown: <?php echo json_encode($drilldown1); ?>
    });

});
		</script>