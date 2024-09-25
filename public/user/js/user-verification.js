$(function () {
    'use strict';

    function validateField(field) {
        const element = $(field.id);
        const value = element.val();
        if (field.condition(value)) {
            element.addClass('is-invalid');
            return false;
        } else {
            element.removeClass('is-invalid');
            return true;
        }
    }

    function handleAjaxErrors(xhr, fieldId) {
        const field = $(fieldId);
        field.removeClass('is-invalid');
        $('.invalid-feedback').hide();

        if (xhr.status === 422) {
            const response = xhr.responseJSON;
            field.addClass('is-invalid');
            field.siblings('.invalid-feedback').text(response.message).show();
        }
    }

    // Send OTP form
    $('#user-otp').on('submit', function(e) {
        e.preventDefault();
        if (validateField({ id: '#mobile_number', condition: (val) => val === '' })) {
            $.ajax({
                url: '/user/send-otp', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#mobileModal').modal('hide');
                        $('#otpModal').modal('show');
                        $('#userPhone').text(response.phone);
                    } else {
                        alert(response.message); // You may replace this with a modal if preferred
                    }
                },
                error: function(xhr) {
                    handleAjaxErrors(xhr, '#mobile_number');
                }
            });
        }
    });

    // Verify OTP form
    $('#verification_otp').on('submit', function(e) {
        e.preventDefault();
        if (validateField({ id: '#verification_code', condition: (val) => val === '' })) {
            $.ajax({
                url: '/user/verify-otp', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#otpModal').modal('hide');
                        $('#otp_error').text('');
                    } else {
                        $('#otp_error').text('Invalid OTP');
                    }
                },
                error: function(xhr) {
                    handleAjaxErrors(xhr, '#verification_code');
                }
            });
        }
    });

    // Back button functionality
    $('.back-button').click(function() {
        const prevModal = $(this).data('prev');
        if (prevModal === 1) {
            $('#otpModal').modal('hide');
            $('#mobileModal').modal('show');
        } else if (prevModal === 2) {
            $('#registerModal').modal('hide');
            $('#otpModal').modal('show');
        }
    });

    // Show registration form
    $('.register-link').click(function() {
        $('#mobileModal').modal('hide');
        $('#registerModal').modal('show');
    });

    // User Registration form
    $('#user_registration').on('submit', function(e) {
        e.preventDefault();
        const fields = [
            { id: '#user_name', condition: (val) => val === '' },
            { id: '#reg_mobile_number', condition: (val) => val === '' }
        ];

        let isValid = true;
        fields.forEach(field => {
            if (!validateField(field)) isValid = false;
        });

        if (isValid) {
            $.ajax({
                url: '/user/register', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#registerModal').modal('hide');
                        $('#mobileModal').modal('show');
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error during registration'); // Replace alert if needed
                }
            });
        }
    });
});
