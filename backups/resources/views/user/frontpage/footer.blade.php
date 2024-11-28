<!--BOOTSTRAP 5 CDN-->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"> -->
<!--BOOTSTRAP 5 CDN-->

<!--FONTAWSOME CDN-->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
<!--FONTAWSOME CDN-->

<!--LOCAL CSS -->
<!-- <link rel="stylesheet" href="./css/home.css">
<link rel="stylesheet" href="./css/responsive.css"> -->
<!--LOCAL CSS -->

<footer>
    <section class="d-none d-lg-block footer-bg">
        <div class="container-fluid p-3">
            <div class="row g-0">
                <div class="col-12 col-lg-1">
                    <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                </div>
                <div class="col-12 col-lg-8 mx-auto my-auto">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('privacy-policy') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Privacy Policy
                        </a>
                        <a href="{{ route('terms-and-conditions') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Terms & Conditions
                        </a>
                        <a href="{{ route('faq') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            FAQs
                        </a>
                        <a href="{{ route('shipping') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Shipping
                        </a>
                        <a href="{{ route('refund') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Refund
                        </a>
                        <a href="{{ route('pricing') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Pricing
                        </a>
                        <a href="{{ route('cancellation') }}" target="_blank" class="text-white text-decoration-none mx-4 fs-16">
                            Cancellation
                        </a>
                    </div>

                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-end my-auto">
                    <div class="d-flex media-list p-1">
                        <a href="https://www.youtube.com" target="_blank" class="me-3">
                            <i class="fab fa-youtube fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.facebook.com" target="_blank" class="me-3">
                            <i class="fab fa-facebook fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="me-3">
                            <i class="fab fa-instagram fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="me-3">
                            <i class="fab fa-linkedin fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" class="me-3">
                            <i class="fab fa-twitter fa-1x media-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color: #11285A;">
            <div class="container-fluid d-flex justify-content-between py-2">
                <div class="fs-14 fw-500 text-white">
                    Privacy | Terms & Conditions
                </div>
                <div class="fs-14 fw-500 text-white">
                    ©2024 Valam
                </div>
            </div>
        </div>
    </section>
    <section class="d-block d-lg-none footer-bg">
        <div class="container p-3">
            <div class="row">
                <div class="col-6 d-flex flex-column justify-content-around">
                    <div>
                        <img src="./assets/Logo (4).png" alt="Site-Logo" class="img-fluid d-block w-75 mb-0 mb-md-3 mb-lg-0">
                    </div>
                    <div class="d-flex media-list p-1">
                        <a href="https://www.youtube.com" target="_blank" class="me-2">
                            <i class="fab fa-youtube fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.facebook.com" target="_blank" class="me-2">
                            <i class="fab fa-facebook fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="me-2">
                            <i class="fab fa-instagram fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="me-2">
                            <i class="fab fa-linkedin fa-1x media-icon"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" class="me-2">
                            <i class="fab fa-twitter fa-1x media-icon"></i>
                        </a>
                    </div>
                </div>
                <div class="col-6 mx-auto my-auto">
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <a href="https://www.youtube.com" target="_blank" class="text-white text-decoration-none mb-2">
                            Home
                        </a>
                        <a href="https://www.youtube.com" target="_blank" class="text-white text-decoration-none mb-2">
                            FAQs
                        </a>
                        <a href="https://www.youtube.com" target="_blank" class="text-white text-decoration-none mb-2">
                            Safety
                        </a>
{{--                        <a href="https://www.youtube.com" target="_blank" class="text-white text-decoration-none mb-2">--}}
{{--                            Blog--}}
{{--                        </a>--}}
                        <a href="https://www.youtube.com" target="_blank" class="text-white text-decoration-none mb-2">
                            Contact us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<script>
    function setFooterPosition() {
        const footer = document.querySelector("footer");
        const bodyHeight = document.body.scrollHeight;
        const windowHeight = window.innerHeight;

        // Check if the viewport width is greater than or equal to 768 pixels (desktop)
        if (window.innerWidth >= 768) {
            // Only fix the footer if the page does not require scrolling
            if (bodyHeight <= windowHeight) {
                footer.style.position = "fixed";
                footer.style.bottom = "0";
                footer.style.width = "100%";
            } else {
                footer.style.position = "static"; // Reset to static if the content overflows
            }
        } else {
            // Reset the footer position for mobile view
            footer.style.position = "static";
        }
    }

    // Initialize and re-run function on resize or DOM load
    document.addEventListener("DOMContentLoaded", setFooterPosition);
    window.addEventListener("resize", setFooterPosition);
</script>
