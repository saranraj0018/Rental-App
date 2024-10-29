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
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light w-100 ms-0 ms-lg-5 ps-0 ps-lg-5 text-end text-lg-start">
                                    <li class="nav-item ms-0 ms-lg-5 pe-0 pe-lg-3"><a class="nav-link text-dark" href="#">Home</a></li>
                                    @if(!Auth::user())
                                        <li class="nav-item"><a class="nav-link text-dark" href="#">FAQ</a></li>
                                    @else
                                        <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>
                                    <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2"><a class="nav-link text-dark me-0 me-lg-5" href="#">Contact-us</a></li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0">

                                        <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">
                                            <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                            <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                        </div>

                                        <div id="after_login_button" class="d-flex justify-content-center justify-content-md-end mt-1 mb-2" style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <div class="me-3"><p class="text-blue m-0 border-blue w-fit rounded-3 f-16 py-1 px-2">{{ Auth::user()->name ?? ''  }}</p></div>
                                            <a href="{{ route('user.profile') }}" class="text-dark my-auto ms-2 text-decoration-none">View profile</a>
                                        </div>
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
                        <input type="text" class="form-control my-hub" placeholder="Coimbatore, Tamilnadu" aria-label="Username" aria-describedby="basic-addon1" disabled>
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
