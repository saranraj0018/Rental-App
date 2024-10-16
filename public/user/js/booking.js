$(function () {
    'use strict';
    $(document).ready(function() {
        $('#apply_coupon').on('click', function () {
            let couponCode = $('#coupon_code').val();
            let total_amount = parseFloat($('#coupon_before').val());
            // Send the coupon code to the server
            $.ajax({
                url: '/user/apply-coupon', // Define the route for coupon validation
                type: 'POST',
                data: {
                    coupon: couponCode,
                },
                success: function (response) {
                    if (response.valid) {
                        let discount_amount;
                        if (response.type === 1) {
                            // Type 1: Percentage discount
                            discount_amount = (total_amount * response.discount) / 100;
                        } else if (response.type === 2) {
                            // Type 2: Fixed discount
                            discount_amount = response.discount;
                        }
                        let final_total = total_amount - discount_amount;
                        $('#discount_text').text(`Coupon Applied Successfully: ${response.code}%`);
                         $('#coupon_message').removeClass('d-none').addClass('d-flex');
                        $('#total_price').text(final_total);
                        $('#coupon_amount').text(discount_amount);
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
            let total_amount = parseFloat($('#coupon_before').val());
            $.ajax({
                url: '/user/remove-coupon', // Define the route for removing the coupon
                type: 'POST',
                success: function () {
                    $('#discount_text').text(``);
                    $('#coupon_code').val(` `);
                    $('#coupon_message').addClass('d-none').removeClass('d-flex');
                    $('#total_price').text(total_amount);
                },
                error: function () {
                    alert('Failed to remove the coupon.');
                }
            });
        });
    });
});
