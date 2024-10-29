
<section class="my-3 my-lg-4">
    @php
            $rating = !empty($section4['rating']) ? $section4['rating'] : 4.5 ;
            $fullStars = floor($rating); // Full stars
            $halfStar = ($rating - $fullStars) >= 0.5; // Check if there's a half star
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Remaining stars
 @endphp
    <div class="container">
        <p class="fs-18 fw-600 fs-mb-12 m-0 mb-3">
            {{ $section4['car_information'] ?? 'Coimbatore Car Rental: Real Time Information' }}
        </p>
        <div class="bg-grey-sec-4 p-4 p-md-1 p-lg-4">
            <div class="row">
                <div class="col-6 col-lg-3 d-block d-md-flex justify-content-center bdr-ryt-grey">
                    <div>
                        <img src="{{ asset('user/img/Group 6564.png') }}" alt="Icon" class="img-fluid d-block me-auto me-lg-4 mb-2 mb-lg-auto mt-1 mt-lg-auto ccr-img">
                    </div>
                    <div class="my-auto">
                        <div class="fs-18 fs-mb-12 fw-600 m-0">₹{{ $section4['daily_price'] ?? '' }}</div>
                        <div class="fs-12 fs-mb-10 text-secondary">{{ $section4['daily_price_title'] ?? '' }}</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 d-block d-md-flex justify-content-center bdr-ryt-grey">
                    <div>
                        <img src="{{ asset('user/img/Group 6564 (1).png') }}" alt="Icon" class="img-fluid d-block me-auto me-lg-4 mb-2 mb-lg-auto mt-1 mt-lg-auto ccr-img">
                    </div>
                    <div class="my-auto">
                        <div class="fs-18 fs-mb-12 fw-600 m-0">{{ $section4['car_model'] ?? '' }}</div>
                        <div class="fs-12 fs-mb-10 text-secondary">{{ $section4['car_model_title'] ?? '' }}</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 d-block d-md-flex justify-content-center bdr-ryt-grey">
                    <div>
                        <img src="{{ asset('user/img/Group 6564 (2).png') }}" alt="Icon" class="img-fluid d-block me-auto me-lg-4 mb-2 mb-lg-auto mt-3 mt-lg-auto ccr-img">
                    </div>
                    <div class="my-auto">
                        <div class="fs-18 fs-mb-12 fw-600 m-0">₹{{ $section4['hour_rate'] ?? '' }} <sub class="text-secondary">per hour</sub></div>
                        <div class="fs-12 fs-mb-10 text-secondary">{{ $section4['hour_rate_title'] ?? '' }}</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 d-block d-md-flex justify-content-center">
                    <div>
                        <img src="{{ asset('user/img/Group 6564.png') }}" alt="Icon" class="img-fluid d-block me-auto me-lg-4 mb-2 mb-lg-auto mt-3 mt-lg-auto ccr-img">
                    </div>
                    <div class="my-auto">
                        <div class="fs-18 fs-mb-12 fw-600 m-0">{{ $section4['rating'] ?? '' }}
                            {{-- Full stars --}}
                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star fs-14" style="color:#E66742;"></i>
                            @endfor

                            {{-- Half star --}}
                            @if($halfStar)
                                <i class="fas fa-star-half-alt fs-14" style="color:#E66742;"></i>
                            @endif

                            {{-- Empty stars --}}
                            @for($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star fs-14" style="color:#E66742;"></i>
                            @endfor
                        <div class="fs-12 fs-mb-10 text-secondary">Avg Rating all cars</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-3 my-lg-4">
    <div class="container">
        <p class="fs-18 fw-600 fs-mb-12 m-0 mb-3">
            {{ $section4['valam_title'] ?? 'Why Valam?' }}
        </p>
        <div class="row g-3">
            <div class="col-6 col-lg-3">
                <div class="p-2 y-valam-card d-block d-lg-flex">
                    <div class="my-auto">
                        <img src="{{ asset('user/img/Group 6572.png') }}" alt="Icon" class="img-fluid d-block mb-2 mb-lg-0">
                    </div>
                    <div class="ms-0 ms-lg-2 my-auto">
                        <div class="fs-12 fs-mb-11 fw-600">
                            {{ $section4['flexibility'] ?? '' }}
                        </div>
                        <div class="fs-12 fs-mb-9">
                            {{ $section4['flexibility_description'] ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-2 y-valam-card d-block d-lg-flex">
                    <div class="my-auto">
                        <img src="{{ asset('user/img/Group 6572 (1).png') }}" alt="Icon" class="img-fluid d-block mb-2 mb-lg-0">
                    </div>
                    <div class="ms-0 ms-lg-2 my-auto">
                        <div class="fs-12 fs-mb-11 fw-600">
                            {{ $section4['maintained'] ?? '' }}
                        </div>
                        <div class="fs-12 fs-mb-9">
                            {{ $section4['maintained_description'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-2 y-valam-card d-block d-lg-flex">
                    <div class="my-auto">
                        <img src="{{ asset('user/img/Group 6572 (3).png') }}" alt="Icon" class="img-fluid d-block mb-2 mb-lg-0">
                    </div>
                    <div class="ms-0 ms-lg-2 my-auto">
                        <div class="fs-12 fs-mb-11 fw-600">
                            {{ $section4['delivery'] ?? '' }}
                        </div>
                        <div class="fs-12 fs-mb-9">
                            {{ $section4['delivery_description'] ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="p-2 y-valam-card d-block d-lg-flex">
                    <div class="my-auto">
                        <img src="{{ asset('user/img/Group 6572 (3).png') }}" alt="Icon" class="img-fluid d-block mb-2 mb-lg-0">
                    </div>
                    <div class="ms-0 ms-lg-2 my-auto">
                        <div class="fs-12 fs-mb-11 fw-600">
                            {{ $section4['price'] ?? '' }}
                        </div>
                        <div class="fs-12 fs-mb-9">
                            {{ $section4['price_description'] ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-3 my-lg-4">
    <div class="container">
        <div class="row gx-3">
            <div class="col-12 col-lg-4 ">
                <div class="bg-grey-sec-6">
                    <div class="p-4 d-flex flex-column gap-2 gap-lg-5">
                        <div>
                            <p class="text-blue fs-4 fw-600">{{ $section4['travel'] ?? "LET'S TRAVEL TOGETHER!" }}</p>
                            <p class="fs-14">{{ $section4['travel_description'] ?? ''}}</p>
                        </div>
                        <button class="my-button btn fs-mb-12">Book Us for Safety Ride</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="ltt-bg">
                    <div class="p-0 p-lg-2 py-5">
                        <div class="row gx-2">
                            <div class="col-5">
                                <div class="d-flex flex-column justify-content-between ms-2">
                                    <div>
                                        <p class="text-secondary fs-14 fs-mb-9 mb-1">
                                            <i class="fa-solid fa-car"></i> {{ $section['valam_ride'] ?? 'Ride Safe with Valam' }}
                                        </p>
                                        <p class="fs-16 fs-mb-9 fw-600 my-2 my-lg-3">{!! $section4['description'] ?? '' !!}</p>
                                        <div class="d-flex fs-14 fs-mb-9 my-0 my-md-3 my-lg-0 text-blue">
                                            <img src="{{ asset('user/img/bxs_offer.svg') }}" alt="Bagde Percentage" class="img-fluid d-block badge-perc-2 me-1 me-lg-2"> <span class="fs-18 fs-mb-9 fw-600 my-auto">  {{ $section4['discount'] ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="my-button btn mt-2 mt-lg-0 mt-lg-3 fs-mb-9 p-1 p-auto">To Know More Offers</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <img src="{{ asset('user/img/Component 9.png') }}" alt="Car Image" class="img-fluid d-block car-fits">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

