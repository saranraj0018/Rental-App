@extends('user.frontpage.list-cars.main')

@section('content')
    <section class="section-1-bg pb-3">
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
            </section>
        </header>
    </section>


    <section class="my-5">
        <ul class="nav nav-pills mb-3 justify-content-center border border-1 rounded-pill w-fit mx-auto" id="pills-tab"
            role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link rounded-pill active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                    role="tab" aria-controls="pills-home" aria-selected="true">Booking</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link rounded-pill" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                    role="tab" aria-controls="pills-profile" aria-selected="false">History</a>
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
                                        @foreach ($booking as $details)
                                            @if ($details->status === 1)
                                                @php
                                                    $car = !empty($details->details->first())
                                                        ? $details->details->first()
                                                        : null;
                                                    $model_details = !empty($car->car_details)
                                                        ? json_decode($car->car_details)
                                                        : [];
                                                    $payment_details = !empty($car->payment_details)
                                                        ? json_decode($car->payment_details)
                                                        : [];
                                                    $coupon_details = !empty($car->coupon)
                                                        ? json_decode($car->coupon)
                                                        : [];
                                                     $booking_end_date = ($details->booking_type === 'pickup' && !empty($details->reschedule_date))  ?
                                                    $details->reschedule_date : $details->end_date;

                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="text-success fs-12 fs-mb-9">
                                                            <i class="fa-solid fa-circle fs-12 fs-mb-9"></i> Booking
                                                            Confirmed
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
                                                            {{ showDateformat($details->start_date) ?? '' }}
                                                        </div>
                                                    </td>
                                                    <td class="pt-4">
                                                        <div class="fs-14 fw-500 fs-mb-12">
                                                            End Date
                                                        </div>
                                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                                            {{ showDateformat($booking_end_date) }}
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
                                                        @php
                                                            $currentDateTime = \Carbon\Carbon::now(); // Get current date and time
                                                            $startDate = \Carbon\Carbon::parse(
                                                                $details->start_date ?? null,
                                                            ); // Parse the start date
                                                            $endDate = \Carbon\Carbon::parse(
                                                                $details->end_date ?? null,
                                                            ); // Parse the start date
                                                        @endphp
                                                        @if ($endDate->gt($currentDateTime))
                                                            <button
                                                                class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none edit_date"
                                                                data-end_date="{{showDateformat($booking_end_date) ?? ''}}"
                                                                data-booking_id="{{ $details->booking_id ?? '' }}"
                                                                data-model_id="{{ $model_details->car_model->id ?? '' }}">Edit</button>
                                                        @endif
                                                        <button
                                                            class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none details"
                                                            data-total_days="{{ $payment_details->total_days ?? '' }}"
                                                            data-total_hours="{{ $payment_details->total_hours ?? '' }}"
                                                            data-total_price="{{ $payment_details->total_price ?? '' }}"
                                                            data-model_name="{{ $model_details->car_model->model_name ?? '' }}"
                                                            data-register_number="{{ $model_details->register_number ?? '' }}"
                                                            data-code="{{ $coupon_details->code ?? '' }}"
                                                            data-discount="{{ $coupon_details->discount ?? '' }}"
                                                            data-week_end_amount="{{ $payment_details->week_end_amount ?? '' }}"
                                                            data-week_days_amount="{{ $payment_details->week_days_amount ?? '' }}"
                                                            data-festival_amount="{{ $payment_details->festival_amount ?? '' }}">View
                                                            Details</button>
                                                        @if ($startDate->gt($currentDateTime))
                                                            <button
                                                                class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none cancel_booking"
                                                                data-booking_id="{{ $details->booking_id ?? '' }}">
                                                                Cancel
                                                            </button>
                                                        @endif
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
                <!-- TAB CONTENT-1 ENDS-->

                <!-- TAB CONTENT-2 -->
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <section class="my-5">
                        <div class="container my-4">
                            <div class="table-responsive">
                                <table class="table booking-table table-borderless" id="booking_history">
                                    <tbody>
                                        @foreach ($booking as $details)
                                            @if ($details->status !== 1)
                                                @php
                                                    $car = !empty($details->details->first())
                                                        ? $details->details->first()
                                                        : null;
                                                    $model_details = !empty($car->car_details)
                                                        ? json_decode($car->car_details)
                                                        : [];
                                                    $payment_details = !empty($car->payment_details)
                                                        ? json_decode($car->payment_details)
                                                        : [];
                                                    $coupon_details = !empty($car->coupon)
                                                        ? json_decode($car->coupon)
                                                        : [];
                                                @endphp
                                                <tr>
                                                    <td>
                                                        @if ($details->status == 2)
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
                                                            {{ showDateformat($details->start_date) ?? '' }}
                                                        </div>
                                                    </td>
                                                    <td class="pt-4">
                                                        <div class="fs-14 fw-500 fs-mb-12">
                                                            End Date
                                                        </div>
                                                        <div class="fs-14 text-secondary fs-mb-10 mt-1 mt-lg-2">
                                                            {{ !empty($details->reschedule_date) ? showDateformat($details->reschedule_date) : showDateformat($details->end_date) ?? '' }}
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
                                                        <button
                                                            class="mt-3 btn-sm rounded-3 bg-blue text-white fs-14 fw-500 fs-mb-10 text-decoration-none details"
                                                            data-total_days="{{ $payment_details->total_days ?? '' }}"
                                                            data-total_hours="{{ $payment_details->total_hours ?? '' }}"
                                                            data-total_price="{{ $payment_details->total_price ?? '' }}"
                                                            data-model_name="{{ $model_details->car_model->model_name ?? '' }}"
                                                            data-register_number="{{ $model_details->register_number ?? '' }}"
                                                            data-code="{{ $coupon_details->code ?? '' }}"
                                                            data-discount="{{ $coupon_details->discount ?? '' }}"
                                                            data-week_end_amount="{{ $payment_details->week_end_amount ?? '' }}"
                                                            data-week_days_amount="{{ $payment_details->week_days_amount ?? '' }}"
                                                            data-festival_amount="{{ $payment_details->festival_amount ?? '' }}">View
                                                            Details</button>
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
                @include('user.frontpage.booking.model')
                <!-- TAB CONTENT-2 ENDS-->
            </div>
        </div>
    </section>

    @include('user.frontpage.footer')

    <!-- FOR TAB ELEMENT -->
@endsection
@section('customJs')
    <script src="{{ asset('user/js/booking.js') }}"></script>
@endsection
