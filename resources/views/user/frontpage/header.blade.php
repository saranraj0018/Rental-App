<section class="section-1-bg pb-3">
    <header>
        <section>
            <div class="container-fluid p-3 pb-5">
                <div class="container bg-head-grey rounded-pill p-1 rounded-sm-3 my-head-round mb-5">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div class="d-flex justify-content-between mobile-head-width">
                                <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo"
                                    class="img-fluid d-block w-50 ">
                                <div class="my-auto h-100">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse" id="mobile_nav">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                <ul
                                    class="navbar-nav navbar-light w-100 ms-0 ms-lg-5 ps-0 ps-lg-5 text-end text-lg-start">
                                    <li class="nav-item ms-0 ms-lg-1 pe-0 pe-lg-1 my-auto"><a
                                            class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                                    <li class="nav-item my-auto"><a class="nav-link text-white"
                                            href="{{ route('about') }}">About</a></li>
                                    <li class="nav-item my-auto" id="booking_button"
                                        style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                        <a class="nav-link text-white" href="{{ route('booking.history') }}">Booking</a>
                                    </li>
                                    <li class="nav-item my-auto"><a class="nav-link text-white"
                                            href="{{ route('faq') }}">FAQ</a></li>
                                    <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                            class="nav-link text-white me-0 me-lg-5"
                                            href="{{ route('contact') }}">Contact-us</a></li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

                                        <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">
                                            <button type="button" class="btn border border-dark rounded-pill me-1"
                                                id="login_user">Sign-In</button>
                                            <button type="button" class="btn bg-blue text-white rounded-pill"
                                                id="register_user">Sign-Up</button>
                                        </div>

                                        <div id="after_login_button" class="mt-1 mb-2 nav-link"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <a href="{{ route('user.profile') }}"
                                                class="text-white text-center my-auto ms-2 text-decoration-none fs-13 fw-600">View
                                                profile</a>
                                            <div class="d-flex d-lg-block justify-content-end">
                                                <p class="text-blue m-0 my-1 border-blue w-fit rounded-3 f-16 px-2 fs-13 fw-600"
                                                    id="user_name">
                                                    {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                                </p>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                                        style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="#" class="text-decoration-none"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

</section>
