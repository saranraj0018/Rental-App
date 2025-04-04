$(function () {
    'use strict'
    $(document).ready(function() {
        let debounceTimer;
        $('#pending_car_model, #pending_register_number, #pending_booking_id, #pending_customer_name, #pending_booking_type, #pending_hub_type, #booking_history').on('input change', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                fetchData(1);
            }, 300); // 300ms delay
        });




        function fetchData(page = 1) {
            const carModel = $('#pending_car_model').val();
            const registerNumber = $('#pending_register_number').val();
            const bookingId = $('#pending_booking_id').val();
            const customerName = $('#pending_customer_name').val();
            const bookingType = $('#pending_booking_type').val();
            const hub_type = $('#pending_hub_type').val();
            const booking_history = $('#booking_history').val();

            $.ajax({
                url: '/admin/booking/pending/search?page=' + page, // Define this route in your web.php
                type: 'GET',
                data: {
                    car_model: carModel,
                    register_number: registerNumber,
                    booking_id: bookingId,
                    customer_name: customerName,
                    booking_type: bookingType,
                    hub_type: hub_type,
                    booking_history: booking_history,

                },
                success: function(response) {
                    updateBookingTable(response.data, response.permissions)  // Populate table with new data
                    console.log(response.data.pagination)
                    updatePagination(response.data.pagination);
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        function updatePagination(pagination) {
            $('#pagination-container').html(pagination);

            // Handle click event on pagination links
            $('#pagination-container a').off('click').on('click', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchData(page);
            });
        }
        $('#pending_table').on('click', '.user-details-modal', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

        $('#pending_table').on('click', '.amount-modal', function() {
            let total = $(this).data('week_days_amount') + $(this).data('week_end_amount') + $(this).data('festival_amount');
            $('#booking_id').val($(this).data('id'));
            $('#week_days_amount').text($(this).data('week_days_amount'));
            $('#week_end_amount').text($(this).data('week_end_amount'));
            $('#festival_amount').text($(this).data('festival_amount'));
            $('#modal_base_fare').text(total ?? 0);
            $('#delivery_fee').text($(this).data('delivery_fee'));
            $('#dep_fee').text($(this).data('dep_fee'));
            $('#amount_modal').modal('show');
            $('#coupon').text($(this).data('coupon'));
            $('#manual_discount').text($(this).data('manual_discount'));
        });

        $('#pending_table').on('click', '.open-risk-modal', function() {
               $('#risk-comment').val(' ');
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


        $('#pending_table').on('change', '.risk-checkbox', function() {
            let booking_id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 2;
            let note = 'risk'
            updatetable(booking_id,status,note)
        });
        $('#pending_table').on('change', '.done-checkbox', function() {
            let booking_id = $(this).data('id');
            let status = $(this).is(':checked') ? 2 : 1;
            let note = 'complete'
            updatetable(booking_id,status,note)
        });

        $('#pending_table').on('click', '.cancel_booking', function() {
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
                url: '/admin/booking/pending/cancel',
                type: 'POST',
                data: {
                    booking_id: bookingId,
                    reason: reason,
                },
                success: function(response) {
                    $('#cancelModal').modal('hide');
                    alertify.success('Booking has been cancelled successfully.');
                   updateBookingTable(response.data, response.permissions)
                },
                error: function(xhr) {
                    alertify.error('Failed to cancel the booking. Please try again.');
                }
            });
        });


        function updatetable(booking_id, status,note) {
            $.ajax({
                url: '/admin/risk-status/pending', // Replace with your route URL
                method: 'POST',
                data: {
                    booking_id: booking_id,
                    status: status,
                    note:note
                },
                success: function(response) {
                    if (response.data) {
                        alertify.success(response.message);
                        updateBookingTable(response.data, response.permissions)
                    } else {
                        alertify.error('Failed to update status.');
                    }
                },
                error: function(xhr, status, error) {
                    alertify.error('AJAX error:', error);
                }
            });
        }

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

        function updateBookingTable(data, permissions) {
            let tbody = $('#pending_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.bookings.length === 0) {
                tbody.append(`<tr><td colspan="15" class="text-center">Record Not Found</td></tr>`);
            } else {
                $.each(data.bookings, function(index, item) {
                    // Parse booking details and payment details if they exist
                    let bookingDetails = (item.details && item.details.length > 0)
                        ? JSON.parse(item.details?.[0].car_details || '{}')
                        : {};
                    let paymentDetails = (item.details && item.details.length > 0)
                        ? JSON.parse(item.details?.[0].payment_details || '{}')
                        : {};

                    let carModel = bookingDetails.car_model || {};
                    let commends = item.comments || [];
                    let rescheduleDate = item.reschedule_date ? `<p class="text-danger">${formatDateTime(item.reschedule_date)}</p>` : '';

                    // Conditionally set the main date based on booking_type
                    let mainDate = item.booking_type === 'pickup'
                        ? formatDateTime(item.end_date)
                        : formatDateTime(item.start_date);

                    tbody.append(`
                <tr class="${item.risk === 1 ? 'bg-light-red' : item.status === 2 ? 'bg-light-green' : ''}">
                <td>${item.booking_type === 'pickup' ? '<h2>P</h2>' : '<h2>D</h2>'}</td>
                <td>  ${!item.details[0].mode_of_payment ? 'N/A' : item.details[0].mode_of_payment}</td>
                      ${(permissions.includes('hub_risk_status') || permissions.includes('hub_risk_comments')) ? `
                    <td>
                     ${permissions.includes('hub_risk_status') ? `
                        <div class="d-flex justify-content-center">
                            <input type="checkbox" class="risk-checkbox" data-id="${item.id}" ${item.risk === 1 ? 'checked' : ''}>
                        </div>
                        <br>
                         ` : ''}
                           ${permissions.includes('hub_risk_commands') ? `
                        <button class="btn btn-warning open-risk-modal" data-id="${item.id}" data-commend='${JSON.stringify(commends).replace(/'/g, "&apos;")}'>
                            <h5>i</h5>
                        </button>
                     ` : ''}
                    </td>
                    ` : ''}

                    ${permissions.includes('hub_risk_status') ? `

                    <td class="d-flex justify-content-center">
                        <input type="checkbox" class="done-checkbox" data-id="${item.id}" ${item.status == 2 ? 'checked' : ''}>
                    </td>
                     ` : ''}
                    <td>${mainDate}<br>${rescheduleDate}</td>
                    <td>${item.user ? item.user.name : ''}</td>
                    <td>${item.user ? item.user.mobile : ""}</td>
                    <td>${carModel.model_name || ''}</td>
                    <td>${bookingDetails.register_number || ''}</td>
                    <td class="truncate-text" title="${item.address}">${item.address}</td>
                    <td>
                        <button class="btn btn-warning user-details-modal" data-id="${item.user_id}" data-mobile="${item.user?.mobile || ''}" data-booking="${item.user?.bookings ? item.user.bookings.length / 2 : 0}" data-aadhaar_number="${item.user?.aadhaar_number}">
                            User details
                        </button>
                    </td>
                    <td>${item.user ? item.user.driving_licence : ''}</td>
                    <td>${item.booking_id}</td>

                    <td>${mainDate}<br>

                    </td>
                    <td>${carModel.dep_amount || 0}</td>
                    <td>
                        <button class="btn btn-warning amount-modal" data-id="${item.booking_id}" data-week_days_amount="${paymentDetails.week_days_amount || 0}" data-week_end_amount="${paymentDetails.week_end_amount || 0}" data-festival_amount="${paymentDetails.festival_amount || 0}" data-delivery_fee="${item.delivery_fee || ''}" data-dep_fee="${carModel.dep_amount || ''}" data-coupon="${item.details?.[0].coupon ? JSON.parse(item.details?.[0].coupon).discount : '0'}" data-type="${item.details?.[0].coupon ? JSON.parse(item.details?.[0].coupon).type : ''}"  data-manual_discount="${item?.payment?.discount ? item?.payment?.discount : 0 }" >
                            Amount Details
                        </button>
                    </td>
                      ${permissions.includes('hub_cancel_booking') ? `
                    <td>
                        <button class="btn btn-danger cancel_booking" data-id="${item.booking_id}">
                            Cancel Order
                        </button>
                    </td>
                    ` : ''}
                </tr>
            `);
                });
            }
        }
    });
});
