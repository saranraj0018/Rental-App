


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

                    <ul class="navbar-nav navbar-light w-100 ms-0 ms-lg-4 ps-0 ps-lg-5 text-end text-lg-start">
                        <li class="nav-item my-nav ms-0 ms-lg-4 pe-0 pe-lg-0 my-auto"><a class="nav-link text-white fw-normal"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('about') }}">About</a>
                        </li>

                        <li
                            class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('blog') }}">Blog</a>
                        </li>

                        <li class="nav-item my-nav my-auto" id="booking_button"
                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                            <a class="nav-link text-white fw-normal" href="{{ route('booking.history') }}">Booking</a>
                        </li>
                        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li class="nav-item my-nav me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                class="nav-link text-white fw-normal me-0 me-lg-0" href="{{ route('contact') }}">Contact-us</a></li>


                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto d-flex d-lg-block justify-content-end">

                            <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};"
                                class="ms-0 ms-lg-5 ps-0 ps-lg-5">
                                <button type="button" class="btn border border-white text-white fw-bold rounded-pill me-1 ms-0 ms-lg-5"
                                    id="login_user">Sign-In</button>
                                <button type="button" class="btn bg-primary text-white fw-bold rounded-pill"
                                    id="register_user">Sign-Up</button>
                            </div>

                            <div id="after_login_button" class="mt-1 mb-2 nav-link bg-white rounded-pill py-1 px-4"
                                style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                <a href="{{ route('user.profile') }}"
                                    class="text-dark text-center my-auto text-decoration-none fs-14 m-0">View
                                    profile</a>
                                <div class="d-flex d-lg-block justify-content-end">
                                    <p class="text-dark fw-500 m-0 border-blue w-fit rounded-3 f-16 fs-13" id="user_name">
                                        {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                    </p>
                                </div>

                            </div>
                        </li>
                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
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
