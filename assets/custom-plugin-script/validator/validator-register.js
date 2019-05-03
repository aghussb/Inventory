$(document).ready(function() {
    $('#valid_register').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
		},
        fields: {
            username: {
                validators: {
					stringLength: {
                        min: 6,
                        max: 200,
                        message:'Username Minimal 6'
					},
					notEmpty: {
                        message: 'Username tidak boleh kosong'
					}
				}
			},
			nama: {
                validators: {
					stringLength: {
                        min: 6,
                        max: 200,
                        message:'Username Minimal 6'
					},
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
					}
				}
			},
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email tidak boleh kosong'
					},
                    emailAddress: {
                        message: 'Masukkan alamat Email yang benar'
					}
				}
			},
			password: {
				validators: {
					notEmpty: {
                        message: 'Password tidak boleh kosong'
					}
				}
			},
			confirm_password: {
				validators: {
					identical: {
						field: 'password',
						message: 'Password Tidak Sama'
					},
					notEmpty: {
                        message: 'Tolong diisi untuk keamanan'
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_register').show();
		$('#valid_register').data('bootstrapValidator').resetForm();
		
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