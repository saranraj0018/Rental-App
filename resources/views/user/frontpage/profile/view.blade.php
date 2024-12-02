@extends('user.frontpage.list-cars.main')

@section('content')
    <section class="other-heads-bg py-4">
        <header>
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="d-flex text-white">
                        <div>
                            <a href="{{ route('home') }}" class="border-2 rounded-pill px-3 py-2 me-3 back-btn" role="button"><i class="fa fa-angle-left text-white fs-18"></i></a>
                        </div>
                        <div class="my-auto">Profile</div>
                    </div>
                    <div class="text-white my-auto">
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out text-white me-1"></i> Logout
                        </a>
                    </div>

                </div>
            </div>
        </header>
    </section>
    <form id="user_profile">
    <section class="my-5">
        <div class="container profile-bg py-3 px-2 bdr-20">

            <div class="row">
                <div class="col-12 col-lg-1">
                    <img src="{{ asset('user/img/saq.png') }}" alt="" class="img-fluid">
                </div>

                <div class="col-12 col-lg-4">
                    <label for="name" class="fs-14 fw-500">Your Name</label>
                    <input type="text" class=" form-control fs-14" name="user_name" id="user_name" value="{{ Auth::user()->name ?? '' }}" placeholder="Enter Your name">
                </div>
                <div class="col-12 col-lg-4">
                    <label for="name" class="fs-14 fw-500">Mobile Number</label>
                    <input type="text" class=" form-control fs-14" name="user_mobile" id="user_mobile" value="{{ Auth::user()->mobile ?? '' }}" placeholder="Enter Your Mobile Number">
                </div>
                <div class="col-12 col-lg-3 my-auto">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn blue-bg text-white rounded-pill fs-14 fw-500" id="update-profile">Update Profile</button>
                    </div>
                </div>
            </div>

        </div>
        <p id="profile_message" class="text-success text-center"></p>
    </section>

    <section class="my-5">
        <div class="container profile-bg">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="fs-5 fw-500 mb-1">
                        Driving License
                    </div>
                    <div class="fs-14 mb-3">
                        Your uploaded documents can be removed or updated anytime.
                    </div>
                    <div class="border-dotted bdr-20 p-4">
                        <label for="dl" class="fs-14 fw-500">Driving License</label>
                        <input type="text" id="driving_licence" name="driving_licence" class="fs-14 form-control" placeholder="Driving License Number" value="{{ Auth::user()->driving_licence ?? '' }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="fs-5 fw-500 mb-1">
                        Aadhaar Card
                    </div>
                    <div class="fs-14 mb-3">
                        Your uploaded documents can be removed or updated anytime.
                    </div>
                    <div class="border-dotted bdr-20 p-4">
                        <label for="aadhaar" class="fs-14 fw-500">Aadhaar Number</label>
                        <input type="number" id="aadhaar_number" name="aadhaar_number" class="fs-14 form-control" placeholder="Aadhaar Number" value="{{ Auth::user()->aadhaar_number ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h4 class="mb-4">Documents List</h4>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Additional Document</label>
                <input type="file" class="form-control w-50" id="other_documents" name="other_documents" >
            </div>
            <div class="row" id="image-gallery">
                @if(!empty($user_details->userDoc))
                @foreach($user_details->userDoc as $image)
                    <div class="col-md-4 mb-4">
                        <div class="card image-card">
                            <img src="{{ asset('/storage/user-documents/' . $image->image_name) }}" class="card-img-top" alt="Image">
                            <button class="btn btn-danger btn-sm delete-image position-absolute" data-id="{{ $image->id }}"
                                    style="top: 5px; right: 5px;">
                                &times;
                            </button>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
    </form>
    @include('user.frontpage.footer')
@endsection
