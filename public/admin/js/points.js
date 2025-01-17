$(function () {
    'use strict'

    $(document).ready(function() {

        $('.editable-field').each(function() {
            const $span = $(this).find('span');
            const $input = $(this).find('input');

            $span.on('click', function() {
                $span.addClass('d-none');
                $input.removeClass('d-none').focus();
            });

            $input.on('blur', function() {
                $span.text($input.val());
                $input.addClass('d-none');
                $span.removeClass('d-none');
            });
        });

        $('#ipr_info_section').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission for validation

            let isValid = true;

            let fields = [
                {id: '#price_plan', condition: (val) => val.trim() === ''},
                {id: '#price_description', condition: (val) => val.trim() === ''},
                {id: '#fuel', condition: (val) => val.trim() === ''},
                {id: '#fuel_description', condition: (val) => val.trim() === ''},
                {id: '#picture_id', condition: (val) => val.trim() === ''},
                {id: '#picture_description', condition: (val) => val.trim() === ''},
                {id: '#car_key', condition: (val) => val.trim() === ''},
                {id: '#car_key_description', condition: (val) => val.trim() === ''},
            ];

            fields.forEach(function (field) {
                let element = $(field.id);
                let parent = element.closest('.form-group');

                if (element.length) {
                    let value = element.val();
                    if (field.condition(value)) {
                        parent.find('.invalid-feedback').show();
                        element.addClass('is-invalid');
                        isValid = false;
                    } else {
                        parent.find('.invalid-feedback').hide();
                        element.removeClass('is-invalid');
                    }
                } else {
                    console.error('Element not found: ' + field.id);
                }
            });

            if (isValid) {

                let formData = new FormData(this);

                $.ajax({
                    url: '/admin/ipr-info/save',
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for jQuery to send the data properly
                    contentType: false, // Required to handle file uploads correctly
                    success: function(response) {
                        alertify.success(response.success);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
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
                    complete: function() {

                    }
                });
            }
        });


    });
});
