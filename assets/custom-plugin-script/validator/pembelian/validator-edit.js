$(document).ready(function() {
    $('#valid_forget').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
		},
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email tidak boleh kosong'
					},
                    emailAddress: {
                        message: 'Masukkan alamat Email yang benar'
					}
				}
			}
		}
	})
	.on('success.form.bv', function(e) {
		$('#success_register').show();
		$('#valid_forget').data('bootstrapValidator').resetForm();
		
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