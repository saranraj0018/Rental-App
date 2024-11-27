<section>
    <form id="get_location">
    <div class="container filter-input-bg bg-white p-4 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-4 my-lg-0">
                <label class="fs-16 fw-500">City</label>
                <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-location-dot"></i>
                        </span>
                    <!-- Input field -->
                    @php
                        $city = !empty($city_list) ? $city_list->toArray() : [];
                    @endphp
                        <!-- Input field -->
                    <input type="text" class="form-control my-hub" id="cityInput" placeholder="Choose City"
                           aria-label="City" aria-describedby="basic-addon1"
                           value="{{ array_key_exists(session('city_id'), $city) ? $city[session('city_id')] : '' }}" readonly>
                    <input type="hidden" id="city_id" name="city_id" value="{{session('city_id')}}">
                </div>
            </div>
            <div class="col-12 col-lg-3 my-1 mt-2 my-lg-0">
                <label class="fs-16 fw-500">Starting Date</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                    <input type="text" class="form-control my-hub" id="dateTimeInput1" placeholder="Select first date and time"
                           data-bs-toggle="modal" data-bs-target="#dateTimeModal1" value="{{ session('start_date') }}" readonly>
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                <label class="fs-16 fw-500">Ending Date</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class=" text-white fa-solid fa-calendar-days"></i>
                    </span>
                    <input type="text" class="form-control my-hub" id="dateTimeInput2" placeholder="Select second date and time"
                           data-bs-toggle="modal" data-bs-target="#dateTimeModal2" value="{{ session('end_date') }}" readonly>
                </div>
            </div>
            <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block my-auto">
                <button type="submit" disabled id="find_car" class="btn my-button w-100 w-lg-auto p-2">
                    <i class=" text-white fa-solid fa-magnifying-glass"></i> Search
                </button>
            </div>
        </div>
    </div>
        <div class="container d-none d-lg-block text-secondary text-center my-3">
            <p class="duration-display"></p>
            <p class="duration-error text-danger"></p>
        </div>
        </form>
    @include('user.frontpage.date_model')
</section>
