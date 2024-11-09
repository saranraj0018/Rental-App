$(function () {
    'use strict';
    $(document).ready(function() {
        let currentWeekOffset = 0; // Track the current week offset

        $('#car_available_model').on('change', function () {
            loadWeekData();
        });

        $('#next-week').on('click', function() {
            currentWeekOffset++;
            loadWeekData();
        });

        $('#prev-week').on('click', function() {
            if (currentWeekOffset > 0) {
                currentWeekOffset--;
                loadWeekData();
            }
        });

        function loadWeekData() {
            $.ajax({
                url: '/admin/check-available',
                method: 'GET',
                data: {
                    model_id: $('#car_available_model').val(),
                    city_code: $('#hub_available').val(),
                    week_offset: currentWeekOffset // Send the current week offset
                },
                success: function(response) {
                    const $tbody = $('#registration-numbers-body');
                    $tbody.empty(); // Clear previous data
                    generateTableHeaders(); // Generate table headers when data is fetched

                    // Ensure you're accessing response.bookings correctly
                    const bookings = response.bookings; // Check if this is an array

                    if (!Array.isArray(bookings)) {
                        console.error('Expected bookings to be an array:', bookings);
                        return; // Exit if it's not an array
                    }

                    const bookingsMap = {};

                    bookings.forEach(function(booking) {
                        const registerNumber = booking.register_number;
                        const startDate = new Date(booking.start_date);
                        const endDate = new Date(booking.end_date);
                        const bookingType = booking.booking_type;

                        if (!bookingsMap[registerNumber]) {
                            bookingsMap[registerNumber] = new Array(7).fill().map(() => new Array(48).fill('green'));
                        }

                        // Determine color based on booking type
                        const color = (bookingType === '0') ? 'red' : (bookingType === '2') ? 'blue' : 'green';

                        for (let d = 0; d < 7; d++) {
                            const currentDate = new Date();
                            currentDate.setDate(currentDate.getDate() + (d + currentWeekOffset * 7));

                            if (currentDate >= startDate && currentDate <= endDate) {
                                const hourStart = (currentDate.toDateString() === startDate.toDateString()) ? Math.floor(startDate.getHours() * 2 + startDate.getMinutes() / 30) : 0;
                                const hourEnd = (currentDate.toDateString() === endDate.toDateString()) ? Math.ceil(endDate.getHours() * 2 + endDate.getMinutes() / 30) : 48;

                                for (let h = hourStart; h < hourEnd; h++) {
                                    if (h < 48) {
                                        bookingsMap[registerNumber][d][h] = color;
                                    }
                                }
                            }
                        }
                    });

                    // Populate the table
                    for (const registerNumber in bookingsMap) {
                        let rowHtml = `<tr style="border: 1px solid #000;"> <td style="border: 1px solid #000;">${registerNumber}</td>`;
                        for (let d = 0; d < 7; d++) {
                            for (let h = 0; h < 48; h++) {
                                const color = bookingsMap[registerNumber][d][h];
                                rowHtml += `<td style="background-color: ${color}; border: 1px solid #000;"></td>`;
                            }
                        }
                        rowHtml += `</tr>`;
                        $tbody.append(rowHtml);
                    }

                    $('#car-details-table').show();


                },

                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                    alert('An error occurred while fetching registration numbers.');
                }
            });
        }

        function generateTableHeaders() {
            let startDate = new Date(); // Use the current date as the starting point
            startDate.setDate(startDate.getDate() + currentWeekOffset * 7); // Adjust for the current week offset
            let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            let dateHeaderRow = '';
            let hoursHeaderRow = '<th>Reg No</th>';

            // Loop through the next 7 days to create headers
            for (let i = 0; i < 7; i++) {
                let date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                let dayName = daysOfWeek[date.getDay()];
                let day = date.getDate();
                let month = date.toLocaleString('default', { month: 'long' });
                let year = date.getFullYear();

                // Create the date header
                let backgroundColor = (i % 2 === 0) ? '#FFFFFF' : '#000000'; // White for even, black for odd days
                let textColor = (i % 2 === 0) ? '#000000' : '#FFFFFF'; // Text color to contrast the background

                dateHeaderRow += `<th colspan="48" style="background-color: ${backgroundColor}; color: ${textColor};">${dayName}, ${month} ${day}, ${year}</th>`;

                // Create hour headers (0 to 23) in half-hour increments
                for (let hour = 0; hour < 24; hour++) {
                    hoursHeaderRow += `<th style="background-color: ${backgroundColor}; color: ${textColor};">${hour}:00</th>`;
                    hoursHeaderRow += `<th style="background-color: ${backgroundColor}; color: ${textColor};">${hour}:30</th>`;
                }
            }

            // Set the table headers
            $('#date-header').html(dateHeaderRow);
            $('#hours-header').html(hoursHeaderRow);
        }

        $('#hub_available').change(function() {
            let hub_id = $(this).val();
            if (hub_id) {
                $.ajax({
                    url: '/admin/get-car-models',
                    method: 'GET',
                    data: { hub_id: hub_id },
                    success: function(response) {
                        let carModelSelect = $('#car_available_model');
                        carModelSelect.empty(); // Clear current options
                        carModelSelect.append('<option selected disabled>Choose a Car Model</option>');
                        if (response.carModels.length > 0) {
                            response.carModels.forEach(function(model) {
                                carModelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
                            });
                        }
                    },
                    error: function() {
                        alertify.error('Error fetching car models.');
                    }
                });
            }
        });
    });
});
