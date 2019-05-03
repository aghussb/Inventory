<div style="margin-top: 80px;">
	<div style="margin: 0px 25px;">
		
		<div class="panel panel-default">
			<div class="panel-heading">Laporan Penjualan Transaksi</div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label class="lbl">Nama Pelanggan</label>
						<select name="nama" id="nama" class="selectpicker form-control" data-live-search="true" placeholder="Nama Pelanggan" required>
							<option></option>
							<?php 
								foreach($option_nama as $row_option_nama){
								?>
								<option value="<?php echo $row_option_nama['nama']?>"><?php echo $row_option_nama['nama']?></option>
								<?php 
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-4" style="margin-left: 0;">
						<label class="lbl">Kode Barang</label>
						<select name="kodebar" id="kodebar" class="selectpicker form-control" data-live-search="true" placeholder="Kode Barang" required>
							<option></option>
							<?php 
								foreach($option_kodebar as $row_option_kodebar){
								?>
								<option value="<?php echo $row_option_kodebar['barang_id']?>"><?php echo $row_option_kodebar['barang_id']?></option>
								<?php 
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-4" style="margin-left: 0;">
						<label class="lbl label-save_all">Tanggal</label>
						<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="dd-mm-yyyy" data-mask="00-00-0000">
					</div>
				</div>
				
				<div class="form-row">
					<center>
						<div class="form-group col-md-12" style="">
							<input type="button" value="Cari" id="search" class="btn btn-primary"/>
							<input type="button" value="Reset" id="reset" class="btn btn-default"/>
						</div>
					</center>
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Table Laporan Penjualan</div>
			<div class="panel-body">
				<table id="table" class="table table-striped table-bordered">
					<thead>
						<tr>
							<!-- <th width="10">No</th> -->
							<th>No.Faktur</th>
							<th>Nama Pelanggan</th>
							<th>Kode Barang</th>
							<th>Tanggal</th>
							<th>Jumlah Beli</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
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
			"bInfo": false,
			"bLengthChange": false,
			"ajax": {
				"url": '<?php echo site_url('m/C_laporanpnjl/table_list')?>',
				"type": "POST",
				"data": function (data) {
					data.nama    = $('#nama').val();
					data.tanggal = $('#tanggal').val();
					data.kodebar = $('#kodebar').val();
				}
			},
			"columns": [
			// {"data": "no"},
			{"data": "nofak"},
			{"data": "namapel"},
			{"data": "kodebar"},
			{"data": "tanggal"},
			{"data": "jumlah_beli"}
			],
			"columnDefs": [
			{ 
				"targets": [0,1,2,3,4], //last column
				"orderable": false, //set not orderable
			}],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"language": {
				"infoFiltered":"",
				"processing": ""
			},
			"dom": 'lBfrtip',
			"buttons": [
			{extend: 'copy',  title: 'Laporan Penjualan'},
			{extend: 'excel', title: 'Laporan Penjualan'},
			{extend: 'csv',   title: 'Laporan Penjualan'},
			{extend: 'pdf',   title: 'Laporan Penjualan'},
			{extend: 'print', title: '',customize: function ( win ) { $(win.document.body).css( 'margin', '25px 25px' ); } },
			{
				text: 'JSON',
				action: function ( e, dt, button, config ) {
					var data = dt.buttons.exportData();
					
					$.fn.dataTable.fileSave(
					new Blob( [ JSON.stringify( data ) ] ),
					'Laporan Penjualan.json'
					);
				}
			}]
		});
		
		$('#search').click(function(){ 
			table.ajax.reload(null,false);
		});
		
		$('#reset').click(function(){
			$("#nama").val('default');
			$("#nama").selectpicker("refresh");
			$("#kodebar").val('default');
			$("#kodebar").selectpicker("refresh");
			$("#tanggal").val('');
			
			table.ajax.reload(null,false);
		});
		
		$('div.dt-buttons').addClass('tab');
		
	});
	
</script>								