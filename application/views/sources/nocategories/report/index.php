<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<link href="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.css" rel="stylesheet" type="text/css">
<style>
	.input-sm {
		height: 26px;
	}
</style>
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Laporan</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>
<!-- /breadcrumbs line -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-print"></i>Laporan</h6>
    </div>
    <form class="form-horizontal need_validation" action="" role="form" method="post" enctype="multipart/form-data">
        <div class="panel-body">
            <div class="alert alert-success fade in block" style="margin-bottom: 15px">
                <i class="icon-info"></i>Lengkapi pilihan kemudian klik tombol download untuk mencetak laporan
            </div>
            <div class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="EMPLOYEE_NIK" class="col-sm-2 control-label">
                                Laporan<span class="mandatory">*</span>
                            </label>
                            <div class="col-sm-6">
                                <select class="select2 wajib" id="TYPE" name="TYPE" data-placeholder="PILIH">
                                    <option value="">Pilih Laporan...</option>
                                    <option value="1">Daftar Program Diklat</option>
                                    <option value="2">Daftar Peserta yang mengikuti Diklat</option>
                                    <option value="3">Daftar Instansi yang mengikuti Diklat</option>
                                </select>     
                                                      
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="POSISI_TANGGAL_PERKARA" class="col-sm-2 control-label">
                                Periode<span class="mandatory">*</span>
                            </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm wajib" id="PERIOD_START" name="PERIOD_START" value="<?php echo date('Y-m-d', time()); ?>" readonly="readonly">
                            </div>
                            <div class="col-sm-1 control-label" >
                                s.d
                            </div>
                            <div class="col-sm-2" style="margin-left:-50px;">
                                <input type="text" class="form-control input-sm wajib" id="PERIOD_END" name="PERIOD_END" value="<?php echo date('Y-m-d', time()); ?>" readonly="readonly">
                            </div>
                        </div>
                        
                        
                         <hr />
                        <div class="form-group">
                            <label for="USER_ACCESS_ID" class="col-sm-2 control-label">
                                
                            </label>
                            <div class="col-sm-10">
                                <!-- <a href="javascript:void(0)" class="btn btn-xs btn-danger aksi_print" id="pdf"><i class="icon-download"></i>Download PDF</a> -->
                                <a href="javascript:void(0)" class="btn btn-xs btn-success aksi_print" id="excel"><i class="icon-download"></i>Download Excel</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- /info blocks -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#PERIOD_START").datepicker({
            format: "yyyy-mm-dd", // Notice the Extra space at the beginning
            //viewMode: "year",
            //minViewMode: "year",
            autoclose: true
        });
        $("#PERIOD_END").datepicker({
            format: "yyyy-mm-dd", // Notice the Extra space at the beginning
            //viewMode: "year",
            //minViewMode: "year",
            autoclose: true
        });
        
    });
    
    $("#pdf").click(function () {

        
    });

    $("#excel").click(function () {
        var type = $('#TYPE').val();
        var param = "";
        //param += $('#TYPE').val() + "|";
        start = $('#PERIOD_START').val();
        end = $('#PERIOD_END').val();

        if (type == 1) {
            window.open(baseurl+"nocategories/report/exceldaftardiklat/"+start+"/"+end, "_blank");
        } else if (type == 2) {
            window.open(baseurl+"nocategories/report/exceldaftarpeserta/"+start+"/"+end, "_blank");
        } else if (type == 3) {
            window.open(baseurl+"nocategories/report/exceldaftarinstansi/"+start+"/"+end, "_blank");
        } else {
            alert("Silakan lengkapi inputan terlebih dahulu !");
        }
       
    });
</script>
