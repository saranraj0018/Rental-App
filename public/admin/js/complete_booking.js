$(function () {
    'use strict'
    $(document).ready(function() {
        $('#complete_car_model, #complete_register_number, #complete_booking_id, #complete_customer_name, #complete_booking_type, #complete_hub_type').on('input change', function() {
            fetchData(1); // Always fetch data for the first page when filters change
        });

        function fetchData(page = 1) {
            const carModel = $('#complete_car_model').val();
            const registerNumber = $('#complete_register_number').val();
            const bookingId = $('#complete_booking_id').val();
            const customerName = $('#complete_customer_name').val();
            const bookingType = $('#complete_booking_type').val();
            const hub_type = $('#complete_hub_type').val();
            let status = 2;
            $.ajax({
                url: '/admin/booking/search?page=' + page, // Define this route in your web.php
                type: 'GET',
                data: {
                    car_model: carModel,
                    register_number: registerNumber,
                    booking_id: bookingId,
                    customer_name: customerName,
                    booking_type: bookingType,
                    status:status,
                    hub_type:hub_type
                },
                success: function(response) {
                     updateBookingTable(response.data, response.permissions) // Populate table with new data
                    updatePagination(response.data.pagination);
                },
                error: function() {
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

        $('#complete_booking_table').on('click', '.user-details-modal', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

        $('#complete_booking_table').on('click', '.amount-modal', function() {
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

        $('#complete_booking_table').on('click', '.revert', function() {
            let bookingId = $(this).data('id');

            $.ajax({
                url: '/admin/booking/revert',
                type: 'POST',
                data: {
                    booking_id: bookingId,
                },
                success: function(response) {
                    if (response.data){
                          updateBookingTable(response.data, response.permissions)
                    } else {
                        alertify.error('Data Not Found');
                    }
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });

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
            let tbody = $('#complete_booking_table tbody');
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
                     ${permissions.includes('booking_revert') ? `
                    <td>
                    ${item.status === 2 ?
                        `<button class="btn btn-warning revert" data-id="${item.id}">
                            Revert
                        </button>` : ''}
                    </td>
                ` : ''}
                    <td>${formatDateTime(item.start_date)}<br>
                    <p class="text-danger">${rescheduleDate}</p></td>
                    <td>${item?.user ? item?.user.name : ''}</td>
                    <td>${item?.user ? item?.user.mobile : ""}</td>
                    <td>${carModel.model_name || ''}</td>
                    <td>${bookingDetails.register_number || ''}</td>
                    <td class="truncate-text" title="${item.address}">${item.address}</td>
                    <td>
                         <button class="btn btn-warning user-details-modal" data-id="${item.user_id}" data-mobile="${item?.user ? item?.user.mobile : ''}" data-booking="${item?.user.bookings ? item?.user.bookings.length / 2 : 0}" data-aadhaar_number="${item?.user ? item?.user.aadhaar_number : ''}">
                            User details
                        </button>
                    </td>
                    <td>${item?.user ? item?.user.driving_licence : ''}</td>
                    <td>${item.booking_id}</td>
                    <td>${item.start_date ? formatDateTime(item.start_date) : formatDateTime(item.end_date)}<br>
                    </td>
                    <td>${carModel.dep_amount || 0}</td>
                    <td>
                        <button class="btn btn-warning amount-modal" data-id="${item.booking_id}" data-week_days_amount="${paymentDetails.week_days_amount || 0}" data-week_end_amount="${paymentDetails.week_end_amount || 0}" data-festival_amount="${paymentDetails.festival_amount || 0}" data-delivery_fee="${item.delivery_fee || ''}" data-dep_fee="${carModel.dep_amount || ''}" data-coupon="${item.details[0].coupon ? JSON.parse(item.details[0].coupon).discount : '0'}" data-type="${item.details[0].coupon ? JSON.parse(item.details[0].coupon).type : ''}"  data-manual_discount="${item?.payment?.discount ? item?.payment?.discount : 0 }"  >
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
