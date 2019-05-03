<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->session->userdata('nama');?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/icon/box02.ico" type="img/x-icon">
		
		<!-- Link CSS -->
		<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/DataTables/datatables.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/custom.style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/roboto/font.css" rel="stylesheet"> 
		<link href="<?php echo base_url();?>assets/awesome-bootstrap-checbox/awesome-bootstrap-checkbox.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/animate/animate.min.css" rel="stylesheet"> 
		<link href="<?php echo base_url();?>assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> 
		
		<script src ="<?php echo base_url();?>assets/jquery/jquery.min.js" type="text/javascript"></script>
		<style type="text/css">
			.editable-empty, .editable-empty:hover, .editable-empty:focus{
			font-style: normal;
			}
		</style>
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
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Master <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('barang');?>">Data Barang</a></li>
							<li><a href="<?php echo site_url('pelanggan');?>">Data Pelanggan</a></li>
							<li><a href="<?php echo site_url('suplier');?>">Data Suplier</a></li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('penjualan');?>">Penjualan Barang</a></li>
							<li><a href="<?php echo site_url('pembelian');?>">Pembelian Barang</a></li>
						</ul>
					</li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan Transaksi  <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('lpr_penjualan');?>">Penjualan</a></li>
							<li><a href="<?php echo site_url('lpr_pembelian');?>">Pembelian</a></li>
						</ul>
					</li>
					
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan Transaksi <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li class = "dropdown-submenu"><a href="#">Penjualan</a>
						<ul class="dropdown-menu" role = "menu">
						<li><a href="<?php echo site_url('pnjlnama');?>">Sesuai Nama</a></li>
						<li><a href="<?php echo site_url('pnjltanggal');?>">Sesuai Tanggal</a></li>
						</ul>
						</li>
						<li class = "dropdown-submenu"><a href="#">Pembelian</a>
						<ul class="dropdown-menu" role = "menu">
						<li><a href="<?php echo site_url('pmblnama');?>">Sesuai Nama</a></li>
						<li><a href="<?php echo site_url('pmbltanggal');?>">Sesuai Tanggal</a></li>
						</ul>
						</li>
						</ul>
					</li> -->
					
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="">
						<a href="<?php echo site_url('logout'); ?>" style="margin-right: 15px;">Logout</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<?php echo $contents;?>
		
		<!-- Link Script -->
		<script src ="<?php echo base_url();?>assets/DataTables/datatables.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/typed/welcome.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap-validator/js/bootstrapvalidator.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src ="<?php echo base_url();?>assets/bootstrap3-editable/js/bootstrap-editable.min.js" type="text/javascript"></script>
		
		<script src ="<?php echo base_url();?>assets/jquery-mask/jquery-mask.min.js" type="text/javascript"></script>
		
	</body>
</html>
