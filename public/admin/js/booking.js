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

        $('#booking_table').on('click', '.cancel_booking', function() {
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
                    console.log()
                    $('#cancelModal').modal('hide');
                    alertify.success('Booking has been cancelled successfully.');
                    updateBookingTable(response.data);
                },
                error: function(xhr) {
                    alertify.error('Failed to cancel the booking. Please try again.');
                }
            });
        });
        $('#booking_table').on('change', '.risk-checkbox', function() {
            let booking_id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 2;
            let note = 'risk'
            updatetable(booking_id,status,note)
        });
        $('#booking_table').on('change', '.done-checkbox', function() {
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
                    if (response.data) {
                        alertify.success(response.message);
                        updateBookingTable(response.data);
                    } else {
                        alertify.error('Failed to update status.');
                    }
                },
                error: function(xhr, status, error) {
                    alertify.error('AJAX error:', error);
                }
            });
        }


        $('#booking_table').on('click', '.open-risk-modal', function() {
            let bookingId = $(this).data('id');
            let commend = $(this).data('commend');
            console.log(commend)
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

        $('#booking_table').on('click', '.user-details-modal', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

        $('#booking_table').on('click', '.edit-booking-date', function() {
            $('#date_booking_id').val($(this).data('id'));
            $('#date_model').modal('show');
        });

        $('#booking_table').on('click', '.amount-modal', function() {
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
                    updateBookingTable(response.data);
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
                    updateBookingTable(response.data);
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        });

        function updateBookingTable(data) {
            console.log(data);
            let tbody = $('#booking_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.bookings.length === 0) {
                tbody.append(`<tr><td colspan="15" class="text-center">Record Not Found</td></tr>`);
            } else {
                $.each(data.bookings, function(index, item) {
                    // Check if details exist and have at least one element
                    let bookingDetails = (item.details && item.details.length > 0)
                        ? JSON.parse(item.details[0].car_details || '{}')
                        : {};
                    let paymentDetails = (item.details && item.details.length > 0)
                        ? JSON.parse(item.details[0].payment_details || '{}')
                        : {};

                    let carModel = bookingDetails.car_model || {};
                    let commends = item.comments || [];

                    let rescheduleDate = item.reschedule_date ? `<p class="text-danger">${formatDateTime(item.reschedule_date)}</p>` : '';

                    tbody.append(`
                <tr class="${item.risk === 1 ? 'bg-light-red' : item.status === 2 ? 'bg-light-green' : ''}">
                    <td>${item.booking_type === 'pickup' ? '<h2>P</h2>' : '<h2>D</h2>'}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <input type="checkbox" class="risk-checkbox" data-id="${item.id}" ${item.risk === 1 ? 'checked' : ''}>
                        </div>
                        <br>
                       <button class="btn btn-warning open-risk-modal" data-id="${item.id}" data-commend='${JSON.stringify(commends).replace(/'/g, "&apos;")}'>
    <h5>i</h5>
</button>

                    </td>
                    <td class="d-flex justify-content-center">
                        <input type="checkbox" class="done-checkbox" data-id="${item.id}" ${item.status == 2 ? 'checked' : ''}>
                    </td>
                    <td>${formatDateTime(item.start_date)}<br>${rescheduleDate}</td>
                    <td>${item.user ? item.user.name : ''}</td>
                    <td>${carModel.model_name || ''}</td>
                    <td>${bookingDetails.register_number || ''}</td>
                    <td class="truncate-text" title="${item.address}">${item.address}</td>
                    <td>
                        <button class="btn btn-warning user-details-modal" data-id="${item.user_id}" data-mobile="${item.user.mobile}" data-booking="${item.user.bookings ? item.user.bookings.length / 2 : 0}" data-aadhaar_number="${item.user.aadhaar_number}">
                            User details
                        </button>
                    </td>
                    <td>${item.user ? item.user.driving_licence : ''}</td>
                    <td>${item.booking_id}</td>
                    <td>${item.start_date ? formatDateTime(item.start_date) : formatDateTime(item.end_date)}<br>
                        <button class="btn btn-warning edit-booking-date" data-id="${item.id}" data-pickup_date="${item.start_date || 0}" data-delivery_date="${item.end_date || 0}">
                            Edit
                        </button>
                    </td>
                    <td>${carModel.dep_amount || 0}</td>
                    <td>
                        <button class="btn btn-warning amount-modal" data-id="${item.booking_id}" data-week_days_amount="${paymentDetails.week_days_amount || 0}" data-week_end_amount="${paymentDetails.week_end_amount || 0}" data-festival_amount="${paymentDetails.festival_amount || 0}" data-delivery_fee="${item.delivery_fee || ''}" data-dep_fee="${carModel.dep_amount || ''}" data-coupon="${item.coupon ? item.coupon.discount : ''}" data-type="${item.coupon ? item.coupon.type : ''}">
                            Amount Details
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger cancel_booking" data-id="${item.id}">
                            Cancel Order
                        </button>
                    </td>
                </tr>
            `);
                });
            }
        }


// Helper function to format dates
        function formatDateTime(dateString) {
            let date = new Date(dateString);

            // Get day, month, and year
            let day = String(date.getDate()).padStart(2, '0'); // Ensure two digits
            let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
            let year = date.getFullYear();

            // Get hours, minutes, and seconds
            let hours = String(date.getHours()).padStart(2, '0');
            let minutes = String(date.getMinutes()).padStart(2, '0');
            let seconds = String(date.getSeconds()).padStart(2, '0');

            // Format date and time
            let formattedDate = `${day}/${month}/${year}`;
            let formattedTime = `${hours}:${minutes}:${seconds}`;

            return `${formattedDate} ${formattedTime}`;
        }


        function fetchData() {
            const carModel = $('#car_model').val();
            const registerNumber = $('#register_number').val();
            const bookingId = $('#booking_id').val();
            const customerName = $('#customer_name').val();
            const bookingType = $('#booking_type').val();
            $.ajax({
                url: '/admin/booking/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    car_model: carModel,
                    register_number: registerNumber,
                    booking_id: bookingId,
                    customer_name: customerName,
                    booking_type: bookingType, // Send the booking type
                },
                success: function(response) {
                    updateBookingTable(response.data) // Populate table with new data
                    updatePagination(response);
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        function updatePagination(data) {
            const paginationContainer = $('#pagination');
            paginationContainer.empty();

            // Create pagination links
            if (data.last_page > 1) {
                for (let i = 1; i <= data.last_page; i++) {
                    const activeClass = (i === data.current_page) ? 'active' : '';
                    paginationContainer.append(`
                    <li class="page-item ${activeClass}">
                        <a class="page-link" href="#" onclick="fetchData(${i})">${i}</a>
                    </li>
                `);
                }
            }
        }
        $('#car_model, #register_number, #booking_id, #customer_name, #booking_type').on('input change', function() {
            fetchData();
        });
    });
});
