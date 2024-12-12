<section class="other-heads-bg py-4">
    <header>
        <div class="container">
            <div>
                <div class="d-flex justify-content-between">
                    <div class="my-auto">
                        {{--                    <button class="border-2 rounded-pill px-3 py-2 me-3 back-btn"><i class="fa fa-angle-left text-white fs-18"></i></button>--}}
                        <a href="{{ url()->previous() }}" class="border-2 rounded-pill px-3 py-2 me-3 back-btn">
                            <i class="fa fa-angle-left text-white fs-18"></i>
                        </a>
                    </div>
                    <div class="text-white text-center my-auto fs-5">Car Booking</div>
                    <div>
                        <ul class="navbar-nav navbar-light w-100 text-end text-lg-start">
                            <li class="nav-item ps-0 ps-lg-0 my-auto">
                                <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};">
                                    <button type="button" class="btn border bg-white text-blue rounded-pill me-1" id="login_user">Sign-In</button>
                                    <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                </div>
                                <div id="after_login_button" class="mt-1 mb-2 nav-link d-flex " style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                    <a href="{{ route('user.profile') }}" class="bg-white p-2 rounded-pill text-dark text-center my-auto ms-2 text-decoration-none fs-13 fw-600">View profile</a>
                                    <div class="ms-2">
                                        <p class="text-white p-2 rounded-pill bg-blue m-0 my-1 w-fit rounded-3 f-16 px-2 fs-13 fw-600" id="user_name">{{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : ''  }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
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
                        <img src="{{ asset('storage/car_image/' . $car_model->carModel->car_image ?? '') }}" alt="car-pic" class="img-fluid">
                    </div>
                    <div class="home-demo">
                        <div class="owl-carousel owl-carousel-6 owl-theme">
                            @if(!empty($image_list))
                                @foreach($image_list as $image)
                                    <div class="item">
                                        <img src="{{ asset('storage/car_other_image/'.$image->name) }}" alt="car-logo" class="img-fluid">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <div class="fs-14 fs-mb-10 fw-500 my-auto {{ $car_model->address ? '' : 'd-none' }}">
                            <img src="{{ asset('user/img/search-result/Group 4 (1).png') }}" alt="location icon" class="img-fluid me-1">
                            {{$car_model->address ?? ''}}
                        </div>
                        <div class="text-success fs-14 fs-mb-10 fw-500 my-auto">
                            <i class="fas fa-circle fs-12 fs-mb-9"></i> Available Now
                        </div>
                    </div>
                    <p class="fs-4 fw-600 my-3 m-0">
                        {{$car_model->carModel->model_name}}
                    </p>
                    <p class="d-lg-flex text-secondary fs-16">
                        <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-2 conf-icon">{{ $car_model->carModel->transmission }}
                        <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3"> {{ $car_model->carModel->seat.'Seats' }}
                        <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3">AC
                        <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3"> {{ $car_model->carModel->fuel_type }}
                    </p>
                    <div class=" mt-2">
                        <ul class="fs-6 fw-500 ps-3">
                            <li>Pricing Plan: Total {{!empty($car_model->carModel->per_day_km) ? $car_model->carModel->per_day_km *  !empty($price_list['different_hours']) ? $price_list['different_hours'] : 0 : $car_model->carModel->per_day_km }} kms, excludes fuel</li>
                            <li>Extra Hour: ₹{{ $car_model->carModel->extra_hours_price ?? '' }} / per hour</li>
                            <li>Extra Km: ₹{{ $car_model->carModel->extra_km_charge }} / per KM</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="p-3 bg-blue bdr-30 p-3 h-100">
                    <form>
                        @php
                            $city_list = \App\Models\City::where('city_status',1)->pluck('name','code')->toArray();
                            $city = !empty($city_list) ?  $city_list : [];
                        @endphp
                        <div class="container my-3">
                            <div class="me-0 mx-lg-2 my-auto">
                                <div class="text-white fs-14 mb-2 text-left">Selected Location</div>
                                <div class="d-flex text-white py-2 px-4 date-pick">
                                    <div class="fs-14">
                                        <i class="fa fa-map-marker me-2" aria-hidden="true"></i><span> {{ array_key_exists(session('city_id'), $city) ? $city[session('city_id')] : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">

                            <div class="d-block d-lg-flex justify-content-evenly">
                                <div class="me-0 me-lg-1 my-auto">
                                    <div class="text-white fs-14 mb-2 text-center">Pick Date & Time </div>
                                    <div class="d-flex text-white py-2 px-4 date-pick">
                                        <div class="fs-14">
                                            <i class="fa fa-calendar me-2"></i><span> {!! str_replace('|', '&nbsp;', Session::get('start_date', '')) !!}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-white my-auto fs-4 d-flex justify-content-center">
                                    <img src="{{ asset('user/img/heroicons_arrows-up-down.svg') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3 my-3">
                                </div>
                                <div class="ms-0 ms-lg-1">
                                    <div class="text-white fs-14 mb-2 text-center">Pick Date & Time </div>
                                    <div class="d-flex text-white py-2 px-4 date-pick">
                                        <div class="fs-14">
                                            <i class="fa fa-calendar me-2"></i><span> {!! str_replace('|', '&nbsp;', Session::get('end_date', '')) !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-4 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total Time</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">{{$price_list['total_days'] ?? 0 }} Day {{ $price_list['total_hours'] ?? 0 }}hr</p>
                        </div>
                        <div class="justify-content-between text-white mt-3 border-bottom border-1 {{ !empty($price_list['festival_amount']) ? 'd-flex' : 'd-none' }}">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total festival fare</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $price_list['festival_amount'] ?? 0  }}</p>
                        </div>
                        <div class="justify-content-between text-white mt-3 border-bottom border-1 {{!empty($price_list['week_end_amount']) ? 'd-flex' : 'd-none' }}">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Weekend fare</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{$price_list['week_end_amount'] ?? 0 }}</p>
                        </div>
                        <div class="justify-content-between text-white mt-3 border-bottom border-1 {{ !empty($price_list['week_days_amount']) ? 'd-flex' : 'd-none' }}">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total normal fare</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $price_list['week_days_amount'] ?? 0  }}</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Total base fare</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $price_list['total_price'] ?? 0  }}</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 mb-1 border-bottom border-1 toggle {{empty($general_section['show_delivery']) ? 'show' : ''}}">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Doorstep delivery & pickup</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $general_section['delivery_fee'] ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-2 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Refundable security deposit</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $car_model->carModel->dep_amount ?? 0 }} </p>
                        </div>
                        @php
                            $total_price = !empty($price_list['total_price']) ? $price_list['total_price'] : 0 ;
                            $coupon = !empty(session('coupon')) ? session('coupon') : [] ;
                            $delivery_fee = empty($general_section['show_delivery']) && !empty( $general_section['delivery_fee'] ) ? $general_section['delivery_fee'] : session('delivery_fee') ;
                            $sub_total_price = $total_price + $delivery_fee + $car_model->carModel->dep_amount ?? 0;

                            $type = !empty($coupon['type']) ? $coupon['type'] : 0 ;
                            $amount = !empty($type) && $type == 2 ? $coupon['discount'] : ($type == 1 ? ($total_price * $coupon['discount']) / 100 : 0);
                            $final_total = $sub_total_price - $amount ?? 0 ;
                        @endphp
                        <div class="{{!empty(session('coupon')) ? 'd-flex' : 'd-none'}} justify-content-between text-white mb-2 border-bottom border-1" id="coupon_message" >
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Coupon Amount</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">-
                                <span id="coupon_amount">{{ $amount }}</span> <br><a href="javascript:void(0)" class="remove-coupon fs-14">Remove</a></p>

                        </div>
                        <div class="d-flex justify-content-between text-white border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Insurance & GST</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Included</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Tolls, Parking & Inter-state taxes</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">To be paid by you</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3 border-bottom border-1">
                            <p class="fs-20 fs-mb-16 my-2">Total Price</p>
                            <span id="total_price">₹{{ $final_total }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-white mt-3">
                            <p class="fs-14 fs-mb-12 my-auto my-lg-2 w-100">Promo / Coupon Code</p>
                            <div class="input-group booking-inputs-2 my-auto w-100 h-50 border border-white rounded-pill">
                                <input type="text" class="form-control coupon-input" id="coupon_code">
                                <button type="button" class="input-group-text form-dates bg-light text-blue fs-12 fw-500 py-0 px-3 mx-auto mx-lg-0"
                                        id="apply_coupon">Apply</button>
                            </div>
                        </div>
                        <p id="discount_text" class="fs-14 fs-mb-12 mt-2 mb-3 text-success"></p>
                        <div class="mt-1 pt-2 mb-3">
                            <div class="mt-2 mt-lg-5">
                                <input type="hidden" id="final_coupon_amount" value="{{session('coupon_amount')}}">
                                <input type="hidden" id="door_delivery" value="{{$general_section['delivery_fee'] ?? 0}}">
                                <input type="hidden" id="final_amount" value="{{ session('booking_details.total_price') }}">
                                <input type="hidden" id="additional_amount" value="{{ $delivery_fee + $car_model->carModel->dep_amount ?? 0 }}">
                                <div class="text-white">
                                    <input type="hidden" id="drop_address_pine">
                                    <input type="hidden" id="pickup_address_pine">
                                    <p class="fs-20 fs-mb-16 my-1">
                                        Delivery location</p>
                                    <span id="drop_address" class="fs-14 fw-500">{{ session('delivery.address') ?? session('pick-delivery.address') ?? '' }}</span>
                                       <div id="check_delivery_location" class="{{ !empty(session('delivery.address')) || !empty(session('pick-delivery.address')) ? '' : 'd-none' }}">
                                           <button type="button" class="input-group-text form-dates fs-16 bg-transparent border-0 font-weight-normal p-0 "
                                                   id="delivery_location" style="color: #47ACFF !important;">Change</button>
                                       </div>


                                    <p class="fs-20 fs-mb-16 my-1">
                                        Return location </p>
                                    <span id="pickup_address" class="fs-14 fw-500">{{ session('pickup.address') ?? session('pick-delivery.address') ?? '' }}</span>
                                    <div id="check_pickup_location" class="{{ !empty(session('pickup.address')) || !empty(session('pick-delivery.address')) ? '' : 'd-none' }}">
                                    <button type="button" class="input-group-text form-dates fs-16 bg-transparent border-0 font-weight-normal p-0"
                                                id="return_location" style="color: #47ACFF !important;">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <div>
                                <div class="m-minus-top my-auto">
                                    <div class="mb-3 {{empty($general_section['show_delivery']) ? 'd-none' : 'd-flex'}}">
                                        <div>
                                            <label class="switch m-0">
                                                <input type="checkbox" id="delivery_amount">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div>
                                            <span class="fs-14 ms-2 text-white">Door Step Delivery</span>
                                        </div>
                                    </div>
                                    <div class="mb-3 mb-md-auto toggle">
                                        <button type="button" class="btn text-white fs-16 fs-mb-14 fw-500 border-white rounded-pill px-4 d-flex justify-content-center w-100 w-md-auto pickup_location">
                                            <img src="{{ asset('user/img/car-booking/Group.png') }}" alt="location icons" class="img-fluid d-block me-2"> Select Drop/Pickup Location
                                        </button>
                                    </div>
                                    <div class="mb-3 mb-md-auto me-3 {{ !empty($general_section['show_delivery']) ? 'd-none' : '' }}">
                                        <button type="button" class="btn text-white fs-16 fs-mb-14 fw-500 border-white rounded-pill px-4 d-flex justify-content-center w-100 w-md-auto pickup_location">
                                            <img src="{{ asset('user/img/car-booking/Group.png') }}" alt="location icons" class="img-fluid d-block me-2"> Select Drop/Pickup Location
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                    <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-5 fw-600 w-100 w-md-auto" style="display:{{ Auth::check() ? 'block' : 'none' }};" id="payment">Proceed Payment</button>
                                    <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-3 fw-600 w-100 w-md-auto"  style="display: {{ Auth::check() ? 'none' : 'block !important' }};" id="login_payment">Login To Proceed Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // When the payment button is clicked
    $(document).on('click', '#payment', async function(e) {
        let doc_verify = await verifyUserDocument();
        if (!doc_verify) {
            $('#user_document').modal('show');
            return;
        }

        let drop_address = "{{ session('delivery.address') ?? session('pick-delivery.address') ?? '' }}";
        let pickup_address = "{{ session('pickup.address') ?? session('pick-delivery.address') ?? '' }}";
        let drop_address_pine = $('#drop_address_pine').val();
        let pickup_address_pine = $('#pickup_address_pine').val();

        // Convert empty strings to 0
        drop_address = drop_address === "" ? 0 : drop_address;
        pickup_address = pickup_address === "" ? 0 : pickup_address;

        if (!drop_address_pine || !pickup_address_pine) {
            if (drop_address === 0 || pickup_address === 0) {
                $('#secondModal').modal('show');
                window.initMarker();
                return;
            }
        }
        // Ensure both values are correctly processed

        let user_booking = await verifyUserbooking();
        if (!user_booking) {
            let message = 'You have already booked for this date. Please select a different date.';
            $('#error_message').text(message);
            $('#login_alert').modal('show');
            return;
        }

        let coupon = $('#final_coupon_amount').val();
        let final_amount = {{ $total_price + $car_model->carModel->dep_amount + $delivery_fee }};
        let coupon_amount = coupon !== '' || coupon !== 0 ? coupon : 0;
        let total = Math.round((final_amount - coupon_amount) * 100);
        let options = {
            "key": "{{ config('services.razorpay.key') }}", // Your Razorpay key
            "amount":  total.toString(), // Amount in smallest currency unit (paise, for INR)
            "currency": "INR",
            "name": "{{ Auth::user()->name ?? 'Customer' }}",
            "description": "{{$car_model->carModel->model_name}}",
            "image": "https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png",
            "handler": function(response) {
                let paymentData = {
                    payment_id: response.razorpay_payment_id,
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    url: '/user/payment',
                    method: 'POST',
                    data: paymentData,
                    success: function(response) {
                        // If successful, redirect to the booking page
                        window.location.href = '/booking/success';
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors (optional)
                        console.error('Payment failed:', error);
                    }
                });
            },
            "prefill": {
                "name": "{{ Auth::user()->name ?? 'Customer' }}", // Prefilled customer name
                "email": "saran@gmail.com"
            },
            "theme": {
                "color": "#F37254"
            }
        };

        let rzp = new Razorpay(options);
        rzp.open(); // Opens Razorpay modal
    });

    async function verifyUserDocument() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/user/verify-document', // Update with your route.
                method: 'GET',
                success: function(response) {
                    if (!response.success) {
                        $('#otpModal').modal('hide');
                        resolve(false);
                    } else {
                        resolve(true);
                    }
                },
                error: function() {
                    resolve(false);
                }
            });
        });
    }

    async function verifyUserbooking() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/user/verify-booking', // Update with your route.
                method: 'GET',
                success: function(response) {
                    if (!response.success) {
                        resolve(false);
                    } else {
                        resolve(true);
                    }
                },
                error: function() {
                    resolve(false);
                }
            });
        });
    }


</script>

<!-- Second Modal Structure -->
<div class="modal fade m-0 m-md-auto" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content bdr-20">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="p-3">
                    <div id="delivery-section" class="slide-section">
                        <p class="fs-16 fw-500">Select delivery location</p>
                        <div class="container">
                            <div id="delivery_map" style="height: 500px; width: 100%;"></div>

                        </div>
                        <p class="fs-16 fw-500 mt-2"> Enter manually</p>
                        <input id="delivery-city" type="text" placeholder="Enter Your Delivery Location" class="form-control current_delivery_address">
                        <p class="text-danger" id="outside_area"></p>
                        <input type="hidden" id="dly_latitude" name="dly_latitude">
                        <input type="hidden" id="dly_longitude" name="dly_longitude">
                        <input type="hidden" id="dly_address" name="dly_address">
                        <p class="text-danger" id="delivery_outside_area"></p>
                        <div class="d-flex">
                            <button type="button" class="btn fs-16 my-button mt-4 w-50 w-lg-25" id="delivery_address">Confirm Location</button>
                            <button type="button" class="btn fs-16 my-drop-button mt-4 mx-2 w-50 w-lg-25" id="same_address">Same as Pickup Location</button>
                            <button type="button" class="btn fs-16 my-current-button rounded-pill mt-4 w-50 w-lg-25" id="drop_current_location">Current Location</button>
                        </div>
                    </div>

                    <div id="pickup-section" class="slide-section d-none">
                        <div class="d-flex">
                            <p class="fs-16 fw-500">Select return location</p>
                        </div>
                        <div class="container">
                            <div id="custom_map" style="height: 500px; width: 100%;"></div>
                        </div>
                        <p class="fs-16 fw-500 mt-2"> Enter manually</p>
                        <input id="custom-city" type="text" placeholder="Enter your return location" class="form-control current_pickup_address">
                        <input type="hidden" id="pic_latitude" name="pic_latitude" >
                        <input type="hidden" id="pic_longitude" name="pic_longitude" >
                        <input type="hidden" id="pic_address" name="pic_address" >
                        <p class="text-danger" id="pickup_outside_area"></p>
                        <div class="d-flex">
                            <button type="button" class="btn fs-16 my-button mt-4 w-50 w-lg-25" id="conform_address">Conform Location</button>
                            <button type="button" class="btn fs-16 my-current-button rounded-pill mt-4 w-50 w-lg-25" id="pick_current_location">Current Location</button>
                        </div>
                    </div>
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


