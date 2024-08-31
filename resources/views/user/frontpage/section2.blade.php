<section>
    <div class="container-fluid container-lg my-3 my-lg-4">
        <div class="home-demo sec-2">
            <div class="owl-carousel owl-carousel-1 owl-theme">
                @foreach($section2 as $item)
                    @if($item->status == 1)
                <div class="item p-2 pb-2 pb-lg-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="ms-2">
                        <p class="text-primary fs-12 fs-mb-9 mb-1">
                            <i class="fa-solid fa-car"></i>{{ $item->title }}
                        </p>
                        <p class="fs-12 fs-mb-9 mb-1">
                            {!! $item->description !!}
                        </p>
                        <div class="card blue-bg p-2 text-white d-flex">
                            <div class="d-flex">
                                <img src="{{ asset('user/img/Vector.png') }}" alt="Bagde Percentage" class="img-fluid d-block badge-perc me-1 me-lg-2">
                                <span class="fs-16 fs-mb-12 fw-500"> {{ $item->amount }}{{  $item->type == 1 ? '%' : '₹' }}</span>
                            </div>
                            <div class="fs-14 fs-mb-9 text-white">
                                {{ $item->prefix }}
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bdr-20">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end close-button text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row p-4">
                        <div class="col-10">
                            <p class="text-primary fs-16 mb-3">
                                <i class="fa-solid fa-car"></i> Ride Safe with Valam
                            </p>
                            <p class="fs-18 fw-500 my-3">
                                New users in Coimbatore get 10% off with Valam Cars.
                            </p>
                            <div class="d-flex my-3">
                                <img src="{{ asset('user/img/bxs_offer.png') }}" alt="Bagde Percentage" class="img-fluid me-1 me-lg-2 badge-perc-2 my-auto"> <span class="fs-2 fs-mb-12 fw-600 text-blue">10%</span>
                                <div class="fs-14 fs-mb-9 fw-500 text-blue my-auto lh-base ms-2">
                                    for new users
                                </div>
                            </div>
                            <p class="text-secondary fs-12 fw-500 my-3">
                                Coupon Code
                            </p>
                            <div class="d-flex">
                                <div class="bg-grey bdr-10 my-auto fs-14 fw-500 btn" id="couponCode">
                                    Valam#2345
                                </div>
                                <button class="btn bdr-10 ms-3 copy-btn fs-14" id="copyButton"><i class="fas fa-clone"></i> Copy Code</button>
                            </div>

                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap JS and dependencies (Popper.js) -->

