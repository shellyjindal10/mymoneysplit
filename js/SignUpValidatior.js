$(document).ready(function () {
$("#signUpForm").validate({
            rules: {
                firstName: {
                    minlength: 2,
                    required: true
                },
                userEmailId: {
                    required: true,
                    email: true
                },
                userPassword: {
                    required: true,
                    required: true
                },
                passwordConfirmation: {
                    minlength: 2,
                    required: true
                }
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.addClass('valid')
                .closest('.form-group').removeClass('has-error').addClass('has-success');
            }
    });


});