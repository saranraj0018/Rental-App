@php
    $data = !empty($section1) && optional($section1)->data_values ? json_decode($section1->data_values, true) : [];
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $features = !empty($data['features']) ? json_decode($data['features'], true) : [];

    $images = $section1->frontendImage ?? [];
    $image1 = $images[0]->name ?? '';
    $image2 = $images[1]->name ?? '';
    $image3 = $images[2]->name ?? '';
@endphp


<section class="section-1-bg pb-3">
    <header>
        <section class="d-none d-lg-block">
            <div class="container-fluid p-3">
                <div class="container bg-white rounded-pill p-1">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container d-flex justify-content-between">
                            <div>
                                <img src="{{ asset('user/img/Rectangle 77.png') }}" alt="Site-Logo" class="img-fluid d-block w-50">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse" id="mobile_nav">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light w-100 ms-5 ps-5">
                                    <li class="nav-item ms-5 pe-3"><a class="nav-link text-dark" href="#">Home</a></li>
                                    @if(!Auth::user())
                                        <li class="nav-item"><a class="nav-link text-dark" href="#">FAQ</a></li>
                                    @else
                                        <li class="nav-item"><a class="nav-link text-dark" href="{{ route('booking.history') }}">Booking</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link text-dark" href="#">Blog</a></li>
                                    <li class="nav-item me-5 pe-2"><a class="nav-link text-dark me-5" href="#">Contact-us</a></li>
                                    <li class="nav-item ms-3 ps-5">
                                        @if(!Auth::user())
                                            <button type="button" class="btn border border-dark rounded-pill me-1" id="login_user">Sign-In</button>
                                            <button type="button" class="btn bg-blue text-white rounded-pill" id="register_user">Sign-Up</button>
                                        @else
                                            <p class="fw-500 f-16 text-white">{{ \Illuminate\Support\Facades\Auth::user()->name ?? ''  }}</p>
                                            <a href="{{ route('user.profile') }}">View profile</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>

        {{--        Mobile view--}}
        <section class="d-block d-lg-none">
            <div class="container-fluid header-bg p-1">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                        <div class="container">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav-1" aria-controls="mobile_nav-1" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="mobile_nav-1">
                                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                </ul>
                                <ul class="navbar-nav navbar-light">
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Home</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Contact-us</a></li>
                                </ul>
                            </div>
                            <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                            <img src="{{ asset('user/img/Group 4 (1).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        </div>
                    </nav>

                </div>
            </div>
        </section>
        {{--        Mobile view--}}
    </header>
    <div class="container py-5 d-none d-lg-block">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="fs-1 text-white fw-500">{!! $title !!}</h1>
                <p class="text-white my-4">{!! $description !!}</p>
                <div class="row">

                    @if(!empty($features))
                        @foreach($features as $key => $option)
                            @if($key <= 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1" style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($key > 1)
                                <div class="col-12 col-lg-6">
                                    <div class="text-white">
                                        <div class="mb-3">
                                            <i class="fa-regular fa-circle-check me-1" style="color:#E66742;font-size:17px;"></i> {{ $option }}
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @endif
                    <button class="btn fs-16 mt-3 fac-button">Find a car</button>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div id="carouselExampleFade" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/section1-image-car/' . $image1) }}" class="d-block w-100 mb-5" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image2) }}" class="d-block w-100 mb-5" alt="Slide 1">

                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/section1-image-car/' . $image3) }}" class="d-block w-100 mb-5" alt="Slide 1">
                        </div>
                    </div>
                    <!-- Pagination Dots -->
                    <div class="carousel-indicators bdr-30 px-1">
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-block d-lg-none text-center pt-3 pb-5 section-1-bg-sm">
        <p class="fw-bold text-white fs-2 m-0">
            Welcome!
        </p>
        <p class="fw-500 f-16 text-white">
            Self Drive Car Rentals In Coimbatore
        </p>
    </div>

</section>

<section>
    <form id="get_location">
        <div class="container filter-input-bg bg-white p-4 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-4 my-lg-0">
                    <label class="fs-16 fw-500">City</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="text-white fa-solid fa-location-dot"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Coimbatore, Tamilnadu" aria-label="City" aria-describedby="basic-addon1" disabled>
                    </div>
                </div>
                <div class="col-12 col-lg-3 my-1 mt-2 my-lg-0">
                    <label class="fs-16 fw-500">Pick Date</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="text-white fa-solid fa-calendar-days"></i>
                        </span>
                        <input type="text" class="form-control mb-2" id="dateTimeInput1" placeholder="Select pick date and time" data-bs-toggle="modal" data-bs-target="#dateTimeModal1" >
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-2 mb-2 my-lg-0">
                    <label class="fs-16 fw-500">Delivery Date</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="text-white fa-solid fa-calendar-days"></i>
                        </span>
                        <input type="text" class="form-control" id="dateTimeInput2Field" placeholder="Select delivery date and time" data-bs-toggle="modal" data-bs-target="#dateTimeModal2" > <!-- Changed this ID -->

                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center d-lg-block my-auto">
                    <button type="submit" disabled id="find_car" class="btn my-button w-100 w-lg-auto p-2">
                        <i class="text-white fa-solid fa-magnifying-glass"></i> Search
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



<!-- Modal Popup -->
<!-- Modal Popup for Date and Time Selection -->
<section>
    <div class="modal fade" id="dateTimeModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog date-modal-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Date and Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#dateTabContent1" id="dateTab">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#timeTabContent1" id="timeTab">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="dateTabContent1">
                            <div id="inlineDatePicker1"></div>
                        </div>
                        <div class="tab-pane fade" id="timeTabContent1">
                            <div class="d-flex flex-wrap">
                                <!-- Time Buttons -->
                                <button class="btn btn-outline-primary time-btn m-1" data-time="00:00">00:00</button>
                                <button class="btn btn-outline-primary time-btn m-1" data-time="00:30">00:30</button>
                                <button class="btn btn-outline-primary time-btn m-1" data-time="01:00">01:00</button>
                                <button class="btn btn-outline-primary time-btn m-1" data-time="01:30">01:30</button>
                                <!-- Add more time buttons as needed up to "23:30" -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="dateTimeModal2" tabindex="-1" aria-hidden="true"> <!-- Ensure this ID matches the target -->
        <div class="modal-dialog date-modal-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Date and Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#dateTabContent2" id="dateTab">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#timeTabContent2" id="timeTab2">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="dateTabContent2">
                            <div id="inlineDatePicker2"></div>
                        </div>
                        <div class="tab-pane fade" id="timeTabContent2">
                            <div class="d-flex flex-wrap">
                                <!-- Time Buttons -->
                                <button class="btn btn-outline-primary time-btn2 m-1" data-time2="00:00">00:00</button>
                                <button class="btn btn-outline-primary time-btn2 m-1" data-time2="00:30">00:30</button>
                                <button class="btn btn-outline-primary time-btn2 m-1" data-time2="01:00">01:00</button>
                                <button class="btn btn-outline-primary time-btn2 m-1" data-time2="01:30">01:30</button>
                                <!-- Add more time buttons as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .date-modal-width { width: 28%; }
    @media (min-width: 401px) and (max-width: 800px) { .date-modal-width { width: 49%; } }
    @media (max-width: 400px) { .date-modal-width { width: 100%; } }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the flatpickr date picker
        flatpickr("#inlineDatePicker1", {
            inline: true,
            onChange: function(selectedDates, dateStr) {
                // Store the selected date and automatically switch to the time tab
                document.getElementById('dateTimeInput1').dataset.selectedDate = dateStr;
                document.getElementById('timeTab').click(); // Switch to the time tab
            }
        });

        flatpickr("#inlineDatePicker2", {
            inline: true,
            onChange: function(selectedDates, dateStr) {
                // Store the selected date and automatically switch to the time tab
                document.getElementById('dateTimeInput2Field').dataset.selectedDate = dateStr;
                document.getElementById('timeTab2').click(); // Switch to the time tab
            }
        });

        // Handle time button clicks
        document.querySelectorAll('.time-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const dateInput = document.getElementById('dateTimeInput1');
                const selectedDate = dateInput.dataset.selectedDate || '';
                const selectedTime = btn.getAttribute('data-time');

                if (selectedDate && selectedTime) {
                    dateInput.value = `${selectedDate} ${selectedTime}`;
                }

                // Manually hide the modal and remove any lingering backdrop or disabling effects
                const modalElement = document.getElementById('dateTimeModal1');
                modalElement.classList.remove('show');
                modalElement.setAttribute('aria-hidden', 'true');
                modalElement.style.display = 'none';

                // Clean up the modal backdrop
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
                document.body.style.removeProperty('overflow');
            });
        });

        document.querySelectorAll('.time-btn2').forEach(btn => {
            btn.addEventListener('click', function () {
                const dateInput = document.getElementById('dateTimeInput2Field');
                const selectedDate = dateInput.dataset.selectedDate || '';
                const selectedTime = btn.getAttribute('data-time2');

                if (selectedDate && selectedTime) {
                    dateInput.value = `${selectedDate} ${selectedTime}`;
                }

                // Manually hide the modal and remove any lingering backdrop or disabling effects
                const modalElement = document.getElementById('dateTimeModal2');
                const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
                modal.hide(); // Use Bootstrap method to hide the modal

                // Clean up the modal backdrop
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
                document.body.style.removeProperty('overflow');
            });
        });


    });

</script>
