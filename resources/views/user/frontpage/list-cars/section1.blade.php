
    <section class="other-heads-bg pb-5">
        <header class="pb-5">
            <section class="d-none d-lg-block">
                <div class="container-fluid p-3">
                    <div class="container bg-white rounded-pill p-1">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                            <div class="container d-flex justify-content-between">
                                <div>
                                    <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo" class="img-fluid d-block w-50">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>

                                <div class="collapse navbar-collapse" id="mobile_nav">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                    </ul>
                                    <ul class="navbar-nav navbar-light w-100 ms-5 ps-5">
                                        <li class="nav-item ms-5 pe-3"><a class="nav-link text-dark" href="#">Home</a></li>
                                        @if(!Auth::user())
                                            <li class="nav-item"><a class="nav-link text-dark" href="#">FAQ</a></li>
                                        @else
                                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                        @endif
                                        <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>
                                        <li class="nav-item me-5 pe-2"><a class="nav-link text-dark me-5" href="#">Contact-us</a></li>
                                        <li class="nav-item ms-3 ps-2 d-flex">
                                            @if(!Auth::user())
                                                <button type="button" class="btn bg-light bg-gradient border border-gradient rounded-pill me-1 px-3" id="login_user"><i class="fas fa-bookmark" style="color:#E12222;"></i></button>
                                                <div class="rounded-pill bg-lightblue ms-2 d-flex my-auto" id="register_user">
                                                    <div class="fs-5 me-2 my-auto">
                                                        <i class="fas fa-user text-blue bg-light-blue px-2 py-2 rounded-circle"></i>
                                                    </div>
                                                    <div class="fs-6 lh-sm">
                                                        <div>
                                                            Sign-Up
                                                        </div>
                                                        <a href="#" class="fs-12 text-decoration-none text-blue fw-500">View Profile</a>
                                                    </div>
                                                </div>
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

            <section class="d-block d-lg-none">
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
                                                href="#">FAQ</a></li>
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Blog</a></li>
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Contact-us</a></li>
                                    </ul>
                                </div>
                                <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo"
                                     class="img-fluid d-block">
                                <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="Site-Logo"
                                     class="img-fluid d-block">
                            </div>
                        </nav>

                    </div>
                </div>
            </section>
        </header>
    </section>


