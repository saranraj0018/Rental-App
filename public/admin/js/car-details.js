$(function () {
    'use strict'


    $(document).ready(function() {

        // Check if any selectpicker element has the is-invalid class
        $('select.form-select, select.form-control').each(function() {
            if ($(this).hasClass('is-invalid')) {
                $(this).closest('.bootstrap-select').addClass('is-invalid');
            }
        });
        function resetInput() {
            // Clear form fields
            $('#create_car').find('input, select,textarea').val('');
            // Reset toggle button
            $('#toggle-button').removeClass('on').css('background-color', 'red');
            $('#toggle-button').find('.label.off').show();
            $('#toggle-button').find('.label.on').hide();
            $('#toggle-value').val(2);
            // Remove Bootstrap validation classes
            $('#create_car').find('.is-invalid').removeClass('is-invalid');
            $('#create_car').find('.is-valid').removeClass('is-valid');
            // Optionally reset other elements
            $('#save_coupon').text('');
            $('#singleImageContainer').html('');
            $('#car_other_images_preview').html('');
        }

        // Add Cars
        $('#add_car').click(function() {
            resetInput();
            $('#car_label').text("Add New Car");
            $('#create_car').modal('show');
            $('#submit_btn').text("Submit");
            $('select').selectpicker('refresh');
        });



        // Store Cars
        $('#car_form').on('submit', function(e) {
            e.preventDefault();
            // Define the elements and their conditions in an array of objects
            let isValid = true;
            let fields = [
                { id: '#hub_city', wrapper: true, condition: (val) => val === null || val === "Hub" },
                { id: '#car_model', wrapper: true, condition: (val) => val === null || val === "Model" },
                { id: '#register_number', wrapper: false, condition: (val) => val.trim() === '' },
                { id: '#current_km', wrapper: false, condition: (val) => val.trim() === '' }
            ];
            if ($('#car_location_option').is(':checked') ) {
                fields.push({ id: '#car_location', wrapper: false,
                    condition: (val) => val.trim() === '' });
            }

            // Loop through the fields and apply the validation logic
            fields.forEach(field => {
                let element = $(field.id);
                let value = element.val();
                let wrapper = field.wrapper ? element.closest('.bootstrap-select') : element;

                if (field.condition(value)) {
                    wrapper.addClass('is-invalid');
                    isValid = false;
                } else {
                    wrapper.removeClass('is-invalid');
                }
            });

            if (isValid) {
                $('#submit_btn').prop('disabled', true);  // Disable submit button during AJAX

                $.ajax({
                    url: '/admin/car/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#create_car').modal('hide');
                        updateTable(response.data);
                        alertify.success(response.success);
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $('.form-control').removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        $.each(errors, function(key, value) {
                            let element = $('#' + key);
                            if (element.is('select')) {
                                let selectPicker = element.closest('.bootstrap-select');
                                // Add the 'is-invalid' class to the Bootstrap Select container
                                selectPicker.addClass('is-invalid');
                                // Update the invalid feedback message
                                selectPicker.next('.invalid-feedback').text(value[0]).show();
                            } else {
                                // For other form controls
                                element.addClass('is-invalid');
                            }
                            // Display the error message
                            element.siblings('.invalid-feedback').text(value[0]);
                        });
                    },
                    complete: function() {
                        $('select').selectpicker('refresh');
                        $('#submit_btn').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }



        });
        function updateTable(data) {
            let tbody = $('#car_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.length === 0) {
                tbody.append(` <tr> <td colspan="9" class="text-center">Record Not Found</td> </tr>`);
            } else {
                // Loop through the data and append rows
                $.each(data, function(index, item) {
                    tbody.append(`
                <tr>
                    <td>${item.id}</td>
                    <td>${item.car_model ? item.car_model.model_name : ''} -
                    <a href="javascript:void(0)" class="edit_model" data-id="${item.car_model ? item.car_model.id : 0}"
                           data-producer="${item.car_model ? item.car_model.producer : ''}"
                           data-model_name="${item.car_model ? item.car_model.model_name : ''}"
                           data-seat="${item.car_model ? item.car_model.seat : ''}"
                           data-fuel_type="${item.car_model ? item.car_model.fuel_type : ''}"
                           data-transmission="${item.car_model ? item.car_model.transmission : ''}"
                           data-engine_power="${item.car_model ? item.car_model.engine_power : ''}"
                           data-price_per_hour="${item.car_model ? item.car_model.price_per_hour : ''}"
                           data-dep_amount="${item.car_model ? item.car_model.days : ''}"
                           data-extra_hours_charge="${item.car_model ? item.car_model.extra_hours_price : ''}"
                           data-day_km="${item.car_model ? item.car_model.per_day_km : ''}"
                           data-weekend_surge="${item.car_model ? item.car_model.weekend_surge : ''}"
                           data-peak_reason_surge="${item.car_model ? item.car_model.peak_reason_surge : ''}"
                           data-extra_km_charge="${item.car_model ? item.car_model.extra_km_charge : ''}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                    </td>
                    <td>${item.model_id}</td>
                    <td>${item.register_number}</td>
                    <td>${item.city ? item.city.name : ''}</td>
                    <td>${item.created_at}</td>
                    <td>
                                    <a href="javascript:void(0)" class="btnEdit" data-id="${item.id}"
                           data-hub="${item.city_code}"
                           data-model="${item.model_id}"
                           data-register_number="${item.register_number}"
                           data-current_km="${item.current_km}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="#"  class="delete_btn text-danger w-4 h-4 mr-1" data-id="${item.id}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                </tr>
            `                   );
                });
            }
        }


        // Edit Car
        $('#car_table').on('click', '.btnEdit', function() {
            resetInput();
            let modal = $('#create_car');
            $('#car_label').text("Edit Car");
            $('#submit_btn').text("Update");
            $('#car_form').trigger("reset");
            modal.find('#hub_city').val($(this).data('hub'));
            modal.find('#car_model').val($(this).data('model'));
            modal.find('#register_number').val($(this).data('register_number'));
            modal.find('#current_km').val($(this).data('current_km'));
            modal.find('input[name=car_id]').val($(this).data('id'));
            modal.modal('show');
            $('select.form-select, select.form-control').each(function() {
                $(this).selectpicker('refresh');
            });
        });


        // Add Car Models
        $('#add_car_model').click(function() {
            resetInput();
            $('select').selectpicker();
            $('#car_model_form').trigger("reset");
            $('#car_modal_label').text("Add New Car");
            $('#create_car_modal').modal('show');
        });

        // Edit Car model
        $('#car_table').on('click', '.edit_model', function() {
            const otherCarImages = $(this).data('other_car');
            const singleImage = $(this).data('single_car');
            $('#singleImageContainer').html(`<img src="/storage/car_image/${singleImage}" alt="Single Car Image" class="img-fluid">`);

            const imageContainer = $('#car_other_images_preview');
            imageContainer.empty();

            if (otherCarImages && otherCarImages.length > 0) {
                otherCarImages.forEach(image => {
                    const imageUrl = `/storage/car_other_image/${image.name}`; // Adjust the path if needed
                    const imgElement = `<img src="${imageUrl}" alt="Car Image" class="img-thumbnail m-2" style="width: 100px; height: auto;">`;
                    imageContainer.append(imgElement);
                });
            } else {
                imageContainer.append('<p>No images available</p>');
            }

            let modal = $('#create_car_modal');
            $('#car_modal_label').text("Edit Model");
            $('#car_model_Submit').text("Update");
            $('#car_model_form').trigger("reset");
            modal.find('#producer').val($(this).data('producer'));
            modal.find('#model_name').val($(this).data('model_name'));
            modal.find('#seats').val($(this).data('seat'));
            modal.find('#fuel_type').val($(this).data('fuel_type'));
            modal.find('#transmission').val($(this).data('transmission'));
            modal.find('#engine_power').val($(this).data('engine_power'));
            modal.find('#price_per_hours').val($(this).data('price_per_hour'));
            modal.find('#dep_amount').val($(this).data('dep_amount'));
            modal.find('#extra_hours_charge').val($(this).data('extra_hours_charge'));
            modal.find('#day_km').val($(this).data('day_km'));
            modal.find('#weekend_surge').val($(this).data('weekend_surge'));
            modal.find('#peak_season').val($(this).data('peak_reason_surge'));
            modal.find('#extra_km_charge').val($(this).data('extra_km_charge'));
            modal.find('input[name=model_id]').val($(this).data('id'));
            modal.modal('show');
        });

        // Delete Car
        let deleteId;
        $('#car_table').on('click', '.delete_btn', function() {
            deleteId = $(this).data('id');  // Capture the ID of the item to delete
            $('#deleteModal').modal('show');  // Show the modal
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: `/admin/car/${deleteId}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#deleteModal').modal('hide');  // Hide the modal
                    updateTable(response.data);
                    alertify.success(response.success);

                },
                error: function(response) {
                    alert('Error');
                }
            });
        });

        $('#car_model_form').on('submit', function(e) {
            e.preventDefault();

            let fieldsToValidate = [
                { id: '#producer'},
                { id: '#model_name' },
                { id: '#seats'},
                { id: '#fuel_type'},
                { id: '#transmission'},
                { id: '#engine_power'},
                { id: '#price_per_hours'},
                { id: '#weekend_surge'},
                { id: '#dep_amount'},
                { id: '#extra_hours_charge'},
                { id: '#day_km'},
                { id: '#peak_season'},
                { id: '#extra_km_charge'},
            ];
            if ($('#model_id').val() === '') {
                fieldsToValidate.push({ id: '#car_image'});
                fieldsToValidate.push({ id: '#car_other_image'});
            }

            let isValid = true;
            // Loop through the fields and validate each one

            fieldsToValidate.forEach(function(field) {
                let element = $(field.id);
                if (element.val() === '') {
                    element.addClass('is-invalid');
                    isValid = false;
                } else {
                    element.removeClass('is-invalid');
                }
            });



            if (isValid) {
                // $('#car_model_Submit').prop('disabled', true);  // Disable submit button during AJAX

                let formData = new FormData(this);
                $.ajax({
                    url: '/admin/car/model/save',
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for jQuery to send the data properly
                    contentType: false, // Required to handle file uploads correctly
                    success: function(response) {
                        $('#create_car_modal').modal('hide');
                        alertify.success(response.success);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $('.form-control').removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        $.each(errors, function(key, value) {
                            let element = $('#' + key);
                            // For other form controls
                            element.addClass('is-invalid');
                            // Display the error message
                            element.siblings('.invalid-feedback').text(value[0]);
                        });
                    },
                    complete: function() {
                      //  $('#car_model_Submit').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }

        });

        $('#search_item').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: '/admin/cars/search', // Make sure to define this route in your web.php
                type: 'GET',
                data: {
                    keyword: query,
                },
                success: function(response) {
                    // Clear existing table rows
                    $('#car_table tbody').empty();
                    updateTable(response.data);
                    // Populate table with new data
                },
                error: function(xhr) {

                }
            });
        });
    });
});
