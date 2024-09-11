
    <section>
        <div class="container">
            @if(!empty($car_models))
            @foreach($car_models as $key => $model)
                    @if($key >= 0 && $key <= 2 )
            <div class="ac-car-active bdr-20 mb-3">
                <div class="float-end p-3">
                    <div class="save-icon my-auto">
                        <i class="fas fa-bookmark text-blue"></i>
                    </div>
                </div>
                <div class="row gx-3 p-3">
                    <div class="col-4">
                        <div class="d-block">
                            <img src="{{ asset('storage/car_image/' . $model->car_image ?? '') }}" alt="cars" class="img-fluid w-100">
                        </div>
                    </div>

                    <div class="col-5 my-auto">
                        <div class="ms-4">
                            <div class="d-flex">
                                <div class="bg-white rounded-pill w-fit px-1 fw-600 fs-12 my-auto px-2 py-1">
                                    <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                </div>
                                <div class="bg-white rounded-pill w-fit fw-600 fs-12 my-auto ms-1 px-3 py-1">
                                    Available from 4 Aug 2024
                                </div>
                            </div>
                            <p class="fs-4 fw-600 my-3 m-0">
                                {{ $model->model_name ?? '' }}
                            </p>
                            <div class="fs-14 fw-500 my-3">
                                <img src="{{ asset('user/img/Group 4.svg') }}" alt="location icon" class="img-fluid me-1"> RS Puram,Coimbatore.
                            </div>

                            <p class="d-flex text-secondary fs-12">
                                <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-1 conf-icon"> {{ $model->transmission ?? '' }}
                                <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->seat.' Seats' }}
                                <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3">AC
                                <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->fuel_type }}
                            </p>
                        </div>
                    </div>

                    <div class="col-3 my-auto">
                        <div class="d-block fs-4 text-blue fw-600">
                            <img src="{{ asset('user/img/bxs_offer.svg') }}" alt="cars" class="img-fluid">10% <span class="fs-15">for new users*</span>
                        </div>
                        <div class="my-2">
                            <div class="fs-3 fw-600">₹3144 <span class="fs-16 fw-500">/ per day</span></div>
                        </div>
                        <a href="{{ route('book.car', ['model_id' => $model->car_model_id]) }}" class="btn my-button p-1 px-3 w-50">Book now</a>
                    </div>
                </div>
            </div>
                    @endif
            @endforeach
            @endif
        </div>


        <div class="rrr p-3 my-5">
            <div class="container">
                <div class="row">
                    <div class="col-8 my-auto p-3">
                        <div class="text-white fs-3 fw-600">
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

        <div class="container">
            @if(!empty($car_models))
                @foreach($car_models as $key => $model)
                    @if($key > 2 )
                        <div class="ac-car-active bdr-20 mb-3">
                            <div class="float-end p-3">
                                <div class="save-icon my-auto">
                                    <i class="fas fa-bookmark text-blue"></i>
                                </div>
                            </div>
                            <div class="row gx-3 p-3">
                                <div class="col-4">
                                    <div class="d-block">
                                        <img src="{{ asset('storage/car_image/' . $model->car_image ?? '') }}" alt="cars" class="img-fluid w-100">
                                    </div>
                                </div>

                                <div class="col-5 my-auto">
                                    <div class="ms-4">
                                        <div class="d-flex">
                                            <div class="bg-white rounded-pill w-fit px-1 fw-600 fs-12 my-auto px-2 py-1">
                                                <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                            </div>
                                            <div class="bg-white rounded-pill w-fit fw-600 fs-12 my-auto ms-1 px-3 py-1">
                                                Available from 4 Aug 2024
                                            </div>
                                        </div>
                                        <p class="fs-4 fw-600 my-3 m-0">
                                            {{ $model->model_name ?? '' }}
                                        </p>
                                        <div class="fs-14 fw-500 my-3">
                                            <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="location icon" class="img-fluid me-1"> RS Puram,Coimbatore.
                                        </div>

                                        <p class="d-flex text-secondary fs-12">
                                            <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon" class="img-fluid me-1 conf-icon"> {{ $model->transmission ?? '' }}
                                            <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->seat.' Seats' }}
                                            <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3">AC
                                            <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}" alt="icon" class="img-fluid mx-1 conf-icon ms-3"> {{ $model->fuel_type }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-3 my-auto">
                                    <div class="d-block fs-4 text-blue fw-600">
                                        <img src="{{ asset('user/img/bxs_offer.svg') }}" alt="cars" class="img-fluid">10% <span class="fs-15">for new users*</span>
                                    </div>
                                    <div class="my-2">
                                        <div class="fs-3 fw-600">₹3144 <span class="fs-16 fw-500">/ per day</span></div>
                                    </div>
                                    <a href="{{ route('book.car', ['model_id' => $model->car_model_id]) }}" class="btn my-button p-1 px-3 w-50">Book now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </section>
