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
        <section class="d-none d-lg-block">
            <div class="container-fluid p-3">
                <div class="container bg-head-grey p-1">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div>
                                <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse" id="mobile_nav">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light">
                                    <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                                    @if(!Auth::user())
                                    <li class="nav-item"><a class="nav-link text-white" href="#">FAQ</a></li>
                                    @else
                                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link text-white" href="#">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link text-white" href="#">Contact-us</a></li>
                                    <li class="nav-item">
                                        @if(!Auth::user())
                                        <button type="button" class="btn btn-primary" id="login_user">Sign-In</button>
                                        <button type="button" class="btn btn-primary" id="register_user">Sign-Up</button>
                                        @else
                                            <p class="fw-500 f-16 text-white">{{ \Illuminate\Support\Facades\Auth::user()->name ?? ''  }}</p>
                                            <a href="{{ route('user.profile') }}">View profile</a>
                                        @endif
                                           </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>

        {{--        Mobile view--}}
        <section class="d-block d-lg-none">
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
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                </ul>
                            </div>
                            <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                            <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>

                </div>
            </div>
        </section>
        {{--        Mobile view--}}
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
                    <input type="text" class="form-control" placeholder="Coimbatore, Tamilnadu" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-12 col-lg-3 my-1 mt-2 my-lg-0">
                <label class="fs-16 fw-500">Starting Date</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                    <input type="text" id="start_date_time" class="form-control w-25" placeholder="Start Date & Time" autocomplete="off">
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                <label class="fs-16 fw-500">Ending Date</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                    <input type="text" id="end_date_time" class="form-control w-25" placeholder="End Date & Time" autocomplete="off">
                </div>
            </div>
            <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block my-auto">
                <button type="submit" disabled id="find_car" class="btn my-button w-100 w-lg-auto p-2">
                    <i class=" text-white fa-solid fa-magnifying-glass"></i> Search
                </button>
            </div>
        </div>
    </div>
        <div class="container d-none d-lg-block text-secondary text-center my-3">
            <p class="duration-display"></p>
            <p class="duration-error text-danger"></p>
        </div>
    </form>
</section>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You are not in Coimbatore.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

