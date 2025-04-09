$(function () {
    'use strict'

    $(document).ready(function() {
        loadDatePickers();

        function loadDatePickers() {
            $('input[name="start_date"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerIncrement: 30,
                timePicker24Hour: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

            $('input[name="end_date"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerIncrement: 30,
                timePicker24Hour: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

        }


        // Add Cars
        $('#add_block').click(function() {
            toggleBookingIdField();
            $('#car_block_form').trigger("reset");
            $('#car_block_label').text("Add New Block");
            $('#create_block').modal('show');
            $('#submit_block').text("Submit");
            $('select').selectpicker('refresh');
        });
        toggleBookingIdField();
        $('input[name="block_type"]').on('change', function() {
            toggleBookingIdField();
            reasonField();

        });

        function toggleBookingIdField() {
            if ($('#maintenance').is(':checked')) {
                $('#booking_id').closest('.form-group').show();
                $('#reason_discretionary').hide();
                $('#reason_maintenance').show();
            } else {
                $('#booking_id').closest('.form-group').hide();
            }
        }
        function reasonField() {
            if ($('#discretionary').is(':checked')) {
                $('#comment').closest('.form-row').hide();
                $('#reason_maintenance').hide();
                $('#reason_discretionary').show();
            } else {
                $('#comment').closest('.form-row').show();
            }
            if ($('#availability_type').is(':checked')) {
                $('#comment').closest('.form-row').show();
                $('#reason_maintenance').hide();
                $('#reason_discretionary').hide();
            }
        }

        $('#radioError').hide();
        $('#car_block_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            let fields = [
                { id: '#hub', wrapper: true, condition: (val) => val === null || val === "Hub" },
                { id: '#car_model', wrapper: true, condition: (val) => val === null || val === "Model" },
                { id: '#block_car_register_number', wrapper: true, condition: (val) => val === null || val === "Car Register Number" },
                { id: '#start_date', wrapper: false, condition: (val) => val === '' },
                { id: '#end_date', wrapper: false, condition: (val) => val === '' },
            ];

            if (!$('#discretionary').is(':checked')) {
                fields.push({ id: '#comment', wrapper: false, condition: (val) => val === '' });
            }

            if ($('.discretionary').is(':checked')) {
                let reason = $('input[name="reason_discretion"]:checked').length > 0;
                radioField(reason,'reason_discretion');
            }


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

            function radioField(reason,name) {

                if (!reason || reason === 'false') {
                    if (name === 'reason') {
                        $('input[name="reason"]').addClass('is-invalid');
                        $('.maintenance_error').show();
                    }
                    else {
                        $('input[name="reason_discretion"]').addClass('is-invalid');
                        $('.discretion_error').show();
                    }

                    isValid = false;
                } else {
                    if (name === 'reason') {
                        $('input[name="reason"]').removeClass('is-invalid');
                        $('.maintenance_error').hide();
                    } else {

                        $('input[name="reason_discretion"]').removeClass('is-invalid');
                        $('.discretion_error').hide();
                    }
                }
            }

            if (isValid) {
                $('#submit_block').prop('disabled', true);  // Disable submit button during AJAX

                $.ajax({
                    url: '/admin/car-block/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#create_block').modal('hide');
                         updateBlockTable(response.data, response.permissions);
                        alertify.success(response.success);
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
                            let errors = response.responseJSON.errors;
                            // Remove existing invalid classes and messages
                            $('.form-control').removeClass('is-invalid');
                            $('.invalid-feedback').empty();
                            $('.bootstrap-select').removeClass('is-invalid');
                            $.each(errors, function(key, value) {
                                let element = $('#' + key);
                                radioField('false',key);
                                // Check if the element is a Bootstrap Select
                                if (element.is('select')) {
                                    let selectPicker = element.closest('.bootstrap-select');
                                    selectPicker.addClass('is-invalid');
                                    // Update the invalid feedback message
                                    selectPicker.next('.invalid-feedback').text(value[0]).show();
                                } else {
                                    // For other form controls
                                    element.addClass('is-invalid');
                                    element.siblings('.invalid-feedback').text(value[0]).show();
                                }
                            });
                        }
                    },
                    complete: function() {
                        $('select').selectpicker('refresh');
                        $('#submit_block').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

        function updateBlockTable(data,permissions) {
            let tbody = $('#car_block_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.length === 0) {
                tbody.append('<tr><td colspan="9" class="text-center">Record Not Found</td></tr>');
            } else {
                let rowCount = 1;
                // Loop through the data and append rows
                data.forEach(item => {
                    console.log(item);
                    tbody.append(`
                <tr>
                    <td>${rowCount++}</td>
                    <td>${block_type()[item.block_type] || ''}</td>
                    <td>${reason_type()[item.reason] || ''}</td>
                    <td>${item.user ? item.user.email : ''}</td>
                    <td>${item.comment}</td>
                    <td>${item.car_register_number}</td>
                    <td>${item.details.city.name}</td>
                    <td>${item.start_date}</td>
                    <td>${item.end_date}</td>
                    <td>
                      ${permissions.includes('car_block_update') ? `
                        <a href="javascript:void(0)" class="edit_block_model"
                           data-id="${item.id}"
                           data-car_register_number="${item.car_register_number}"
                           data-start_date="${item.start_date}"
                           data-end_date="${item.end_date}"
                           data-comment="${item.comment}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
                         ` : ''}
                        <!-- Uncomment this block if you want to enable the delete button -->
  ${permissions.includes('car_block_delete') ? `
                        <a href="#" class="delete_block_model text-danger w-4 h-4 mr-1" data-id="${item.id}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
` : ''}
                    </td>
                </tr>
            `);
                });
            }
        }

        function block_type() {
            return {
                0: 'Maintenance',
                1: 'Discretionary',
                2: 'Availability Type',
                3: 'U-refurbish',
                4: 'U-recovery',
                5: 'It-reserve',
            };
        }

        function reason_type() {
            return {
                '0': 'Major Repair',
                '1': 'Accident',
                '2': 'Running Repair',
                '3': 'Service',
                '4': 'Others',
                '5': 'Buffer',
                '6': 'GPS-Issue',
                '7': 'Forced-Extension',
                '8': 'Others'
            };
        }



        // Edit Car
        $('#car_block_table').on('click', '.edit_block_model', function() {

              $('input[name="edit_start_date"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerIncrement: 30,
                timePicker24Hour: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

            $('input[name="edit_end_date"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerIncrement: 30,
                timePicker24Hour: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY HH:mm'
                }
            });

            let modal = $('#edit_block');
            $('#car_edit_block_form').trigger("reset");
            modal.find('#register_number').val($(this).data('car_register_number'));
            modal.find('#edit_start_date').val($(this).data('start_date'));
            modal.find('#edit_end_date').val($(this).data('end_date'));
            modal.find('#edit_comment').val($(this).data('comment'));
            modal.find('input[name=block_id]').val($(this).data('id'));
            modal.modal('show');
        });


        $('#car_edit_block_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            let fields = [
                { id: '#edit_start_date', wrapper: false, condition: (val) => val === '' },
                { id: '#edit_end_date', wrapper: false, condition: (val) => val === '' },
                { id: '#edit_comment', wrapper: false, condition: (val) => val === '' }
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

                // $('#update_block').prop('disabled', true);
                $.ajax({
                    url: '/admin/car-block/update',
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#edit_block').modal('hide');
                        updateBlockTable(response.data, response.permissions);
                        alertify.success(response.success);
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
                            let errors = response.responseJSON.errors;
                            $('.form-control').removeClass('is-invalid');
                            $('.invalid-feedback').empty();
                            $.each(errors, function(key, value) {
                                let element = $('#' + key);
                                    element.addClass('is-invalid');
                                    element.siblings('.invalid-feedback').text(value[0]).show();
                            });
                        }
                    },
                    complete: function() {
                        $('#update_block').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

        // Delete Car
        let delete_id;
        $('#car_block_table').on('click', '.delete_block_model', function() {
            delete_id = $(this).data('id');  // Capture the ID of the item to delete
            $('#deleteModal').modal('show');  // Show the modal
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: `/admin/car-block/${delete_id}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#deleteModal').modal('hide');  // Hide the modal
                    updateBlockTable(response.data, response.permissions);
                    alertify.success(response.success);

                },
                error: function(response) {
                    alertify.error('Internal server error');
                }
            });
        });


        function fetchData() {
            let blockType = $('#block_type').val();
            let registerNumber = $('#register_number').val();
            $.ajax({
                url: '/admin/car-block/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    block_type: blockType,
                    register_number: registerNumber
                },
                success: function(response) {
                      updateBlockTable(response.data, response.permissions);
                },
                error: function(xhr) {
                }
            });
        }

        $('#block_type').on('change', fetchData);
        $('#register_number').on('keyup', fetchData);

        $('#hub_city').change(function() {
            let hubId = $(this).val();
            if (hubId) {
                $.ajax({
                    url: '/admin/get-car-models',
                    method: 'GET',
                    data: { hub_id: hubId },
                    success: function(response) {
                        let carModelSelect = $('#car_model');
                        carModelSelect.empty(); // Clear current options
                        carModelSelect.append('<option selected disabled>Choose a Car Model</option>');
                        if (response.carModels.length > 0) {
                            response.carModels.forEach(function(model) {
                                carModelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
                            });
                        }
                        // Refresh the selectpicker to update UI
                        carModelSelect.selectpicker('refresh');
                    },
                    error: function() {
                        alertify.error('Error fetching car models.');
                    }
                });
            }
        });

        $('#car_model').change(function() {
            let modelId = $(this).val();  // Get selected car model ID
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            let hubId = $('#hub_city').val();

            if (start_date === '' && end_date === ''){
                alertify.error('Choose First Start and End dates')
                return;
            }

            if (modelId) {
                $.ajax({
                    url: '/admin/get-car-registration-numbers', // Laravel route to get registration numbers by model
                    method: 'GET',
                    data: { model_id: modelId,start_date:start_date,end_date:end_date, hub_id: hubId  },
                    success: function(response) {
                        let carModelSelect = $('#block_car_register_number');
                        carModelSelect.empty().append('<option selected disabled>Registration Number</option>'); // Clear register number options
                        carModelSelect.selectpicker('refresh');
                        if (response.register_number.length > 0) {
                            response.register_number.forEach(function(register_number) {
                                carModelSelect.append('<option value="' + register_number + '">' + register_number + '</option>');
                            });
                        }
                        carModelSelect.selectpicker('refresh');
                    },
                    error: function() {
                        alertify.error('Internal Error')
                    }
                });
            }
        });
    });
});
