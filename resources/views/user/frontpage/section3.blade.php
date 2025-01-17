<section class="mt-3 mb-5">
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="my-auto">
                <p class="fs-18 fw-600 fs-mb-12 m-0">
                    Ready to Drive Cars?
                </p>
            </div>
            <div>
                <button class="btn text-blue fs-16 fs-mb-12 fw-500 view_all">View All <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        @if (!empty($section3))
            <div class="home-demo">
                <div class="owl-carousel owl-carousel-5 owl-theme">

                    @foreach ($section3 as $item)
                        <div class="item">
                            <div class="r2dc-card-bg px-3 py-1">
                                <div class="d-flex justify-content-between"
                                    style="display: @if (!empty($timing_setting['show_bookmarks']) && $timing_setting['show_bookmarks'] == 1) flex @else none @endif !important">
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
                                    <img src="{{ asset('storage/car_image/' . $item->carModel->car_image ?? '') }}"
                                        alt="Cars" class="img-fluid w-75 mx-auto car-list-image">
                                </div>
                            </div>
                            <div class="r2dc-card-content-bg py-2 px-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fs-5 fw-600 m-0">
                                            {{ $item->carModel->model_name ?? '' }}
                                        </p>
                                        <p class="d-flex text-secondary fs-12 m-0">
                                            <img src="{{ asset('user/img/iconTransmission.png') }}" alt="icon"
                                                class="img-fluid my-auto me-1"> {{ $item->carModel->transmission ?? '' }}
                                            <img src="{{ asset('user/img/iconSeat.png') }}" alt="icon"
                                                class="img-fluid my-auto mx-1">
                                            {{ $item->carModel->seat . ' Seats' ?? '' }}
                                        </p>
                                        <p class="fs-5 fw-600">
                                            ₹ {{ $item->carModel->price_per_hour ?? '' }} <span class="fw-500 fs-12">per
                                                hour</span>
                                        </p>
                                    </div>
                                    <div class="my-auto">
                                        <button type="button" value="{{ $item->id }}" id="car_book_id"
                                            class="my-button btn btn-lg fs-16 py-2 px-3 float-end book_now">Book now</button>
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
