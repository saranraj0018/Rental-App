
<section>
    @if(!empty($car_models))
        @foreach($car_models as $key => $model)
            <div class="container">
                <div class="ac-car-active bdr-20 mb-3">
                    <div class="float-end p-3">
                        <div class="save-icon my-auto">
                            <i class="fas fa-bookmark text-blue"></i>
                        </div>
                    </div>
                    <div class="row gx-3 p-3">
                        <div class="col-5">
                            <div class="d-block">
                                <img src="{{ asset('storage/car_image/' . $model->carModel->car_image ?? '') }}" alt="cars" class="img-fluid w-100">
                            </div>
                        </div>

                        <div class="col-5 my-auto">
                            <div class="ms-4">
                                <div class="d-flex">
                                    <div class="bg-white rounded-pill w-fit px-1 fw-600 fs-12 my-auto px-2 py-1">
                                        <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                    </div>
                                </div>
                                <p class="fs-4 fw-600 my-3 m-0">
                                    {{ $model->carModel->model_name ?? '' }}
                                </p>
                                <p class="fs-5 fw-600 my-3 m-0">
                                    <i class="fas fa-map-marker-alt text-blue me-2"></i>
                                    R.S Puram
                                </p>
                                <div class="fs-14 fw-500 my-3 {{ $model->address ? '' : 'd-none' }}">
                                    <img src="{{ asset('user/img/Group 4.svg') }}" alt="location icon" class="img-fluid me-1">
                                    {{ $model->address ?? '' }}
                                </div>

                                <p class="d-flex text-secondary fs-12">
                                    <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-1 conf-icon"> {{ $model->carModel->transmission ?? '' }}
                                    <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->carModel->seat.' Seats' }}
                                    <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3">AC
                                    <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->carModel->fuel_type }}
                                </p>
                            </div>
                        </div>

                        <div class="col-2 my-auto">
                            <div class="my-2">
                                @php

                                $prices = ['festival' =>  $model->carModel->peak_reason_surge ?? 0,
            'weekend' => $model->carModel->weekend_surge ?? 0,
            'weekday' =>  $model->carModel->price_per_hour ?? 0];
        $price_list = \App\Http\Controllers\User\UserController::calculatePrice($prices,session('start_date'),session('end_date'));
                                @endphp
                                <div class="fs-3 fw-600"> ₹{{ $price_list['total_price'] ?? '' }}</div>
                            </div>
                                <a href="{{ route('book.car', ['model_id' => $model->id]) }}" class="btn my-button p-1 px-3 w-75">Book now</a>

                        </div>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0)
                <div class="rrr py-5 my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-8 my-auto p-3">
                                <div class="text-white fs-2 fw-600">
                                    Rent. Ride. Repeat.
                                </div>
                                <div class="text-white fs-14 fw-500 my-2">
                                    Discover your perfect ride, wherever your journey takes you.<br> We've got it all, ready for your next adventure—super cool!
                                </div>
                                <button class="btn bg-white rounded-pill fw-600 text-blue my-4 p-1 px-3">Book your car now</button>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif


</section>
