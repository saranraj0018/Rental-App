$(function () {
    'use strict';
    $(document).ready(function() {

        $('#booking_id').on('input', function () {
            let booking_id = $(this).val();
            $.ajax({
                url: '/admin/get/booking_date',
                type: 'GET',
                data: {booking_id : booking_id},
                success: function(response) {
                    if (response.data) {
                        $('#start_date').val(response.data.start_date);
                        $('#end_date').val(response.data.end_date);
                        $('#search_cars').prop('disabled',false);
                    }
                },
                error: function(response) {
                },
            });
        });

        $('#search_cars').on('click', function () {
           let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            $.ajax({
                url: '/admin/available/cars',
                type: 'GET',
                data: {start_date : start_date, end_date : end_date},
                success: function (response) {
                    if (response.data.available_cars && response.data.available_cars.length > 0) {
                        $('#car-list').empty();
                        $('#car-card-container').empty();
                        $('#car-swap-table').show();
                        response.data.available_cars.forEach(function (car) {
                            let card = `
                        <div class="card m-2" style="width: 18rem;">
                            <div class="card-body">
                              <input type="hidden" name="car_id" id="car_id" value="${car.id}" >
                                <h5 class="card-title">${car.car_model.model_name ?? ''}</h5>
                                <p class="card-text">Register Number: ${car.register_number}</p>
                                <button type="button" class="btn btn-primary with_price">With Price</button>
                                <button type="button" class="btn btn-secondary without_price">Without Price</button>
                            </div>
                        </div>
                    `;
                            $('#car-card-container').append(card);
                        });
                    } else {
                        alertify.warning('No available cars found for the selected period.');
                    }
                },
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                }
            });
        });

        $(document).on('click', '.without_price', function (e) {
            e.preventDefault();
            let car_id = $('#car_id').val();
            let booking_id = $('#booking_id').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            $.ajax({
                url: '/admin/swap/car',
                type: 'POST',
                data: {car_id : car_id, booking_id : booking_id,start_date : start_date, end_date:end_date},
                success: function (response) {
                    if (response.success) {
                        $('#without-price-modal').modal('show');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                },
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                }
            });
        });

        $(document).on('click', '.with_price', function (e) {
            e.preventDefault();
            let car_id = $('#car_id').val();
            let booking_id = $('#booking_id').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            $.ajax({
                url: '/admin/calculate/swap/car',
                type: 'GET',
                data: {car_id : car_id, booking_id : booking_id,start_date : start_date, end_date:end_date},
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
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                }
            });
        });

    });
});
