{{--<section class="my-4">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-6 d-none d-lg-block">--}}
{{--                <div class="card p-3 bdr-30">--}}
{{--                    <p class="fs-18 fw-500">Sanitised and safe cars</p>--}}

{{--                    <div class="row p-0">--}}
{{--                        <div class="col-3 d-flex flex-column">--}}
{{--                            <img src="{{ asset('user/img/car-booking/Vector.png') }}" alt="" class="img-fluid mx-auto my-2">--}}
{{--                            <p class="fs-14 fw-500 text-center lh-sm">Full Car<br> Sanitization</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 d-flex flex-column">--}}
{{--                            <img src="{{ asset('user/img/car-booking/doorstep-delivery 1.png') }}" alt="" class="img-fluid mx-auto my-2">--}}
{{--                            <p class="fs-14 fw-500 text-center lh-sm">Full Car<br> Sanitization</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 d-flex flex-column">--}}
{{--                            <img src="{{ asset('user/img/car-booking/Frame.png') }}" alt="" class="img-fluid mx-auto my-2">--}}
{{--                            <p class="fs-14 fw-500 text-center lh-sm">Full Car<br> Sanitization</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 d-flex flex-column">--}}
{{--                            <img src="{{ asset('user/img/car-booking/Capa_1.png') }}" alt="" class="img-fluid mx-auto my-2">--}}
{{--                            <p class="fs-14 fw-500 text-center lh-sm">Full Car<br> Sanitization</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<section class="my-4 bg-grey py-4">
    <div class="container">
        <div class="text-blue fs-5 fw-600">
            {{ $ipr_data['point_title'] ?? 'Important Points To Remember' }}
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="ipr-card p-3 bdr-10 d-flex flex-column justify-content-between h-100">
                    <div>
                        <p class="fs-16 fw-500 mb-2">{{  $ipr_data['price_plan'] ?? '' }}</p>
                        <p class="fs-14 text-justify">{{ $ipr_data['price_description'] ?? ''}}</p>
                    </div>
                    <div>
                        <img src="{{ asset('user/img/car-booking/Group 35379.png') }}" alt="IPR image" class="img-fluid mt-4">
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="ipr-card p-3 bdr-10 d-flex flex-column justify-content-between h-100">
                    <div>
                        <p class="fs-16 fw-500 mb-2">{{ $ipr_data['fuel'] ?? '' }}</p>
                        <p class="fs-14 text-justify">{{ $ipr_data['fuel_description'] ?? '' }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('user/img/car-booking/Group 35379s.png') }}" alt="IPR image" class="img-fluid mt-4">
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="ipr-card p-3 bdr-10 d-flex flex-column justify-content-between h-100">
                    <div>
                        <p class="fs-16 fw-500 mb-2">{{ $ipr_data['picture_id'] ?? '' }}</p>
                        <p class="fs-14 text-justify">{{ $ipr_data['picture_description'] ?? '' }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('user/img/car-booking/Group 353792.png') }}" alt="IPR image" class="img-fluid mt-4">
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="ipr-card p-3 bdr-10 d-flex flex-column justify-content-between h-100">
                    <div>
                        <p class="fs-16 fw-500 mb-2">{{ $ipr_data['car_key'] ?? '' }}</p>
                        <p class="fs-14 text-justify">{{ $ipr_data['car_key_description'] ?? '' }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('user/img/car-booking/Group 353791.png') }}" alt="IPR image" class="img-fluid mt-4">
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="my-4">
    <div class="container">
        <div class="mb-3">
            <p class="fs-18 fw-600 fs-mb-12 m-0">
                Similer cars for your needs
            </p>
        </div>
        @if(!empty($available_cars))
        <div class="home-demo">
            <div class="owl-carousel owl-carousel-7 owl-theme">
                @foreach($available_cars as $cars)
                <div class="item">
                    <div class="r2dc-card-bg p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="bg-white rounded-pill w-fit px-1 fw-500 fs-15 my-auto"
                                     style="display: @if ($general_section['show_bookmarks'] == 1) unset @else none @endif !important">
                                    <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                </div>
                            </div>
                            <div   style="display: @if ($general_section['show_bookmarks'] == 1) unset @else none @endif !important">
                                <div class="save-icon my-auto">
                                    <i class="fas fa-bookmark text-blue"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <img src="{{ asset('storage/car_image/' . $cars->carModel->car_image ?? '') }}" alt="cars" class="img-fluid w-100">
                        </div>
                    </div>
                    <div class="r2dc-card-content-bg p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fs-15 fw-600">
                                    {{ $cars->carModel->model_name ?? '' }}
                                </p>
                                <p class="d-flex text-secondary fs-12">
                                    <img src="{{ asset('user/img/iconTransmission.png') }}" alt="icon" class="img-fluid me-1"> {{ $cars->carModel->transmission ?? '' }}
                                    <img src="{{ asset('user/img/iconSeat.png') }}" alt="icon" class="img-fluid mx-1">  {{ $cars->carModel->seat.' Seats' }}
                                </p>
                            </div>
                            <div>
                                @php
                                    $prices = ['festival' =>  $cars->carModel->peak_reason_surge ?? 0,
                                                'weekend' => $cars->carModel->weekend_surge ?? 0,
                                                'weekday' =>  $cars->carModel->price_per_hour ?? 0];
            $price_list = \App\Http\Controllers\User\UserController::calculatePrice($prices,session('start_date'),session('end_date'));
                                @endphp
                                <p class="fs-15 fw-600 mb-2">
                                    ₹{{ $price_list['total_price'] ?? '' }}<span class="fw-500 fs-12"></span>
                                </p>
                            @if ($cars['booking_status'] === 'available')
                                <a href="{{ route('book.car', ['model_id' => $cars->id]) }}" class="my-button p-1 px-3 w-100 btn fs-14">Book now</a>
                            @elseif ($cars['booking_status'] === 'sold')
                                <button type="button" class="sold-button btn btn-lg fs-14 float-end">Sold</button>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
