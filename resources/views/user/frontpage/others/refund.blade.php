@extends('user.frontpage.list-cars.main')

@section('content')

<section>
    <header>
        <section class="booking-header">
            <div class="container-fluid p-3">
                <div class="container bg-white rounded-pill p-1 rounded-sm-3 my-head-round">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div class="d-flex justify-content-between mobile-head-width">
                                <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo" class="img-fluid d-block w-50">
                                <div class="my-auto h-100">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse" id="mobile_nav">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light w-100 ms-0 ms-lg-5 ps-0 ps-lg-5 text-end text-lg-start">
                                    <li class="nav-item ms-0 ms-lg-5 pe-0 pe-lg-3"><a class="nav-link text-dark" href="{{ route('home') }}">Home</a></li>
                                    @if(!Auth::user())
                                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('faq') }}">FAQ</a></li>
                                    @else
                                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
{{--                                    <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>--}}
                                    <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2"><a class="nav-link text-dark me-0 me-lg-5" href="{{ route('contact') }}">Contact-us</a></li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0">
                                        @if(!Auth::user())
                                        <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                        <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                        @else
                                        <div class="d-flex justify-content-center justify-content-md-end mt-1 mb-2">
                                            <div class="me-3">
                                                <p class="text-blue m-0 border-blue w-fit rounded-3 f-16 py-1 px-2">{{ \Illuminate\Support\Facades\Auth::user()->name ?? ''  }}</p>
                                            </div>
                                            <a href="{{ route('user.profile') }}" class="text-dark my-auto ms-2 text-decoration-none">View profile</a>
                                        </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="container mb-3 py-5">
                <h1 class="display-1 fw-bold text-white text-center">REFUND</h1>
            </div>
        </section>

        <section class="d-none">
            <div class="container-fluid header-bg p-1">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav-1" aria-controls="mobile_nav-1" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="mobile_nav-1">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light">
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Home</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Booking</a></li>
{{--                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>--}}
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                </ul>
                            </div>
                            <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block">
                            <img src="./assets/Group 4 (1).png" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>
                </div>
                <div class="container mb-3 py-5">
                    <h1 class="display-5 fw-bold text-white text-center">REFUND</h1>
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
        <div>

            <p class="fs-18 my-2 text-justify">
                A refundable security deposit of up to Rs 5,000 will be charged. During limited-period offers, this amount might be lower. It will be refunded within 10 days of the booking's end time. Please select the "Refund to Bank Account" or "Refund to Wallet" options while paying for fast refunds within 4 days of the booking's end time.
            </p>

        </div>

    </div>
</section>
@include('user.frontpage.footer')

@endsection