$(function () {
    'use strict'
    $(document).ready(function() {
        $('#car_model').on('change', function () {
            $.ajax({
                url: '/admin/car-availability',
                data: {
                    model_id: $('#car_model').val(),
                },
                success: function (response) {
                    $('#availabilityTable').html(response);
                }
            });
        });
    })
})
