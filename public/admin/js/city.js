$(function () {
    'use strict'
    $(document).ready(function() {

        $('#add_city').click(function() {
            $('#city_label').text("Create City");
            $('#city_model').modal('show');
            $('#save_city').text("Submit");
        });

        $('#city_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            let fields = [
                { id: '#city_name', wrapper: true, condition: (val) => val === '' },
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
                $('#save_city').prop('disabled', true);  // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/city/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#city_model').modal('hide');
                        updateHolidayTable(response.data)
                        alertify.success(response.success);
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
                        $('#save_city').prop('disabled', false);
                    }
                });
            }
        });

        // Edit Holiday
        $('#city_table').on('click', '.city_edit', function() {
            let modal = $('#city_model');
            $('#city_label').text("Edit Holiday");
            $('#save_city').text("Update");
            modal.find('#city_name').val($(this).data('name'));
            modal.find('#city_status').val($(this).data('status'));
            modal.find('input[name=city_id]').val($(this).data('id'));
            modal.modal('show');
        });

        function updateHolidayTable(data) {
            let tbody = $('#city_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.city.length === 0) {
                tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
            } else {
                // Loop through the data and append rows
                $.each(data.city, function(index, item) {
                    tbody.append(`
                <tr>
                   <td>${index + 1}</td>
                    <td>${item.name}</td>
                   <td>${item.user ? item.user.email : ''}</td>
                    <td>${item.city_status}</td>
                    <td>${formatDateTime(item.updated_at)}</td>
                    <td>
                        <a href="javascript:void(0)" class="city_edit" data-id="${item.id}" data-name="${ item.name }" data-status="${ item.city_status }">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
                        <a href="#" class="city_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            `);
                });
            }
        }

        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }

        // Delete Car
        let delete_id;
        $('#city_table').on('click', '.city_delete', function() {
            delete_id = $(this).data('id');  // Capture the ID of the item to delete
            $('#delete_city').modal('show');  // Show the modal
        });

        $('#confirm_delete').on('click', function() {
            $.ajax({
                url: `/admin/city/${delete_id}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#delete_city').modal('hide');  // Hide the modal
                    updateHolidayTable(response.data)
                    alertify.success(response.success);

                },
                error: function() {
                    alertify.error('Something Went Wrong');
                }
            });
        });

        // function fetchData() {
        //     let holiday_search = $('#holiday_search').val();
        //     $.ajax({
        //         url: '/admin/holiday/search', // Define this route in your web.php
        //         type: 'GET',
        //         data: {
        //             holiday_search: holiday_search
        //         },
        //         success: function(response) {
        //             updateHolidayTable(response.data) // Populate table with new data
        //         },
        //         error: function(xhr) {
        //             alertify.error('Something Went Wrong');
        //         }
        //     });
        // }
        //
        // $('#holiday_search').on('keyup', fetchData);
    });
});
