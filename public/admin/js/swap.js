$(function () {
    'use strict';
    $(document).ready(function() {

        $('#booking_id').on('input', function () {
            let booking_id = $(this).val();
            let city_code = $('#hub_city').val();
            $.ajax({
                url: '/admin/get/booking_date',
                type: 'GET',
                data: {booking_id : booking_id,city_code:city_code},
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
            let hub_list = $('#hub_city').val();

            $.ajax({
                url: '/admin/available/cars',
                type: 'GET',
                data: {start_date : start_date, end_date : end_date,hub_list : hub_list},
                success: function (response) {
                    if (response.data && response.data.length > 0) {
                        $('#car-list').empty();
                        $('#car-card-container').empty();
                        $('#car-swap-table').show();
                        response.data.forEach(function (car) {
                            let card = `
                        <div class="card m-2" style="width: 18rem;">
                            <div class="card-body">
                              <input type="hidden" name="car_id" id="car_id" class="car_id" value="${car.id}" >
                                <h5 class="card-title">${car.car_model.model_name ?? ''}</h5>
                                <p class="card-text">Register Number: ${car.register_number}</p>
                                <p class="card-text">car id Number: ${car.id}</p>
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
            let car_id = $(this).closest('.card').find('.car_id').val();
            let old_car_id = $('#old_car_id').val();
            let booking_id = $('#booking_id').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            $.ajax({
                url: '/admin/swap/car',
                type: 'POST',
                data: {car_id : car_id, old_car_id:old_car_id, booking_id : booking_id,start_date : start_date, end_date:end_date},
                success: function (response) {
                    if (response.success) {
                        $('#with-price-modal').modal('hide');
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
            let car_id = $(this).closest('.card').find('.car_id').val();
            let booking_id = $('#booking_id').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            $.ajax({
                url: '/admin/calculate/swap/car',
                type: 'GET',
                data: {car_id : car_id, booking_id : booking_id,start_date : start_date, end_date:end_date},
                success: function (data) {
                    if (data.success) {
                        const { festival_amount, week_end_amount, week_days_amount, total_price, booking_price,final_total_price } = data;
                        $('#calculated-amount').html(`
                        <p>Normal Days: ₹${week_days_amount}</p>
                        <p>Festival Days: ₹${festival_amount}</p>
                        <p>Weekend Days: ₹${week_end_amount}</p>
                        <p>Total Booking Amount : ₹${booking_price}</p>
                        <p>Total: ₹${final_total_price}</p>
                         <input type="hidden" name="old_car_id" id="old_car_id" class="old_car_id" value="${car_id}" >
                    `);
                        $('#amount').val(final_total_price);
                        $('#with-price-modal').modal('show');

                    } else {
                        alertify.error('Error calculating price. Please try again.');
                    }
                },
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                }
            });
        });

        $(document).on('click', '#send_payment', function (e) {
            e.preventDefault();
            let booking_id = $('#booking_id').val();
            let amount = $('#amount').val();
            $.ajax({
                url: '/admin/payment/link',
                type: 'POST',
                data: { booking_id : booking_id,amount :amount},
                success: function (data) {
                    if (data.success) {
                        $('#payment_success').text(data.success);
                    } else {
                        alertify.error('Error calculating price. Please try again.');
                    }
                },
                error: function () {
                    alertify.error('An error occurred while fetching the data.');
                }
            });
        });

        $('#history_booking_id').on('keyup', fetchData);

        function fetchData() {
            let booking_id = $('#history_booking_id').val();
            $.ajax({
                url: '/admin/swap/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    booking_id: booking_id,
                },
                success: function (response) {
                    updateSwapTable(response.data, response.permissions) // Populate table with new data
                },
                error: function (xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        function updateSwapTable(data, permissions) {
            let tbody = $('#swap_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.swap.length === 0) {
                tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
            } else {
                // Loop through the data and append rows
                let rowCount = 1;
                $.each(data.swap, function(index, item) {
                    tbody.append(`
                <tr>
                     <td>${rowCount++}</td>
                    <td>${item.booking_id}</td>
                   <td>${item.user ? item.user.email : ''}</td>
                   <td>${item.car.car_model ? item.car.car_model.model_name : ''}</td>
                    <td>${item.swap_car.car_model ? item.swap_car.car_model.model_name : ''}</td>
                    <td>${formatDateTime(item.updated_at)}</td>

                </tr>
            `);
                });
            }
        }

        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }

    });
});
