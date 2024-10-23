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
                    if (response.valid) {
                        $('#discount_text').text(`Coupon Applied Successfully: ${response.code}%`);
                         $('#coupon_message').removeClass('d-none').addClass('d-flex');
                        $('#total_price').text(total_amount + additional_amount);
                        $('#coupon_amount').text(coupon_amount);
                        $('#final_coupon_amount').val(coupon_amount);
                        $('#coupon_code').val(` `);
                    } else {
                        alert('Invalid coupon code.');
                    }
                },
                error: function () {
                    alert('An error occurred while applying the coupon.');
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
            dateFormat: "d-m-Y | H:i",
            time_24hr: true,
            minuteIncrement: 30, // 30-minute intervals
            allowInput: true,
        });

        $('#calculate_price').on('click', function () {
            const bookingId = $('#booking_id').val();
            const endDate = $('#end_date').val();
            const model_id = $('#model_id').val();
            const date = $('#delivery_date').val();
            let deliveryDate = date.replace(/\|/g, '').trim();

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

        $('#risk-form').on('submit', function (event) {
            event.preventDefault();

            // Implement the payment logic here, such as initializing Razorpay.
        });
    });
});
