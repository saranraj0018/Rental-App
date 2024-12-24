$(function () {
    'use strict'
    $(document).ready(function() {
        $('#cancel_car_model, #cancel_register_number, #cancel_booking_id, #cancel_customer_name, #cancel_booking_type, #cancel_hub_type').on('input change', function() {
            fetchData();
        });

        function fetchData() {
            const carModel = $('#cancel_car_model').val();
            const registerNumber = $('#cancel_register_number').val();
            const bookingId = $('#cancel_booking_id').val();
            const customerName = $('#cancel_customer_name').val();
            const bookingType = $('#cancel_booking_type').val();
            const hub_type = $('#cancel_hub_type').val();
            let status = 3;
            $.ajax({
                url: '/admin/booking/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    car_model: carModel,
                    register_number: registerNumber,
                    booking_id: bookingId,
                    customer_name: customerName,
                    booking_type: bookingType,
                    hub_type: hub_type,
                    status:status
                },
                success: function(response) {
                    updateBookingTable(response.data, response.permissions) // Populate table with new data
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        $('#cancel_booking_table').on('click', '.user-details-modal', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

        $('#cancel_booking_table').on('click', '.amount-modal', function() {
            let total = $(this).data('week_days_amount') + $(this).data('week_end_amount') + $(this).data('festival_amount');
            $('#booking_id').val($(this).data('id'));
            $('#week_days_amount').text($(this).data('week_days_amount'));
            $('#week_end_amount').text($(this).data('week_end_amount'));
            $('#festival_amount').text($(this).data('festival_amount'));
            $('#modal_base_fare').text(total ?? 0);
            $('#delivery_fee').text($(this).data('delivery_fee'));
            $('#dep_fee').text($(this).data('dep_fee'));
            $('#amount_modal').modal('show');
        });

        $('#cancel_booking_table').on('click', '.open-risk-modal', function() {
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

        function updateBookingTable(data,permissions) {
            let tbody = $('#cancel_booking_table tbody');
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

                    ${(permissions.includes('hub_risk_status') || permissions.includes('hub_risk_comments')) ? `
                    <td>
                       <button class="btn btn-warning open-risk-modal" data-id="${item.id}" data-commend='${JSON.stringify(commends).replace(/'/g, "&apos;")}'>
                         <h5>i</h5>
                        </button>
                    </td>
                    ` : ''}

                    <td>${formatDateTime(item.start_date)}<br>
<p class="text-danger">${rescheduleDate}</p></td>
                    <td>${item.user ? item.user.name : ''}</td>
                    <td>${carModel.model_name || ''}</td>
                    <td>${bookingDetails.register_number || ''}</td>
                    <td class="truncate-text" title="${item.address}">${item.address}</td>
                    <td>
                        <button class="btn btn-warning user-details-modal" data-id="${item.user_id}" data-mobile="${item.user ? item.user.mobile : ''}" data-booking="${item.user.bookings ? item.user.bookings.length / 2 : 0}" data-aadhaar_number="${item.user ? item.user.aadhaar_number : ''}">
                            User details
                        </button>
                    </td>
                    <td>${item.user ? item.user.driving_licence : ''}</td>
                    <td>${item.booking_id}</td>
                    <td>${item.start_date ? formatDateTime(item.start_date) : formatDateTime(item.end_date)}<br>
                    </td>
                    <td>${carModel.dep_amount || 0}</td>
                    <td>
                        <button class="btn btn-warning amount-modal" data-id="${item.booking_id}" data-week_days_amount="${paymentDetails.week_days_amount || 0}" data-week_end_amount="${paymentDetails.week_end_amount || 0}" data-festival_amount="${paymentDetails.festival_amount || 0}" data-delivery_fee="${item.delivery_fee || ''}" data-dep_fee="${carModel.dep_amount || ''}" data-coupon="${item.coupon ? item.coupon.discount : ''}" data-type="${item.coupon ? item.coupon.type : ''}">
                            Amount Details
                        </button>
                    </td>
                </tr>
            `);
                });
            }
        }
    });
});
