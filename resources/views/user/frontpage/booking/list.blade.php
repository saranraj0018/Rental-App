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
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="{{ route('home') }}">Home</a></li>
                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Booking</a></li>
{{--                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>--}}
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
{{--                                <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>--}}
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
                            <table class="table booking-table table-borderless" id="user_booking">
                                <tbody>
                                @foreach($booking as $details)
                                    @if($details->status === 1)
                                        @php
                                        $car = !empty($details->details->first()) ? $details->details->first() : null;
                                        $model_details = !empty($car->car_details) ? json_decode($car->car_details) : [];
                                        $payment_details = !empty($car->payment_details) ? json_decode($car->payment_details) : [];
                                        $coupon_details = !empty($car->coupon) ? json_decode($car->coupon) : [];

                                    @endphp
                                <tr>
                                    <td>
                                        <div class="text-success fs-12 fs-mb-9">
                                            <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Booking Confirmed
                                        </div>
                                        <div class="fs-5 my-1 my-lg-2 fw-500 fs-mb-12">
                                           {{ $model_details->car_model->model_name ?? '' }}
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
                                            {{ !empty($details->reschedule_date) ? showDateTime($details->reschedule_date) : showDateTime($details->end_date) ?? '' }}
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
                                        <button class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none edit_date"
                                                data-end_date="{{showDateformat($details->end_date) ?? ''}}" data-booking_id="{{$details->booking_id ?? ''}}"
                                                data-model_id="{{ $model_details->car_model->id ?? '' }}">Edit</button>
                                        <button class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none details"
                                                data-total_days="{{ $payment_details->total_days ?? '' }}" data-total_hours="{{ $payment_details->total_hours ?? '' }}"
                                                data-total_price="{{ $payment_details->total_price ?? '' }}"
                                                data-model_name="{{  $model_details->car_model->model_name ?? ''}}"
                                                data-register_number="{{ $model_details->register_number ?? '' }}"
                                                data-code="{{ $coupon_details->code ?? '' }}"
                                                data-discount="{{ $coupon_details->discount ?? '' }}"
                                                data-week_end_amount="{{ $payment_details->week_end_amount ?? '' }}"
                                                data-week_days_amount="{{ $payment_details->week_days_amount ?? '' }}"
                                                data-festival_amount="{{ $payment_details->festival_amount ?? '' }}">View Details</button>
                                        <button class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none cancel_booking"  data-booking_id="{{$details->booking_id ?? ''}}">Cancel</button>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('user.frontpage.booking.model')
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
                                @foreach($booking as $details)
                                    @if($details->status !== 1)
                                    @php
                                        $car = !empty($details->details->first()) ? $details->details->first() : null;
                                        $model_details = !empty($car->car_details) ? json_decode($car->car_details) : [];
                                        $payment_details = !empty($car->payment_details) ? json_decode($car->payment_details) : [];
                                        $coupon_details = !empty($car->coupon) ? json_decode($car->coupon) : [];
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($details->status == 2)
                                            <div class="text-success fs-12 fs-mb-9">
                                            <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Completed
                                            </div>
                                                @else
                                                    <div class="text-danger fs-12 fs-mb-9">
                                                        <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Cancel
                                                    </div>
                                                @endif

                                            <div class="fs-5 my-1 my-lg-2 fw-500 fs-mb-12">
                                                {{ $model_details->car_model->model_name ?? '' }}
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
                                                {{ !empty($details->reschedule_date) ? showDateTime($details->reschedule_date) : showDateTime($details->end_date) ?? '' }}
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
                                            <button class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none details"
                                                    data-total_days="{{ $payment_details->total_days ?? '' }}" data-total_hours="{{ $payment_details->total_hours ?? '' }}"
                                                    data-total_price="{{ $payment_details->total_price ?? '' }}"
                                                    data-model_name="{{  $model_details->car_model->model_name ?? ''}}"
                                                    data-register_number="{{ $model_details->register_number ?? '' }}"
                                                    data-code="{{ $coupon_details->code ?? '' }}"
                                                    data-discount="{{ $coupon_details->discount ?? '' }}"
                                                    data-week_end_amount="{{ $payment_details->week_end_amount ?? '' }}"
                                                    data-week_days_amount="{{ $payment_details->week_days_amount ?? '' }}"
                                                    data-festival_amount="{{ $payment_details->festival_amount ?? '' }}">View Details</button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
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
@endsection
@section('customJs')
    <script src="{{asset('user/js/booking.js')}}"></script>
@endsection

