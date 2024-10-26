<!-- First Modal Popup -->
<div class="modal fade" id="dateTimeModal1" tabindex="-1" aria-labelledby="dateTimeModalLabel1" aria-hidden="true">
    <div class="modal-dialog date-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateTimeModalLabel1">Choose Date and Time (1)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-pills" id="dateTimeTab1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3 active" id="date-tab1" data-bs-toggle="tab"
                               href="#dateTabContent1" role="tab" aria-controls="dateTabContent1"
                               aria-selected="true">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3" id="time-tab1" data-bs-toggle="tab"
                               href="#timeTabContent1" role="tab" aria-controls="timeTabContent1"
                               aria-selected="false">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active p-3" id="dateTabContent1" role="tabpanel"
                         aria-labelledby="date-tab1">
                        <div id="inlineDatePicker1"></div>
                    </div>
                    <div class="tab-pane fade p-3" id="timeTabContent1" role="tabpanel" aria-labelledby="time-tab1">
                        <div id="time-buttons" class="d-flex justify-content-between flex-wrap container">
                            <!-- Time Buttons for 24 hours with 30-minute intervals -->
                            <!-- You can keep the buttons here as in the original code -->
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="00:00">00:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="00:30">00:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="01:00">01:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="01:30">01:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="02:00">02:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="02:30">02:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="03:00">03:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="03:30">03:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="04:00">04:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="04:30">04:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="05:00">05:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="05:30">05:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="06:00">06:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="06:30">06:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="07:00">07:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="07:30">07:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="08:00">08:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="08:30">08:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="09:00">09:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="09:30">09:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="10:00">10:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="10:30">10:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="11:00">11:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="11:30">11:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="12:00">12:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="12:30">12:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="13:00">13:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="13:30">13:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="14:00">14:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="14:30">14:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="15:00">15:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="15:30">15:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="16:00">16:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="16:30">16:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="17:00">17:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="17:30">17:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="18:00">18:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="18:30">18:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="19:00">19:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="19:30">19:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="20:00">20:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="20:30">20:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="21:00">21:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="21:30">21:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="22:00">22:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="22:30">22:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="23:00">23:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="23:30">23:30</button>
                            <!-- Add more buttons as needed -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitDateTime1" data-bs-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Second Modal Popup -->
<div class="modal fade" id="dateTimeModal2" tabindex="-1" aria-labelledby="dateTimeModalLabel2" aria-hidden="true">
    <div class="modal-dialog date-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateTimeModalLabel2">Choose Date and Time (2)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-pills" id="dateTimeTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3 active" id="date-tab2" data-bs-toggle="tab"
                               href="#dateTabContent2" role="tab" aria-controls="dateTabContent2"
                               aria-selected="true">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3" id="time-tab2" data-bs-toggle="tab"
                               href="#timeTabContent2" role="tab" aria-controls="timeTabContent2"
                               aria-selected="false">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active p-3" id="dateTabContent2" role="tabpanel"
                         aria-labelledby="date-tab2">
                        <div id="inlineDatePicker2"></div>
                    </div>
                    <div class="tab-pane fade p-3" id="timeTabContent2" role="tabpanel" aria-labelledby="time-tab2">
                        <div id="time-buttons" class="d-flex justify-content-between flex-wrap container">
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="00:00">00:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="00:30">00:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="01:00">01:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="01:30">01:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="02:00">02:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="02:30">02:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="03:00">03:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="03:30">03:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="04:00">04:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="04:30">04:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="05:00">05:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="05:30">05:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="06:00">06:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="06:30">06:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="07:00">07:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="07:30">07:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="08:00">08:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="08:30">08:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="09:00">09:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="09:30">09:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="10:00">10:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="10:30">10:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="11:00">11:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="11:30">11:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="12:00">12:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="12:30">12:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="13:00">13:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="13:30">13:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="14:00">14:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="14:30">14:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="15:00">15:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="15:30">15:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="16:00">16:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="16:30">16:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="17:00">17:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="17:30">17:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="18:00">18:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="18:30">18:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="19:00">19:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="19:30">19:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="20:00">20:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="20:30">20:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="21:00">21:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="21:30">21:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="22:00">22:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="22:30">22:30</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="23:00">23:00</button>
                            <button class="btn btn-outline-primary time-btn me-2 mb-2 p-1"
                                    data-time="23:30">23:30</button>
                            <!-- Add more buttons as needed -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitDateTime2" data-bs-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="minimum_days" id="minimum_days" value="{{ $timing_setting['total_minimum_hours'] ?? ''}}">
    <input type="hidden" name="maximum_days" id="maximum_days" value="{{ $timing_setting['total_maximum_hours'] ?? ''}} ">
</div>
<style>
    .date-modal-width {
        width: 28%;
    }

    @media only screen and (min-width: 401px) and (max-width: 800px) {
        .date-modal-width {
            width: 49%;
        }
    }

    @media only screen and (max-width: 400px) {
        .date-modal-width {
            width: 100%;
        }

        .flatpickr-weekdays {
            width: 90%;
        }

        .dayContainer {
            width: 274.875px;
            min-width: 274.875px;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedDate1 = "";
        let selectedTime1 = "";
        let selectedDate2 = "";
        let selectedTime2 = "";

        function formatDateTime(dateStr, timeStr) {
            const dateParts = dateStr.split('-');
            const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // Convert to YYYY-MM-DD
            return `${formattedDate}T${timeStr}`; // Add 'T' between date and time
        }


        // Initialize Flatpickr for both calendars
        flatpickr("#inlineDatePicker1", {
            inline: true,
            dateFormat: "d-m-Y",
            disable: [
                date => date < new Date().setHours(0, 0, 0, 0) // Disable past dates but allow today
            ],
            onChange: function (selectedDates, dateStr) {
                selectedDate1 = dateStr;
                if (dateStr) {
                    // Automatically switch to time tab after selecting date
                    let timeTab = new bootstrap.Tab(document.getElementById('time-tab1'));
                    timeTab.show();
                }
            }
        });

        flatpickr("#inlineDatePicker2", {
            inline: true,
            dateFormat: "d-m-Y",
            disable: [
                date => date < new Date().setHours(0, 0, 0, 0) // Disable past dates but allow today
            ],
            onChange: function (selectedDates, dateStr) {
                selectedDate2 = dateStr;
                if (dateStr) {
                    // Automatically switch to time tab after selecting date
                    let timeTab = new bootstrap.Tab(document.getElementById('time-tab2'));
                    timeTab.show();
                }
            }
        });

        // Handle time button click for first modal
        document.querySelectorAll('#timeTabContent1 .time-btn').forEach(button => {
            button.addEventListener('click', function () {
                selectedTime1 = this.getAttribute('data-time');
                // Set active color for the selected button
                document.querySelectorAll('#timeTabContent1 .time-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Handle submit for first modal
        document.getElementById('submitDateTime1').addEventListener('click', function () {
            if (!selectedDate1) {
                alert("Please choose a date before submitting.");
                return;
            }
            if (!selectedTime1) {
                alert("Please choose a time before submitting.");
                return;
            }

            const combinedDateTime1 = formatDateTime(selectedDate1, selectedTime1);
            document.getElementById('dateTimeInput1').value = combinedDateTime1;

            // Hide the modal using jQuery for Bootstrap 4
            $('#dateTimeModal1').modal('hide');



            calculateTimeDifference(); // Call function to calculate time difference
        });




        // Handle time button click for second modal
        document.querySelectorAll('#timeTabContent2 .time-btn').forEach(button => {
            button.addEventListener('click', function () {
                selectedTime2 = this.getAttribute('data-time');
                // Set active color for the selected button
                document.querySelectorAll('#timeTabContent2 .time-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Handle submit for second modal
        document.getElementById('submitDateTime2').addEventListener('click', function () {
            if (!selectedDate2) {
                alert("Please choose a date before submitting.");
                return;
            }
            if (!selectedTime2) {
                alert("Please choose a time before submitting.");
                return;
            }

            const combinedDateTime2 = formatDateTime(selectedDate2, selectedTime2);
            document.getElementById('dateTimeInput2').value = combinedDateTime2;

            // Hide the modal using jQuery for Bootstrap 4
            $('#dateTimeModal2').modal('hide');


            calculateTimeDifference(); // Call function to calculate time difference
        });

        // Function to calculate time difference
        function calculateTimeDifference() {
            const dateTime1 = $('#dateTimeInput1').val(); // Get the value of the first date-time input
            const dateTime2 = $('#dateTimeInput2').val(); // Get the value of the second date-time input

            if (dateTime1 && dateTime2) {
                const date1 = new Date(dateTime1);
                const date2 = new Date(dateTime2);

                // Calculate the difference in milliseconds
                const diffMs = Math.abs(date2 - date1);
                const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                const diffHrs = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const totalHours = diffDays * 24 + diffHrs; // Total hours

                // Display the difference using jQuery
                $('.date-value').text(diffDays); // Set the number of days
                $('.time-value').text(diffHrs); // Set the number of hours

                // Get minimum and maximum limits from hidden inputs
                const minHours = parseInt($('#minimum_days').val());
                const maxHours = parseInt($('#maximum_days').val());

                // Enable/disable the button based on the total hours

                if (totalHours < minHours) {
                    $('#find_car').prop('disabled', true);
                    $('.duration-error').text(`Minimum ${minHours} hours required`);
                } else if (totalHours > maxHours) {
                    $('#find_car').prop('disabled', true);
                    $('.duration-error').text(`Maximum ${maxHours} hours exceeded`);
                } else {
                    $('#find_car').prop('disabled', false);
                    $('.duration-error').text(``); // Clear any error message
                }
            }
        }


    });
</script>
