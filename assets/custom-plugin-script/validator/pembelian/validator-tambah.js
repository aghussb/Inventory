$(document).ready(function() {
    $('#valid_pembelian_tambah').bootstrapValidator({
		
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
		},
        fields: {
            namabar: {
                validators: {
                    notEmpty: {
                        message: 'Nama Barang tidak boleh kosong'
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_register').show();
		$('#valid_pembelian_tambah').data('bootstrapValidator').resetForm();
		
		// Prevent form submission
		e.preventDefault();
		
		// Get the form instance
		var $form = $(e.target);
		
		// Get the BootstrapValidator instance
		var bv = $form.data('bootstrapValidator');
		
		// Use Ajax to submit form data
		$.post($form.attr('action'), $form.serialize(), function(result) {
			console.log(result);
		}, 'json');
	});
	.find('[name="namabar"]')
	.selectpicker()
	.change(function(e) {
		/* Revalidate the language when it is changed */
		$('#valid_pembelian_tambah').formValidation('revalidateField', 'namabar');
	})
	.end()
});