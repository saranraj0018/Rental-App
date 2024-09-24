$(function () {
    'use strict';
    $(document).ready(function() {
        $('#apply_coupon').on('click', function () {
            let couponCode = $('#coupon_code').val();

            // Send the coupon code to the server
            $.ajax({
                url: '/user/apply-coupon', // Define the route for coupon validation
                type: 'POST',
                data: {
                    coupon: couponCode,
                },
                success: function (response) {
                    if (response.valid) {
                        // Show success message and apply discount
                        $('#discount_text').text(`Discount Applied: ${response.code}%`);
                         $('#coupon_message').removeClass('d-none').addClass('d-flex');
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
            $.ajax({
                url: '/user/remove-coupon', // Define the route for removing the coupon
                type: 'POST',
                success: function () {
                    // Clear the UI
                    $('#discount_message').slideUp();
                },
                error: function () {
                    alert('Failed to remove the coupon.');
                }
            });
        });
    });
});
