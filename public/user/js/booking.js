$(function () {
    'use strict';
    $(document).ready(function() {
        $('#apply_coupon').on('click', function () {
            let couponCode = $('#coupon_code').val();
            let final_amount = parseFloat($('#final_amount').val());
            let additional_amount = parseFloat($('#additional_amount').val());
            // Send the coupon code to the server
            $.ajax({
                url: '/user/apply-coupon', // Define the route for coupon validation
                type: 'POST',
                data: {
                    coupon: couponCode,
                },
                success: function (response) {
                    let coupon_amount = response.final_amount ?? 0;
                    let total_amount = final_amount - coupon_amount;
                      if (response.message) {
                          $('#mobileModal').modal('show');
                        return;
                    }
                    if (response.valid) {
                        $('#discount_text').text(`Coupon Applied Successfully: ${response.code}%`);
                         $('#coupon_message').removeClass('d-none').addClass('d-flex');
                        $('#total_price').text(total_amount + additional_amount);
                        $('#coupon_amount').text(coupon_amount);
                        $('#final_coupon_amount').val(coupon_amount);
                        $('#coupon_code').val(` `);
                    } else {
                         let error_message = 'Invalid coupon code';
                        $('#error_message').text(error_message);
                        $('#login_alert').modal('show');
                    }
                },
                 error: function (response) {

                    if (response.responseJSON && response.responseJSON.message) {
                        let errors = response.responseJSON.message;
                        if (errors === 'Unauthenticated.') {
                            $('#mobileModal').modal('show');
                        }
                    }
                }
            });
        });

        $(document).on('click', '.remove-coupon', function () {
            let final_amount = parseFloat($('#final_amount').val());
            let additional_amount = parseFloat($('#additional_amount').val());
            $.ajax({
                url: '/user/remove-coupon', // Define the route for removing the coupon
                type: 'POST',
                success: function () {
                    $('#final_coupon_amount').val(0);
                    $('#discount_text').text(``);
                    $('#coupon_code').val(` `);
                    $('#coupon_message').addClass('d-none').removeClass('d-flex');
                    $('#total_price').text(final_amount + additional_amount);
                },
                error: function () {
                    alert('Failed to remove the coupon.');
                }
            });
        });

        $('#user_booking').on('click', '.edit_date', function() {
            $('#booking_id').val($(this).data('booking_id'));
            $('#end_date').val($(this).data('end_date'));
            $('#model_id').val($(this).data('model_id'));
            $('#reschedule_model').modal('show');
        });
        flatpickr("#delivery_date", {
            minDate: "today",
            enableTime: true,
            dateFormat: "d-m-Y H:i",
            time_24hr: true,
            minuteIncrement: 30, // 30-minute intervals
            allowInput: true,
        });

        $('#calculate_price').on('click', function () {
            const bookingId = $('#booking_id').val();
            const endDate = $('#end_date').val();
            const model_id = $('#model_id').val();
            const date = $('#delivery_date').val();
            let deliveryDate = date.replace(/\|/g,'').trim();

            if (!deliveryDate) {
                $('#delivery_date').addClass('is-invalid');
                return;
            }

            // Make an AJAX request to calculate the price
            $.ajax({
                url: '/user/calculate-price',
                method: 'POST',
                data: { booking_id: bookingId, end_date: endDate, delivery_date: deliveryDate, model_id:model_id },
                success: function (data) {
                    if (data.success) {
                        const { festival_amount, week_end_amount, week_days_amount, total_price } = data;
                        $('#price-details').html(`
                        <p>Normal Days: ₹${week_days_amount}</p>
                        <p>Festival Days: ₹${festival_amount}</p>
                        <p>Weekend Days: ₹${week_end_amount}</p>
                        <p>Total: ₹${total_price}</p>
                    `);
                        $('#reschedule_pay').removeClass('d-none');

                    } else {
                        alert('Error calculating price. Please try again.');
                    }
                },
                error: function (response) {
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
                }
            });
        });

        $('#pills-tabContent').on('click', '.details', function() {
            $('#booking_id').text($(this).data('booking_id'));
            $('#total_days').val($(this).data('total_days'));
            $('#total_hours').val($(this).data('total_hours'));
            $('#total_price').val($(this).data('total_price'));
            $('#festival_amount').val($(this).data('festival_amount'));
            $('#weekend_amount').val($(this).data('weekend_amount'));
            $('#week_days_amount').val($(this).data('week_days_amount'));
            $('#model_name').val($(this).data('model_name'));
            $('#register_number').val($(this).data('register_number'));
            $('#coupon_code').val($(this).data('code'));
            $('#discount').val($(this).data('discount'));
            $('#booking_model').modal('show');
        });

        $('#user_booking').on('click', '.cancel_booking', function() {
            $('#cancel_booking_id').val($(this).data('booking_id'));
            $('#cancel_booking').modal('show');
        });
        
           $(document).on('click', '#close_pop', function () {
            $('#reschedule_model').modal('hide');
        });

        $(document).on('click', '#details_close_pop', function () {
            $('#booking_model').modal('hide');
        });

        $(document).on('click', '#cancel_close_pop', function () {
            $('#cancel_booking').modal('hide');
        });

  $('#accept_terms').on('change', function() {
            if ($(this).is(':checked')) {
                $('#confirm_cancel_btn').prop('disabled', false);
            } else {
                $('#confirm_cancel_btn').prop('disabled', true);
            }
        });

        $('#cancel_booking_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            let fields = [
                { id: '#cancel_reason', wrapper: true, condition: (val) => val === '' },
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
                $.ajax({
                    url: '/user/booking/cancel',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#cancel_booking').modal('hide');
                        window.location.reload();
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
                });
            }
        });
    });
});
