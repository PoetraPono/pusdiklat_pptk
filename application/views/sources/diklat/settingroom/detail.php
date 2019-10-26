<style>
	.input-sm {
		height: 26px;
	}
</style>

<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href='<?php echo base_url();?>'>Pusdiklat PPATK</a></li>
		<li class="active">Detail Data Peserta</li>
	</ul>

	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>

</div>



<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="icon-copy"></i>Detail Data Peserta</h6>
	</div>
    <form id="mki_form" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <div class="panel-body">
            <div class="form-horizontal">

                 <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Nama Peserta :
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $peserta["MEMBER_NAME"] ?>
                    </div>
                </div>
<!-- 
                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                      Username :
                    </label>
                    <div class="col-sm-9 control-label">
                       <?php echo $peserta['MEMBER_USERNAME']; ?>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                       Password :
                    </label>
                    <div class="col-sm-9 control-label">
                       <?php echo $peserta['MEMBER_PASSWORD']; ?>
                    </div>
                </div> -->

                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Nik :
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $peserta["MEMBER_NIK"] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                        Alamat :
                    </label>
                    <div class="col-sm-9 control-label">
                        <?php echo $peserta["MEMBER_ADDRESS"] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                       E Mail :
                    </label>
                    <div class="col-sm-9 control-label">
                       <?php echo $peserta['MEMBER_EMAIL']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                       Phone :
                    </label>
                    <div class="col-sm-9 control-label">
                       <?php echo $peserta['MEMBER_PHONE']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="config_code" class="col-sm-2 control-label" style="text-align: right">
                       Jumlah Keikutsertaan :
                    </label>
                    <div class="col-sm-9 control-label">
                       <?php echo $peserta['MEMBER_JML_DIKLAT']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 control-label">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-table2"></i> Daftar Diklat yang Pernah Diikuti</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;" rowspan="2">No.</th>
                                        <th style="text-align:center;" rowspan="2">Nama Program</th>
                                        <th style="text-align:center;" rowspan="2">Deskripsi</th>
                                        <th style="text-align:center;" rowspan="2">Bidang Program</th>
                                        <th style="text-align:center;" colspan="2">Tanggal</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;">Mulai</th>
                                        <th style="text-align:center;">Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $n = 1; if(count($diklat) > 0){ ?>
                                        <?php foreach ($diklat as $k => $v) { ?>
                                            <tr class="rw_participant">
                                                <td class="align-center" style="text-align:center;"><?php echo $n; ?></td>
                                                <td class="align-left"><?php echo $v['PROGRAM_NAME']; ?></td>
                                                <td class="align-center" style="text-align:left;"><?php echo $v['PROGRAM_DESCRIPTION']; ?></td>
                                                <td class="align-center" style="text-align:left;"><?php echo $v['SECTOR_NAME']; ?></td>
                                                <td class="align-center" style="text-align:center;"><?php echo date('d-m-Y', strtotime($v['PROGRAM_START'])); ?></td>
                                                <td class="align-center" style="text-align:center;"><?php echo date('d-m-Y', strtotime($v['PROGRAM_END'])); ?></td>
                                                
                                            </tr>
                                        <?php $n++; } ?>
                                    <?php }else{ ?>
                                    <tr><td collspan="6">Tidak ada program diklat yang pernah diikuti</td></tr>
                                    <?php } ?>
                                </tbody>
                              
                               <!--  <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align:right;">
                                            <a href="javascript:void(0);" class="btn btn-xs btn-default" id="reset" ><i class="icon-loop4"></i> reset</add>
                                            &emsp; <a href="javascript:void(0);" class="btn btn-xs btn-info" id="add_requisite" data-ref="<?php echo $n; ?>"><i class="icon-plus-circle"></i> tambah</add>
                                        </td>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        
                        <a href="<?php echo base_url();?>diklat/peserta" class="btn btn-xs btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>