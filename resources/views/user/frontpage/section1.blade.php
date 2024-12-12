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


<section class="section-1-bg pb-3">
    <header>
        <section>
            <div class="container-fluid p-3">
                <div class="container bg-white rounded-pill p-1 rounded-sm-3 my-head-round">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div class="d-flex justify-content-between mobile-head-width">
                                <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo" class="img-fluid d-block w-50 ">
                                <div class="my-auto h-100">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                            </div>

                                <div class="collapse navbar-collapse" id="mobile_nav">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                    <ul class="navbar-nav navbar-light w-100 ms-0 ms-lg-5 ps-0 ps-lg-5 text-end text-lg-start">
                                        <li class="nav-item ms-0 ms-lg-1 pe-0 pe-lg-1 my-auto"><a class="nav-link text-dark" href="{{ route('home') }}">Home</a></li>
                                        <li class="nav-item my-auto"><a class="nav-link text-dark" href="{{ route('about') }}">About</a></li>
                                        <li class="nav-item my-auto" id="booking_button" style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <a class="nav-link text-dark" href="{{ route('booking.history') }}" >Booking</a></li>
                                        <li class="nav-item my-auto"><a class="nav-link text-dark" href="{{ route('faq') }}">FAQ</a></li>
                                        <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a class="nav-link text-dark me-0 me-lg-5" href="{{ route('contact') }}">Contact-us</a></li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

                                            <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">
                                                <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                                <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                            </div>

                                            <div id="after_login_button" class="mt-1 mb-2 nav-link" style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                <a href="{{ route('user.profile') }}" class="text-dark text-center my-auto ms-2 text-decoration-none fs-13 fw-600">View profile</a>
                                                <div class="d-flex d-lg-block justify-content-end">
                                                    <p class="text-blue m-0 my-1 border-blue w-fit rounded-3 f-16 px-2 fs-13 fw-600" id="user_name">{{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : ''  }}</p></div>

                                            </div>
                                        </li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button" style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <a href="#" class="text-decoration-none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out text-blue me-1"></i>
                                            </a>
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

                    @if(!empty($features))
                        @foreach($features as $key => $option)
                            @if($key <= 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1" style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($key > 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1" style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @endif
                    <button class="btn fs-16 mt-3 fac-button">Find a car</button>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div id="carouselExampleFade" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/section1-image-car/' . $image1) }}" class="d-block w-100 mb-5" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image2) }}" class="d-block w-100 mb-5" alt="Slide 1">

                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image3) }}" class="d-block w-100 mb-5" alt="Slide 1">
                        </div>
                    </div>
                    <!-- Pagination Dots -->
                    <div class="carousel-indicators bdr-30 px-1">
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
        <div class="container filter-input-bg bg-white p-4 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-4 my-lg-0">
                    <label class="fs-16 fw-500">City</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-location-dot"></i>
                    </span>
                        @php
                            $city = !empty($city_list) ? $city_list->toArray() : [];
                        @endphp
                        <!-- Input field -->
                        <input type="text" class="form-control my-hub" id="cityInput" placeholder="Choose City"
                               aria-label="City" aria-describedby="basic-addon1"
                               value="{{ array_key_exists(session('city_id'), $city) ? $city[session('city_id')] : '' }}" readonly>
                        <input type="hidden" id="city_id" name="city_id" value="{{session('city_id')}}">
                    </div>
                </div>
                <div class="col-12 col-lg-3 my-1 mt-2 my-lg-0">
                    <label class="fs-16 fw-500">Starting Date</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                        <input type="text" class="form-control my-hub" id="dateTimeInput1" placeholder="Select first date and time"
                               data-bs-toggle="modal"  value="{{ session('start_date') }}" data-bs-target="#dateTimeModal1" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                    <label class="fs-16 fw-500">Ending Date</label>
                    <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                        <input type="text" class="form-control my-hub" id="dateTimeInput2" placeholder="Select second date and time"
                               data-bs-toggle="modal"  value="{{ session('end_date') }}" data-bs-target="#dateTimeModal2" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block my-auto">
                    <button type="submit" disabled id="find_car" class="btn my-button w-100 w-lg-auto p-2">
                        <i class=" text-white fa-solid fa-magnifying-glass"></i> Search
                    </button>
                </div>
            </div>
        </div>
        <div class="time-difference text-center mt-4">Duration <span class="date-value">0 </span> day <span class="time-value"> 0 </span> hrs.</div>
        <p class="duration-error text-center text-danger"></p>
    </form>
    @include('user.frontpage.date_model')
</section>
