@extends('user.frontpage.list-cars.main')

@section('content')
<section>
    <header>
        <section class="booking-header">
            <div class="container-fluid p-3">
                <div class="container bg-white rounded-pill p-1 rounded-sm-3 my-head-round">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div class="d-flex justify-content-between mobile-head-width">
                                <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo" class="img-fluid d-block w-50">
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
                                    <li class="nav-item ms-0 ms-lg-5 pe-0 pe-lg-3"><a class="nav-link text-dark" href="{{ route('home') }}">Home</a></li>
                                    @if(!Auth::user())
                                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('faq') }}">FAQ</a></li>
                                    @else
                                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
{{--                                    <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>--}}
                                    <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2"><a class="nav-link text-dark me-0 me-lg-5" href="{{ route('contact') }}">Contact-us</a></li>
                                    <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0">
                                        @if(!Auth::user())
                                        <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                        <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                        @else
                                        <div class="d-flex justify-content-center justify-content-md-end mt-1 mb-2">
                                            <div class="me-3">
                                                <p class="text-blue m-0 border-blue w-fit rounded-3 f-16 py-1 px-2">{{ \Illuminate\Support\Facades\Auth::user()->name ?? ''  }}</p>
                                            </div>
                                            <a href="{{ route('user.profile') }}" class="text-dark my-auto ms-2 text-decoration-none">View profile</a>
                                        </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="text-center text-white py-5">
                <div class="display-1 fw-500 mb-3">CONTACT US</div>
                <div class="fs-16">We are ready to provide right solution <br>accordion to your needs</div>
            </div>
        </section>

        <section class="d-none">
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
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Booking</a></li>
{{--                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>--}}
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                </ul>
                            </div>
                            <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                            <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>
                </div>
                <div class="text-center text-white py-5">
                    <h1 class="display-5 fw-500 mb-3">CONTACT US</h1>
                    <div class="fs-16">We are ready to provide right solution <br>accordion to your needs</div>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.navbar-light .dmenu').hover(function() {
                    $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
                }, function() {
                    $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
                });
            });
        </script>

    </header>

</section>

<section class="section my-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-6">
                <div class="card border-0 h-100 p-4 bdr-20 bg-grey">
                    <div class="fs-1 fw-500 text-blue">
                        Get in Touch
                    </div>
                    <div class="fs-16 my-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ab dolore doloremque cum optio eos.
                    </div>
                    <div class="d-flex mt-2">
                        <div class="me-4">
                            <i class="fas fa-map text-white bg-blue p-3 rounded-circle fs-3"></i>
                        </div>
                        <div class="my-auto">
                            <div class="fs-5 fw-500 text-blue">
                                Head Office
                            </div>
                            <div class="fs-16">
                                No 593 , Valam self driving cars
                                Avinashi road, Goldwins
                                Coimbatore -641 014
                            </div>
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="me-4">
                            <i class="fas fa-envelope text-white bg-blue p-3 rounded-circle fs-3"></i>
                        </div>
                        <div class="my-auto">
                            <div class="fs-5 fw-500 text-blue">
                                Email Us
                            </div>
                            <a class="fs-16 text-decoration-none text-dark" href="mailto:jr.webdev@rankuhigher.in">
                                jr.webdev@rankuhigher.in
                            </a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-4">
                            <i class="fas fa-phone-alt text-white bg-blue p-3 rounded-circle fs-3"></i>
                        </div>
                        <div class="my-auto">
                            <div class="fs-5 fw-500 text-blue">
                                Call Us
                            </div>
                            <a class="fs-16 text-decoration-none text-dark" href="tel:7094053462">
                                Phone : 7094053462
                            </a><br>
                            <a class="fs-16 text-decoration-none text-dark" href="tel:0422-7094053462">

                                Fax : 0422-7094053462
                            </a>
                        </div>
                    </div>
                    <div class="fs-5 fw-500 mt-4 text-blue">
                        Follow our social media
                    </div>
                    <div class="d-flex my-3">
                        <a href="https://www.youtube.com" target="_blank" class="me-3">
                            <i class="fab fa-youtube fa-1x text-white bg-blue rounded-circle p-2"></i>
                        </a>
                        <a href="https://www.facebook.com" target="_blank" class="me-3">
                            <i class="fab fa-facebook fa-1x text-white bg-blue rounded-circle p-2"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="me-3">
                            <i class="fab fa-instagram fa-1x text-white bg-blue rounded-circle p-2"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="me-3">
                            <i class="fab fa-linkedin fa-1x text-white bg-blue rounded-circle p-2"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" class="me-3">
                            <i class="fab fa-twitter fa-1x text-white bg-blue rounded-circle p-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 my-auto">
                <div class="fs-1 fw-500 text-blue">
                    Send us a Message
                </div>

                <form action="" class="mt-3">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label for="name" class="fs-16 fw-500 text-blue">Name</label>
                            <input type="text" class="form-control input-sm bg-grey border border-0" placeholder="Enter your name">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="company" class="fs-16 fw-500 text-blue">Company</label>
                            <input type="text" class="form-control input-sm bg-grey border border-0" placeholder="Enter your company">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="Phone" class="fs-16 fw-500 text-blue">Phone</label>
                            <input type="text" class="form-control input-sm bg-grey border border-0" placeholder="Enter your Phone">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="Email" class="fs-16 fw-500 text-blue">Email</label>
                            <input type="text" class="form-control input-sm bg-grey border border-0" placeholder="Enter your Email">
                        </div>
                        <div class="col-12">
                            <label for="Subject" class="fs-16 fw-500 text-blue">Subject</label>
                            <input type="text" class="form-control input-sm bg-grey border border-0" placeholder="Enter your Subject">
                        </div>
                        <div class="col-12">
                            <label for="Message" class="fs-16 fw-500 text-blue">Message</label>
                            <textarea class="form-control input-sm bg-grey border border-0"></textarea>
                        </div>
                        <div class="col-12">
                            <input type="submit" class="form-submit bg-blue btn text-white" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@include('user.frontpage.footer')

@endsection

<!-- FOR TAB ELEMENT -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<!-- FOR TAB ELEMENT END -->
