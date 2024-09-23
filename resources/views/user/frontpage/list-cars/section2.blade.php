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
                    <input type="text" class="form-control" placeholder="Coimbatore, Tamilnadu" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-12 col-lg-3 my-1 mt-2 my-lg-0">
                <label class="fs-16 fw-500">Starting Date</label>
                <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-calendar-days"></i>
                        </span>
                    <input type="text" id="start_date_time" class="form-control w-25" value="{{ $date['start_date'] }}" placeholder="Start Date & Time" autocomplete="off">
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                <label class="fs-16 fw-500">Ending Date</label>
                <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class=" text-white fa-solid fa-calendar-days"></i>
                        </span>
                    <input type="text" id="end_date_time" class="form-control w-25" placeholder="End Date & Time"  value="{{ $date['end_date'] }}" autocomplete="off">
                </div>
            </div>
            <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block ">
                <button type="submit" id="find_car" class="btn my-button w-100 w-lg-auto p-2">
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
</section>
