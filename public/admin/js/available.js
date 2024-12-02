$(function () {
    'use strict';

    $(document).ready(function() {
        let currentWeekOffset = 0;
        const initialDate = new Date();
        initialDate.setDate(initialDate.getDate() - 7); // 7 days before today

// Get today's date
        const today = new Date(); // Current date

        // Load data on car model change
        $('#car_available_model').on('change', loadWeekData);

        // Load next week's data
        $('#next-week').on('click', function() {
            currentWeekOffset++;
            loadWeekData();
        });

        // Load previous week's data
        $('#prev-week').on('click', function() {
            // Calculate the date offset by weeks
            const newDate = new Date(today);
            newDate.setDate(newDate.getDate() - currentWeekOffset * 7 - 7); // Previous week's date
                currentWeekOffset--;
                loadWeekData();

        });

        // Fetch and render data for the selected week
        function loadWeekData() {
            $.ajax({
                url: '/admin/check-available',
                method: 'GET',
                data: {
                    model_id: $('#car_available_model').val(),
                    city_code: $('#hub_available').val(),
                    week_offset: currentWeekOffset
                },
                success: function(response) {
                    const $tbody = $('#registration-numbers-body');

                    $tbody.empty(); // Clear previous data
                    generateTableHeaders(); // Generate table headers

                    const bookings = response.bookings;
                    if (!Array.isArray(bookings)) {
                        console.error('Expected bookings to be an array:', bookings);
                        return;
                    }

                    const bookingsMap = {}; // Map register numbers to their daily bookings

                    bookings.forEach(function (booking) {
                        const registerNumber = booking.register_number;
                        const startDate = new Date(booking.start_date);
                        const endDate = new Date(booking.end_date);
                        const bookingType = booking.booking_type;
                        const booking_id = booking.booking_id;

                        if (!bookingsMap[registerNumber]) {
                            bookingsMap[registerNumber] = new Array(7).fill().map(() => new Array(48).fill('green'));
                        }

                        const color =
                            (bookingType === '1') ? 'red' : (bookingType === '2') ? 'blue' :
                                (bookingType === '3') ? 'yellow' :
                                        (bookingType === '4') ? 'purple' :
                                            (bookingType === '5') ? 'orange' :
                                                (bookingType === '6') ? 'gray' :
                                                    (bookingType === '7') ? 'brown' : 'green';
                        let tempDate = new Date(startDate); // Clone startDate to avoid mutation

                        while (tempDate <= endDate) {
                            const dayIndex = calculateDayIndex(tempDate);

                            if (dayIndex >= 0 && dayIndex < 7) {
                                let hourStart = 0;
                                let hourEnd = 48;

                                // Handle start day
                                if (tempDate.toDateString() === startDate.toDateString()) {
                                    hourStart = Math.floor(startDate.getHours() * 2 + startDate.getMinutes() / 30);
                                }

                                // Handle end day
                                if (tempDate.toDateString() === endDate.toDateString()) {
                                    hourEnd = Math.ceil(endDate.getHours() * 2 + endDate.getMinutes() / 30) + 1;
                                }

                                // Loop through the hours for the current day
                                for (let h = hourStart; h < hourEnd; h++) {
                                    if (h < 48) {
                                        bookingsMap[registerNumber][dayIndex][h] = { color, booking_id };
                                    }
                                }
                            }

                            // Move to the next day safely without affecting tempDate
                            tempDate.setDate(tempDate.getDate() + 1);
                            tempDate.setHours(0, 0, 0, 0); // Reset time to midnight for the new day
                        }


                    });

// Populate the table with booking data
                    // Populate the table with booking data
                    for (const registerNumber in bookingsMap) {
                        let rowHtml = `<tr style="border: 1px solid #000;"> <td style="border: 1px solid #000;">${registerNumber}</td>`;
                        for (let d = 0; d < 7; d++) {
                            for (let h = 0; h < 48; h++) {
                                const colorData = bookingsMap[registerNumber][d][h];
                                const cellColor = colorData?.color || 'green'; // Default to green if no color is set
                                const bookingId = colorData?.booking_id || ''; // Default to empty if no booking_id is present

                                rowHtml += `<td style="background-color: ${cellColor}; border: 1px solid #000;"
                 title="${bookingId ? 'Booking ID: ' + bookingId : 'Default Green'}">
                 ${bookingId || ''}
            </td>`;
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

        // Generate table headers dynamically
        function generateTableHeaders() {
            let startDate = new Date();
            startDate.setDate(startDate.getDate() + currentWeekOffset * 7);

            const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let dateHeaderRow = '';
            let hoursHeaderRow = '<th>Reg No</th>';

            for (let i = 0; i < 7; i++) {
                let date = new Date(startDate);
                date.setDate(startDate.getDate() + i);

                const dayName = daysOfWeek[date.getDay()];
                const month = date.toLocaleString('default', { month: 'long' });
                dateHeaderRow += `<th colspan="48">${dayName}, ${month} ${date.getDate()}, ${date.getFullYear()}</th>`;

                for (let hour = 0; hour < 24; hour++) {
                    hoursHeaderRow += `<th>${hour}:00</th><th>${hour}:30</th>`;
                }
            }

            $('#date-header').html(dateHeaderRow);
            $('#hours-header').html(hoursHeaderRow);
        }

        // Calculate the day index for bookings
        function calculateDayIndex(currentDate) {
            const weekStartDate = new Date();
            weekStartDate.setDate(weekStartDate.getDate() + currentWeekOffset * 7);
            weekStartDate.setHours(0, 0, 0, 0);

            const diffInMs = currentDate - weekStartDate;
            return Math.floor(diffInMs / (1000 * 60 * 60 * 24));
        }

        // Fetch car models based on hub selection
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
