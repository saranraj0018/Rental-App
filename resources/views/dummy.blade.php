<!-- resources/views/calendar.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Holiday Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <style>
        .fc-daygrid-day.bg-holiday {
            background-color: #ff9f89 !important;
        }
    </style>
</head>
<body>
<div id="calendar"></div>
<button id="save-holidays">Save Selected Holidays</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            select: function(info) {
                // Add holiday class to selected date
                var dateStr = info.startStr;
                var dayCell = document.querySelector(`[data-date="${dateStr}"]`);
                if (dayCell) {
                    dayCell.classList.add('bg-holiday');
                }
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '/holidays',
                    method: 'GET',
                    success: function(response) {
                        const holidays = response.map(date => ({
                            title: 'Holiday',
                            start: date,
                            display: 'background',
                            backgroundColor: '#ff9f89',
                        }));

                        successCallback(holidays);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
        });

        calendar.render();

        // Save selected holidays
        $('#save-holidays').on('click', function() {
            var selectedDates = [];
            document.querySelectorAll('.fc-daygrid-day.bg-holiday').forEach(function(day) {
                selectedDates.push(day.dataset.date);
            });

            $.ajax({
                url: '/holidays',
                method: 'POST',
                data: {
                    dates: selectedDates,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function() {
                    alert('An error occurred while saving holidays.');
                }
            });
        });
    });
</script>
</body>
</html>
