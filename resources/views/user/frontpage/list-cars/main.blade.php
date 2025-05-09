<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="ValamCars is your trusted platform for hassle-free car rentals" />

    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">

    <title>Valam Cars | Flexible Rental Cars</title>
    <!--BOOTSTRAP 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--FONTAWSOME CDN-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!--FONTAWSOME CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <!--BOOTSTRAP 5 CDN-->
    <!-- Owl Carousel CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--OWL CAROUSEL LINK -->
    <link rel="stylesheet" href="{{ asset('user/css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/search-result.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/car-booking.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="content-wrapper">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset("user/js/frontpage.js")}}"></script>
    <script src="{{asset("user/js/custom-map.js")}}"></script>
    <script src="{{asset("user/js/booking.js")}}"></script>
    <script src="{{asset("user/js/user-verification.js")}}"></script>
    <script src="{{asset("user/js/profile.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Set CSRF token for axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


        function googleRedirectAction(googleRegisterData) {
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('google_redirect') && googleRegisterData != null) {
                $('#registerModal').modal('show');

                $('#registerModal').on('shown.bs.modal', function () {
                    document.querySelector('#google_button').style.display = "none";

                    // Set name and email
                    $('#user_name_').val(googleRegisterData.name);
                    $('.user_email').val(googleRegisterData.email);
                });

            } else {
                document.querySelector('#google-button').style.display = 'unset';
                $('#user_name_').val('');
                $('#user_email').val('');
            }
        }

    </script>
</body>

</html>