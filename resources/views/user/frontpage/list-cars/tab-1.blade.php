<section>
    @if (!empty($car_models))
        @foreach ($car_models as $key => $model)
            <div class="container">
                <div class="ac-car-active bdr-20 mb-3">
                    <div class="float-end p-3"
                        style="display: @if ($timing_setting['show_bookmarks'] == 1) inherit @else none @endif">
                        <div class="save-icon my-auto">
                            <i class="fas fa-bookmark text-blue"></i>
                        </div>
                    </div>
                    <div class="row gx-3 p-3">
                        <div class="col-3">
                            <div class="d-block">
                                <img src="{{ asset('storage/car_image/' . $model->carModel->car_image ?? '') }}"
                                    alt="cars" class="img-fluid w-100 car-list-image-for-grid">
                            </div>
                        </div>

                        <div class="col-7 my-auto">
                            <div class="ms-4">
                                <div class="d-flex"
                                    style="display: @if ($timing_setting['show_bookmarks'] == 1) flex @else none @endif !important">
                                    <div class="bg-white rounded-pill w-fit px-1 fw-600 fs-12 my-auto px-2 py-1">
                                        <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                    </div>
                                </div>
                                <p class="fs-4 fw-600 my-3 m-0">
                                    {{ $model->carModel->model_name ?? '' }}
                                </p>

                                <div class="fs-14 fw-500 my-3 {{ $model->address ? '' : 'd-none' }}">
                                    <img src="{{ asset('user/img/Group 4.svg') }}" alt="location icon"
                                        class="img-fluid me-1">
                                    {{ $model->address ?? '' }}
                                </div>

                                <p class="d-flex text-secondary fs-12">
                                    <img src="{{ asset('user/img/search-result/iconTransmission.png') }}" alt="icon"
                                        class="img-fluid me-1 conf-icon my-auto"> {{ $model->carModel->transmission ?? '' }}
                                    <img src="{{ asset('user/img/search-result/iconSeat.png') }}" alt="icon"
                                        class="img-fluid mx-1 conf-icon my-auto ms-4"> {{ $model->carModel->seat . ' Seats' }}
                                    <img src="{{ asset('user/img/search-result/material-symbols-light_air.png') }}"
                                        alt="icon" class="img-fluid mx-1 conf-icon my-auto ms-4">AC
                                    <img src="{{ asset('user/img/search-result/streamline_gas-station-fuel-petroleum.png') }}"
                                        alt="icon" class="img-fluid mx-1 conf-icon my-auto ms-4">
                                    {{ $model->carModel->fuel_type }}
                                </p>
                            </div>
                        </div>

                        <div class="col-2 my-auto">
                            <div class="my-2">
                                @php

                                    $prices = [
                                        'festival' => $model->carModel->peak_reason_surge ?? 0,
                                        'weekend' => $model->carModel->weekend_surge ?? 0,
                                        'weekday' => $model->carModel->price_per_hour ?? 0,
                                    ];
                                    $price_list = \App\Http\Controllers\User\UserController::calculatePrice(
                                        $prices,
                                        session('start_date'),
                                        session('end_date'),
                                    );
                                @endphp
                                <div class="fs-4 fw-600 text-center w-75"> ₹{{ $price_list['total_price'] ?? '' }}</div>
                            </div>
                            @if ($model['booking_status'] === 'available')
                                <a href="{{ route('book.car', ['model_id' => $model->id]) }}"
                                    class="btn my-button py-2 px-3 w-75">Book now</a>
                            @elseif ($model['booking_status'] === 'sold')
                                <button type="button" class="sold-button btn btn-lg fs-14 float-end">Sold</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    <div class="rrr py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-8 my-auto p-3">
                    <div class="text-white fs-2 fw-600">
                        Rent. Ride. Repeat.
                    </div>
                    <div class="text-white fs-14 fw-500 my-2">
                        Discover your perfect ride, wherever your journey takes you.<br> We've got it all,
                        ready for your next adventure—super cool!
                    </div>
                    {{--                                <button class="btn bg-white rounded-pill fw-600 text-blue my-4 p-1 px-3">Book your car now</button> --}}
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </div>
</section>
