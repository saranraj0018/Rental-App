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
    });
});
