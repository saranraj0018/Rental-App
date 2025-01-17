@extends('user.frontpage.list-cars.main')

@section('content')

<section>
    <header>
        <section class="booking-header">
              @include('user.frontpage.menus')
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
