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

        document.getElementById('copyButton').addEventListener('click', function () {
            const couponCode = document.getElementById('couponCode').textContent;
            navigator.clipboard.writeText(couponCode).then(() => {
                alert('Coupon code copied: ' + couponCode);
            }).catch(err => {
                alert('Failed to copy text: ', err);
            });
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
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    });
});
