$(document).ready(function() {
    $('#valid_suplier_edit').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok v_sedit_bnr',
            invalid: 'glyphicon glyphicon-remove v_sedit_slah',
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
			alamat: {
                validators: {
                    notEmpty: {
                        message: 'Alamat tidak boleh kosong'
					}
				}
			},
			telp: {
                validators: {
                    notEmpty: {
                        message: 'No.Telepon tidak boleh kosong'
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_register').show();
		$('#valid_suplier_edit').data('bootstrapValidator').resetForm();
		
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