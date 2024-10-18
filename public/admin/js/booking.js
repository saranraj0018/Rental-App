$(function () {
    'use strict'
    $(document).ready(function() {

        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm', // Customize the format as needed
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash-alt',
                close: 'fas fa-times'
            }
        });
        // Edit Pickup/delivery
        $('#booking_table').on('click', '.booking_edit', function() {
            let modal = $('#booking_model');
            modal.find('#event_name').val($(this).data('event_name'));
            modal.find('#event_date').val($(this).data('event_date'));
            modal.find('#description').val($(this).data('description'));
            modal.find('input[name=holiday_id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.cancel_booking').on('click', function() {
            let booking_id = $(this).data('id');
            $('#cancel-booking-id').val(booking_id);
            $('#cancelModal').modal('show');
        });

        $('#cancel-booking-form').on('submit', function(e) {
            e.preventDefault();
            let bookingId = $('#cancel-booking-id').val();
            let reason = $('#cancel-reason').val().trim();

            // Validate the reason field
            if (reason === '') {
                $('#cancel-reason').addClass('is-invalid');
                return; // Stop the form from submitting
            } else {
                $('#cancel-reason').removeClass('is-invalid');
            }

            $.ajax({
                url: '/admin/booking/cancel',
                type: 'POST',
                data: {
                    booking_id: bookingId,
                    reason: reason,
                },
                success: function(response) {
                    $('#cancelModal').modal('hide');
                    alertify.success('Booking has been cancelled successfully.');
                },
                error: function(xhr) {
                    alertify.error('Failed to cancel the booking. Please try again.');
                }
            });
        });

        $('.risk-checkbox').on('change', function() {
            let booking_id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 2;
            let note = 'risk'
            updatetable(booking_id,status,note)
        });
        $('.done-checkbox').on('change', function() {
            let booking_id = $(this).data('id');
            let status = $(this).is(':checked') ? 2 : 1;
            let note = 'complete'
            updatetable(booking_id,status,note)
        });

        function updatetable(booking_id, status,note) {
            $.ajax({
                url: '/admin/risk-status', // Replace with your route URL
                method: 'POST',
                data: {
                    booking_id: booking_id,
                    status: status,
                    note:note
                },
                success: function(response) {
                    if (response.success) {
                        alertify.success(response.success);
                    } else {
                        alertify.error('Failed to update status.');
                    }
                },
                error: function(xhr, status, error) {
                    alertify.error('AJAX error:', error);
                }
            });
        }



        $('.open-risk-modal').on('click', function() {
            let bookingId = $(this).data('id');
            let commend = $(this).data('commend');

            // Parse the comments if they are not already an array
            let comments = Array.isArray(commend) ? commend : JSON.parse(commend || '[]');
            // Set the booking ID in the hidden input
            $('#risk-booking-id').val(bookingId);

            // Clear the previous comments list
            $('#comments-list').empty();

            // Loop through the comments and add them to the comments list
            if (comments.length > 0) {
                comments.forEach(function(comment, index) {
                    // Convert the created_at string into a Date object
                    let createdAt = new Date(comment.created_at);
                    // Format the date as 'hour:minute AM/PM, month day'
                    let formattedDate = createdAt.toLocaleString('en-US', {
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true,
                        month: 'short',
                        day: 'numeric'
                    });

                    $('#comments-list').append(
                        `<div class="alert alert-secondary" role="alert">
                <strong>Comment ${index + 1}:</strong> ${comment.commends} <br>
                <small>Created at: ${formattedDate}</small>
            </div>`
                    );
                });
            } else {
                $('#comments-list').append('<p class="text-muted">No comments available.</p>');
            }

            // Show the modal
            $('#riskModal').modal('show');
        });


        $('.user-details-modal').on('click', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

        $('.edit-booking-date').on('click', function() {
            $('#date_booking_id').val($(this).data('id'));
            $('#date_model').modal('show');
        });

        $('.amount-modal').on('click', function() {
            let total = $(this).data('week_days_amount') + $(this).data('week_end_amount') + $(this).data('festival_amount');
            $('#booking_id').val($(this).data('id'));
            $('#week_days_amount').text($(this).data('week_days_amount'));
            $('#week_end_amount').text($(this).data('week_end_amount'));
            $('#festival_amount').text($(this).data('festival_amount'));
            $('#modal_base_fare').text(total ?? 0);
            $('#delivery_fee').text($(this).data('delivery_fee'));
            $('#dep_fee').text($(this).data('dep_fee'));
            // $('#coupon').text($(this).data('coupon'));
            // $('#type').val($(this).data('type'));
            $('#amount_modal').modal('show');
        });
        // Handle risk comment form submission
        $('#risk-form').on('submit', function(e) {
            e.preventDefault();
            let bookingId = $('#risk-booking-id').val();
            let commends = $('#risk-comment').val();

            $.ajax({
                url: '/admin/risk-comment',
                method: 'POST',
                data: {
                    booking_id: bookingId,
                    commends: commends
                },
                success: function(response) {
                    $('#riskModal').modal('hide');
                    alertify.success('Comment saved successfully!');
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        });

        $('#booking_date').on('submit', function(e) {
            e.preventDefault();
            let bookingId = $('#date_booking_id').val();
            let date = $('#start_date').val();

            $.ajax({
                url: '/admin/reschedule/date',
                method: 'POST',
                data: {
                    booking_id: bookingId,
                    date: date
                },
                success: function(response) {
                    $('#date_model').modal('hide');
                    alertify.success(response.success);
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        });

        // function updateHolidayTable(data) {
        //     let tbody = $('#holiday_table tbody');
        //     tbody.empty(); // Clear existing rows
        //
        //     if (data.holiday.length === 0) {
        //         tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
        //     } else {
        //         // Loop through the data and append rows
        //         $.each(data.holiday, function(index, item) {
        //             tbody.append(`
        //         <tr>
        //             <td>${item.id}</td>
        //             <td>${item.event_name}</td>
        //             <td>${formatDate(item.event_date)}</td>
        //            <td>${item.user ? item.user.email : ''}</td>
        //             <td>${formatDateTime(item.updated_at)}</td>
        //             <td>
        //                 <a href="javascript:void(0)" class="holiday_edit" data-id="${item.id}"
        //                     data-event_name="${item.event_name}" data-description="${item.notes}"
        //                     data-event_date="${formatDate(item.event_date)}" >
        //                     <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        //                         <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
        //                     </svg>
        //                 </a>
        //                 <a href="#" class="holiday_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
        //                     <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        //                         <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        //                     </svg>
        //                 </a>
        //             </td>
        //         </tr>
        //     `);
        //         });
        //     }
        // }

// Helper function to format dates
        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function fetchData() {
            let holiday_search = $('#holiday_search').val();
            $.ajax({
                url: '/admin/holiday/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    holiday_search: holiday_search
                },
                success: function(response) {
                    updateHolidayTable(response.data) // Populate table with new data
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        $('#holiday_search').on('keyup', fetchData);
    });
});
