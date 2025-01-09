@extends('user.frontpage.list-cars.main')

@section('content')

<section>
    <header>
        <section class="booking-header">
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
                                        data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse ms-5" id="mobile_nav">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                <ul
                                    class="navbar-nav navbar-light w-100 ms-0 ms-lg-4 ps-0 ps-lg-5 text-end text-lg-start">
                                    <li class="nav-item my-nav ms-0 ms-lg-3 pe-0 pe-lg-1 ps-lg-5 my-auto"><a
                                            class="nav-link text-white fw-normal" href="{{ route('home') }}">Home</a>
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
                                    <li class="nav-item ms-0 ms-lg-4 ps-0 ps-lg-0 my-auto">

                                        <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};"
                                            class="ms-0 ms-lg-5 ps-0 ps-lg-5">
                                            <button type="button"
                                                class="btn border border-1 border-white text-white rounded-pill me-1 ms-0 ms-lg-5"
                                                id="login_user">Sign-In</button>
                                            <button type="button" class="btn bg-primary text-white rounded-pill"
                                                id="register_user">Sign-Up</button>
                                        </div>

                                        <div id="after_login_button" class="mt-1 mb-2 py-0 px-4 bg-white rounded-pill"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <div class="d-flex d-lg-block justify-content-end">
                                                <p class="text-dark m-0 border-blue w-fit rounded-3 f-12 fw-500"
                                                    id="user_name">
                                                    {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                                </p>
                                            </div>
                                            <a href="{{ route('user.profile') }}"
                                                class="text-blue text-decoration-none fs-12 fw-500">View
                                                profile</a>
                                            <div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                                        style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                            style="display: none;">
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
            <div class="container mb-3 py-5">
                <h1 class="fs-2 fw-bold text-white text-center">Booking Confirmed</h1>
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
                    <h1 class="display-5 fw-bold text-white text-center">Booking Confirmed</h1>
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
    @php
        $item = \App\Models\Frontend::where('data_keys', 'policy')->first();
    @endphp
</section>

<section class="b-confirm-bg py-5">
    <div class="py-4 container">
        <div class="mx-auto card bdr-20 my-bc border border-0 py-4 px-3">
            <img src="{{ asset('user/img/Layer_1.png') }}" alt="" class="img-fluid check-icon mx-auto py-3">
            <div class="text-center fs-3">
                Congratulations
            </div>
            <div class="text-center fs-16 my-4">
                Your booking is confirmed! Please visit the Booking page
                to verify the details. Booking ID: {{ session('booking_id') }}.
            </div>
            <a href="{{ route('home') }}" class="btn bg-blue text-white w-fit mx-auto rounded-pill">Another Booking</a>
        </div>
    </div>
</section>
@include('user.frontpage.footer')
@endsection
