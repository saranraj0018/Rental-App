$(function () {
    'use strict'
    $(document).ready(function() {

        $('.navbar-light .dmenu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });

        // First Owl Carousel
        let owl1 = $(".owl-carousel.owl-carousel-1");
        owl1.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>', '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                // Breakpoint from 768 up
                769: {
                    items: 4
                }
            }
        });

        let owl2 = $(".owl-carousel.owl-carousel-5");
        owl2.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>', '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                // Breakpoint from 768 up
                769: {
                    items: 3
                }
            }
        });

        // First Owl Carousel
        let owl3 = $(".owl-carousel.owl-carousel-3");
        owl3.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>', '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 3
                },
                768: {
                    items: 8
                },
                // Breakpoint from 768 up
                769: {
                    items: 9
                }
            }
        });

        // First Owl Carousel
        let owl4 = $(".owl-carousel.owl-carousel-4");
        owl4.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>', '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                // Breakpoint from 768 up
                769: {
                    items: 5
                }
            }
        });
        // Initialize Owl Carousel
        $('#owl1').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });

        // First Owl Carousel
        let owl5 = $(".owl-carousel.owl-carousel-6");
        owl5.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 2
                },
                768: {
                    items: 2
                },
                // Breakpoint from 768 up
                769: {
                    items: 2
                }
            }
        });
        let owl7 = $(".owl-carousel.owl-carousel-7");
        owl7.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: ['<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>', '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>'],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                // Breakpoint from 768 up
                769: {
                    items: 3
                }
            }
        });
        $('#coupon_section').on('click', '.coupon_info', function () {
            let modal = $('#coupon_model');
            modal.find('#title').html('<i class="fa-solid fa-car"></i> ' + $(this).data('title'));
            modal.find('#description').html($(this).data('description'));
            modal.find('#amount').html($(this).data('amount') + $(this).data('type'));
            modal.find('#prefix').html($(this).data('prefix'));
            modal.find('#coupon_code').html($(this).data('code'));
            modal.modal('show');
        });

        $('#copyButton').on('click', function () {
            const couponCode = $('#coupon_code').text();

            navigator.clipboard.writeText(couponCode).then(() => {
                // Change the button text to indicate the code was copied
                $(this).text('Copied!');

                // Optionally, reset the button text after a short delay
                setTimeout(() => {
                    $(this).text('Copy Code');
                }, 2000); // Reset after 2 seconds
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });

        $('#get_location').on('submit', function(e) {
            e.preventDefault();
            sendPosition();
            function sendPosition() {
                $.ajax({
                    url: '/update-location',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        start_date:$('#dateTimeInput1').val(),
                        end_date:$('#dateTimeInput2').val(),
                    }),
                    success: function(data) {
                        if (data) {
                            window.location.href = '/search-car/list';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
        $('.navbar-light .dmenu').hover(function() {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function() {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });

        $('#delivery_amount').on('change', function() {
            const isChecked = $(this).is(':checked');
            const deliveryFee = isChecked ? parseFloat($('#door_delivery').val()) : 0;
            const finalAmount = parseFloat($('#final_amount').val());
            const toggleDivs = $('.toggle');
            const toggleFadeDiv = $('.toggle-fade');
            const toggleMarginDivs = $('.m-minus-top');

            // Toggle visibility and classes for the '.toggle' elements
            toggleDivs.toggle(isChecked).toggleClass('show', isChecked);
            toggleFadeDiv.toggle(!isChecked); // Show or hide the fade div based on the checkbox

            // Adjust classes for the '.m-minus-top' elements
            toggleMarginDivs.toggleClass('m-minus-top-48', isChecked)
                .toggleClass('my-auto', !isChecked);

            // Calculate and update the total price
            const finalTotal = isChecked ? finalAmount + deliveryFee : finalAmount - deliveryFee;
            $('#total_price').text(finalTotal);

            // Send an AJAX request to update the session
            $.ajax({
                url: '/user/update-delivery-fee',
                type: 'POST',
                data: { delivery_fee: deliveryFee },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr) {
                    console.error('Error updating delivery fee:', xhr);
                }
            });
        });
    });
});

$(document).ready(function(){
    $('.save-icon').click(function(){
        $(this).toggleClass('save-icon save-icon-active');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let selectedDate1 = "";
    let selectedTime1 = "";
    let selectedDate2 = "";
    let selectedTime2 = "";
    calculateTimeDifference();
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
            // Reformat date strings from "DD-MM-YYYY HH:mm" to "YYYY-MM-DDTHH:mm:ss"
            const formattedDate1 = dateTime1.replace(/(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2})/, '$3-$2-$1T$4:$5:00');
            const formattedDate2 = dateTime2.replace(/(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2})/, '$3-$2-$1T$4:$5:00');

            const date1 = new Date(formattedDate1);
            const date2 = new Date(formattedDate2);

            if (isNaN(date1) || isNaN(date2)) {
                console.error('Invalid date format');
                return;
            }

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
                $('.duration-error').text(''); // Clear any error message
            }
        }
    }


    $('.book_now').on('click', function () {
        let start_date = $('#dateTimeInput1').val();
        let end_date = $('#dateTimeInput2').val();

        if (start_date === '' && end_date === '') {
            $('#alert_booking').modal('show');
        } else {
            let booking_id = $('#car_book_id').val();

            window.location.href = '/book/'+booking_id;
        }
    });


});

