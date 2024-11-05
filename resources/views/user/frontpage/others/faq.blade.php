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
            <div class="container mb-3 py-5">
                <h1 class="display-1 fw-bold text-white text-center">CANCELLATION</h1>
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
                            <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block">
                            <img src="./assets/Group 4 (1).png" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>
                </div>
                <div class="container mb-3 py-5">
                    <h1 class="display-5 fw-bold text-white text-center">CANCELLATION</h1>
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




    <section>
        <div class="container my-5">
            <div class="accordion" id="faqAccordion">
                <!-- First Item (Open by Default) -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. What is a self-driving car rental service?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            A self-driving car rental service allows you to rent a vehicle and drive it yourself without a chauffeur. You can book a car for a few hours or days, and you’re in control of where and how you drive.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. How do I book a self-driving car?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You can easily book a car through our website or webapp. Simply select your location, pick the vehicle, choose your rental period, and provide the required documentation and payment information.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. What documents are required to rent a self-driving car?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You will need to provide:
                            <ul>
                                <li class="text-justify fs-16">A valid driver's license issued by the Indian government.</li>
                                <li class="text-justify fs-16">A government-issued ID for verification (e.g., Aadhaar, PAN, or Passport).</li>
                                <li class="text-justify fs-16">A credit or debit card for payment.</li>
                                <li class="text-justify fs-16">An International Driving Permit (IDP) is required to drive in foreign countries when you hold a driving license issued by another country.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingfour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                            4. What are the eligibility requirements to rent a car?
                        </button>
                    </h2>
                    <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            To rent a self-driving car, you must:
                            <ul>
                                <li class="text-justify fs-16">Be at least 20 years old.</li>
                                <li class="text-justify fs-16">Hold a valid driver’s license with at least one year of driving experience.</li>
                                <li class="text-justify fs-16">Pass any verification checks, including identity and driving record verification.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingfive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                            5. What is the process for picking up and dropping off the car?
                        </button>
                    </h2>
                    <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            <ul>
                                <li class="text-justify fs-16">Pickup: The vehicle can be collected from the location you selected during booking. You will need to present your booking confirmation, driver’s license, and identification.</li>
                                <li class="text-justify fs-16">Return: The vehicle must be returned to the same location at the agreed time. Late returns may incur additional fees.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingsix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                            6. How does the fuel policy work?
                        </button>
                    </h2>
                    <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingsix" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You will receive the car with a full tank of fuel. It must be returned with a full tank. If the car is returned with less fuel, refuelling charges will be applied based on current market rates.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingseven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                            7. What happens if I cancel my booking?
                        </button>
                    </h2>
                    <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingseven" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            If you cancel your booking, Rs 500/- will be deducted from the total amount as a cancellation fee. The remaining balance will be refunded according to our cancellation policy.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingeight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                            8. How long does it take to process a refund?
                        </button>
                    </h2>
                    <div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingeight" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Refunds are processed within 7 business days and will be credited via UPI ID or bank transfer, depending on the payment method you used at the time of booking.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingnine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
                            9. What should I do in case of an accident or damage to the vehicle?
                        </button>
                    </h2>
                    <div id="collapsenine" class="accordion-collapse collapse" aria-labelledby="headingnine" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            In the event of an accident or damage:
                            <ul>
                                <li class="text-justify fs-16">Notify us immediately.</li>
                                <li class="text-justify fs-16">Contact the local authorities and file a police report, if necessary.</li>
                                <li class="text-justify fs-16">Cooperate with our insurance team in filling out all necessary documentation.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingten">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten" aria-expanded="false" aria-controls="collapseten">
                            10. Is the car covered by insurance?
                        </button>
                    </h2>
                    <div id="collapseten" class="accordion-collapse collapse" aria-labelledby="headingten" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Yes, all our vehicles come with basic insurance coverage, which includes third-party liability and limited damage protection. However, you are responsible for any damages, theft, or accidents occurring during the rental period, up to the deductible amount.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingeleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeleven" aria-expanded="false" aria-controls="collapseeleven">
                            11. What is not covered under insurance?
                        </button>
                    </h2>
                    <div id="collapseeleven" class="accordion-collapse collapse" aria-labelledby="headingeleven" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Insurance may not cover:
                            <ul>
                                <li class="text-justify fs-16">Damages due to reckless driving or illegal activities.</li>
                                <li class="text-justify fs-16">Personal belongings inside the car.</li>
                                <li class="text-justify fs-16">Damages resulting from violating the terms of use (e.g., driving under the influence of alcohol).</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingtwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwelve" aria-expanded="false" aria-controls="collapsetwelve">
                            12. What happens if the car breaks down during the rental?
                        </button>
                    </h2>
                    <div id="collapsetwelve" class="accordion-collapse collapse" aria-labelledby="headingtwelve" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            If the vehicle breaks down due to mechanical issues, please inform us immediately. We will arrange for roadside assistance or provide a replacement vehicle, depending on availability, at no additional cost if the issue is not caused by misuse.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingthirteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethirteen" aria-expanded="false" aria-controls="collapsethirteen">
                            13. Can I extend my rental period?
                        </button>
                    </h2>
                    <div id="collapsethirteen" class="accordion-collapse collapse" aria-labelledby="headingthirteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Yes, you can extend your rental period, subject to vehicle availability. Additional charges may apply, and the extension must be confirmed at least 5 hours before your original return time to avoid late fees.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingfourteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefourteen" aria-expanded="false" aria-controls="collapsefourteen">
                            14. Are there any restrictions on where I can drive?
                        </button>
                    </h2>
                    <div id="collapsefourteen" class="accordion-collapse collapse" aria-labelledby="headingfourteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You may drive the vehicle within the geographical limits specified in your rental agreement. Interstate travel is allowed, but you must notify us in advance. Additional fees or permits may be required for long-distance or interstate travel.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingfifteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefifteen" aria-expanded="false" aria-controls="collapsefifteen">
                            15. Can someone else drive the car?
                        </button>
                    </h2>
                    <div id="collapsefifteen" class="accordion-collapse collapse" aria-labelledby="headingfifteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            No, only the person(s) listed in the rental agreement are authorized to drive the vehicle. Allowing another person to drive without prior approval is a violation of our terms and may void the insurance coverage.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingsixteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesixteen" aria-expanded="false" aria-controls="collapsesixteen">
                            16. What should I do if I receive a traffic violation or parking ticket?
                        </button>
                    </h2>
                    <div id="collapsesixteen" class="accordion-collapse collapse" aria-labelledby="headingsixteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You are responsible for any fines, traffic violations, or parking tickets incurred during the rental period. Please notify us if you receive any such penalties, and ensure they are paid to avoid additional charges.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingseventeen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseventeen" aria-expanded="false" aria-controls="collapseseventeen">
                            17. What type of vehicles are available for rental?
                        </button>
                    </h2>
                    <div id="collapseseventeen" class="accordion-collapse collapse" aria-labelledby="headingseventeen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            We offer a variety of vehicles, including:
                            <ul>
                                <li class="text-justify fs-16">Damages due to reckless driving or illegal activities.</li>
                                <li class="text-justify fs-16">Personal belongings inside the car.</li>
                                <li class="text-justify fs-16">Damages resulting from violating the terms of use (e.g., driving under the influence of alcohol).</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingeighteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeighteen" aria-expanded="false" aria-controls="collapseeighteen">
                            18. Do I need to pay a security deposit?
                        </button>
                    </h2>
                    <div id="collapseeighteen" class="accordion-collapse collapse" aria-labelledby="headingeighteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Yes, a refundable security deposit may be required at the time of booking. This amount will be returned to you after the vehicle is returned in good condition, with all fines and charges cleared.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingninteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseninteen" aria-expanded="false" aria-controls="collapseninteen">
                            19. What happens if I return the car late?
                        </button>
                    </h2>
                    <div id="collapseninteen" class="accordion-collapse collapse" aria-labelledby="headingninteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Returning the car later than the agreed time may incur additional charges. Please inform us if you are running late to avoid penalties.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingtwenty">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwenty" aria-expanded="false" aria-controls="collapsetwenty">
                            20. What is the maximum distance I can drive in a day?
                        </button>
                    </h2>
                    <div id="collapsetwenty" class="accordion-collapse collapse" aria-labelledby="headingtwenty" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            We offer rental plans with varying mileage limits. Exceeding the daily mileage limit may result in additional charges based on the distance travelled. You can choose unlimited mileage plans for long trips.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingtwentyone">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwentyone" aria-expanded="false" aria-controls="collapsetwentyone">
                            21. How do I contact customer service?
                        </button>
                    </h2>
                    <div id="collapsetwentyone" class="accordion-collapse collapse" aria-labelledby="headingtwentyone" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            You can reach our customer service team via:
                            <ul>
                                <li class="text-justify fs-16">Email: care@valamcars.com</li>
                                <li class="text-justify fs-16">Phone: 9363065901</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingtwentytwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwentytwo" aria-expanded="false" aria-controls="collapsetwentytwo">
                            22. Can I rent a car for outstation trips?
                        </button>
                    </h2>
                    <div id="collapsetwentytwo" class="accordion-collapse collapse" aria-labelledby="headingtwentytwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Yes, our cars are available for outstation trips. Be sure to check the terms for any restrictions and notify us if you plan to travel out of state.
                        </div>
                    </div>
                </div>
                <!--Item -->
                <div class="accordion-item bg-grey bdr-20 my-2">
                    <h2 class="accordion-header" id="headingtwentythree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwentythree" aria-expanded="false" aria-controls="collapsetwentythree">
                            23. Do you offer hourly rentals?
                        </button>
                    </h2>
                    <div id="collapsetwentythree" class="accordion-collapse collapse" aria-labelledby="headingtwentythree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-3 fs-mb-14 text-justify">
                            Yes, we offer flexible hourly, daily, and weekly rental plans to suit your needs. You can choose the duration that works best for your schedule.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



    @include('user.frontpage.footer')

    @endsection
