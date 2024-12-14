$(function () {
    'use strict'
    $(document).ready(function() {
        loadDatePickers()
        function loadDatePickers() {


            $('input[name="coupon_start_date"]').daterangepicker({
                singleDatePicker: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });

            $('input[name="coupon_end_date"]').daterangepicker({
                singleDatePicker: true,
                startDate: moment().startOf('hour'),
                minDate: moment().startOf('day'),
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
        }

        $('#add_coupon').click(function() {
            resetInput();
            $('#coupon_label').text("Create Coupon");
            $('#coupon_model').modal('show');
            $('#save_coupon').text("Submit");
        });

        $('#toggle-button').on('click', function() {
            $(this).toggleClass('on');
            let value;
            if ($(this).hasClass('on')) {
                $(this).css('background-color', 'green');
                value = 1;
            } else {
                $(this).css('background-color', 'red');
                value = 2;
            }
            $(this).find('.label.off').toggle(!$(this).hasClass('on'));
            $(this).find('.label.on').toggle($(this).hasClass('on'));
            $('#toggle-value').val(value);
        });

        // Initially set the button to red color using jQuery
        $('#toggle-button').css('background-color', 'red');

        $('#coupon_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            let fields = [
                { id: '#title', wrapper: true, condition: (val) => val === '' },
                { id: '#description', wrapper: true, condition: (val) => val === '' },
                { id: '#amount', wrapper: true, condition: (val) => val === '' },
                { id: '#coupon_code', wrapper: true, condition: (val) => val === '' },
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
                 $('#save_coupon').prop('disabled', true);  // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/coupon/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#coupon_model').modal('hide');
                        updateCouponTable(response.data, response.permissions)
                        alertify.success(response.success);
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
                        $('#save_coupon').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }



        });

        // Edit Coupon
        $('#coupon_table').on('click', '.coupon_edit', function() {
            let modal = $('#coupon_model');
            $('#coupon_label').text("Edit Coupon");
            $('#save_coupon').text("Update");
            modal.find('#title').val($(this).data('title'));
            modal.find('#description').val($(this).data('description'));
            modal.find('#coupon_start_date').val($(this).data('start_date'));
            modal.find('#coupon_end_date').val($(this).data('end_date'));
            modal.find('#amount').val($(this).data('amount'));
            modal.find('#type').val($(this).data('type'));
            modal.find('#prefix').val($(this).data('prefix'));
            modal.find('#coupon_code').val($(this).data('code'));
            modal.find('#status').val($(this).data('status'));
            modal.find('input[name=coupon_id]').val($(this).data('id'));
            // Set the toggle button state based on the status
            let status = $(this).data('status');
            if (status == 1) {
                $('#toggle-button').addClass('on').css('background-color', 'green');
                $('#toggle-button').find('.label.off').hide();
                $('#toggle-button').find('.label.on').show();
                $('#toggle-value').val(1);
            } else {
                $('#toggle-button').removeClass('on').css('background-color', 'red');
                $('#toggle-button').find('.label.off').show();
                $('#toggle-button').find('.label.on').hide();
                $('#toggle-value').val(2);
            }

            modal.modal('show');
        });

        function updateCouponTable(data, permissions) {
            let tbody = $('#coupon_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.coupon.length === 0) {
                tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
            } else {
                // Loop through the data and append rows
                $.each(data.coupon, function(index, item) {
                    let statusBadge = item.status == 1
                        ? `<span class="badge badge-secondary" style="background-color: green">Activate</span>`
                        : `<span class="badge badge-danger" style="background-color: red">Deactivate</span>`;

                    tbody.append(`
                <tr>
                      <td>${index + 1}</td>
                    <td>${item.title}</td>
                    <td>${item.amount}</td>
                    <td>${item.type == 1 ? 'Percentage' : 'Fixed'}</td>
                    <td>${item.code}</td>
                    <td>${statusBadge}</td>
                    <td>${item.start_date ? formatDate(item.start_date) : ''}</td>
                    <td>${item.end_date ? formatDate(item.end_date) : ''}</td>
                   <td>${item.user ? item.user.email : ''}</td>
                    <td>${formatDateTime(item.updated_at)}</td>
                    <td>

                    ${permissions.includes('coupon_update') ? `


                        <a href="javascript:void(0)" class="coupon_edit" data-id="${item.id}"
                            data-title="${item.title}" data-description="${item.description}"
                            data-start_date="${item.start_date}" data-end_date="${item.end_date}"
                            data-amount="${item.amount}" data-type="${item.type}"
                            data-prefix="${item.prefix}" data-code="${item.code}"
                            data-status="${item.status}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
` : ''}
                        ${permissions.includes('coupon_delete') ? `


                        <a href="#" class="coupon_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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

// Helper function to format dates
        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function resetInput() {
            // Clear form fields
            $('#coupon_model').find('input, textarea').val('');

            // Reset toggle button
            $('#toggle-button').removeClass('on').css('background-color', 'red');
            $('#toggle-button').find('.label.off').show();
            $('#toggle-button').find('.label.on').hide();
            $('#toggle-value').val(2);
            // Remove Bootstrap validation classes
            $('#coupon_model').find('.is-invalid').removeClass('is-invalid');
            $('#coupon_model').find('.is-valid').removeClass('is-valid');
            // Optionally reset other elements
            $('#coupon_label').text('');
            $('#save_coupon').text('');
        }

        // Delete Car
        let deleteId;
        $('#coupon_table').on('click', '.coupon_delete', function() {
            deleteId = $(this).data('id');  // Capture the ID of the item to delete
            $('#deleteModal').modal('show');  // Show the modal
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: `/admin/coupon/${deleteId}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#deleteModal').modal('hide');  // Hide the modal
                    updateCouponTable(response.data, response.permissions)
                    alertify.success(response.success);

                },
                error: function(response) {
                    alert('Error');
                }
            });
        });

        function fetchData() {
            let status = $('#status').val();
            let coupon_search = $('#coupon_search').val();
                $.ajax({
                    url: '/admin/coupon/search', // Define this route in your web.php
                    type: 'GET',
                    data: {
                        status: status,
                        coupon_code: coupon_search
                    },
                    success: function(response) {
                        updateCouponTable(response.data, response.permissions) // Populate table with new data
                    },
                    error: function(xhr) {
                        console.error('An error occurred:', xhr.responseText);
                    }
                });
            }

        $('#status').on('change', fetchData);
        $('#coupon_search').on('keyup', fetchData);
    });
});
