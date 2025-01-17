$(function () {
    'use strict'
    $(document).ready(function() {
        $('#add_role').click(function() {
            $('#user_role_label').text("Add User Role");
            $('#add_user_role').modal('show');
            $('#save_user_role').text("Submit");
        });

        $('#user_role_form').on('submit', function(e) {
            e.preventDefault();
            // Define the elements and their conditions in an array of objects
            let isValid = true;
            let field = { id: '#role', wrapper: false, condition: (val) => val.trim() === '' };

            // Loop through the fields and apply the validation logic

            let element = $(field.id);
            let value = element.val();
            if (field.condition(value)) {
                element.addClass('is-invalid');
                isValid = false;
            } else {
                element.removeClass('is-invalid');
            }

            if (isValid) {
                // $('#save_user_role').prop('disabled', true);  // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/user-role/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#add_user_role').modal('hide');
                        updateRoleTable(response.data,response.permission)
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

        $('#role_table').on('click', '.role_edit', function() {
            let modal = $('#edit_user_role');
            modal.find('input[type=checkbox]').prop('checked', false);
            let userRoles = $(this).data('user_permission');
            $('#car_label').text("Edit User Role");
            $('#update_user_role').text("Update");
            if (Array.isArray(userRoles)) {
                // Clear all checkboxes first
                modal.find('input[type=checkbox]').prop('checked', false);
                // Loop through the array and check the corresponding checkboxes
                userRoles.forEach(function(role) {
                    modal.find('input[value="' + role + '"]').prop('checked', true);
                });
            } else {
                // console.error("userRoles is not an array:", userRoles);
            }
            modal.find('#user_role').val($(this).data('role'));
            modal.find('input[name=role_id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('#user_role_edit_form').on('submit', function(e) {
            e.preventDefault();
            $('#update_user_role').prop('disabled', true);  // Disable submit button during AJAX
            $.ajax({
                url: '/admin/user-role/update',
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    $('#edit_user_role').modal('hide');
                    updateRoleTable(response.data,response.permission)
                    alertify.success(response.success);
                },
                error: function(response) {
                    if (response.responseJSON) {
                        let errors = response.responseJSON.errors;
                    }
                },
                complete: function() {
                    $('#update_user_role').prop('disabled', false);  // Re-enable the submit button
                }
            });
        });

        function updateRoleTable(data,permission) {
            window.history.pushState(null, '', '/admin/user-role/list?page=' + 1);
            let tbody = $('#role_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.role.length === 0) {
                tbody.append(`<tr><td colspan="4" class="text-center">Record Not Found</td></tr>`);
            } else {
                window.history.pushState(null, '', '/admin/user-role/list?page=' + 1);
                $.each(data.role, function(index, item) {
                    let editPermission = permission.includes('roles_update');
                    let deletePermission = permission.includes('roles_delete');

                    tbody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.user_role}</td>
                    <td>${item.user ? item.user.email : ''}</td>
                   <td>${formatDateTime(item.created_at)}</td>
                    <td>
                        ${editPermission ? `
                            <a href="javascript:void(0)" class="role_edit"
                               data-id="${item.id}"
                               data-role="${item.user_role}"
                               data-user_permission='${item.permissions}'> <!-- Ensure JSON is properly encoded -->
                                <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </a>
                        ` : ''}
                        ${deletePermission ? `
                            <a href="#" class="role_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
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
                    let href = $(this).attr('href'); // Get the current href attribute
                    $(this).attr('href', newBaseUrl); // Set the new URL
                });
            }
        }
        
          function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        // Delete Car
        let deleteId;
        $('#role_table').on('click', '.role_delete', function() {
            deleteId = $(this).data('id');  // Capture the ID of the item to delete
            $('#delete_role_model').modal('show');  // Show the modal
        });

        $('#confirm_delete_row').on('click', function() {
            $.ajax({
                url: `/admin/user-role/${deleteId}/delete`,
                type: 'DELETE',
                success: function(response) {
                    $('#delete_role_model').modal('hide');  // Hide the modal
                    updateRoleTable(response.data,response.permission)
                    alertify.success(response.success);
                },
                error: function(response) {
                    // alert('Error');
                }
            });
        });
    });
});
