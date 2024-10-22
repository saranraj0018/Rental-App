<section class="mt-3 mb-5">
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="my-auto">
                <p class="fs-18 fw-600 fs-mb-12 m-0">
                    Ready to Drive Cars?
                </p>
            </div>
            <div>
                <button class="btn text-blue fs-16 fs-mb-12 fw-500">View All <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="home-demo">
            <div class="owl-carousel owl-carousel-5 owl-theme">
                @if(!empty($section3))
                    @foreach($section3 as $item)
                        <div class="item">
                            <div class="r2dc-card-bg p-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="bg-white rounded-pill w-fit px-2 py-1 fw-500 fs-15 my-auto">
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
                                    <img src="{{ asset('storage/car_image/' . $item->carModel->car_image ?? '') }}" alt="Cars" class="img-fluid w-75 mx-auto">
                                </div>
                            </div>
                            <div class="r2dc-card-content-bg p-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fs-15 fw-600 m-0">
                                           {{ $item->carModel->model_name ?? '' }}
                                        </p>
                                        <p class="fs-15 fw-600 my-2">
                                            <i class="fas fa-map-marker-alt text-blue me-2"></i>
                                            {{ $item->carModel->model_name ?? '' }}
                                        </p>
                                        <p class="d-flex text-secondary fs-12">
                                            <img src="{{ asset('user/img/iconTransmission.png') }}" alt="icon" class="img-fluid me-1"> {{ $item->carModel->transmission ?? ''}}
                                            <img src="{{ asset('user/img/iconSeat.png') }}" alt="icon" class="img-fluid mx-1">
                                            {{ $item->carModel->seat.' Seats' ?? ''}}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="fs-15 fw-600 mb-2">
                                            ₹ {{ $item->carModel->price_per_hour ?? ''}} <span class="fw-500 fs-12">per hours</span>
                                        </p>
                                        <a href="{{ route('book.car', ['model_id' => $item->id]) }}" class="my-button btn btn-lg fs-14 float-end">Book now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="item">
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
                                <img src="{{ asset('user/img/Group (2).png') }}" alt="Cars" class="img-fluid w-75 mx-auto">
                            </div>
                        </div>
                        <div class="r2dc-card-content-bg p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fs-15 fw-600">
                                        Maruthi Swift
                                    </p>
                                    <p class="d-flex text-secondary fs-12">
                                        <img src="{{ asset('user/img/iconTransmission.png') }}" alt="icon" class="img-fluid me-1"> Automatic <img src="{{ asset('user/img/iconSeat.png') }}" alt="icon" class="img-fluid mx-1"> 5 Seats
                                    </p>
                                </div>
                                <div>
                                    <p class="fs-15 fw-600 mb-2">
                                        ₹3144 <span class="fw-500 fs-12">per day</span>
                                    </p>
                                    <button class="my-button btn fs-14">
                                        Book now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
