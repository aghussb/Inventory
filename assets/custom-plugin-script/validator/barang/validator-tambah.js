$(document).ready(function() {
    $('#').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		button: {
            selector: '#btnSave',
            disabled: 'disabled'
		},
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
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
			hgb: {
                validators: {
                    notEmpty: {
                        message: 'Harga Beli tidak boleh kosong'
					},
					numeric: {
						message: 'Masukkan Angka yang Benar',
					}
				}
			},
			hgj: {
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
		$('#form_barang').data('bootstrapValidator').resetForm();
		$("#btnSave").attr("disabled", false);
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