<br/><br/><br/>
<div class="box"></div>
<div class="container">
	<div class="col-md-12">
		<span class="reg" id="reg-typed"></span>
		<form action="<?php echo site_url();?>C_auth/add" method="post" class="pull-right" style="margin-top: -70px;"  id="valid_register">
			<div class="row">
				<div class="form-group">
					<label for="" class="lbl">Username</label>
					<input name="username" placeholder="Username" class="form-control" type="text">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="" class="lbl">Nama</label>
					<input type="text" class="form-control" name="nama" id="" placeholder="Nama" onkeypress="return hanyahuruf(event)">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="" class="lbl">Email</label>
					<input type="email" class="form-control" name="email" id="" placeholder="Email">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group asd">
					<label for="" class="lbl">Password</label>
					<input type="password" class="form-control" name="password" id="" placeholder="Password">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group has-feedback">
					<label for="" class="lbl">Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password" id="" placeholder="Confirm">
				</div>
			</div>
			
			<div class="form-group">
				<center>
					<button type="submit" class="btn btn-default" name="simpan" value=""><i class="fa fa-check"></i> Daftar</button>
				</center>
			</div>
		</form>
	</div>
</div>

<div class="ver"></div>

<p class="reg1">Register<br/>To Make<br/>History</p>
<!-- Add Script -->
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		new Typed('#reg-typed', {
			strings: ['Register'],
			typeSpeed: 100,
			backSpeed: 100,
			fadeOut: true,
			loop: false
		});
	});
</script>
<script type="text/javascript">
	function hanyahuruf(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
		return false;
		return true;
	}
</script>
