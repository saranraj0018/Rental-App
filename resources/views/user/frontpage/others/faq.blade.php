@extends('user.frontpage.list-cars.main')

@section('content')
    @include('user.frontpage.single-car.verified-model')
    <section>
        <header>
            <section class="booking-header">
              
                <section>
                    @include('user.frontpage.menus')
                </section>

                <div class="container mb-3 py-5">
                    <h1 class="fs-1 fw-bold text-white text-center">FAQ</h1>
                </div>
            </section>

            <section class="d-none">
                <div class="container-fluid header-bg p-1">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                            <div class="container">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#mobile_nav-1" aria-controls="mobile_nav-1" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="mobile_nav-1">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">
                                    </ul>
                                    <ul class="navbar-nav navbar-light">
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Home</a></li>
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Booking</a></li>
                                        {{--                                    <li class="nav-item"><a class="nav-link text-white d-flex align-items-center justify-content-center " href="#">Blog</a></li> --}}
                                        <li class="nav-item"><a
                                                class="nav-link text-white d-flex align-items-center justify-content-center "
                                                href="#">Contact-us</a></li>
                                    </ul>
                                </div>
                                <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block">
                                <img src="./assets/Group 4 (1).png" alt="Site-Logo" class="img-fluid d-block">
                            </div>
                        </nav>
                    </div>
                    <div class="container mb-3 py-5">
                        <h1 class="display-5 fw-bold text-white text-center">FAQ</h1>
                    </div>
                </div>
            </section>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.navbar-light .dmenu').hover(function() {
                        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
                    }, function() {
                        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
                    });
                });
            </script>

        </header>

    </section>


    @php
        $faq_items = \App\Models\Frontend::where('data_keys', 'faq-section')->get();
    @endphp
    <section>
        <div class="container my-5">
            <div class="accordion" id="faqAccordion">
                <!-- First Item (Open by Default) -->
                @if (filled($faq_items))
                    @foreach ($faq_items as $item)
                        @php $value = !empty($item['data_values']) ? json_decode($item['data_values']) : null ;@endphp
                        <div class="accordion-item bg-grey bdr-20 my-2">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne_{{ $item->id }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    {{ $loop->iteration . '.  ' . $value->question ?? '' }}
                                </button>
                            </h2>
                            <div id="collapseOne_{{ $item->id }}" class="accordion-collapse collapse"
                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body py-3 fs-mb-14 text-justify">
                                    {{ $value->answer ?? '' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="accordion-item bg-grey bdr-20 my-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Is there a speed limit?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body py-3 fs-mb-14 text-justify">
                                Valam allows up to 125 km/hr. However it is 80 km/hr in a few cities where some cars might
                                be equipped with speed governors as per government directives. Revv strictly advises to
                                follow local speed limits.
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-end my-3">
                <button class="btn btn-sm bg-blue text-white rounded-pill view-more">View More</button>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const faqAccordion = document.getElementById("faqAccordion");
                const accordionItems = Array.from(faqAccordion.querySelectorAll(".accordion-item"));
                const viewMoreButton = document.querySelector(".view-more");

                const INITIAL_VISIBLE_COUNT = 5;
                let isExpanded = false;

                // Function to update accordion visibility
                function updateAccordionVisibility() {
                    accordionItems.forEach((item, index) => {
                        if (index < INITIAL_VISIBLE_COUNT || isExpanded) {
                            item.style.display = "block";
                        } else {
                            item.style.display = "none";
                        }
                    });
                }

                // Function to toggle accordion visibility
                function toggleAccordion() {
                    isExpanded = !isExpanded;
                    updateAccordionVisibility();
                    viewMoreButton.textContent = isExpanded ? "View Less" : "View More";
                }

                // Initialize accordion visibility
                updateAccordionVisibility();

                // Attach click event listener to the button
                viewMoreButton.addEventListener("click", toggleAccordion);
            });
        </script>
    </section>
    @include('user.frontpage.footer')

@endsection
