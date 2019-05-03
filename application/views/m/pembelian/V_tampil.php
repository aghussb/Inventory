<div style="margin-top: 80px;">
	<div style="margin: 0px 25px;">
		<div class="panel panel-default">
			<div class="panel-heading">Pembelian Transaksi</div>
			<div class="panel-body">
				<form id="res-nama" method="post" action="">
					<input type="hidden" name="ttitm" placeholder="Total Item" value="" readonly>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label class="lbl">No.Faktur</label>
							<input type="text" class="form-control" name="nofak" placeholder="No.Faktur" value="" readonly>
						</div>
						<div class="form-group col-md-3 form-save_all" style="margin-left: 600px;">
							<label class="lbl label-save_all">Kode Suplier</label>
							
							<select name="kodesup" id="kodesup" class="selectpicker form-control" data-live-search="true" placeholder="Kode Suplier" required>
								<option></option>
								<?php 
									foreach($option as $row_option){
									?>
									<option value="<?php echo $row_option['sup_id'];?>"><?php echo $row_option['sup_id'];?></option>
									<?php 
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label class="lbl">Hari Ini</label>
							<input type="text" class="form-control" name="hari" placeholder="Hari Ini" value="<?php echo $tanggal;?>" readonly>
						</div>
						
						<div class="form-group col-md-3 form-save_all" style="margin-left: 600px;">
							<label class="lbl label-save_all">Nama Suplier</label>
							<input type="text" class="form-control" id="namasup" name="namasup" placeholder="Nama Suplier" readonly>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Table Barang Pembelian</div>
			<div class="panel-body">
				<div class="btn-group tab">
					<button type="button" onclick="add_item()" class="btn btn-default">
						<i class="glyphicon glyphicon-plus"></i> Tambah
					</button>
				</div>
				
				<table id="table" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Harga Beli</th>
							<th>Jumlah Beli</th>
							<th>Stock Awal</th>
							<th>Stock Akhir</th>
							<th>Total Bayar</th>
							<th width="30">Batal</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Total</div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label class="lbl">Total Semua Item</label>
						<input type="text" class="form-control" name="ttitm" placeholder="Total Item" value="" readonly>
					</div>
					<div class="form-group col-md-3" style="margin-left: 600px;">
						<label class="lbl">Total Semua Pembayaran</label>
						<input type="text" class="form-control" placeholder="Total Semua Bayar" name="ttby" id="ttby" value="" readonly>
					</div>
				</div>
				<div class="frm_btn_pmbl" style="display:none;">
					<button type="button" class="btn btn-primary" name="save_beli" id="" onclick="save_all()" form="res-nama">Simpan</button>
					<button type="button" class="btn btn-warning" onclick="delete_item_all()">Tidak Jadi</button>
					<button type="reset" class="btn btn-default" onclick="reset_top()" form="res-nama">Reset</button>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready( function () {
		table = $('#table').DataTable({ 
			// Load data for the table's content from an Ajax source
			"order": [],
			"autoWidth": false,
			// "bInfo": false,
			"bLengthChange": false,
			"ajax": {
				"url": '<?php echo site_url('m/C_pembelian/table_list'); ?>',
				"type": "POST"
			},
			"columns": [
			{"data": "kodebar"},
			{"data": "namabar"},
			{"data": "harga_beli"},
			{"data": "jumlah_beli"},
			{"data": "stock"},
			{"data": "stock_akhir"},
			{"data": "total_bayar"},
			{"data": "delete"}
			],
			
			"columnDefs": [
			{ 
				"targets": [0,1,2,3,4,5,6,7], //last column
				"orderable": false, //set not orderable
			}],
			"infoCallback": function( settings, start, end, max, total, pre ) {
				$('[name="ttitm"]').val(total);
				
				if ((total) == "0") {
					$('.frm_btn_pmbl').hide();
				}
				else{
					$('.frm_btn_pmbl').show();
				}
				
				// return 'Showing ' + start +' to ' + end + " of " + total + " entries ";
			},	
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"language": {
				"infoFiltered":"",
				"processing": ""
			},
		});
		
		$('#kodesup').change(function(){
			$.ajax({
				url: '<?php echo site_url("m/C_pembelian/getOptionSelectNamasup")?>',
				type: "GET",
				dataType: "json",
				data: {kode:$(this).val()},
				success: function(data){
					if (data == null) {
						$('#namasup').val('');
					}
					else {
						$('#namasup').val(data.nama);
					}
				}
				
			});
		});
		
		$('#barang').change(function(){
			$.ajax({
				url: '<?php echo site_url("m/C_pembelian/getOptionSelectBarang")?>',
				type: "GET",
				dataType: "json",
				data: {nama:$(this).val()},
				success: function(data){
					if (data == null) {
						$('#kodebar').val('');
						$('#beli').val('');
						$('#stock').val('');
					}
					else {
						$('#kodebar').val(data.barang_id);
						$('#beli').val(data.harga_beli);
						$('#stock').val(data.stock);
					}
				}
				
			});
		});
		
	});
	
	setInterval(function() {
		$.ajax({
			method: 'GET',
			url: '<?php echo site_url('m/C_pembelian/nofak');?>',
			success: function(text) {
				$('[name="nofak"]').val(text);
			}
		});
	}, 1000);
	
	setInterval(function() {
		$.ajax({
			method: 'GET',
			url: '<?php echo site_url('m/C_pembelian/total_bayar');?>',
			success: function(text) {
				var	reverse = text.toString().split('').reverse().join(''),
				ribuan 	    = reverse.match(/\d{1,3}/g);
				ribuan	    = ribuan.join('.').split('').reverse().join('');
				$('[name="ttby"]').val("Rp." + ribuan);
			}
		});
	}, 1000);
	
	function angka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		
		return false;
		return true;
	}
	
	function reset_top() {
		$("#kodesup").val('default');
		$("#kodesup").selectpicker("refresh");
		$('.form-save_all').removeClass('has-error');
		$('.label-save_all').removeClass('text-danger');
	}
	
	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax 
	}
	
	function add_item()
	{
		$('#form_barang')[0].reset(); // reset form on modals
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.form-group').removeClass('has-error'); // clear error class
		$(".label-option").removeClass('text-danger');
		$('.form-save_all').removeClass('has-error');
		$('.label-save_all').removeClass('text-danger');
		$(".form-option").removeClass('has-error');
	}
	
	function insert_barang()
	{	
		$('#btnSave').attr('disabled',true); //set button disable 
		$.ajax({
			url : "<?php echo site_url('m/C_pembelian/add_barang')?>",
			type: "POST",
			data: $('#form_barang').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					$('#modal_form').modal('hide');
					$("#barang").val('default');
					$("#barang").selectpicker("refresh");
					$(document).ready(function(){
						$.notify({
							title: '<strong>Success</strong><br/>',
							icon: 'fa fa-check',
							message: "Tambah Barang"
							},{
							type: 'success',
							animate: {
								enter: 'animated fadeIn',
								exit: 'animated fadeOutRight'
							},
							placement: {
								from: "top",
								align: "right"
							},
							offset: 20,
							spacing: 10,
							z_index: 1031,
							delay: 2000,
							timer: 1000
						});
					});
					
					reload_table();// for reload a page
				}
				else if(data.sudah){
					
					$(document).ready(function(){
						$.notify({
							title: '<strong>Danger</strong><br/>',
							icon: 'fa fa-warning',
							message: "Data Sudah Ditambahkan"
							},{
							type: 'danger',
							animate: {
								enter: 'animated fadeIn',
								exit: 'animated fadeOutRight'
							},
							placement: {
								from: "top",
								align: "right"
							},
							offset: 20,
							spacing: 10,
							z_index: 100000,
							delay: 2000,
							timer: 1000
						});
					});
					
				}
				else{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('.label-option').addClass('text-danger');
						$('[name="'+data.inputerror[i]+'"]').next().html(data.error_string[i]); //select span help-block class set text error string
					}
				}
				
				$('#btnSave').attr('disabled',false); //set button enable
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
			}
		});
		
	}
	
	function delete_barang(id)
	{
		$.ajax({
			url : "<?php echo site_url('m/C_pembelian/delete_item')?>/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				
				$(document).ready(function(){
					$.notify({
						title: '<strong>Success</strong><br/>',
						icon: 'fa fa-check',
						message: "Hapus Barang"
						},{
						type: 'success',
						animate: {
							enter: 'animated fadeIn',
							exit: 'animated fadeOutRight'
						},
						placement: {
							from: "top",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 100000,
						delay: 2000,
						timer: 1000
					});
				});
				
				reload_table();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error deleting data');
			}
		});
	}
	
	function update_jumlah_beli(val) {
		$.fn.editable.defaults.mode = 'inline';
		$(val).editable({
			tpl:'<input type="text" class="form-control input-medium" onkeypress="return angka(event)"/>',
			url: 'm/C_pembelian/update_x',
			type: 'text',
			emptytext: '0',
			pk: 1,
			name: 'jumlah_beli',
			title: 'Enter name',
			validate: function(value) {
				if ($.trim(value) == '') {
					return ' ';
				}
				
			},
			ajaxOptions: {
				type: 'POST',
				dataType: 'json',
				success: function (data) {
					if (data.status) {
						reload_table();
						$(document).ready(function(){
							$.notify({
								title: '<strong>Success</strong><br/>',
								icon: 'fa fa-check',
								message: "Ganti Jumlah Beli"
								},{
								type: 'success',
								animate: {
									enter: 'animated fadeIn',
									exit: 'animated fadeOutRight'
								},
								placement: {
									from: "top",
									align: "right"
								},
								offset: 20,
								spacing: 10,
								z_index: 1031,
								delay: 2000,
								timer: 1000
							});
						});
					}  
				}
			}
		});
	}
	
	function delete_item_all()
	{
		
		var modalConfirm = function(callback){
			$("#confirm-modal").modal('show');
			
			$("#modal-btn-yes").on("click", function(){
				callback(true);
				$("#confirm-modal").modal('hide');
			});
			
			$("#modal-btn-no").on("click", function(){
				callback(false);
				$("#confirm-modal").modal('hide');
			});
		};
		
		modalConfirm(function(confirm){
			if(confirm){
				$.ajax({
					url : "<?php echo site_url('m/C_pembelian/delete_item_all')?>",
					type: "POST",
					dataType: "JSON",
					success: function(data)
					{
						if (data.status) {
							$(document).ready(function(){
								$.notify({
									title: '<strong>Success</strong><br/>',
									icon: 'fa fa-check',
									message: "Hapus Semua Transaksi"
									},{
									type: 'success',
									animate: {
										enter: 'animated fadeIn',
										exit: 'animated fadeOutRight'
									},
									placement: {
										from: "top",
										align: "right"
									},
									offset: 20,
									spacing: 10,
									z_index: 100000,
									delay: 2000,
									timer: 1000
								});
							});
						} 
						
						reload_table();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
				});
			}
			else{
				$("#confirm-modal").modal('hide');
				return false;
			}
		});
		
	}
	
	function save_all()
	{	
		// ajax adding data to database
		$.ajax({
			url : "<?php echo site_url('m/C_pembelian/save_all');?>",
			type: "POST",
			data: $('#res-nama').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					//if success close modal and reload ajax table
					$('[name="ttby"]').val("");
					document.getElementById("res-nama").reset();
					$("#kodepel").val('default');
					$("#kodepel").selectpicker("refresh");
					$('.form-save_all').removeClass('has-error');
					$('.label-save_all').removeClass('text-danger');
					
					$(document).ready(function(){
						$.notify({
							title: '<strong>Success</strong><br/>',
							icon: 'fa fa-check',
							message: "Transaksi Berhasil"
							},{
							type: 'success',
							animate: {
								enter: 'animated fadeIn',
								exit: 'animated fadeOutRight'
							},
							placement: {
								from: "top",
								align: "right"
							},
							offset: 20,
							spacing: 10,
							z_index: 1031,
							delay: 2000,
							timer: 1000
						});
					});
					
					reload_table();// for reload a page
				}
				else{
					$('.form-save_all').addClass('has-error');
					$('.label-save_all').addClass('text-danger');
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error Transaksi');
			}
		});
		
	}
</script>																						

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Barang</h4>
			</div>
			<div class="modal-body form">
				<form action="#" id="form_barang" class="form-horizontal">
					<div class="form-body">
						
						<div class="form-group">
							<label class="control-label col-md-3 lbl">Kode Barang</label>
							<div class="col-md-5">
								<input name="kodebar" id="kodebar" placeholder="Kode Barang" class="form-control" type="text" readonly>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 lbl label-option">Nama Barang</label>
							<div class="col-md-9 form-option">
								<select name="barang" id="barang" class="selectpicker form-control" data-live-search="true" placeholder="Kode Pelanggan" required>
									<option></option>
									<?php 
										foreach($namabar as $row_barang){
										?>
										<option value="<?php echo $row_barang['nama']?>"><?php echo $row_barang['nama'];?></option>
										<?php
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 lbl">Harga Beli</label>
							<div class="col-md-5">
								<input name="hgb" id="beli" placeholder="Harga Beli" class="form-control" type="text" readonly>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 lbl">Stock</label>
							<div class="col-md-4">
								<input name="stock" id="stock" placeholder="Stock" class="form-control" type="text" readonly>
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="insert_barang()" form="form_barang" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 style="margin-top: 50px;margin-left: 50px;">Apakah Yakin Ingin Membatalkan Transaksi?</h3>
				<br/>
				<div class="modal-footer" style="border-top: 0px transparent;padding:0px;">
					<button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
					<button type="button" class="btn btn-default" id="modal-btn-no">No</button>
				</div>
			</div>
		</div>
	</div>		
</div>		