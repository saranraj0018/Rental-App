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
                                    <li class="nav-item ms-0 ms-lg-5 pe-0 pe-lg-3"><a class="nav-link text-dark" href="#">Home</a></li>
                                    @if(!Auth::user())
                                    <li class="nav-item"><a class="nav-link text-dark" href="#">FAQ</a></li>
                                    @else
                                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>
                                    <li class="nav-item me-0 me-lg-3 pe-0 pe-lg-2"><a class="nav-link text-dark me-0 me-lg-5" href="#">Contact-us</a></li>
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
            <div class="container mb-3 py-5">
                <h1 class="display-1 fw-bold text-white text-center">PRIVACY & POLICY</h1>
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
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                </ul>
                            </div>
                            <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block">
                            <img src="./assets/Group 4 (1).png" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>
                </div>
                <div class="container mb-3 py-5">
                    <h1 class="display-5 fw-bold text-white text-center">PRIVACY & POLICY</h1>
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
    

    
    <section class="my-5">
        <div class="container">
            <div>
                <h2 class="text-blue text-end fs-5 fw-500">
                    Effective Date: 16/10/2024
                </h2>
                <h2 class="text-blue fs-5 fw-bold">
                    1. Valam Cars
                </h2>
                <p class="fs-16 text-justify">
                    Valamcars operates a self-driving car rental service through our website and web app. We are committed to protecting your privacy and ensuring your personal information is handled responsibly. This Privacy Policy outlines the types of information we collect, how we use, share, and protect it, and your rights regarding your personal data.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    2. Information                  
                </h2>
                <p class="fs-16 text-justify">
                    Information We collect the following types of information:
                </p>
                <h3 class="fs-16 fw-500">
                    a. Personal Information:
                </h3>
                <ul>
                    <li class="text-justify fs-16">Name</li>
                    <li class="text-justify fs-16">Email address</li>
                    <li class="text-justify fs-16">Phone number</li>
                    <li class="text-justify fs-16">Address</li>
                    <li class="text-justify fs-16">Payment information </li>
                    <li class="text-justify fs-16">Government-issued ID details (e.g., Aadhaar, driver's license)</li>
                </ul>
                <h3 class="fs-16 fw-500">
                    b. Usage Data:
                </h3>
                <ul>
                    <li class="text-justify fs-16">IP address</li>
                    <li class="text-justify fs-16">Browser type and version</li>
                    <li class="text-justify fs-16">Operating system</li>
                    <li class="text-justify fs-16">Device information</li>
                    <li class="text-justify fs-16">Pages viewed, time spent, and interactions with our site/app</li>
                    <li class="text-justify fs-16">Geolocation data (with your consent)</li>
                </ul>
                <h3 class="fs-16 fw-500">
                    c. Vehicle Data:
                </h3>
                <ul>
                    <li class="text-justify fs-16">Vehicle usage history (time, mileage, fuel consumption)</li>
                    <li class="text-justify fs-16">GPS location during rental</li>
                    <li class="text-justify fs-16">Driver behaviour data (speed, braking, etc.)</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    3. How We Use Your Information                   
                </h2>
                <p class="fs-16 text-justify">
                    We use the collected data for the following purposes:
                </p>
                <ul>
                    <li class="text-justify fs-16">To provide and manage our services, including vehicle bookings, payments, and customer support.</li>
                    <li class="text-justify fs-16">To verify your identity and ensure legal compliance.</li>
                    <li class="text-justify fs-16">To improve our website, services, and customer experience.</li>
                    <li class="text-justify fs-16">To process payments and prevent fraud.</li>
                    <li class="text-justify fs-16">To communicate with you regarding bookings, updates, and promotional offers (with your consent).</li>
                    <li class="text-justify fs-16">To monitor the performance and safety of rented vehicles.</li>
                    <li class="text-justify fs-16">To comply with legal obligations.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    4. Sharing Your Information 
                </h2>
                <p class="fs-16 text-justify">
                    we may share your personal information under the following circumstances:
                </p>
                <ul>
                    <li class="text-justify fs-16">With service providers: We share data with trusted third-party vendors (payment processors, vehicle maintenance providers, etc.) to facilitate our services.</li>
                    <li class="text-justify fs-16">With law enforcement or government authorities: We may disclose information when required by law or in response to legal processes.</li>
                    <li class="text-justify fs-16">In case of a merger or acquisition: If our company undergoes a merger or sale, your data may be transferred to the new entity.</li>
                    <li class="text-justify fs-16">With insurance companies: In the event of accidents or claims, your data may be shared with insurance providers.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                5. Data Security 
                </h2>
                <p class="fs-16 text-justify">
                    We employ industry-standard security measures, such as encryption and secure servers, to protect your data. While we strive to protect your personal information, no method of transmission over the internet or method of storage is 100% secure. We cannot guarantee absolute security.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    6. Your Rights 
                </h2>
                <p class="fs-16 text-justify">
                    You have the following rights concerning your personal data:
                </p>
                <ul>
                    <li class="text-justify fs-16">Access: You can request access to your personal information.</li>
                    <li class="text-justify fs-16">Correction: You can request corrections to any inaccurate or incomplete data.</li>
                    <li class="text-justify fs-16">Deletion: You can request the deletion of your personal information, subject to legal obligations.</li>
                    <li class="text-justify fs-16">Objection: You can object to the processing of your data for marketing purposes.</li>
                    <li class="text-justify fs-16">Data Portability: You can request a copy of your data in a machine-readable format. To exercise these rights, contact us at [Contact Email].</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    7. Cookies and Tracking Technologies 
                </h2>
                <p class="fs-16 text-justify">
                    We use cookies and similar technologies to enhance your browsing experience. These track your preferences and help us understand how you interact with our website. You can manage cookie preferences through your browser settings.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                8. Third-Party Links
                </h2>
                <p class="fs-16 text-justify">
                    Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies before providing any personal information.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    9. Refund Policy / Cancellation Policy 
                </h2>            
                <ul>
                    <li class="text-justify fs-16">If you wish to cancel your booking, a charge of ₹500 will be deducted from the total amount paid when processing the refund.</li>
                    <li class="text-justify fs-16">Valam Cars reserves the right to cancel and refund any orders without customer approval due to incorrect information in the booking or issues beyond our control, such as document discrepancies or incorrect details.</li>
                    <li class="text-justify fs-16">In cases where the booking cannot be fulfilled due to unavailability of the car, the refund will be processed within 7 days via UPI or bank transfer.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                10. Changes to This Policy
                </h2>            
                <p class="fs-16 text-justify">
                    We may update this Privacy Policy from time to time. Any changes will be posted on this page with a revised "Effective Date." Your continued use of our services constitutes acceptance of the updated policy.
                </p>
                
                
            </div>
        </div>
    </section>
    @include('user.frontpage.footer')

@endsection

