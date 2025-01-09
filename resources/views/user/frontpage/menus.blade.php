<div class="collapse navbar-collapse ms-5" id="mobile_nav">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>

    <ul class="navbar-nav navbar-light w-100 ms-0 ms-lg-4 ps-0 ps-lg-5 text-end text-lg-start">
        <li class="nav-item my-nav ms-0 ms-lg-3 pe-0 pe-lg-1 my-auto"><a class="nav-link text-white fw-normal"
                href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('about') }}">About</a>
        </li>

        <li style="display: @if (!empty($timing_setting['show_blog']) && $timing_setting['show_blog'] == 1) unset @else none @endif !important"
            class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('blog') }}">Blog</a>
        </li>

        <li class="nav-item my-nav my-auto" id="booking_button"
            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
            <a class="nav-link text-white fw-normal" href="{{ route('booking.history') }}">Booking</a>
        </li>
        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal" href="{{ route('faq') }}">FAQ</a>
        </li>
        <li class="nav-item my-nav me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                class="nav-link text-white fw-normal me-0 me-lg-1" href="{{ route('contact') }}">Contact-us</a></li>


        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

            <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};"
                class="ms-0 ms-lg-5 ps-0 ps-lg-5">
                <button type="button" class="btn border border-white text-white fw-bold rounded-pill me-1 ms-0 ms-lg-5"
                    id="login_user">Sign-In</button>
                <button type="button" class="btn bg-blue text-white fw-bold rounded-pill"
                    id="register_user">Sign-Up</button>
            </div>

            <div id="after_login_button" class="mt-1 mb-2 nav-link"
                style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                <a href="{{ route('user.profile') }}"
                    class="text-white text-center my-auto ms-2 text-decoration-none fs-13">View
                    profile</a>
                <div class="d-flex d-lg-block justify-content-end">
                    <p class="text-white m-0 my-1 border-blue w-fit rounded-3 f-16 ps-2 fs-13" id="user_name">
                        {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                    </p>
                </div>
                <div>

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
