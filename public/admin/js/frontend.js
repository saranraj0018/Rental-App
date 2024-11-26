$(function () {
    'use strict'

    $(document).ready(function() {
        $(".select2-auto-tokenize").select2();
        //  let imageUploadCount = 3;

        function readURL(input, previewElement) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(previewElement).attr('src', e.target.result).removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('input[name="image_car[]"]').on('change', function() {
            // Find the corresponding preview element
            let previewElement = $(this).closest('.image-upload-section').find('img');
            readURL(this, previewElement);
        });

        // Add more image upload sections vertically
        // document.getElementById('add-more-images').addEventListener('click', function() {
        //     imageUploadCount++;
        //     const container = document.getElementById('image-upload-container');
        //     const newImageUpload = `
        //     <div class="image-upload-section mb-3">
        //         <div class="border p-2 rounded text-center">
        //             <img id="image_preview_${imageUploadCount}" src="#" alt="Your Image" class="img-fluid mb-2 d-none" style="max-height: 150px;">
        //             <input type="file" class="form-control" name="image_car[]" id="car_pic_${imageUploadCount}" accept=".png, .jpg, .jpeg" >
        //         </div>
        //     </div>
        // `;
        //     container.insertAdjacentHTML('beforeend', newImageUpload);
        //
        //     // Add event listener for the new file input
        //     document.getElementById(`car_pic_${imageUploadCount}`).addEventListener('change', function() {
        //         readURL(this, `image_preview_${imageUploadCount}`);
        //     });
        // });

        $('.select2-auto-tokenize').select2({
            dropdownParent: $('.card-body form'),
            tags: true,
            tokenSeparators: [','],
            placeholder: "Enter Car Features",
            allowClear: true
        });
        // Validate the form before submission

        $('#banner_section').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission for validation

            let isValid = true;

            // Define the elements and their conditions
            let fields = [
                {id: '#title', condition: (val) => val.trim() === ''},
                {id: '#description', condition: (val) => val.trim() === ''},
                {id: '#features', condition: (val) => !val || val.length === 0}, // Validate array for features
            ];
            if ($('#banner_id').val() === '0') {
                let imageInputs = $('input[name="image_car[]"]');
                let filledInputs = 0;

                imageInputs.each(function () {
                    if ($(this).val()) {
                        filledInputs++;
                    } else {
                        $(this).addClass('is-invalid');
                    }
                });


                if (filledInputs < 3) {
                    isValid = false;
                    imageInputs.each(function () {
                        if (!$(this).val()) {
                            $(this).addClass('is-invalid');
                        }
                    });
                } else {
                    imageInputs.removeClass('is-invalid');
                }
            }

            fields.forEach(function (field) {
                let element = $(field.id);
                let parent = element.closest('.form-group');

                if (element.length) {
                    let value = element.val();
                    if (field.condition(value)) {
                        parent.find('.invalid-feedback').show();
                        element.addClass('is-invalid');
                        parent.addClass('is-invalid');
                        isValid = false;
                    } else {
                        parent.find('.invalid-feedback').hide();
                        element.removeClass('is-invalid');
                        parent.removeClass('is-invalid');
                    }
                } else {
                    console.error('Element not found: ' + field.id);
                }
            });

            if (isValid) {
                // $('#banner_save').prop('disabled', true);  // Disable submit button during AJAX

                let formData = new FormData(this);


                $.ajax({
                    url: '/admin/banner/save',
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
                            for (let key in errors) {
                                let inputElement = $(`[name="${key+[]}"]`);
                                // Check for array inputs
                                if (key.includes('.')) {
                                    let baseKey = key.split('.')[0];
                                    inputElement = $(`[name="${baseKey}[]"]`);
                                }
                                // If the inputElement is still not found, look by ID
                                if (!inputElement.length) {
                                    inputElement = $(`#${key}`);
                                }
                                if (inputElement.length) {
                                    inputElement.addClass('is-invalid');
                                    inputElement.closest('.form-group').find('.invalid-feedback').text(errors[key][0]).show();
                                } else {
                                    console.error('Element not found for key:', key); // Log missing element key
                                }
                            }
                        } else {
                            console.log(response);
                        }
                    },
                    complete: function() {
                        $('#banner_save').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

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

        $('#front_car_image').on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('#car_info_section').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission for validation

            let isValid = true;

            let fields = [
                {id: '#daily_price', condition: (val) => val.trim() === ''},
                {id: '#daily_price_title', condition: (val) => val.trim() === ''},
                {id: '#car_model', condition: (val) => val.trim() === ''},
                {id: '#car_model_title', condition: (val) => val.trim() === ''},
                {id: '#hour_rate', condition: (val) => val.trim() === ''},
                {id: '#hour_rate_title', condition: (val) => val.trim() === ''},
                {id: '#rating', condition: (val) => val.trim() === ''},
                {id: '#rating_title', condition: (val) => val.trim() === ''},
                {id: '#flexibility', condition: (val) => val.trim() === ''},
                {id: '#flexibility_description', condition: (val) => val.trim() === ''},
                {id: '#maintained', condition: (val) => val.trim() === ''},
                {id: '#maintained_description', condition: (val) => val.trim() === ''},
                {id: '#delivery', condition: (val) => val.trim() === ''},
                {id: '#delivery_description', condition: (val) => val.trim() === ''},
                {id: '#price', condition: (val) => val.trim() === ''},
                {id: '#price_description', condition: (val) => val.trim() === ''},
                {id: '#travel_description', condition: (val) => val.trim() === ''},
                {id: '#description', condition: (val) => val.trim() === ''},
                {id: '#discount', condition: (val) => val.trim() === ''},
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
                    url: '/admin/car-info/save',
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
                        $('#banner_save').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

        $('#brand_section').on('submit', function(e) {
            e.preventDefault();
            $('#vacation_submit').prop('disabled', true);  // Disable submit button during AJAX
            let isValid = true;

            let brandValue = $('#brand_id').val();

            $('.vacation-description, .car, .vacation, .vacation-url').each(function() {
                const $this = $(this);

                const shouldValidate =
                    $this.hasClass('vacation-description') ||
                    $this.hasClass('vacation-url') ||
                    (brandValue !== 1 && ($this.hasClass('car') && $this.hasClass('vacation')));

                if (shouldValidate && $this.val().trim() === '') {
                    $this.addClass('is-invalid');
                    $this.siblings('.invalid-feedback').show();
                    isValid = false;
                } else {
                    $this.removeClass('is-invalid');
                    $this.siblings('.invalid-feedback').hide();
                }
            });

            if (isValid) {
                let formData = new FormData(this);

                $.ajax({
                    url: '/admin/brand/save',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
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
                        $('#vacation_submit').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

        let deleteId;
        $('#brand_section').on('click', '.delete-brand', function() {
            deleteId = $(this).data('id');
            $('#delete_brand_model').modal('show');
        });

        $('#confirm_delete_image').on('click', function() {
            $.ajax({
                url: `/admin/brand/${deleteId}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#delete_brand_model').modal('hide');  // Hide the modal
                    alertify.success(response.success);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);

                },
                error: function(response) {
                    alert('Error');
                }
            });
        });

        $('#general_section').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission for validation

            let isValid = true;

            // Define the elements and their conditions
            let fields = [
                {id: '#minimum_hours', condition: (val) => val.trim() === ''},
                {id: '#maximum_hours', condition: (val) => val.trim() === ''},
                {id: '#delivery_fee',condition: (val) => val.trim() === ''},
                {id: '#show_duration',condition: (val) => val.trim() === ''},
            ];

            fields.forEach(field => {
                let element = $(field.id);
                let value = element.val();
                if (field.condition(value)) {
                    element.addClass('is-invalid');
                    isValid = false;
                } else {
                    element.removeClass('is-invalid');
                }
            });

            if (isValid) {
                $.ajax({
                    url: '/admin/general/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alertify.success(response.success);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
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
                    complete: function() {
                        // $('#banner_save').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });
    });
});
