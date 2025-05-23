$(function () {
    'use strict'
    $(document).ready(function() {
        $('select.form-select, select.form-control').each(function() {
            if ($(this).hasClass('is-invalid')) {
                $(this).closest('.bootstrap-select').addClass('is-invalid');
            } else {
                $(this).closest('.bootstrap-select').removeClass('is-invalid');
            }
        });


     $('input[name="end_date"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerIncrement: 30,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            locale: {
                format: 'DD-MM-YYYY HH:mm'
            }
        });

        $('input[name="user_start_date"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerIncrement: 30,
            timePicker24Hour: true,
            // startDate: moment().startOf('hour'),
            // minDate: moment().startOf('day'),
            locale: {
                format: 'DD-MM-YYYY HH:mm'
            }
        });

        $('input[name="user_end_date"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerIncrement: 30,
            timePicker24Hour: true,
            // startDate: moment().startOf('hour'),
            // minDate: moment().startOf('day'),
            locale: {
                format: 'DD-MM-YYYY HH:mm'
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
                    $('#cancelModal').modal('hide');
                    alertify.success('Booking has been cancelled successfully.');
                    updateBookingTable(response.data,response.permissions);
                },
                error: function(xhr) {
                    alertify.error('Failed to cancel the booking. Please try again.');
                }
            });
        });


        $('#create_booking').click(function() {
            $('#hub_list').selectpicker('refresh');
            $('#create_user_booking').modal('show');
        });

        $('#car_available').on('click', function(e) {
            e.preventDefault();

            let start_date = $('#user_start_date').val();
            let end_date = $('#user_end_date').val();
            let hub_list = $('#hub_list').val();

            if (!start_date && !end_date){
                alertify.warning('please Choose Start and End Date');
                return;
            }
            if (!hub_list){
                alertify.warning('please Choose City');
                return;
            }

            if (start_date && end_date) {
                $.ajax({
                    url: '/admin/available/cars',
                    type: 'get',
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        hub_list: hub_list,
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            let carSelect = $('#user_car_model');
                            carSelect.empty(); // Clear existing options
                            carSelect.append('<option value="">Select Car Model</option>');
                            $.each(response.data, function(index, car) {
                                    carSelect.append('<option value="' + car.car_model.car_model_id + '">' + car.car_model.model_name + '</option>');
                            });
                            carSelect.selectpicker('refresh');

                            $('#car_availability_section').show();
                        } else {
                            $('#car_availability_section').hide();
                            alertify.error('No cars available for the selected dates.');
                        }

                     },
                    error: function(xhr) {
                        alertify.error('Failed to cancel the booking. Please try again.');
                    }
                });
            }

        });


        $('#user_car_model').on('change', function() {
            let carModelId = $(this).val();
            let start_date = $('#user_start_date').val();
            let end_date = $('#user_end_date').val();
            if (carModelId) {
                $.ajax({
                    url: '/admin/check-payment/models', // Replace with your route for getting car price
                    method: 'GET',
                    data: {
                        car_model_id: carModelId,
                        start_date: start_date,
                        end_date: end_date,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#model_name').text(response.car_model.model_name?? '');
                            $('#total_days').text(response.total_days ?? 0);
                            $('#total_hours').text(response.total_hours ?? 0);
                            $('#user_week_days_amount').text(response.week_days_amount ?? 0);
                            $('#user_week_end_amount').text(response.week_end_amount ?? 0);
                            $('#user_festival_amount').text(response.festival_amount ?? 0);
                            $('#total_price').text(response.total_price ?? 0);
                            $('#user_delivery_fee').text(response.delivery_fee ?? 0);
                            $('#security_dep').text(response.car_model.dep_amount ?? 0);
                            let finalTotalPrice = parseFloat(response.total_price) + parseFloat(response.delivery_fee) + parseFloat(response.car_model.dep_amount);
                            $('#final_total_price').text(finalTotalPrice.toFixed(2)?? 0);
                            $('#price_list_section').show();
                            $('#user_amount').val(finalTotalPrice);
                        } else {
                            $('#price_list').html('<p>No price information available.</p>');
                        }
                    },
                    error: function() {
                        alertify.error('Failed to retrieve price information. Please try again.');
                    }
                });
            } else {
                $('#price_list_section').hide();
            }
        });


        $(document).on('click', '#user_payment_link', function (e) {
            e.preventDefault();
            let email = $('#email').val();

            if (!email){
                alertify.warning('please enter email Address');
                return;
            }
            let amount = $('#user_amount').val();
              let mobile = $('#mobile').val();
            $('#user_payment_link').prop('disabled', true);
            let discount = $('#discount').val();


            const _amount = parseFloat(amount) - parseFloat(discount);
            $.ajax({
                url: '/admin/user-payment/link',
                type: 'POST',
                  data: { email: email, amount: _amount, mobile: mobile },
                success: function (data) {
                    if (data.success) {
                        $('#payment_success').text(data.success);
                        alertify.success(data.success);
                    } else {
                        alertify.error('Error calculating price. Please try again.');
                    }
                },
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                },
                complete: function() {
                    $('#user_payment_link').prop('disabled', false);
                }
            });
        });

        $('#user_booking_form').on('submit', function(e) {

            e.preventDefault();
            let isValid = true;
            let fields = [
                { id: '#name', wrapper: true, condition: (val) => val === '' },
                { id: '#email', wrapper: true, condition: (val) => val === '' },
                { id: '#mobile', wrapper: true, condition: (val) => val === '' },
                { id: '#pickup_location', wrapper: true, condition: (val) => val === '' },
                { id: '#drop_location', wrapper: true, condition: (val) => val === '' },
                { id: '#license_number', wrapper: true, condition: (val) => val === '' },
                { id: '#aadhaar_card', wrapper: true, condition: (val) => val === '' },
                { id: '#user_start_date', wrapper: true, condition: (val) => val === '' },
                { id: '#user_end_date', wrapper: true, condition: (val) => val === '' },
                { id: '#discount', wrapper: true, condition: (val) => val === '' },
                { id: '#mode_of_payment', wrapper: true, condition: (val) => val === '' },
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
                $("#manual_booking").prop("disabled", true); // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/user/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#alert-modal-admin').modal('show');
                        $('#create_user_booking').modal('hide');

                        $('#response_booking_id').text(response?.booking?.booking_id);
                        $('#response_start_date').text(response?.booking?.start_date);
                        $('#response_end_date').text(response?.booking?.end_date);
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
                        $('#manual_booking').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
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
                        updateBookingTable(response.data, response.permissions);
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

        $('#booking_table').on('click', '.user-details-modal', function() {
            $('#user_mobile').val($(this).data('mobile'));
            $('#user_aadhaar').val($(this).data('aadhaar_number'));
            $('#booking_count').text($(this).data('booking'));
            $('#user_model').modal('show');
        });

              $('#booking_table').on('click', '.edit-booking-date', function() {
            $('#date_booking_id').val($(this).data('id'));
            $('#date_booking_type').val($(this).data('booking_type'));
            $('#date_start_date').val($(this).data('start_date'));
            $('#end_date').val($(this).data('start_date'));
            $('#model_id').val($(this).data('model_id'));
            $('#car_id').val($(this).data('car_id'));
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
            $('#coupon').text($(this).data('coupon'));
            $('#manual_discount').text($(this).data('manual_discount'));

            $('#grand_total').text(
                (isNull(parseFloat($(this).data('week_days_amount')), 0) +
                isNull(parseFloat($(this).data('week_end_amount')), 0) +
                isNull(parseFloat($(this).data('festival_amount')), 0) +
                isNull(parseFloat($(this).data('delivery_fee')), 0) +
                isNull(parseFloat($(this).data('dep_fee')), 0)) -
                isNull(parseFloat($(this).data('coupon')), 0) -
                isNull(parseFloat($(this).data('manual_discount')), 0)
            );

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
                    updateBookingTable(response.data,response.permissions);
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        });

        $('#booking_date').on('submit', function(e) {
            e.preventDefault();
            let bookingId = $('#date_booking_id').val();
            let start_date = $('#date_start_date').val().replaceAll('/', '-');
            let end_date = $('#end_date').val().replaceAll('/', '-');
            let booking_type = $('#date_booking_type').val();
            let model_id = $('#model_id').val();
            let car_id = $('#car_id').val();

            $.ajax({
                url: '/admin/reschedule/date',
                method: 'POST',
                data: {
                    booking_id: bookingId,
                    start_date: start_date,
                    end_date: end_date,
                    booking_type: booking_type,
                    model_id: model_id,
                    car_id: car_id,

                },
                success: function(response) {
                    $('#date_model').modal('hide');
                    alertify.success(response.success);
                    updateBookingTable(response.data,response.permissions);
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        });

        function updateBookingTable(data,permissions) {
            let tbody = $('#booking_table tbody');
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
                    <td style="font-size: .5em">${item.booking_type === 'pickup' ? '<h2 style="font-size: 2em">P</h2>' : '<h2 style="font-size: 2em">D</h2>'}</td>
                    <td style="font-size: .7em; width: 100px !important; word-break: break-word; white-space: normal;">
                    ${!item.details[0].mode_of_payment ? 'N/A' : item.details[0].mode_of_payment}
                    </td>
                     ${(permissions.includes('hub_risk_status') || permissions.includes('hub_risk_comments')) ? `
                        <td style="font-size: .7em; padding: .3em">
                            ${permissions.includes('hub_risk_status') ? `<div class="d-flex justify-content-center">
                                <input type="checkbox" class="risk-checkbox" data-id="${item.id}" ${item.risk === 1 ? 'checked' : ''}>
                            </div>` : ''}
                            <br>
                            ${permissions.includes('hub_risk_comments') ? `
                            <button style="font-size: .9em !important; padding: .8em; border:none; outline: none; border-radius: 5px" class="btn-warning open-risk-modal" data-id="${item.id}" data-commend='${JSON.stringify(commends).replace(/'/g, "&apos;")}'>
                                <span>i</span>
                            </button>
                            ` : ''}
                        </td>

                        ` : ''}
                    ${permissions.includes('hub_risk_status') ? `
                    <td class="d-flex justify-content-center">
                        <input type="checkbox" class="done-checkbox" data-id="${item.id}" ${item.status == 2 ? 'checked' : ''}>
                    </td>
                    ` : ''}

                    <td style="font-size: .7em; padding: .3em; width: 100px !important; word-break: break-word; white-space: normal;">${mainDate}<br>${rescheduleDate}</td>
                    <td style="font-size: .7em; padding: .3em">${item?.user ? item?.user?.name : ''}</td>
                    <td style="font-size: .7em; padding: .3em">${item.user ? item.user.mobile : ""}</td>
                    <td style="font-size: .7em; padding: .3em">${carModel.model_name || ''}</td>
                    <td style="font-size: .7em; padding: .3em">${bookingDetails.register_number || ''}</td>
                      <td class="truncate-text" style="font-size: .7em; padding: .3em" title="${item.address}">${item.address}</td>
                    <td style="font-size: .7em; padding: .3em">
                        <button style="font-size: .9em !important; padding: .8em; border:none; outline: none; border-radius: 5px" class=" btn-warning user-details-modal" data-id="${item?.user_id}" data-mobile="${item?.user?.mobile}" data-booking="${item?.user?.bookings ? item.user.bookings.length / 2 : 0}" data-aadhaar_number="${item?.user?.aadhaar_number}" >
                            <i class="fa fa-user"></i>
                        </button>
                    </td>
                    <td style="font-size: .7em; padding: .3em; width: 20px !important; word-break: break-word; white-space: normal;">${item?.user ? item?.user?.driving_licence : ''}</td>
                    <td style="font-size: .7em; padding: .3em">${item.booking_id}</td>
                    <td style="font-size: .7em; padding: .3em; width: 20px !important; word-break: break-word; white-space: normal;">${mainDate}<br>
                        ${permissions.includes('hub_reschedule') ? `
                        <button style="font-size: .9em !important; padding: .8em; border:none; outline: none; border-radius: 5px" class="btn-warning edit-booking-date" data-id="${item.id}"
                        data-booking_type="${item.booking_type}"
                        data-model_id="${carModel.car_model_id || ''}"
                        data-start_date="${mainDate || 0}"
                        data-car_id="${item.car_id || 0}">
                            <i class="fa fa-edit"></i>
                            </button>
                            ` : ''}
                    </td>
                    <td style="font-size: .7em; text-align: right; padding: .3em">${carModel.dep_amount || 0}</td>
                    <td style="font-size: .7em; padding: .3em">
                        <button style="font-size: .9em !important; padding: .8em; border:none; outline: none; border-radius: 5px" class=" btn-warning amount-modal" data-id="${item.booking_id}" data-week_days_amount="${paymentDetails.week_days_amount || 0}" data-week_end_amount="${paymentDetails.week_end_amount || 0}" data-festival_amount="${paymentDetails.festival_amount || 0}" data-delivery_fee="${item.delivery_fee || ''}" data-dep_fee="${carModel.dep_amount || ''}" data-coupon="${item.details?.[0].coupon ? JSON.parse(item.details?.[0].coupon).discount : '0'}" data-type="${item.details?.[0].coupon ? JSON.parse(item.details?.[0].coupon).type : ''}" data-manual_discount="${item?.payment?.discount ? item?.payment?.discount : 0 }" >
                             <i class="fa fa-wallet"></i>
                        </button>
                    </td>
                    ${permissions.includes('hub_cancel_booking') && item?.status == 1 ? `
                    <td style="font-size: .7em; padding: .3em">
                        <button style="font-size: .9em !important; padding: .8em; border:none; outline: none; border-radius: 5px" class="btn-danger cancel_booking" data-id="${item.booking_id}">
                              Cancel order
                        </button>
                    </td>
                    ` : ''}
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


        function fetchData(page = 1) {
            const carModel = $('#car_model').val();
            const registerNumber = $('#register_number').val();
            const bookingId = $('#booking_id').val();
            const customerName = $('#customer_name').val();
            const bookingType = $('#booking_type').val();
            const hub_type = $('#hub_type').val();
               let status = 1;
            $.ajax({
                url: '/admin/booking/search?page=' + page,
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
                    updateBookingTable(response.data, response.permissions)
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
        $('#car_model, #register_number, #booking_id, #customer_name, #booking_type, #hub_type').on('input change', function() {
            fetchData(1);
        });
    });




    $('.mobile_field').on('blur', function() {

        if ($(this).val().length === 10) {

            $.ajax({
                url: '/admin/fill-user-details',
                method: 'POST',
                data: {
                   mobile_number: $(this).val(),
                },

                success: function(response) {
                    if(response.user) {
                        const { name, email, aadhaar_number, driving_licence } = response.user;

                        $('#name').val(name);
                        $('#email').val(email);
                        $('#aadhaar_card').val(aadhaar_number);
                        $('#license_number').val(driving_licence);
                    }
                },
                error: function(xhr, status, error) {
                    alertify.error(error);
                }
            });
        }
    });



});


function isNull(value, replacment) {
    return !value ? replacment : value;
}
