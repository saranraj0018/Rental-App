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
                <h1 class="display-1 fw-bold text-white text-center">TERMS & CONDITIONS</h1>
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
                    <h1 class="display-5 fw-bold text-white text-center">TERMS & CONDITIONS</h1>
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
                <h2 class="text-blue fs-5 fw-bold">
                    Terms and Conditions
                </h2>
                <p class="fs-16 text-justify">
                    By accessing and using our services, you ("Customer", "You", "Your") agree to comply with and be bound by these Terms and Conditions ("Terms"). Please read them carefully.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    1. Eligibility
                </h2>
                <p class="fs-16 text-justify">
                    To use Valam self-driving car rental services, you must:
                </p>
                <ul>
                    <li class="text-justify fs-16">Be at least 20 years old.</li>
                    <li class="text-justify fs-16">Hold a valid Indian driver's license for the appropriate vehicle category.</li>
                    <li class="text-justify fs-16">Provide valid identification (Aadhaar, PAN, or passport) at the time of booking and vehicle pickup.</li>
                    <li class="text-justify fs-16">Undergo and pass any required verification checks, including driving history and identity.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    2. Booking and Payment
                </h2>
                <ul>
                    <li class="text-justify fs-16">Booking: All bookings must be made through our website or webapp. You must provide accurate and up-to-date information when making a booking.</li>
                    <li class="text-justify fs-16">Payment: Full payment is required at the time of booking. We accept credit cards, debit cards, UPI, and other digital payment methods.</li>
                    <li class="text-justify fs-16">Cancellation Policy: If you cancel your booking, a cancellation fee of Rs 500/- will be deducted from the total amount paid. Refunds will be processed according to our refund policy.</li>
                    <li class="text-justify fs-16">Booking Modifications: Any changes to your booking, such as extending or reducing the rental period, are subject to availability and may incur additional charges.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    3. Valam Cars’ Right to Cancel
                </h2>
                <p class="fs-16 text-justify">
                    Valam Cars reserves the right to cancel any booking without prior approval from the customer for reasons including but not limited to:
                </p>

                <ul>
                    <li class="text-justify fs-16">Inaccurate or incomplete information provided at the time of booking.</li>
                    <li class="text-justify fs-16">Inadequate documentation (e.g., driver’s license, identity proof).</li>
                    <li class="text-justify fs-16">Suspicious or fraudulent activity. In such cases, a full refund will be issued.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    4. Refunds
                </h2>
                <ul>
                    <li class="text-justify fs-16">Refunds will be processed within 7 business days if a booking is cancelled by Valam Cars due to vehicle unavailability or other reasons beyond our control. Refunds will be made through UPI ID or bank transfer, depending on the payment method used at the time of booking.</li>
                    <li class="text-justify fs-16">Refunds related to customer-initiated cancellations will follow the cancellation fee policy.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    5. Pickup and Return
                </h2>
                <ul>
                    <li class="text-justify fs-16">Pickup: You are responsible for picking up the vehicle at the designated location at the scheduled time. A valid driver's license and booking confirmation must be presented.</li>
                    <li class="text-justify fs-16">Return: You must return the vehicle at the specified location and time. Late returns may incur additional charges. The vehicle must be returned in the same condition as when rented.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    6. Use of Vehicle
                </h2>
                <p class="fs-16 text-justify">
                    You agree to use the vehicle in accordance with the following terms:
                </p>
                <ul>
                    <li class="text-justify fs-16">Legal Use: You must comply with all Indian traffic and road laws. Any fines or penalties during the rental period will be your responsibility.</li>
                    <li class="text-justify fs-16">Prohibited Uses: The vehicle cannot be used for illegal activities, racing, towing, transporting hazardous materials or for commercial purposes (e.g., ride-sharing services).</li>
                    <li class="text-justify fs-16">Driver Limitations: Only the person(s) named in the rental agreement are authorized to drive the vehicle. Sub-leasing or allowing another person to drive the vehicle is strictly prohibited.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    7. Fuel Policy
                </h2>
                <p class="fs-16 text-justify">
                    The vehicle will be provided with a full tank of fuel. It must be returned with a same full tank. If the vehicle is returned with less fuel Rs 500/- will be charged extra apart from the refuelling amount based on the current fuel rates.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    8. Damage, Theft, and Insurance
                </h2>
                <ul>
                    <li class="text-justify fs-16">Insurance: All vehicles are covered under basic insurance policies that include third-party liability and limited damage coverage. However, you are liable for any damages, theft, or accidents occurring during the rental period up to the insurance deductible amount.</li>
                    <li class="text-justify fs-16">Accidents or Damage: In case of an accident or damage to the vehicle, you must immediately notify Valam Cars and local authorities. You are required to cooperate fully with any investigations, including filing police reports and completing insurance claim forms.</li>
                    <li class="text-justify fs-16">Repairs and Maintenance: You are responsible for the general upkeep of the vehicle (e.g., checking tire pressure, fuel level). Unauthorized repairs or modifications to the vehicle are prohibited.</li>
                    <li class="text-justify fs-16"><b>Consequential damages :</b><br>The customer shall be liable for any consequential damages incurred to the vehicle during the rental period. This includes, but is not limited to</li>
                    <li class="text-justify fs-16">Tire Damage: Any damages resulting from tire punctures or blowouts caused by neglect or misuse while driving.</li>
                    <li class="text-justify fs-16">Engine Overheating: Damages caused by continuous driving without adequate breaks, leading to engine overheating, particularly if this results from exceeding the maximum number of passengers or improper vehicle operation.</li>
                    <li class="text-justify fs-16">Accidental Damages: Costs associated with repairs due to accidents, including body damage, mechanical failures, or other damages that may arise from the customer’s actions.</li>
                    <li class="text-justify fs-16">In all cases of consequential damages, the customer will be responsible for covering the full amount of repairs and associated costs, which may include parts, labor and any additional charges incurred as a result of the damage.</li>
                    <li class="text-justify fs-16"><b>Vehicle Damage and Liability Policy :</b><br>In the event of any vehicle damage, the customer will be solely responsible for all associated losses, irrespective of the cause, or who caused the damage.</li>
                    <li class="text-justify fs-16"><b>Accident Liability:</b><br>In the event of an accident, the customer is liable to pay up to ₹20,000/- for damages. The customer will also be responsible for covering the damage repair costs based on the quotation provided by an authorized dealership. Additionally, the customer must compensate valam cars for downtime losses by paying the rental equivalent to the number of days the vehicle is under repair.</li>
                    <li class="text-justify fs-16">If the damage exceeds ₹20,000/-: A comprehensive insurance claim will be filed. Any difference between the insurance claim and the actual repair cost will be borne by the customer. The downtime losses will remain the same, with the customer covering the rental for the repair period.</li>
                    <li class="text-justify fs-16"><b>Total Loss Scenario:</b><br>In case of total loss, a comprehensive insurance claim will be processed. Any additional costs, such as the difference between the claim and the actual cost, parking charges, and three months of downtime losses due to the claim process, will be charged to the customer.</li>
                    <li class="text-justify fs-16"><b>Negligence or Accidents Involving Alcohol or Drugs:</b><br>In situations of user negligence, including driving under the influence of alcohol or drugs, the customer will be responsible for the full cost of damages.</li>
                    <li class="text-justify fs-16"><b>Discretionary Exceptions for Negligent Usage:</b><br>In cases of irresponsible, unsafe, or negligent usage, the customer may be held liable for all damages, regardless of vability to claim insurance. This includes situations such as:</li>
                    <li class="text-justify fs-16"><b>Consequential Damage:</b><br>If the customer continues driving despite abnormal vehicle performance, resulting in further damage.</li>
                    <li class="text-justify fs-16">Prohibited Beach/Off-road Driving: If the vehicle is taken to a beach or off-road, the customer will be liable for a compensation fee of ₹8,000/-, in addition to covering other damages.</li>
                    <li class="text-justify fs-16">Illegal Usage: valam cars vehicles cannot be used for purposes prohibited by law. The customer will be solely responsible for any legal actions or consequences.</li>
                    <li class="text-justify fs-16"><b>Other Liability Scenarios:</b><br>The customer will also be fully liable in the following situations:</li>
                    <li class="text-justify fs-16">If the driver during the incident is different from the one who made the booking.</li>
                    <li class="text-justify fs-16">If the customer fails to comply with valam cars terms and conditions or the law.</li>
                    <li class="text-justify fs-16">If the customer is found to be under the influence of alcohol or narcotics while driving.</li>
                    <li class="text-justify fs-16">If the number of passengers exceeds the vehicle’s seating capacity during the incident.</li>
                    <li class="text-justify fs-16">If the incident occurs in a state where the customer failed to pay the inter-state tax.</li>
                    <li class="text-justify fs-16">If there is a misrepresentation of driving license or ID details provided by the customer.</li>
                    <li class="text-justify fs-16">If there is clear evidence of rash or negligent driving by the customer.</li>
                    <li class="text-justify fs-16">If the customer violates traffic rules or the Motor Vehicles Act.</li>

                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    9. Vehicle Breakdown
                </h2>
                <p class="fs-16 text-justify">
                    In the event of a vehicle breakdown:
                </p>
                <ul>
                    <li class="text-justify fs-16">You must notify Valam Cars immediately.</li>
                    <li class="text-justify fs-16">Valam Cars will arrange for roadside assistance or a replacement vehicle, if necessary, at no extra cost to you, provided the breakdown is not due to your negligence.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    10. Fines and Penalties
                </h2>
                <p class="fs-16 text-justify">
                    To ensure a smooth and pleasant experience for all our users, it is essential to adhere to certain basic norms. Breaching these norms may result in the following penalties
                </p>
                <ul>
                    <li class="text-justify fs-16">You are responsible for any traffic violations, parking tickets, toll charges, and other fines incurred during the rental period. Any unpaid fines or penalties will be charged to you along with an additional administrative fee.</li>
                    <li class="text-justify fs-16">Failure to Present Driving License & Identity Proof: If the driving license and identity proof (Aadhaar card or Passport) are not shown at the time of car delivery, the booking will be treated as cancelled. The customer will be charged 100% of the base fare, along with any applicable doorstep delivery and pickup charges. Please note that a driving license printed on an A4 sheet of paper (original or otherwise) will not be accepted as a valid document.</li>
                    <li class="text-justify fs-16">Delay in Taking Car Delivery: There is no fee for the first 30 minutes of delay (counted from the scheduled booking start time). After that, a charge of Rs. 50 will be applied for every additional 30 minutes of delay.</li>
                    <li class="text-justify fs-16">Traffic/Parking Violations: Customers will be responsible for the full payment of fines or late fees incurred, including those notifications received from relevant authorities after the booking period ends. An additional charge of Rs. 300 will apply for every 30 days of delayed payment.</li>
                    <li class="text-justify fs-16">Over-speeding (Above 120 Kms/Hr): A penalty of Rs. 500 will be imposed for the first over-speeding incident. For repeated infractions after a warning, the charge will increase to Rs. 2000. Continuous over-speeding may result in the withdrawal of services from the user.</li>
                    <li class="text-justify fs-16">Loss/Non-return of Key: A fee of Rs. 500 will be charged for the loss or non-return of the key, in addition to the replacement cost if the key is not returned within 3 days.</li>
                    <li class="text-justify fs-16">Cleaning Required (Interiors): For minor cleaning, a charge of Rs. 1000 will apply. Major cleaning will incur a fee of Rs. 1500.</li>
                    <li class="text-justify fs-16">Vehicle Returned to Wrong Location: If the vehicle is returned to a location different from the one specified at the time of booking or modification, a fee of Rs. 500 will be charged, along with the base fare and any late penalties for the additional hours until the vehicle is returned.</li>
                    <li class="text-justify fs-16">Not Refueling: If the car is returned with a lower fuel level than when received, a refueling service charge of Rs. 500 will apply, plus the actual fuel cost required to restore the tank to its original level.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    11. Termination of Service
                </h2>
                <p class="fs-16 text-justify">
                    Valam Cars reserves the right to terminate your rental agreement if:
                </p>
                <ul>
                    <li class="text-justify fs-16">You provide false or misleading information.</li>
                    <li class="text-justify fs-16">You violate any terms of this agreement.</li>
                    <li class="text-justify fs-16">You misuse or damage the vehicle. In such cases, no refunds will be issued.</li>
                </ul>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    12. Liability and Indemnity
                </h2>
                <p class="fs-16 text-justify">
                    You agree to indemnify and hold Valam Cars harmless from any claims, damages, or losses arising from your use of the vehicle, including legal fees and other costs. Valam Cars is not liable for any personal injury, death, or loss of property incurred while using the rented vehicle.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    13. Privacy
                </h2>
                <p class="fs-16 text-justify">
                    We value your privacy. Any personal information collected during the booking and rental process is governed by our Privacy Policy, available on our website.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    14. Governing Law
                </h2>
                <p class="fs-16 text-justify">
                    These Terms and Conditions are governed by and construed in accordance with the laws of India. Any disputes arising from these terms or the use of our services shall be subject to the exclusive jurisdiction of the courts in [City Name].
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    15. Changes to Terms
                </h2>
                <p class="fs-16 text-justify">
                    Valam Cars reserves the right to modify these Terms and Conditions at any time. Any changes will be communicated via our website, and your continued use of our services constitutes acceptance of the updated terms.
                </p>
            </div>
            <div>
                <h2 class="text-blue fs-5 fw-bold">
                    16. Contact Us
                </h2>
                <p class="fs-16 text-justify">
                    For any questions or concerns regarding these Terms & Conditions, please contact us at:
                </p>
                <ul>
                    <li class="text-justify fs-16">Email: Care@valamcars.com</li>
                    <li class="text-justify fs-16">Phone: xxxxxxxxxxxxx</li>
                    <li class="text-justify fs-16">Address: No: 593, Avinashi Road, Goldwins, Coimbatore – 641 014</li>
                </ul>
            </div>
        </div>
    </section>
    @include('user.frontpage.footer')

@endsection
