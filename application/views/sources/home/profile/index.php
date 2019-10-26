<link href="<?php echo base_url();?>assets/js/plugins/strength-password/jquery.pwstrength.css" rel="stylesheet" type="text/css">
<div class="row"> 
	<div class="col-md-12">
		<!-- start: FORM VALIDATION 2 PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Profil
			</div>
			
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="tabbable">
							<ul id="myTab" class="nav nav-tabs tab-bricky">
								<li class="active">
									<a href="#aktif" data-toggle="tab" data-id="1">
										Profil Pengguna
									</a>
								</li>
								<li>
									<a href="#editpassword" data-toggle="tab" data-id="3">
										Edit Password
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane in active" id="aktif">
									<div class="row">
										<div class="panel-body">
											<table class="table table-condensed table-hover">
												<thead>
													<tr>
														<th colspan="2">Informasi Pengguna</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Nama Hak Akses</td>
														<td><?php echo $pengguna["ACCESS_NAME"];?></td>
													</tr>
													<tr>
														<td>Username</td>
														<td><?php echo $pengguna["USER_NAME"];?></td>
													</tr>													
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="editpassword">
									<form id="mki_form_edit_password" method="post" enctype="multipart/form-data" action="<?php echo base_url()."home/profile/editpassword/".$this->session->userdata('user_id');?>">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label">
														Kata Sandi Lama
													</label>
													<input type="password" placeholder="password" class="form-control wajib" name="oldpassword" id="oldpassword">
												</div>
												<div class="form-group">
													<label class="control-label">
														Kata Sandi
													</label>
													<input type="password" data-indicator="pwindicator" placeholder="password" class="form-control wajib" name="password" id="password">
													<span id="pwindicator">
									                    <div class="bar"></div>
									                    <div class="label"></div>
									                </span>
												</div>
												<div class="form-group">
													<label class="control-label">
														Ulang Kata Sandi
													</label>
													<input type="password"  placeholder="password" class="form-control wajib" id="password_again" name="password_again">
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-12">
											<input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
												<button class="btn btn-sm btn-green" type="submit" onclick="cekpassword()">
													<i class="clip-checkbox"></i> Simpan
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-- end: FORM VALIDATION 2 PANEL -->
	</div>
	<div class="modal fade" id="konfirmasi_email" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<p>
						Anda yakin mereset password user ini ?
					</p>
				</div>
				<div class="modal-footer">
					<button aria-hidden="true" data-dismiss="modal" class="btn btn-red">
						<i class="fa fa-times"></i> Batal
					</button>
					<button class="btn btn-green" id="yakin_konfirm_email" type="button">
						<i class="clip-checkbox"></i> Yakin
					</button>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url();?>assets/js/plugins/strength-password/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		var $ = jQuery;
		$(document).ready(function() {
			$('#password').pwstrength();
			$('#buttonclick').click(function(){
				$('#konfirmasi_email').modal('show');
			});
			
			$('#yakin_konfirm_email').click(function(){
				$.ajax({
					url: '<?php echo base_url(); ?>home/profile/reset_password',
					type: 'POST',
					dataType: 'html',
				})
				.done(function(result) {
					alert()
				});
			});
			$('#oldpassword').blur(function() {
				var thisval = $(this).val();

				$.ajax({
					url: '<?php echo base_url(); ?>home/profile/checkOldPass?oldpass='+thisval,
					type: 'POST',
					dataType: 'html',
				})
				.done(function(result) {
					if(result==0){
						$('#oldpassword').parents(".form-group").removeClass('has-success').find('.help-block').html('');
						$('#oldpassword').parents(".form-group").addClass('has-error').find('.help-block').html('Password incorect, please try again!');
					}else{
						$('#oldpassword').parents(".form-group").removeClass('has-error').find('.help-block').html('');
						$('#oldpassword').parents(".form-group").addClass('has-success').find('.help-block').html('');
					}
				});
			});	
		});

</script>