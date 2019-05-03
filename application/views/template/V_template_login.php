<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Inventory</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/icon/box01.ico" type="img/x-icon">
		
		<!-- Link CSS -->
		<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/roboto/font.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-validator/bootstrapValidator.min.css">
		<link href="<?php echo base_url();?>assets/awesome-bootstrap-checbox/awesome-bootstrap-checkbox.min.css" rel="stylesheet">
		
		<!-- Link Custom CSS -->
		<link href="<?php echo base_url();?>assets/custom.style.css" rel="stylesheet">
		
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url();?>"><i class="fa fa-briefcase"></i> Inventory</a>
			</div>
            <div class="collapse navbar-collapse" id="">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="" class="dropdown-toggle" style="margin-right: 15px;" data-toggle="dropdown">Sign in <b class="caret"></b></a>
						<ul class="dropdown-menu" style="padding: 15px;min-width: 300px;margin-right: 15px;">
							<li>
								<div class="row">
									<div class="col-md-12">	
										<form class="form" role="login" method="post" action="<?php echo base_url('login'); ?>" accept-charset="UTF-8" id="login">
											<div class="form-group input-group">
												<input type="text" class="form-control" placeholder="Username" id="username" name="username" required/>
												<span class="input-group-addon"><i class="fa fa-user"></i></span>
											</div>
											
											<!--<div class="form-group has-feedback">
												<input type="text" class="form-control" placeholder="Username" name="username" required/>
												<span class="form-control-feedback"><i class="fa fa-user"></i></span>
											</div>-->
											
											<div class="form-group">
												<input data-toggle="password" data-placement="after" name="password" id="password" class="form-control" type="password" placeholder="password" required>
												<!--<span class="form-control-feedback" id="text" style="display:block;"><i class="fa fa-eye" onclick="passw()"  style="pointer-events:initial;"></i></span>
												<span class="form-control-feedback" id="password" style="display:none;"><i class="fa fa-eye-slash" onclick="passw()"  style="pointer-events:initial;"></i></span>-->
											</div>
											
											<!--<div class="form-group input-group">
												<span class="input-group-addon"><i class="fa fa-lock" ></i></span>
												<input type="password" class="form-control"  placeholder="Password" name="password" required/>
											</div>-->
											
											<div class="" style="">
												<label>
													<div class="checkbox">
														<input type="checkbox" name="checkbox" value="checkbox" style="position: absolute;" id="remember_me">
														<label for="remember_me"> Remember me</label>
													</div>
												</label>
												<a href="#" class="pull-right" style="margin-top: -32px;margin-left: 149px;" data-toggle="modal" data-target="#forgot"><u>Forgot Password</u></a>
											</div>
											<?php 
												if(isset($error)){
													echo $error;
												}
												else{
												?>
												<div class="form-group">
													<button type="submit" class="btn btn-default" id="" name="submit" value="login">Login</button>
													<a href="<?php echo site_url('register');?>" class="btn btn-default">Sign Up</a>
												</div>
												<?php 
												}
											?>
										</form>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		
		<div id="page-wrapper" >
			<div id="page-inner">
				<div class="row">
					<div class="col-md-10">
					
						<?php echo $contents;?>
						
					</div>
				</div>
			</div>             
		</div>
		
		<!-- Modal Forget -->
		<div id="forgot" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- konten modal-->
				<div class="modal-content">
					<!-- heading modal -->
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Forgot Password</h4>
					</div>
					<!-- body modal -->
					<div class="modal-body">
						<form action="<?php echo base_url('forget')?>" method="post" id="valid_forget">
							
							<div class="form-group">
								<label for="" class="lbl">Email Pertama Anda</label>
								<input type="email" class="form-control" id="" name="email" placeholder="Email">
							</div>
							
							<div class="form-group">
								<input type="submit" class="btn btn-primary center-block" style="margin-left: 250px;" name="for" value="Simpan">
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Add -->
		
		<!-- Link Script -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-alert-auto-dissmis/bootstrap-auto-dismiss-alert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-show-password/bootstrap-show-password.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/typed/register/kanan/reg-typed.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-validator/js/bootstrapvalidator.min.js"></script>
		
		<!-- Custom Toggle Link Script -->
		<!--<script type="text/javascript" src="assets/custom-show-password/show-password.min.js"></script>-->
		
		<!-- Link Validator Script -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugin-script/validator/validator-register.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/custom-plugin-script/validator/validator-forget.js"></script>
		
		<!-- Add Script -->
		<script>
			$(function() {
				if (localStorage.chkbx && localStorage.chkbx != '') {
					$('#remember_me').attr('checked', 'checked');
					$('#username').val(localStorage.usrname);
					$('#password').val(localStorage.pass);
					} else {
					$('#remember_me').removeAttr('checked');
					$('#username').val('');
					$('#password').val('');
				}
				
				$('#remember_me').click(function() {
					
					if ($('#remember_me').is(':checked')) {
						// save username and password
						localStorage.usrname = $('#username').val();
						localStorage.pass = $('#password').val();
						localStorage.chkbx = $('#remember_me').val();
					} 
					else {
						localStorage.usrname = '';
						localStorage.pass = '';
						localStorage.chkbx = '';
					}
				});
			});
		</script>
	</body>
</html>										