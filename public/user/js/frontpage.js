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
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(sendPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
            function sendPosition(position) {
                $.ajax({
                    url: '/update-location',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        start_date:$('#start_date_time').val(),
                        end_date:$('#end_date_time').val(),
                    }),
                    success: function(data) {
                        if (data.isWithinCoimbatore) {
                            // If the location is within Coimbatore, submit the form
                            window.location.href = '/search-car/list';
                        } else {
                            $('#errorModal').modal('show');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
        calculateDuration();
        $('.navbar-light .dmenu').hover(function() {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function() {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });

        // Get user's geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Send geolocation data to server
                $.ajax({
                    url: '/api/save-geolocation',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    }),
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
        // document.querySelectorAll('.next-button').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const currentSet = this.closest('.input-set');
        //         const nextSetNumber = this.getAttribute('data-next');
        //         const nextSet = document.querySelector(`.input-set[data-set="${nextSetNumber}"]`);
        //
        //         // Fade out the current set
        //         currentSet.classList.remove('show');
        //         currentSet.addEventListener('transitionend', function() {
        //             currentSet.style.display = 'none'; // Hide it after fading out
        //             // Fade in the next set
        //             nextSet.style.display = 'block'; // Ensure it's display is block for transition
        //             nextSet.classList.add('show');
        //         }, {
        //             once: true
        //         });
        //     });
        // });

        // document.querySelectorAll('.back-button').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const currentSet = this.closest('.input-set');
        //         const prevSetNumber = this.getAttribute('data-prev');
        //         const prevSet = document.querySelector(`.input-set[data-set="${prevSetNumber}"]`);
        //
        //         // Fade out the current set
        //         currentSet.classList.remove('show');
        //         currentSet.addEventListener('transitionend', function() {
        //             currentSet.style.display = 'none'; // Hide it after fading out
        //             // Fade in the previous set
        //             prevSet.style.display = 'block'; // Ensure it's display is block for transition
        //             prevSet.classList.add('show');
        //         }, {
        //             once: true
        //         });
        //     });
        // });
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


        $('#start_date_time').on('change', calculateDuration);
        $('#end_date_time').on('change', calculateDuration);

        function calculateDuration() {
            let startDate = $('#start_date_time').val();
            let endDate = $('#end_date_time').val();

            if (startDate && endDate) {
                // Parse the dates using the correct format
                let start = moment(startDate, 'DD-MM-YYYY HH:mm'); // Adjust to the input date format
                let end = moment(endDate, 'DD-MM-YYYY HH:mm');

                // Validate dates
                if (!start.isValid() || !end.isValid()) {
                    $('.duration-display').text('Invalid date format');
                    return;
                }

                // Calculate the exact difference between dates
                let diff = moment.duration(end.diff(start));

                // Extract days and hours
                let days = Math.floor(diff.asDays()); // Use asDays() directly for correct day calculation
                let hours = diff.hours();

                // Handle pluralization correctly
                let durationText = `${days} day${days !== 1 ? 's' : ''}, ${hours} hr${hours !== 1 ? 's' : ''}.`;

                // Display the calculated duration
                $('.duration-display').text(`Duration ${durationText}`);
                if (diff.asHours() < 24) {
                    $('#find_car').prop('disabled', true);
                    $('.duration-error').text(`Minimum 1 day required`);
                } else {
                    $('#find_car').prop('disabled', false);
                    $('.duration-error').text(``);
                }
            }
        }
        flatpickr("#start_date_time", {
            minDate: "today",
            enableTime: true,
            dateFormat: "d-m-Y | H:i",
            time_24hr: true,
            minuteIncrement: 30, // 30-minute intervals
            allowInput: true,
        });
        flatpickr("#end_date_time", {
            minDate: "today",
            enableTime: true,
            dateFormat: "d-m-Y | H:i",
            time_24hr: true,
            minuteIncrement: 30, // 30-minute intervals
            allowInput: true,
        });
    });
});

$(document).ready(function(){
    $('.save-icon').click(function(){
        $(this).toggleClass('save-icon save-icon-active');
    });
});

