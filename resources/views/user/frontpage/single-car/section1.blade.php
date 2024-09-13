<section class="other-heads-bg py-4">
    <header>
        <div class="container">
            <div class="d-flex text-white">
                <div class="mt-2">
                    {{--                    <button class="border-2 rounded-pill px-3 py-2 me-3 back-btn"><i class="fa fa-angle-left text-white fs-18"></i></button>--}}
                    <a href="{{ url()->previous() }}" class="border-2 rounded-pill px-3 py-2 me-3 back-btn">
                        <i class="fa fa-angle-left text-white fs-18"></i>
                    </a>
                </div>
                <div class="my-auto">Car Booking</div>
            </div>
        </div>
    </header>
</section>
<section class="my-4 mt-5">
    <div class="container">
        <div class="row gy-3 gy-lg-0">
            <div class="col-12 col-lg-6">
                <div class="card p-3 bdr-30 h-100">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="bg-white rounded-pill w-fit px-1 fw-500 fs-15 my-auto">
                                <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                            </div>
                        </div>
                        <div>
                            <div class="save-icon my-auto bg-grey">
                                <i class="fas fa-bookmark text-blue"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-block">
                        <img src="{{ asset('storage/car_image/' . $car_model->car_image ?? '') }}" alt="car-pic" class="img-fluid">
                    </div>
                    <div class="home-demo">
                        <div class="owl-carousel owl-carousel-6 owl-theme">
                            @if(!empty($car_model->carDoc))
                                @foreach($car_model->carDoc as $image)
                                    <div class="item">
                                        <img src="{{ asset('storage/car_other_image/'.$image->name) }}" alt="car-logo" class="img-fluid">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <div class="fs-14 fs-mb-10 fw-500 my-auto">
                            <img src="{{ asset('user/img/search-result/Group 4 (1).png') }}" alt="location icon" class="img-fluid me-1">
                            Gandhipuram, Coimbatore
                        </div>
                        <div class="text-success fs-14 fs-mb-10 fw-500 my-auto">
                            <i class="fas fa-circle fs-12 fs-mb-9"></i> Available Now
                        </div>
                    </div>
                    <p class="fs-4 fw-600 my-3 m-0">
                       {{$car_model->model_name}}
                    </p>
                    <p class="d-flex text-secondary fs-12">
                        <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-1 conf-icon">{{ $car_model->transmission }}
                        <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $car_model->seat.'Seats' }}
                        <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3">AC
                        <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $car_model->fuel_type }}
                    </p>
                    <div class="row mt-2">
                        <div class="col-7">
                            <ul class="fs-13 fw-500 ps-3">
                                <li>Pricing Plan: Includes 480 kms, excludes fuel</li>
                                <li>Extra Hour: ₹550 / per hour</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul class="fs-13 fw-500 ps-3">
                                <li>Extra Km: ₹{{ $car_model->extra_km_charge }} / per KM</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="p-3 bg-blue bdr-30 p-3 h-100">
                    <form action="">
                        <div class="row d-block d-lg-none">
                            <div class="me-0 me-lg-2 col-12">
                                <label class="fs-12 fw-500 text-white">Pickup date & Time</label>
                                <div class="input-group booking-inputs">
                                        <span class="input-group-text form-dates" id="basic-addon1">
                                            <i class="text-white fa-solid fa-calendar-days"></i>
                                        </span>
                                    <input type="datetime-local" class="form-control">
                                </div>
                            </div>
                            <div class="ms-0 ms-lg-2 col-12">
                                <label class="fs-12 fw-500 text-white">Pickup date & Time</label>
                                <div class="input-group booking-inputs">
                                        <span class="input-group-text form-dates" id="basic-addon1">
                                            <i class="text-white fa-solid fa-calendar-days"></i>
                                        </span>
                                    <input type="datetime-local" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-lg-block">
                            <div class="d-flex">
                                <div class="me-0 me-lg-2">
                                    <label class="fs-14 text-white">Pickup date & Time</label>
                                    <div class="input-group booking-inputs">
                                            <span class="input-group-text form-dates" id="basic-addon1">
                                                <i class="text-white fa-solid fa-calendar-days"></i>
                                            </span>
                                        <input type="datetime-local" class="form-control">
                                    </div>
                                </div>
                                <div class="ms-0 ms-lg-2">
                                    <label class="fs-14 text-white">Pickup date & Time</label>
                                    <div class="input-group booking-inputs">
                                            <span class="input-group-text form-dates" id="basic-addon1">
                                                <i class="text-white fa-solid fa-calendar-days"></i>
                                            </span>
                                        <input type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-4 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total Time</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">1 Day 2hr</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total base fare</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹9299</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 mb-1 border-bottom border-1 toggle">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Doorstep delivery & pickup</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹500</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-2 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Refundable security deposit</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹2000</p>
                        </div>
                        <div class="d-flex justify-content-between text-white border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Insurance & GST</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Included</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Tolls, Parking & Inter-state taxes</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">To be paid by you</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3">
                            <p class="fs-14 fs-mb-12 my-auto my-lg-2 w-100">Promo / Coupon Code</p>
                            <div class="input-group booking-inputs-2 my-auto bdr-30 w-50 h-50">
                                <input type="type" class="form-control coupen-input">
                                <span class="input-group-text form-dates bg-white text-blue fs-12 fw-500 py-0 px-3 mx-auto mx-lg-0" id="basic-addon1">
                                        Apply
                                    </span>
                            </div>
                        </div>
                        <div class="mt-1 pt-2 mb-3">
                            <div class="mt-5 d-flex justify-content-between flex-column flex-md-row">
                                <div class="my-auto">
                                    <div class="d-flex">
                                        <div>
                                            <label class="switch m-0">
                                                <input type="checkbox" id="toggleSwitch">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div>
                                            <span class="fs-14 ms-2 text-white">Door Step Delievery</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <p class="fs-20 fs-mb-16 my-2 text-end">Total Price ₹11599</p>
                                </div>
                            </div>
                        </div>
                        <div class="toggle-fade">
                            <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-5 fw-600 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Proceed Payment</button>
                        </div>
                        <div class="d-flex justify-content-between flex-column flex-md-row toggle">
                            <div class="mb-3 mb-md-auto">
                                <button type="button" class="btn text-white fs-16 fs-mb-14 fw-500 border-white rounded-pill px-4 d-flex justify-content-center w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#secondModal">
                                    <img src="{{ asset('user/img/car-booking/Group.png') }}" alt="location icons" class="img-fluid d-block me-2"> Select Your Location</button>
                            </div>

                            <div>
                                <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-5 fw-600 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Proceed Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Structure -->
<div class="modal left fade custom-modal m-0 overflow-hidden" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog position-top-right">
        <div class="modal-content bdr-20">
            <div class="modal-body h-600px p-0">
                <!-- Input Sets -->
                <div class="input-set fade-element show" data-set="1">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-angle-left text-white fs-18"></i></button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm" id="exampleModalLabel">Sign In To Your <br>Account</h4>
                            <p class="fs-12 text-white" id="exampleModalLabel">Sign In To Your Account</p>
                        </div>
                    </div>
                    <div class="py-3 px-2 px-lg-5">
                        <div class="mb-3">
                            <label for="input1" class="form-label fs-12 fw-500">Enter your Mobile Number</label>
                            <input type="tel" class="form-control bg-grey form-bdr" id="input1" placeholder="9329*****1">
                        </div>
                        <div class="fs-10 line-container"> or sign-in with</div>
                        <div class="d-flex justify-content-center my-3">
                            <img src="{{ asset('user/img/car-booking/Group 35412.png') }}" alt="form-icon" class="img-fluid mx-2">
                        </div>
                        <button type="button" class="btn my-button next-button w-100" data-next="2">Request OTP</button>
                        <div class="fs-10 text-secondary text-center mt-3">Don't have an account? <span class="text-dark fw-500">Register</span></div>
                    </div>
                </div>
                <div class="input-set fade-element" data-set="2">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white back-button mb-2" data-prev="1"><i class="fa fa-angle-left text-white fs-18"></i></button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm" id="exampleModalLabel">OTP Verification</h4>
                            <p class="fs-12 text-white" id="exampleModalLabel">Check your mobile to see verification code</p>
                        </div>
                    </div>
                    <div class="py-3 px-2 px-lg-5">
                        <div class="mb-3">
                            <p class="form-label fs-12 fw-500 text-secondary text-center">Enter the OTP sent to <span class="text-dark fw-500">+91 - 8554569487</span></p>
                            <div class="d-flex my-4">
                                <input type="tel" class="form-control bg-grey form-bdr mx-1 mx-md-2">
                                <input type="tel" class="form-control bg-grey form-bdr mx-1 mx-md-2">
                                <input type="tel" class="form-control bg-grey form-bdr mx-1 mx-md-2">
                                <input type="tel" class="form-control bg-grey form-bdr mx-1 mx-md-2">
                                <input type="tel" class="form-control bg-grey form-bdr mx-1 mx-md-2">
                            </div>
                        </div>
                        <div class="mt-5 pt-5">
                            <div class="fs-10 text-secondary text-center my-3">Don't recieve the OTP? <span class="text-dark fw-500">RESEND OTP</span></div>
                            <button type="button" class="btn my-button next-button w-100" data-next="3">Verify Code</button>
                        </div>
                    </div>
                </div>
                <div class="input-set fade-element" data-set="3">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white back-button mb-2" data-prev="2"><i class="fa fa-angle-left text-white fs-18"></i></button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm" id="exampleModalLabel">Create Your Account</h4>
                            <p class="fs-12 text-white" id="exampleModalLabel">Create Your Account</p>
                        </div>
                    </div>
                    <div class="py-3 px-2 px-lg-5">
                        <div class="mb-2">
                            <label for="input2" class="form-label fs-12 fw-500">Your Name</label>
                            <input type="tel" class="form-control bg-grey form-bdr" id="input2" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="input3  " class="form-label fs-12 fw-500">Enter Your Mobile Number</label>
                            <input type="tel" class="form-control bg-grey form-bdr" id="input3" placeholder="+91">
                        </div>
                        <div class="my-3">
                            <div class="fs-10 line-container"> or sign-in with</div>
                            <div class="d-flex justify-content-center my-3">
                                <img src="{{ asset('user/img/car-booking/Group 35412.png') }}" alt="form-icon" class="img-fluid mx-2">
                                <img src="{{ asset('user/img/car-booking/Group 35413.png') }}" alt="form-icon" class="img-fluid mx-2">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn my-button next-button w-100" id="submit-button" data-bs-dismiss="modal" aria-label="Close">Request OTP</button>
                            <div class="fs-10 text-secondary text-center my-3">Already have an account? <span class="text-dark fw-500">Sign In</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Second Modal Structure -->
<div class="modal fade m-0 m-md-auto" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bdr-20">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="p-3">
                    <p class="fs-16 fw-500">Select Location on Map</p>
                    <div class="container">

                        <div id="custom_map" style="height: 500px; width: 100%;"></div>
                    </div>
                    <p class="fs-16 fw-500 mt-2">(or) Enter manually</p>
{{--                    <input type="text" id="cityInput" class="form-control" placeholder="Enter a city name">--}}
                    <input id="custom-city" type="text" placeholder="Search city" class="form-control">
                    <button type="button" class="btn fs-16 my-button mt-4 w-50 w-lg-25" data-bs-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .pac-container {
        z-index: 1051 !important; /* Set it higher than the modal (Bootstrap modals usually have a z-index of 1050) */
    }
    .modal-body {
        position: relative;
        z-index: 1050; /* Default z-index for modal content */
    }
</style>
<script async src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMarker"></script>


