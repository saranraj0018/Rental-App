<section class="vt-bg">
    <div class="container my-5 py-5">
        <div class="d-flex justify-content-between mb-3">
            <div class="my-auto">
                <p class="fs-18 fw-600 fs-mb-12 m-0">
                    {{ !empty($section8['vacation_trip']) ? $section8['vacation_trip'] : 'Where to next vacation trip?' }}
                </p>
            </div>
            <div>
                <!--<button class="btn text-blue fs-16 fs-mb-12 fw-500">View All <i class="fas fa-chevron-right"></i></button>-->
            </div>
        </div>

        <div class="home-demo">
            <div class="owl-carousel owl-carousel-4 owl-theme">
                @if(!empty($brand_image))
                    @foreach($brand_image as $key => $image)
                        @if(!empty($image->slug) && $image->slug == 'vacation-image')
                <div class="item card bg-white bdr-20 border-0 position-relative">
                    <img src="{{ !empty($image->name) ? asset('storage/vacation-section/' . $image->name) :  asset('admin/img/maruthamalai.png') }}" alt="car-logo" class="img-fluid vt-img">
                    
                    <div class="p-2 mt-2">
                        <p class="fs-14 fw-600 mb-1">
                            {{ $image->description }}
                        </p>
                        <p class="fs-12">
                            <i class="fas fa-map-marker-alt text-blue fs-14"></i> {{ $image->title }}
                        </p>
                    </div>
                </div>
                        @endif
                    @endforeach
                @else
                    <div class="item card bg-white bdr-20 border-0 position-relative">
                        <img src="{{ asset('user/img/Rectangle 23.png') }}" alt="car-logo" class="img-fluid vt-img">
                        <div class="position-absolute ps-3 pt-3">
                            <div class="bg-white rounded-pill w-fit px-1 fw-500 fs-15">
                                <i class="fas fa-star" style="color:#E66742;"></i> 4.5
                            </div>
                        </div>
                        <div class="p-2 mt-2">
                            <p class="fs-14 fw-600 mb-1">
                                Gedee Car Museum
                            </p>
                            <p class="fs-12">
                                <i class="fas fa-map-marker-alt text-blue fs-14"></i> Race Course, Coimbatore...
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

