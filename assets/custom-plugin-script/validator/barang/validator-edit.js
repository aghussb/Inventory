$(document).ready(function() {
    $('#valid_barang_edit').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok v_bedit_bnr',
            invalid: 'glyphicon glyphicon-remove v_bedit_slah',
            validating: 'glyphicon glyphicon-refresh'
		},
        fields: {
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
					}
				}
			},
			beli: {
                validators: {
                    notEmpty: {
                        message: 'Harga Beli tidak boleh kosong'
					},
					numeric: {
						message: 'Masukkan Angka yang Benar',
					}
				}
			},
			jual: {
                validators: {
                    notEmpty: {
                        message: 'Harga Jual tidak boleh kosong'
					},
					numeric: {
						message: 'Masukkan Angka yang Benar',
					}
				}
			},
			stock: {
                validators: {
                    notEmpty: {
                        message: 'Stock tidak boleh kosong'
					},
					numeric: {
						message: 'Masukkan Angka yang Benar',
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_register').show();
		$('#valid_barang_edit').data('bootstrapValidator').resetForm();
		
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
});