$(function () {
    "use strict";
    $(document).ready(function () {
        $(".navbar-light .dmenu").hover(
            function () {
                $(this)
                    .find(".sm-menu")
                    .first()
                    .stop(true, true)
                    .slideDown(150);
            },
            function () {
                $(this).find(".sm-menu").first().stop(true, true).slideUp(105);
            }
        );

        // First Owl Carousel
        let owl1 = $(".owl-carousel.owl-carousel-1");
        owl1.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                // Breakpoint from 768 up
                769: {
                    items: 4,
                },
            },
        });

        let owl2 = $(".owl-carousel.owl-carousel-5");
        owl2.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                // Breakpoint from 768 up
                769: {
                    items: 3,
                },
            },
        });

        // First Owl Carousel
        let owl3 = $(".owl-carousel.owl-carousel-3");
        owl3.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 3,
                },
                768: {
                    items: 8,
                },
                // Breakpoint from 768 up
                769: {
                    items: 9,
                },
            },
        });

        // First Owl Carousel
        let owl4 = $(".owl-carousel.owl-carousel-4");
        owl4.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1,
                },
                768: {
                    items: 3,
                },
                // Breakpoint from 768 up
                769: {
                    items: 5,
                },
            },
        });
        // Initialize Owl Carousel
        $("#owl1").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 5,
                },
            },
        });

        // First Owl Carousel
        let owl5 = $(".owl-carousel.owl-carousel-6");
        owl5.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                // Breakpoint from 768 up
                769: {
                    items: 2,
                },
            },
        });
        let owl7 = $(".owl-carousel.owl-carousel-7");
        owl7.owlCarousel({
            items: 4,
            margin: 10,
            loop: true,
            nav: true,
            navText: [
                '<button class="owl-prev"><i class="fas fa-chevron-left"></i></button>',
                '<button class="owl-next"><i class="fas fa-chevron-right"></i></button>',
            ],
            responsive: {
                // Breakpoint from 0 up
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                // Breakpoint from 768 up
                769: {
                    items: 3,
                },
            },
        });
        $("#coupon_section").on("click", ".coupon_info", function () {
            let modal = $("#coupon_model");
            modal
                .find("#title")
                .html(
                    '<i class="fa-solid fa-car"></i> ' + $(this).data("title")
                );
            modal.find("#description").html($(this).data("description"));
            modal
                .find("#amount")
                .html($(this).data("amount") + $(this).data("type"));
            modal.find("#prefix").html($(this).data("prefix"));
            modal.find("#coupon_code").html($(this).data("code"));
            modal.modal("show");
        });

        $("#copyButton").on("click", function () {
            const couponCode = $("#coupon_code").text();

            navigator.clipboard
                .writeText(couponCode)
                .then(() => {
                    // Change the button text to indicate the code was copied
                    $(this).text("Copied!");

                    // Optionally, reset the button text after a short delay
                    setTimeout(() => {
                        $(this).text("Copy Code");
                    }, 2000); // Reset after 2 seconds
                })
                .catch((err) => {
                    console.error("Failed to copy text: ", err);
                });
        });

        $("#get_location").on("submit", function (e) {
            e.preventDefault();
            sendPosition();
            let city = $("#city_id").val();

            if (city === "") {
                $("#cityModal").modal("show");
            }

            function sendPosition() {
                $.ajax({
                    url: "/update-location",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        start_date: $("#dateTimeInput1").val(),
                        end_date: $("#dateTimeInput2").val(),
                        city_id: $("#city_id").val(),
                    }),
                    success: function (data) {
                        if (data) {
                            window.location.href = "/search-car/list";
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    },
                });
            }
        });
        $(".navbar-light .dmenu").hover(
            function () {
                $(this)
                    .find(".sm-menu")
                    .first()
                    .stop(true, true)
                    .slideDown(150);
            },
            function () {
                $(this).find(".sm-menu").first().stop(true, true).slideUp(105);
            }
        );

        $("#delivery_amount").on("change", function () {
            const isChecked = $(this).is(":checked");
            const deliveryFee = parseFloat($("#door_delivery").val());
            const finalAmount = (parseFloat($("#final_amount").val()) + parseFloat($("#additional_amount").val())) - (parseFloat($('#final_coupon_amount').val()) ?? 0);
            const toggleDivs = $(".toggle");
            const toggleFadeDiv = $(".toggle-fade");
            const toggleMarginDivs = $(".m-minus-top");

            // Toggle visibility and classes for the '.toggle' elements
            toggleDivs.toggle(isChecked).toggleClass("show", isChecked);
            toggleFadeDiv.toggle(!isChecked); // Show or hide the fade div based on the checkbox

            // Adjust classes for the '.m-minus-top' elements
            toggleMarginDivs
                .toggleClass("m-minus-top-48", isChecked)
                .toggleClass("my-auto", !isChecked);

            // Calculate and update the total price
            const finalTotal = isChecked
                ? finalAmount + deliveryFee
                : finalAmount ;
            $("#total_price").text(finalTotal);


            // Send an AJAX request to update the session
            $.ajax({
                url: "/user/update-delivery-fee",
                type: "POST",
                data: {  delivery_fee: isChecked ? deliveryFee : 0 },
                success: function (response) {
                    let fee = response.fee ?? 0; // If response.fee is null, set it to 0
                    $('#is_delivery').val(fee);
                },
                error: function (xhr) {
                    console.error("Error updating delivery fee:", xhr);
                },
            });
        });
    });
});

$(document).ready(function () {
    $(".save-icon").click(function () {
        $(this).toggleClass("save-icon save-icon-active");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let selectedDate1 = "",
        selectedTime1 = "",
        selectedDate2 = "",
        selectedTime2 = "";
    const duration = $("#front_duration").val();
    calculateTimeDifference();
    function calculateTimeDifference() {
        const dateTime1 = $("#dateTimeInput1").val();
        const dateTime2 = $("#dateTimeInput2").val();

        if (!dateTime1 || !dateTime2) return;

        const date1 = new Date(
            dateTime1.replace(
                /(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2})/,
                "$3-$2-$1T$4:$5:00"
            )
        );
        const date2 = new Date(
            dateTime2.replace(
                /(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2})/,
                "$3-$2-$1T$4:$5:00"
            )
        );
        if (isNaN(date1) || isNaN(date2) || date1 >= date2) {
            setDurationError(
                "The start date and time must be earlier than the end date and time."
            );
            $("#find_car").prop("disabled", true);
            return;
        }

        const diffMs = date2 - date1;
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        const diffHrs = Math.floor(
            (diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const totalHours = diffDays * 24 + diffHrs;

        $(".date-value").text(diffDays);
        $(".time-value").text(diffHrs);

        const minHours = parseInt($("#minimum_days").val());
        const maxHours = parseInt($("#maximum_days").val());
        if (totalHours < minHours) {
            setDurationError(`Minimum ${minHours} hours required`);
            $("#find_car").prop("disabled", true);
        } else if (totalHours > maxHours) {
            setDurationError(`Maximum ${maxHours} hours exceeded`);
            $("#find_car").prop("disabled", true);
        } else {
            setDurationError("");
            $("#find_car").prop("disabled", false);
        }
    }

    function setDurationError(message) {
        $(".duration-error").text(message);
    }
    // Function to format date and time for datetime-local input
    function formatDateTime(dateStr, timeStr) {
        const dateParts = dateStr.split("-");
        return `${dateParts[0]}-${dateParts[1]}-${dateParts[2]} ${timeStr}`;
    }

    function disablePastTimes(timeContainer, selectedDate) {
        const today = new Date();
        const bufferTime = new Date(today.getTime() + 3 * 60 * 60 * 1000); // Add 3 hours

        const currentHour = bufferTime.getHours();
        const currentMinute = bufferTime.getMinutes();

        if (selectedDate === flatpickr.formatDate(today, "d-m-Y")) {
            // Loop through each time button
            timeContainer.querySelectorAll(".time-btn").forEach((button) => {
                const [hour, minute] = button
                    .getAttribute("data-time")
                    .split(":")
                    .map(Number);
                // Disable or hide if time is less than 3 hours ahead
                if (
                    hour < currentHour ||
                    (hour === currentHour && minute < currentMinute)
                ) {
                    button.classList.add("disabled"); // Add 'disabled' class or hide
                    button.style.display = "none"; // Hide past time options
                } else {
                    button.classList.remove("disabled");
                    button.style.display = ""; // Show future time options
                }
            });
        } else {
            // If not today, ensure all time buttons are enabled
            timeContainer.querySelectorAll(".time-btn").forEach((button) => {
                button.classList.remove("disabled");
                button.style.display = "";
            });
        }
    }

    // Initialize Flatpickr for both date pickers
    flatpickr("#inlineDatePicker1", {
        inline: true,
        dateFormat: "d-m-Y",
        disable: [
            (date) => {
                const now = new Date();
                const ninePM = new Date().setHours(21, 0, 0, 0);

                if (now > ninePM) {
                    now.setDate(now.getDate() + 1);
                }

                return date < now.setHours(0, 0, 0, 0);
            },
        ],
        maxDate: duration,
        onChange: function (selectedDates, dateStr) {
            selectedDate1 = dateStr;
            disablePastTimes(
                document.getElementById("timeTabContent1"),
                selectedDate1
            ); // Disable past times
            if (dateStr) {
                let timeTab = new bootstrap.Tab(
                    document.getElementById("time-tab1")
                );
                timeTab.show();
            }
        },
    });

    flatpickr("#inlineDatePicker2", {
        inline: true,
        dateFormat: "d-m-Y",
        disable: [
            (date) => {
                const now = new Date();
                const ninePM = new Date().setHours(21, 0, 0, 0);

                if (now > ninePM) {
                    now.setDate(now.getDate() + 1);
                }

                return date < now.setHours(0, 0, 0, 0);
            },
        ],
        maxDate: duration,
        onChange: function (selectedDates, dateStr) {
            selectedDate2 = dateStr;
            disablePastTimes(
                document.getElementById("timeTabContent2"),
                selectedDate2
            ); // Disable past times
            if (dateStr) {
                let timeTab = new bootstrap.Tab(
                    document.getElementById("time-tab2")
                );
                timeTab.show();
            }
        },
    });

    // Event listener for time buttons in the first modal
    document.querySelectorAll(".submitDateTime1").forEach((button) => {
        button.addEventListener("click", function () {
            selectedTime1 = this.getAttribute("data-time");
            if (!selectedDate1) {
                alert("Please choose a date before submitting.");
                return;
            }
            const combinedDateTime1 = formatDateTime(
                selectedDate1,
                selectedTime1
            );
            document.getElementById("dateTimeInput1").value = combinedDateTime1;
            $("#dateTimeModal1").modal("hide");
            calculateTimeDifference();
        });
    });

    // Event listener for time buttons in the second modal
    document.querySelectorAll(".submitDateTime2").forEach((button) => {
        button.addEventListener("click", function () {
            selectedTime2 = this.getAttribute("data-time");
            if (!selectedDate2) {
                alert("Please choose a date before submitting.");
                return;
            }
            const combinedDateTime2 = formatDateTime(
                selectedDate2,
                selectedTime2
            );
            document.getElementById("dateTimeInput2").value = combinedDateTime2;
            $("#dateTimeModal2").modal("hide");

            calculateTimeDifference();
        });
    });

    $(document).on("click", ".book_now", function () {
        const start_date = $("#dateTimeInput1").val();
        const end_date = $("#dateTimeInput2").val();
        if (start_date === "" || end_date === "") {
            $("#alert_booking").modal("show");
        } else {
            const booking_id = $("#car_book_id").val();
            window.location.href = `/book/${booking_id}`;
        }
    });

    $(document).on("click", ".view_all", function () {
        const start_date = $("#dateTimeInput1").val();
        const end_date = $("#dateTimeInput2").val();
        if (start_date === "" || end_date === "") {
            $("#alert_booking").modal("show");
        } else {
            window.location.href = "/search-car/list";
        }
    });

    $("#cityInput").on("click", function () {
        $("#cityModal").modal("show");
    });

    $(".book_car_input").on("click", function () {
        const start_date = $("#dateTimeInput1").val();
        const end_date = $("#dateTimeInput2").val();

        if ($("#city_id").val() === "") {
            $("#cityModal").modal("show");
        } else if (start_date === "" || end_date === "") {
            $("#alert_booking").modal("show");
        } else {
            const booking_id = $("#car_book_id").val();
            window.location.href = `/book/${booking_id}`;
        }
    });

    $(".city-option").on("click", function () {
        let selectedCity = $(this).text();
        let city_id = $(this).data("id");
        $("#cityInput").val(selectedCity);
        $("#city_id").val(city_id);
        $("#cityModal").modal("hide");
    });
});
