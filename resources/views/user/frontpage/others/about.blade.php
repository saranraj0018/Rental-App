@extends('user.frontpage.list-cars.main')

@section('content')
    @include('user.frontpage.single-car.verified-model')
    <section>
        <header>
            <section class="booking-header">
                {{-- <div class="container-fluid p-3">
                    <div class="container bg-white rounded-pill p-1 rounded-sm-3 my-head-round">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                            <div class="container d-flex justify-content-between">
                                <div class="d-flex justify-content-between mobile-head-width">
                                    <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo"
                                        class="img-fluid d-block w-50">
                                    <div class="my-auto h-100">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false"
                                            aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse navbar-collapse" id="mobile_nav">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                    <ul
                                        class="navbar-nav navbar-light w-100 ms-0 ms-lg-5 ps-0 ps-lg-5 text-end text-lg-start">
                                        <li class="nav-item ms-0 ms-lg-1 pe-0 pe-lg-1 my-auto"><a class="nav-link text-dark"
                                                href="{{ route('home') }}">Home</a></li>
                                        <li class="nav-item my-auto"><a class="nav-link text-dark"
                                                href="{{ route('about') }}">About</a></li>
                                        <li class="nav-item my-auto" id="booking_button"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a>
                                        </li>
                                        <li class="nav-item my-auto"><a class="nav-link text-dark"
                                                href="{{ route('faq') }}">FAQ</a></li>
                                        <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                                class="nav-link text-dark me-0 me-lg-5"
                                                href="{{ route('contact') }}">Contact-us</a></li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

                                            <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">
                                                <button type="button" class="btn border border-dark rounded-pill me-1"
                                                    id="login_user">Sign-In</button>
                                                <button type="button" class="btn bg-blue text-white rounded-pill"
                                                    id="register_user">Sign-Up</button>
                                            </div>

                                            <div id="after_login_button" class="mt-1 mb-2 nav-link"
                                                style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                <a href="{{ route('user.profile') }}"
                                                    class="text-dark text-center my-auto ms-2 text-decoration-none fs-13 fw-600">View
                                                    profile</a>
                                                <div class="d-flex d-lg-block justify-content-end">
                                                    <p class="text-blue m-0 my-1 border-blue w-fit rounded-3 f-16 px-2 fs-13 fw-600"
                                                        id="user_name">
                                                        {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                                    </p>
                                                </div>

                                            </div>
                                        </li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            <a href="#" class="text-decoration-none"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out text-blue me-1"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div> --}}

                <header>
                    <section>
                        <div class="container-fluid p-3">
                            <div class="container bg-head-grey rounded-pill p-1 rounded-sm-3 my-head-round">
                                <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                                    <div class="container d-flex justify-content-between">
                                        <div class="d-flex justify-content-between mobile-head-width">
                                            <a href="{{ route('home') }}">
                                                <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo"
                                                    class="img-fluid d-block">
                                            </a>
                                            <div class="my-auto h-100">
                                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                                    data-target="#mobile_nav" aria-controls="mobile_nav"
                                                    aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="collapse navbar-collapse ms-5" id="mobile_nav">
                                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                            <ul
                                                class="navbar-nav navbar-light w-100 ms-0 ms-lg-4 ps-0 ps-lg-5 text-end text-lg-start">
                                                <li class="nav-item my-nav ms-0 ms-lg-3 pe-0 pe-lg-1 ps-lg-5 my-auto"><a
                                                        class="nav-link text-white fw-normal"
                                                        href="{{ route('home') }}">Home</a>
                                                </li>
                                                <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal"
                                                        href="{{ route('about') }}">About</a></li>
                                                <li class="nav-item my-nav my-auto" id="booking_button"
                                                    style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                    <a class="nav-link text-white fw-normal"
                                                        href="{{ route('booking.history') }}">Booking</a>
                                                </li>
                                                <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal"
                                                        href="{{ route('faq') }}">FAQ</a></li>
                                                <li class="nav-item my-nav me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                                        class="nav-link text-white fw-normal me-0 me-lg-1"
                                                        href="{{ route('contact') }}">Contact-us</a></li>
                                                <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

                                                    <div id="login_button"
                                                        style="display: {{ Auth::check() ? 'none' : 'block' }};"
                                                        class="ms-0 ms-lg-5 ps-0 ps-lg-5">
                                                        <button type="button"
                                                            class="btn border border-white text-white fw-bold rounded-pill me-1 ms-0 ms-lg-5"
                                                            id="login_user">Sign-In</button>
                                                        <button type="button"
                                                            class="btn bg-blue text-white fw-bold rounded-pill"
                                                            id="register_user">Sign-Up</button>
                                                    </div>

                                                    <div id="after_login_button" class="mt-1 mb-2 nav-link"
                                                        style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                        <a href="{{ route('user.profile') }}"
                                                            class="text-white text-center my-auto ms-2 text-decoration-none fs-13">View
                                                            profile</a>
                                                        <div class="d-flex d-lg-block justify-content-end">
                                                            <p class="text-white m-0 my-1 border-blue w-fit rounded-3 f-16 ps-2 fs-13"
                                                                id="user_name">
                                                                {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                                            </p>
                                                        </div>
                                                        <div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                                                    style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                    <form id="logout-form" action="{{ route('user.logout') }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <but href="#" class="text-decoration-none"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="fa fa-sign-out text-white me-1 fs-5"></i>
                                                    </but>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </section>
                </header>
                <div class="container mb-3 py-5">
                    <h1 class="display-4 display-lg-1 fw-bold text-white text-center">ABOUT US</h1>
                    <h2 class="display-5 fw-500 text-white text-center">Valam Self-Driving Car Rental</h2>
                    <p class="fs-16 text-white text-center">
                        Welcome to Valam Cars, India's premier self-driving car rental service! At Valam, we believe in
                        empowering people to take charge of their journeys, offering a hassle-free and reliable self-driving
                        experience. Whether you need a car for a quick city trip, a long weekend getaway, or a business
                        journey, we provide an easy and flexible solution for all your travel needs.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn border border-white rounded-pill text-white">Read More</button>
                    </div>
                </div>
            </section>

            <section class="d-none">
                <div class="container-fluid header-bg p-1">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                            <div class="container">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#mobile_nav-1" aria-controls="mobile_nav-1" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="mobile_nav-1">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                    </ul>
                                    <ul class="navbar-nav navbar-light">
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Home</a></li>
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Booking</a></li>
                                        {{--                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li> --}}
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Contact-us</a></li>
                                    </ul>
                                </div>
                                <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block">
                                <img src="./assets/Group 4 (1).png" alt="Site-Logo" class="img-fluid d-block">
                            </div>
                        </nav>
                    </div>
                    <div class="container mb-3 py-5">
                        <h1 class="display-5 fw-bold text-white text-center">ABOUT US</h1>
                        <h2 class="display-5 fw-500 text-white text-center">Valam Self-Driving Car Rental</h2>
                        <p class="fs-16 text-white text-justify">
                            Welcome to Valam Cars, India's premier self-driving car rental service! At Valam, we believe in
                            empowering people to take charge of their journeys, offering a hassle-free and reliable
                            self-driving experience. Whether you need a car for a quick city trip, a long weekend getaway,
                            or a business journey, we provide an easy and flexible solution for all your travel needs.
                        </p>
                        <div class="d-flex justify-content-center">
                            <button class="btn border border-white rounded-pill text-white">Read More</button>
                        </div>
                    </div>
                </div>
            </section>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.navbar-light .dmenu').hover(function() {
                        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
                    }, function() {
                        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
                    });
                });
            </script>
        </header>
    </section>

    <section class="my-5">
        <div class="container">
            <h2 class="text-blue text-center fs-3 fw-bold">
                WHO ARE WE
            </h2>
            <p class="fs-16 text-center">
                Valam Cars was founded with the vision to make car rentals <br>accessible, affordable, and seamless for
                everyone.
            </p>

            <div class="row">
                <div class="col-12 col-lg-3">
                    <img src="{{ asset('user/img/about/Group 40519.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-lg-3">
                    <img src="{{ asset('user/img/about/Group 40518.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('user/img/about/Group 40520.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section class="my-5 py-5 blue-light-bg">
        <div class="container">
            <h2 class="text-blue text-center fs-3 fw-bold">
                WHY CHOOSE VALAM CARS?
            </h2>
            <p class="fs-16 text-center">
                Your trusted partner for affordable, convenient, and secure self-drive rentals.<br> Enjoy a seamless
                experience with our diverse fleet and 24/7 support.
            </p>
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('user/img/about/Group 40537.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-lg-3">
                    <div class="dark-blue-bg bdr-20 text-white h-100 p-3">
                        <div>
                            <div>
                                <h2 class="fs-1 fw-500">
                                    Affordable Rates
                                </h2>
                                <p class="fs-16 text-justify">
                                    Our pricing is transparent and competitive, ensuring that you get the best deal without
                                    hidden charges.
                                </p>
                            </div>
                            <hr class="bg-white mt-5">
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="bg-primary bdr-20 text-white h-100 p-3">
                        <div>
                            <div>
                                <p class="fs-16 text-justify">
                                    All our cars come equipped with GPS tracking, and our rentals include basic insurance
                                    coverage, ensuring your safety on the road.
                                </p>
                            </div>

                            <h2 class="fs-1 fw-500 mt-5">
                                Safe and Secure
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="bg-primary bdr-20 text-white h-100 p-3">
                        <div class="w-50 mt-3">
                            <img src="{{ asset('user/img/about/Vector (1).png') }}" alt=""
                                class="img-fluid w-25">
                        </div>
                        <p class="fs-16 text-justify mt-4">
                            Our dedicated support team is available round-the-clock to assist you with any queries or issues
                            during your journey.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('user/img/about/Group 40538.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">
            <img src="{{ asset('user/img/about/Group 40536.png') }}" alt="" class="img-fluid">
        </div>
    </section>
    <section class="mt-5 abt-os-blue py-5">
        <div class="container">
            <h2 class="text-center text-white display-5 display-lg-1 fw-bold">OUR SERVICES</h2>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <img src="{{ asset('user/img/about/from Right Front View 1.png') }}" alt=""
                        class="img-fluid">
                </div>
                <div class="col-12 col-lg-5 my-auto">
                    <div class="bdr-20 border border-white p-2">
                        <ul class="text-white m-0">
                            <li>Hourly, Daily, and Weekly Rentals: We offer flexible rental plans so you can choose the
                                duration that fits your needs.</li>
                            <li>Interstate Travel: Whether you’re planning a road trip or an outstation journey, Valam Cars
                                is with you, offering interstate travel options.</li>
                            <li>Easy Pickup & Drop Locations: We have pickup and drop-off points across multiple cities for
                                your convenience.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <img src="{{ asset('user/img/about/Group 40535.png') }}" alt="" class="img-fluid">
    </section>

    @include('user.frontpage.footer')
@endsection
