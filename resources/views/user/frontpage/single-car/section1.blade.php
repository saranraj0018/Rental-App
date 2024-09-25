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
                    <p class="d-flex text-secondary fs-16">
                        <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-2 conf-icon">{{ $car_model->carModel->transmission }}
                        <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3"> {{ $car_model->carModel->seat.'Seats' }}
                        <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3">AC
                        <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-2 conf-icon ms-3"> {{ $car_model->carModel->fuel_type }}
                    </p>
                    <div class=" mt-2">
                        <ul class="fs-6 fw-500 ps-3">
                            <li>Pricing Plan: Per day {{$car_model->carModel->per_day_km ?? ''}} kms, excludes fuel</li>
                            <li>Extra Hour: ₹{{ $car_model->carModel->extra_hours_price ?? '' }} / per hour</li>
                            <li>Extra Km: ₹{{ $car_model->carModel->extra_km_charge }} / per KM</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="p-3 bg-blue bdr-30 p-3 h-100">
                    <form action="">
                        <div class="d-none d-lg-block">
                            <div class="d-flex justify-content-evenly">
                                <div class="me-0 me-lg-1 my-auto">
                                    <div class="text-white fs-14 mb-2 text-center">Pick Date & Time </div>
                                    <div class="d-flex text-white py-2 px-4 date-pick">
                                        <div class="fs-14">
                                            <i class="fa fa-calendar me-2"></i><span> {!! str_replace('|', '&nbsp;', Session::get('start_date', '')) !!}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-white my-auto fs-4">
                                    <img src="{{ asset('user/img/heroicons_arrows-up-down.svg') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3">
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
                        <div class="d-flex justify-content-between text-white mt-3 mb-1 border-bottom border-1 toggle">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Doorstep delivery & pickup</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹500</p>
                        </div>
                        <div class="d-flex justify-content-between text-white mb-2 border-bottom border-1">
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">Refundable security deposit</p>
                            <p class="fs-14 fs-mb-12 mt-2 mb-3">₹{{ $car_model->carModel->dep_amount ?? 0 }} </p>
                        </div>
                        @php
                            $total_price = !empty($price_list['total_price']) ? $price_list['total_price'] : 0 ;
                            $sub_total_price = $total_price + $car_model->carModel->dep_amount ?? 0;
                            $coupon = !empty(session('coupon')) ? session('coupon') : [] ;
                            $type = !empty($coupon['type']) ? $coupon['type'] : 0 ;
                            $amount = !empty($type) && $type == 1 ? $coupon['discount'] : ($type == 2 ? ($sub_total_price * $coupon['discount']) / 100 : 0);
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
                                @php
                                     $final_total = $sub_total_price - $amount ?? 0;
                                    @endphp
                                <input type="hidden" id="coupon_before" value="{{$sub_total_price}}">
                                <div class="text-white">
                                    <p class="fs-20 fs-mb-16 my-2 text-end">
                                        Total Price ₹<span id="total_price">{{ $final_total }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="toggle-fade">
                            <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-5 fw-600 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#mobileModal">Proceed Payment</button>
                        </div>
                        <div class="d-flex justify-content-between flex-column flex-md-row toggle">
                            <div class="mb-3 mb-md-auto">
                                <button type="button" class="btn text-white fs-16 fs-mb-14 fw-500 border-white rounded-pill px-4 d-flex justify-content-center w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#secondModal">
                                    <img src="{{ asset('user/img/car-booking/Group.png') }}" alt="location icons" class="img-fluid d-block me-2"> Select Your Location</button>
                            </div>

                            <div>
                                <button type="button" class="btn bg-white rounded-pill text-blue text-center fs-16 fs-mb-14 px-5 fw-600 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#mobileModal">Proceed Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    <p class="fs-16 fw-500 mt-2"> Enter manually</p>
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
{{--<script async src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMarker"></script>--}}


