<section>
    <div class="container-fluid container-lg my-3 my-lg-4" id="coupon_section">
        <div class="home-demo sec-2">
            <div class="owl-carousel owl-carousel-1 owl-theme">
                @foreach($section2 as $item)
                    @if($item->status == 1)
                <div class="item p-3 pb-2 pb-lg-3 coupon_info" data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                data-amount="{{ number_format($item->amount,0) }}"  data-type="{{  $item->type == 1 ? '%' : '₹' }}" data-prefix="{{ $item->prefix }}" data-code="{{ $item->code }}">
                    <div class="ms-2">
                        <p class="text-primary fs-12 fs-mb-11 mb-1">
                            <i class="fa-solid fa-car"></i>{{ $item->title }}
                        </p>
                       <p class="fs-12 fs-mb-11" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width: 240px; margin-bottom: 1em; min-height: 40px;">
                                    {!! $item->description !!}
                        </p>
                        <div class="card blue-bg w-50 p-2 text-white d-flex">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('user/img/offer.png') }}" alt="Bagde Percentage" class="img-fluid d-block badge-perc me-1 me-lg-2">
                                <span class="fs-16 fs-mb-12 fw-500">  {{ $item->type != 1 ? '₹ ' : '' }}{{ intval($item->amount) }} {{ $item->type != 1 ? ' /- ' : '%' }}</span>
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
    <div class="modal fade" id="coupon_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bdr-20">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end close-button text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row p-4">
                        <div class="col-10">
                            <p class="text-primary fs-16 mb-3" id="title"></p>
                            <p class="fs-18 fw-500 my-3" id="description"></p>
                            <div class="d-flex my-3">
                                <img src="{{ asset('user/img/bxs_offer.svg') }}" alt="Bagde Percentage" class="img-fluid me-1 me-lg-2 badge-perc-2 my-auto">
                                <span class="fs-2 fs-mb-12 fw-600 text-blue" id="amount"></span>
                                <div class="fs-14 fs-mb-9 fw-500 text-blue my-auto lh-base ms-2" id="prefix">
                                </div>
                            </div>
                            <p class="text-secondary fs-12 fw-500 my-3" >
                                Coupon Code
                            </p>
                            <div class="d-flex">
                                <div class="bg-grey bdr-10 my-auto fs-14 fw-500 btn" id="coupon_code">
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

