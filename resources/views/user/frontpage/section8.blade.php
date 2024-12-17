<section>
    <div class="container">
        <p class="fs-18 fw-600 fs-mb-12 m-0 mb-3">
            {{ !empty($section['brand_title']) ? $section['brand_title'] : 'Popular Brands' }}
        </p>

        <div class="home-demo">
            <div class="owl-carousel owl-carousel-3 owl-theme">
                @if(!empty($brand_image))
                @foreach($brand_image as $key => $image)
                        @if(!empty($image->slug) && $image->slug == 'brand-image')
                            <div class="item">
                                <img src=" {{ !empty($image->name) ? asset('storage/brand-section/' . $image->name) : asset('admin/img/01.png') }}" alt="car-logo" class="img-fluid">
                            </div>
                        @endif
                @endforeach
                    @else
                <div class="item">
                    <img src="{{ asset('user/img/02 (3).png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/03 (3).png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/04 (1).png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/05 (2).png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/06 (1).png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/07.png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/08.png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/09.png') }}" alt="car-logo" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{ asset('user/img/10 (1).png') }}" alt="car-logo" class="img-fluid">
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <div class="my-auto">
                <p class="fs-18 fw-600 fs-mb-12 m-0">
                    FAQ
                </p>
            </div>
            <div>
                <a href="{{ url('/') }}/user/faq" class="btn text-blue fs-16 fs-mb-12 fw-500">View All <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="accordion" id="faqAccordion">
            <!-- First Item (Open by Default) -->
            @if(filled($faq_items))
                @foreach($faq_items as $item)
                    @php $value = !empty($item['data_values']) ? json_decode($item['data_values']) : null ;@endphp
                    <div class="accordion-item bg-grey bdr-20 my-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$item->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{ $value->question ?? '' }}
                            </button>
                        </h2>
                        <div id="collapseOne_{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body py-3 fs-mb-14 text-justify">
                                {{ $value->answer ?? '' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="accordion-item bg-grey bdr-20 my-2">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Is there a speed limit?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body py-3 fs-mb-14 text-justify">
                        Valam allows up to 125 km/hr. However it is 80 km/hr in a few cities where some cars might be equipped with speed governors as per government directives. Revv strictly advises to follow local speed limits.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
