 <section>
        <div class="container">
            <div class="row">
                @if(!empty($car_models))
                    @foreach($car_models as $key => $model)
                <div class="col-6 col-lg-4">
                    <div class="r2dc-card-bg p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="bg-white rounded-pill w-fit px-1 fw-500 fs-15 my-auto">
                                    <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                                </div>
                            </div>
                            <div>
                                <div class="save-icon my-auto">
                                    <i class="fas fa-bookmark text-blue"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <img src="{{ asset('storage/car_image/' . $model->carModel->car_image ?? '') }}" alt="Cars" class="img-fluid w-100 mx-auto">
                        </div>
                    </div>

                    <div class="r2dc-card-content-bg p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fs-16 fw-600 m-0">
                                    {{ $model->carModel->model_name ?? '' }}
                                </p>

                                <p class="d-flex text-secondary fs-12">
                                    <img src="{{ asset('user/img/iconTransmission.png') }}" alt="icon" class="img-fluid me-1">{{ $model->carModel->transmission ?? '' }}
                                    <img src="{{ asset('user/img/iconSeat.png') }}" alt="icon" class="img-fluid mx-1"> {{ $model->carModel->seat.' Seats' }}
                                </p>
                            </div>
                            <div>
                                @php

                                    $prices = ['festival' =>  $model->carModel->peak_reason_surge ?? 0,
                'weekend' => $model->carModel->weekend_surge ?? 0,
                'weekday' =>  $model->carModel->price_per_hour ?? 0];
            $price_list = \App\Http\Controllers\User\UserController::calculatePrice($prices,session('start_date'),session('end_date'));
                                @endphp
                                <p class="fs-15 fw-600 mb-2">
                                    ₹{{ $price_list['total_price'] ?? '' }}
                                </p>
                                @if ($model['booking_status'] === 'available')
                                    <a href="{{ route('book.car', ['model_id' => $model->id]) }}" class="btn my-button fs-14">Book now</a>
                                @elseif ($model['booking_status'] === 'sold')
                                    <button type="button" class="sold-button btn btn-lg fs-14 float-end">Sold</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                        @if(($key + 1) % 3 == 0)
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
{{--                                        <button class="btn bg-white rounded-pill fw-600 text-blue my-4 p-1 px-3">Book your car now</button>--}}
                                    </div>
                                    <div class="col-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>


    </section>
