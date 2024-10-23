@extends('user.frontpage.list-cars.main')

@section('content')
<header>
    <section class="d-none d-sm-block booking-header">
        <div class="container-fluid p-3">
            <div class="container bg-head-grey p-1">
                <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                    <div class="container">
                        <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mobile_nav">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                            </ul>
                            <ul class="navbar-nav navbar-light">
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Home</a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Booking</a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                <li class="nav-item"><a class="text-white d-flex align-items-center justify-content-center " href="#">
                                        <img src="{{ asset('user/img/Group 4.svg') }}" alt="Site-Logo" class="img-fluid d-block"></a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">
                                        <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="Site-Logo" class="img-fluid d-block sign-up-icon px-2">Sign In / Sign Up</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <section class="d-sm-none d-block">
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
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                            </ul>
                        </div>
                        <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        <img src="{{(asset('user/img/Group 4 (1).png')) }}" alt="Site-Logo" class="img-fluid d-block">
                    </div>
                </nav>

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

<section class="my-5">
    <ul class="nav nav-pills mb-3 justify-content-center border border-1 rounded-pill w-fit mx-auto" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-pill active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Booking</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-pill" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">History</a>
        </li>
    </ul>

    <div class="mt-5">
        <div class="tab-content" id="pills-tabContent">
            <!-- TAB CONTENT-1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <section class="my-5">
                    <div class="container my-4">
                        <div class="table-responsive">
                            <table class="table booking-table table-borderless">
                                <tbody>
                                @foreach($booking as $details)
                                    @php

                                        $car = !empty($details->details->first()) ? $details->details->first() : null;
                                        $model_details = !empty($car->car_details) ? json_decode($car->car_details) : [];
                                        $payment_details = !empty($car->payment_details) ? json_decode($car->payment_details) : [];
                                    @endphp
                                <tr>
                                    <td>
                                        <div class="text-success fs-12 fs-mb-9">
                                            <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Booking Confirmed
                                        </div>
                                        <div class="fs-5 my-1 my-lg-2 fw-500 fs-mb-12">
                                           {{ $model_details->car_model->model_name ?? '' }}
                                        </div>
                                        <div class="d-flex fs-12 fs-mb-9">
                                            <div>
                                                <i class="bg-blue rounded-circle p-1 p-lg-2 text-white fa-solid fa-location-dot fs-12"></i>
                                            </div>
                                            <div class="ms-1 fw-500 my-auto">
                                                {{ '' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pt-4">
                                        <div class="fs-14 fw-500 fs-mb-12">
                                            Booking ID
                                        </div>
                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                            {{ $details->booking_id ?? '' }}
                                        </div>
                                    </td>
                                    <td class="pt-4">
                                        <div class="fs-14 fw-500 fs-mb-12">
                                            Starting Date
                                        </div>
                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                            {{ showDateTime($details->start_date) ?? '' }}
                                        </div>
                                    </td>
                                    <td class="pt-4">
                                        <div class="fs-14 fw-500 fs-mb-12">
                                            End Date
                                        </div>
                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                            {{ showDateTime($details->end_date) ?? '' }}
                                        </div>
                                    </td>
                                    <td class="pt-4">
                                        <div class="fs-14 fw-500 fs-mb-12">
                                            Total Price
                                        </div>
                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                            ₹ {{ $payment_details->total_price ?? '' }}
                                        </div>
                                    </td>
                                    <td class="pt-4 pt-lg-5">
                                        <a class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none">View Details</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
            <!-- TAB CONTENT-1 ENDS-->

            <!-- TAB CONTENT-2 -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <section class="my-5">
                    <div class="container my-4">
                        <div class="table-responsive">
                            <table class="table booking-table table-borderless">
                                <tbody>
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="text-danger fs-12 fs-mb-9">--}}
{{--                                            <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Completed--}}
{{--                                        </div>--}}
{{--                                        <div class="fs-5 my-1 my-lg-2 fw-500 fs-mb-12">--}}
{{--                                            Maruti Swift--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex fs-12 fs-mb-9">--}}
{{--                                            <div>--}}
{{--                                                <i class="bg-blue rounded-circle p-1 p-lg-2 text-white fa-solid fa-location-dot fs-12"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="ms-1 fw-500 my-auto">--}}
{{--                                                RS Puram,Coimbatore.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="pt-4">--}}
{{--                                        <div class="fs-14 fw-500 fs-mb-12">--}}
{{--                                            Booking ID--}}
{{--                                        </div>--}}
{{--                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">--}}
{{--                                            59437584--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="pt-4">--}}
{{--                                        <div class="fs-14 fw-500 fs-mb-12">--}}
{{--                                            Starting Date--}}
{{--                                        </div>--}}
{{--                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">--}}
{{--                                            12/08/2024 09:30AM--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="pt-4">--}}
{{--                                        <div class="fs-14 fw-500 fs-mb-12">--}}
{{--                                            End Date--}}
{{--                                        </div>--}}
{{--                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">--}}
{{--                                            13/08/2024 01:30PM--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="pt-4">--}}
{{--                                        <div class="fs-14 fw-500 fs-mb-12">--}}
{{--                                            Total Price--}}
{{--                                        </div>--}}
{{--                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">--}}
{{--                                            ₹11,599--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="pt-4 pt-lg-5">--}}
{{--                                        <a class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none">View Details</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <!-- TAB CONTENT-2 ENDS-->
        </div>
    </div>
</section>

@include('user.frontpage.footer')

    <!-- FOR TAB ELEMENT -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
@endsection
