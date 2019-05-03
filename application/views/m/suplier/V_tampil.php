<div class="container pos">
	<div id="toolbar" class="btn-group tab">
		<button type="button" onclick="add_suplier()" class="btn btn-default">
			<i class="glyphicon glyphicon-plus"></i>
		</button>
		<button type="button" id="update_suplier" class="btn btn-default">
			<i class="glyphicon glyphicon-edit"></i>
		</button>
		<button type="button" id="delete_suplier" class="btn btn-default">
			<i class="glyphicon glyphicon-trash"></i>
		</button>
	</div>
	<table id="table" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width:0px;">
					<div class="checkbox">
						<input type="checkbox" name="checkbox" value="checkbox" style="position: absolute;" id="checkbox">
						<label for="checkbox"></label>
					</div>
				</th>
				<th>No ID Suplier</th>
				<th>Nama Suplier</th>
				<th>Alamat</th>
				<th>No.Telepon</th>
				<th>Tanggal Terakhir</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">

	var save_method; //for save method string
	var table;

	$(document).ready(function() {
		//datatables
		table = $('#table').DataTable({
			// Load data for the table's content from an Ajax source
			"order": [],
			"autoWidth": false,
			"bInfo": false,
			"bLengthChange": false,
			"ajax": {
				"url": '<?php echo site_url('m/C_suplier/table_list'); ?>',
				"type": "POST"
			},
			"columns": [
			{"data": "id"},
			{"data": "sup_id"},
			{"data": "nama"},
			{"data": "alamat"},
			{"data": "telp"},
			{"data": "tanggal"}
			],

			"columnDefs": [
			{
				"targets": [0,1,2,3,4,5], //last column
				"orderable": false, //set not orderable
			}
			],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"language": {
				"infoFiltered":"",
				"processing": ""
			},
		});

		$('#checkbox').change(function(){
			cells = table.cells().nodes();
			$(cells).find(':checkbox').prop('checked', $(this).is(':checked'));
		});

		$('#delete_suplier').click(function(){
			var id = [];

			$(':checkbox:checked').each(function(i){
				id[i] = $(this).val();
			});

			if(id.length === 0){
				$(document).ready(function(){
					$.notify({
						title: '<strong>Warning</strong><br/>',
						icon: 'fa fa-warning',
						message: "Minimal Tambah 1 Checbox"
						},{
						type: 'warning',
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
				return false;
			}
			else{

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
							url : "<?php echo site_url('m/C_suplier/suplier_delete')?>",
							method:'POST',
							data:{id:id},
							success:function()
							{
								for(var i=0; i<id.length; i++)
								{
									$('tr#'+id[i]+'').css('background-color', '#ccc');
									$('tr#'+id[i]+'').fadeOut('slow');
								}
								reload_table();
								$('#checkbox').prop( 'checked', false );
								$(document).ready(function(){
									$.notify({
										title: '<strong>Success</strong><br/>',
										icon: 'fa fa-check',
										message: "Hapus Suplier"
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
						});
					}
					else{
						$("#confirm-modal").modal('hide');
						return false;
					}
				});

			}
		});

		$('#update_suplier').click(function(){
			var id = [];
			$(':checkbox:checked').each(function(i){
				id[i] = $(this).val();
			});

			if(id.length === 0){
				$(document).ready(function(){
					$.notify({
						title: '<strong>Warning</strong><br/>',
						icon: 'fa fa-warning',
						message: "Minimal Tambah 1 Checbox"
						},{
						type: 'warning',
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
				return false;
			}
			else{
				if(id.length > 1){
					$(document).ready(function(){
						$.notify({
							title: '<strong>Warning</strong><br/>',
							icon: 'fa fa-warning',
							message: "Update Tidak Bisa Lebih Dari 1"
							},{
							type: 'warning',
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
				else{
					$.ajax({
						success:function()
						{
							for(var i=0; i<id.length; i++)
							{
								$('tr#'+id[i]+'').css('background-color', '#ccc');
								$('tr#'+id[i]+'').fadeOut('slow');
							}
							edit_suplier(id);
						}
					});
				}
			}
		});

	});



	function add_suplier()
	{
		save_method = 'add';
		$('#form_suplier')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Suplier'); // Set Title to Bootstrap modal title
	}

	function edit_suplier(id)
	{
		save_method = 'update';
		$('#form_suplier')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class

		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('m/C_suplier/get_id/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{

				$('[name="id"]').val(data.id);
				$('[name="nama"]').val(data.nama);
				$('[name="alamat"]').val(data.alamat);
				$('[name="telp"]').val(data.telp);
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Update Suplier'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax
	}

	function save()
	{
		$('#btnSave').attr('disabled',true); //set button disable
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('m/C_suplier/suplier_insert')?>";
		}
		else {
			url = "<?php echo site_url('m/C_suplier/suplier_update')?>";
		}

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form_suplier').serialize(),
			dataType: "JSON",
			success: function(data)
			{

				if(data.status) //if success close modal and reload ajax table
				{
					if(save_method == 'add') {
						$('#modal_form').modal('hide');

						reload_table();
					}
					else{
						$('#modal_form').modal('hide');

						$(document).ready(function(){
							$.notify({
								title: '<strong>Success</strong><br/>',
								icon: 'fa fa-check',
								message: "Update Suplier"
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

						reload_table();
					}
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++)
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
				$('#btnSave').attr('disabled',false); //set button enable


			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable

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
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form_suplier" class="form-horizontal">
					<input type="hidden" value="" name="id"/>
					<div class="form-body">

						<div class="form-group">
							<label class="control-label col-md-3 lbl">Nama Suplier</label>
							<div class="col-md-9">
								<input name="nama" placeholder="Nama Suplier" class="form-control" type="text">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 lbl">Alamat</label>
							<div class="col-md-9">
								<textarea name="alamat" placeholder="Alamat" class="form-control"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 lbl">No.Telepon</label>
							<div class="col-md-6">
								<input name="telp" placeholder="No.Telepon" data-mask="(+62) 000-0000-0000" class="form-control" type="text">
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body form">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 style="margin-top: 50px;margin-left: 50px;" class="lbl">Apakah Yakin Ingin Menghapus Data ini?</h3>
				<br/>
				<div class="modal-footer" style="border-top: 0px transparent;padding:0px;">
					<button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
					<button type="button" class="btn btn-default" id="modal-btn-no">No</button>
				</div>
			</div>
		</div>
	</div>
</div>
