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

    $('#user_profile').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        const fields = [
            { id: '#user_name', condition: (val) => val === '' },
            { id: '#user_mobile', condition: (val) => val === '' },
            { id: '#aadhaar_number', condition: (val) => val === '' },
            { id: '#driving_licence', condition: (val) => val === '' },
        ];
        fields.forEach(field => {
            if (!validateField(field)) isValid = false;
        });

        if (isValid) {
            let formData = new FormData(this);
            $.ajax({
                url: '/user/document/update', // Update with your route
                method: 'POST',
                data: formData,
                processData: false, // Required for jQuery to send the data properly
                contentType: false, // Required to handle file uploads correctly
                success: function(response) {
                    if (response.success){
                        $('#profile_message').text(response.message)
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        $('.form-control').removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        $.each(errors, function (key, value) {
                            let element = $('#' + key);
                            // For other form controls
                            element.addClass('is-invalid');
                            // Display the error message
                            element.siblings('.invalid-feedback').text(value[0]);
                        });
                    }
                },
            });
        }
    });

});
