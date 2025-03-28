@extends('user.frontpage.list-cars.main')

@section('content')
@include ('user.frontpage.header')
@include('user.frontpage.list-cars.section2')
@include('user.frontpage.single-car.verified-model')

<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="my-auto">
                <p class="fs-18 fw-600 fs-mb-12 m-0">
                    @php
                        $city = !empty($city_list) ? $city_list->toArray() : [];
                    @endphp
            Available Cars In <span class="fs-4 text-blue"> {{ array_key_exists(session('city_id'), $city) ? $city[session('city_id')] : '' }}</span>
                </p>
            </div>
            <div>
                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link m-1 active d-none d-lg-block" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-th-large"></i>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link m-1 d-none d-lg-block" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-bars"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="mt-5">
        <div class="tab-content" id="pills-tabContent">
            <!-- TAB CONTENT-1 -->
            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                @include('user.frontpage.list-cars.tab-1')

            </div>
            <!-- TAB CONTENT-1 ENDS-->

            <!-- TAB CONTENT-2 -->
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @include('user.frontpage.list-cars.tab-2')
            </div>
            <!-- TAB CONTENT-2 ENDS-->
        </div>
    </div>
    @include('user.frontpage.section2')
</section>
    @include('user.frontpage.footer')
@endsection
