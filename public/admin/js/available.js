$(function () {
    'use strict'
    $(document).ready(function() {
        $('#car_model').on('change', function () {
            $.ajax({
                url: '/admin/check-available',
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
