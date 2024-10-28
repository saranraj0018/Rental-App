<section class="section-1-bg pb-3">
    <header>
        <section>
            <div class="container-fluid p-3 pb-5">
                <div class="container bg-white rounded-pill p-1 rounded-sm-3 my-head-round mb-5">
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

                                        <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">--}}
                                            <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                            <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                        </div>

                                        <div id="after_login_button" class="d-flex justify-content-center justify-content-md-end mt-1 mb-2" style="display: {{ Auth::check() ? 'block' : 'none' }};">
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

</section>
