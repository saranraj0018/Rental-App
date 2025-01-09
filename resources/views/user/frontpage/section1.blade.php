@php
    $data = !empty($section1) && optional($section1)->data_values ? json_decode($section1->data_values, true) : [];
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $features = !empty($data['features']) ? json_decode($data['features'], true) : [];

    $images = $section1->frontendImage ?? [];
    $image1 = $images[0]->name ?? '';
    $image2 = $images[1]->name ?? '';
    $image3 = $images[2]->name ?? '';
@endphp


<section class="section-1-bg pb-3" x-data>
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
                                    <li class="nav-item my-nav my-auto"><a
                                            class="nav-link text-white fw-normal me-0 me-lg-1"
                                            href="{{ route('contact') }}">Contact-us</a></li>
                                    <li class="nav-item my-nav me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                            class="nav-link text-white fw-normal me-0 me-lg-1"
                                            href="{{ route('contact') }}">Blog</a></li>
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


    <div class="container py-5 d-none d-lg-block">

        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="fs-1 text-white fw-500">{!! $title !!}</h1>
                <p class="text-white my-4">{!! $description !!}</p>
                <div class="row">

                    @if (!empty($features))
                        @foreach ($features as $key => $option)
                            @if ($key <= 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1"
                                                style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($key > 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1"
                                                style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @endif
                    <button class="btn fs-16 mt-3 fac-button"
                        @click.prevent="() => {
                        $('#cityModal').modal('show')
                    }">Find
                        a
                        car</button>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div id="carouselExampleFade" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/section1-image-car/' . $image1) }}" class="d-block w-100 mb-5"
                                alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image2) }}" class="d-block w-100 mb-5"
                                alt="Slide 1">

                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image3) }}"
                                class="d-block w-100 mb-5" alt="Slide 1">
                        </div>
                    </div>
                    <!-- Pagination Dots -->
                    <div class="carousel-indicators bdr-30 px-1">
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-block d-lg-none text-center pt-3 pb-5 section-1-bg-sm">
        <p class="fw-bold text-white fs-2 m-0">
            Welcome!
        </p>
        <p class="fw-500 f-16 text-white">
            Self Drive Car Rentals In Coimbatore
        </p>
    </div>

</section>

<section>
    <form id="get_location">
        <div class="container filter-input-bg bg-white p-3 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-3 my-lg-0">
                    <label class="fs-16 fw-500 text-center w-100">City</label>
                    <div class="input-group my-grps">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-location-dot"></i>
                        </span>
                        @php
                            $city = !empty($city_list) ? $city_list->toArray() : [];
                        @endphp
                        <!-- Input field -->
                        <input type="text" class="form-control fs-14 my-hub" id="cityInput"
                            placeholder="Choose City" aria-label="City" aria-describedby="basic-addon1"
                            value="{{ array_key_exists(session('city_id'), $city) ? $city[session('city_id')] : '' }}"
                            readonly style="font-size:13px;">
                        <input type="hidden" id="city_id" name="city_id" value="{{ session('city_id') }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4 my-1 mt-2 my-lg-0">
                    <label class="fs-16 fw-500 text-center w-100">Starting Date</label>
                    <div class="input-group my-grps">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-calendar-days"></i>
                        </span>
                        <input type="text" class="form-control fs-14 my-hub" id="dateTimeInput1"
                            placeholder="Select Start Date" data-bs-toggle="modal"
                            value="{{ session('start_date') }}" data-bs-target="#dateTimeModal1" readonly
                            style="font-size:13px;">
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                    <label class="fs-16 fw-500 text-center w-100">Ending Date</label>
                    <div class="input-group my-grps">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-calendar-days"></i>
                        </span>
                        <input type="text" class="form-control fs-14 my-hub" id="dateTimeInput2"
                            placeholder="Select End Date" data-bs-toggle="modal" value="{{ session('end_date') }}"
                            data-bs-target="#dateTimeModal2" readonly style="font-size:13px;">
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block my-auto">
                    <button type="submit" disabled id="find_car" class="btn my-button w-100 w-lg-auto p-2">
                        <i class=" text-white fa-solid fa-magnifying-glass"></i> Search
                    </button>
                </div>
            </div>
        </div>
        <div class="time-difference text-center mt-4">Duration <span class="date-value">0 </span> day <span
                class="time-value"> 0 </span> hrs.</div>
        <p class="duration-error text-center text-danger"></p>
    </form>
    @include('user.frontpage.date_model')
</section>
