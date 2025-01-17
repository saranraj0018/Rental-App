$(function () {
    'use strict'
    $(document).ready(function() {
        $('#add_faq').click(function() {
              $('#question').val('');
            $('#answer').val('');
            $('#add_faq_label').text("Add Faq Item");
            $('#add_faq_item').modal('show');
            $('#save_faq').text("Save");
        });

        $('#faq_form').on('submit', function(e) {
            e.preventDefault();
            // Define the elements and their conditions in an array of objects
            let isValid = true;
            let fields = [
                { id: '#question', wrapper: false, condition: (val) => val.trim() === '' },
                { id: '#answer', wrapper: false, condition: (val) => val.trim() === '' },
            ];

            // Loop through the fields and apply the validation logic

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
                // $('#save_user_role').prop('disabled', true);  // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/faq/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#add_faq_item').modal('hide');
                        updateFaqTable(response.data, response.permissions)
                        alertify.success(response.success);
                    },
                    error: function(response) {
                        if (response.responseJSON) {
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
                        $('#save_user_role').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }



        });

        $('#faq_table').on('click', '.faq_edit', function() {
              $('#question').val('');
            $('#answer').val('');
            let modal = $('#add_faq_item');
            $('#add_faq_label').text("Update Faq Item");
            $('#save_faq').text("Update");
            modal.find('#question').val($(this).data('question'));
            modal.find('#answer').val($(this).data('answer'));
            modal.find('input[name=faq_id]').val($(this).data('id'));
            modal.modal('show');
        });


          function updateFaqTable(data, permissions) {
            window.history.pushState(null, '', '/admin/faq/list?page=' + 1);
            let tbody = $('#faq_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.faq_items.length === 0) {
                tbody.append(`<tr><td colspan="4" class="text-center">Record Not Found</td></tr>`);
            } else {
                window.history.pushState(null, '', '/admin/faq/list?page=' + 1);
                $.each(data.faq_items, function(index, item) {
                    let dataValues = item.data_values ? JSON.parse(item.data_values) : null;

                    tbody.append(`
                <tr>
                    <td>${item.id}</td>
                    <td>${dataValues.question}</td>
                    <td>${dataValues.email}</td>
                    <td>${formatDate(item.updated_at)}</td>
                    <td>
                        ${permissions.includes('faq_update') ? `
                            <a href="javascript:void(0)" class="faq_edit"
                               data-id="${item.id}"
                               data-question="${dataValues.question}"
                               data-answer='${dataValues.answer}'> <!-- Ensure JSON is properly encoded -->
                                <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </a>
                              ` : ''}

                            ${permissions.includes('faq_delete') ? `

                            <a href="#" class="faq_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
                                <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
` : ''}
                    </td>
                </tr>
            `);
                });
                $('#pagination').html(data.pagination);
                let newBaseUrl =  window.location.href;
                $('.pagination a').each(function() {
                    $(this).attr('href', newBaseUrl); // Set the new URL
                });
            }
        }

        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        // Delete Car
        let deleteId;
        $('#faq_table').on('click', '.faq_delete', function() {
            deleteId = $(this).data('id');  // Capture the ID of the item to delete
            $('#delete_faq_model').modal('show');  // Show the modal
        });

        $('#confirm_delete_row').on('click', function() {
            $.ajax({
                url: `/admin/faq/${deleteId}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#delete_faq_model').modal('hide');  // Hide the modal
                      updateFaqTable(response.data, response.permissions)
                    alertify.success(response.success);
                },
                error: function(response) {
                    // alert('Error');
                }
            });
        });

        $('#search_item').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: '/admin/faq/search', // Make sure to define this route in your web.php
                type: 'GET',
                data: {
                    question: query,
                },
                success: function(response) {
                    // Clear existing table rows
                    $('#faq_table tbody').empty();
                     updateFaqTable(response.data, response.permissions)
                    // Populate table with new data
                },
                error: function(xhr) {

                }
            });
        });
    });
});
