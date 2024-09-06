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
        // $('.daterange').daterangepicker({
        //     timePicker: true,
        //     startDate: moment().startOf('hour'),
        //     endDate: moment().startOf('hour').add(32, 'hour'),
        //     locale: {
        //         format: 'M/DD hh:mm A'
        //     }
        // });

        // flatpickr("#daterange", {
        //     mode: "range",            // Enable date range selection
        //     enableTime: true,         // Enable time selection
        //     time_24hr: true,          // Use 24-hour format (optional, for 12-hour, set to false)
        //     dateFormat: "Y-m-d H:i",  // Customize the date and time format
        //     minuteIncrement: 30,      // Set 30-minute intervals
        // });

        // flatpickr("#uncontrolled-picker", {
        //     mode: "range",
        //     enableTime: true,
        //     time_24hr: true,
        //     defaultDate: ['2022-04-17 15:30', '2022-04-21 18:30'],  // Default dates
        //     dateFormat: "Y-m-d H:i",
        //     minuteIncrement: 30,
        // });

            // Controlled input using a model-based approach
            let currentValue = ['2022-04-17 15:30', '2022-04-21 18:30']; // Example model value

            const controlledPicker = flatpickr("#controlled-picker", {
            mode: "range",
            enableTime: true,
            time_24hr: true,
            defaultDate: currentValue,  // Set the current value as default
            dateFormat: "Y-m-d H:i",
            minuteIncrement: 30,
            onChange: function(selectedDates, dateStr, instance) {
            // Update the model value when the user changes the date range
            currentValue = selectedDates.map(date => instance.formatDate(date, "Y-m-d H:i"));
            console.log("Updated date range:", currentValue);
            // Here you can send this updated value to your backend or process it further
        }
        });

            // Example: Update the controlled picker programmatically based on new model data
            function updatePicker() {
            const newDateRange = ['2022-05-01 12:00', '2022-05-05 16:30'];
            controlledPicker.setDate(newDateRange, true);  // Set new dates programmatically
            currentValue = newDateRange;
        }

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
    });
});
