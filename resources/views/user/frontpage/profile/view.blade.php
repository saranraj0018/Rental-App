@extends('user.frontpage.list-cars.main')

@section('content')
    <section class="section-1-bg pb-3">
        <header>
            <section>
                <div class="container-fluid p-3">
                    <div class="container bg-head-grey rounded-pill p-1 rounded-sm-3 my-head-round">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                            <div class="container d-flex justify-content-between">
                                <div class="d-flex justify-content-between mobile-head-width">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo"
                                            class="img-fluid d-block">
                                    </a>
                                    <div class="my-auto h-100">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false"
                                            aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse navbar-collapse ms-5" id="mobile_nav">
                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right"></ul>
                                    <ul
                                        class="navbar-nav navbar-light w-100 ms-0 ms-lg-4 ps-0 ps-lg-5 text-end text-lg-start">
                                        <li class="nav-item my-nav ms-0 ms-lg-3 pe-0 pe-lg-1 ps-lg-5 my-auto"><a
                                                class="nav-link text-white fw-normal" href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal"
                                                href="{{ route('about') }}">About</a></li>
                                        <li class="nav-item my-nav my-auto" id="booking_button"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <a class="nav-link text-white fw-normal"
                                                href="{{ route('booking.history') }}">Booking</a>
                                        </li>
                                        <li class="nav-item my-nav my-auto"><a class="nav-link text-white fw-normal"
                                                href="{{ route('faq') }}">FAQ</a></li>
                                        <li class="nav-item my-nav me-0 me-lg-3 pe-0 pe-lg-2 my-auto"><a
                                                class="nav-link text-white fw-normal me-0 me-lg-1"
                                                href="{{ route('contact') }}">Contact-us</a></li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto">

                                            <div id="login_button" style="display: {{ Auth::check() ? 'none' : 'block' }};"
                                                class="ms-0 ms-lg-5 ps-0 ps-lg-5">
                                                <button type="button"
                                                    class="btn border border-white text-white fw-bold rounded-pill me-1 ms-0 ms-lg-5"
                                                    id="login_user">Sign-In</button>
                                                <button type="button" class="btn bg-blue text-white fw-bold rounded-pill"
                                                    id="register_user">Sign-Up</button>
                                            </div>

                                            <div id="after_login_button" class="mt-1 mb-2 nav-link"
                                                style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                                <a href="{{ route('user.profile') }}"
                                                    class="text-white text-center my-auto ms-2 text-decoration-none fs-13">View
                                                    profile</a>
                                                <div class="d-flex d-lg-block justify-content-end">
                                                    <p class="text-white m-0 my-1 border-blue w-fit rounded-3 f-16 ps-2 fs-13"
                                                        id="user_names">
                                                        {{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : '' }}
                                                    </p>
                                                </div>
                                                <div>

                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item ms-0 ms-lg-3 ps-0 ps-lg-0 my-auto " id="logout_button"
                                            style="display: {{ Auth::check() ? 'block' : 'none !important' }};">
                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            <but href="#" class="text-decoration-none"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out text-white me-1 fs-5"></i>
                                            </but>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </section>
        </header>
    </section>

    <form id="user_profile" x-data="{
        documents: JSON.parse('{{ auth()->user()->documents ?? '[]' }}'),

        create() {
            this.documents.push({
                title: '',
                value: ''
            });
        },

        remove(index) {
            this.documents.splice(index, 1);
        }
    }">

        <input type="hidden" :value="JSON.stringify(documents.filter(doc => doc.title != ''))" name="documents"
            id="documents">

        <section class="my-5">

            <div class="my-4">
                <div class="container">
                    <div class="d-flex text-white">
                        <div>
                            <a href="{{ route('home') }}" class="border-2 rounded-circle px-2 py-2 me-2 back-btn"
                                role="button"><i class="fa fa-angle-left text-white fs-18 px-1"></i></a>
                        </div>
                        <div class="my-auto text-blue fw-bold">Back</div>
                    </div>
                </div>
            </div>
            <div class="container profile-bg py-3 px-2 bdr-20">

                <div class="row">
                    <div class="col-12 col-lg-1">
                        <img src="{{ asset('user/img/saq.png') }}" alt="" class="img-fluid">
                    </div>

                    <div class="col-12 col-lg-3">
                        <label for="name" class="fs-14 fw-500">Your Name</label>
                        <input type="text" class=" form-control fs-14" name="user_name" id="user_name"
                            value="{{ Auth::user()->name ?? '' }}" placeholder="Enter Your name">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label for="name" class="fs-14 fw-500">Email Address</label>
                        <input type="text" class=" form-control fs-14" name="user_email" id="user_mobile"
                            value="{{ Auth::user()->email ?? '' }}" placeholder="Enter Your Email Address">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label for="name" class="fs-14 fw-500">Mobile Number</label>
                        <input type="text" class=" form-control fs-14" name="user_mobile" id="user_mobile"
                            value="{{ Auth::user()->mobile ?? '' }}" placeholder="Enter Your Mobile Number">
                    </div>
                    <div class="col-12 col-lg-2 my-auto">
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn my-blue-btn blue-bg text-white rounded-pill fs-14 fw-500"
                                id="update-profile">Update Profile</button>
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
                            <input type="text" id="driving_licence" name="driving_licence" class="fs-14 form-control"
                                placeholder="Driving License Number" value="{{ Auth::user()->driving_licence ?? '' }}">
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
                            <input type="number" id="aadhaar_number" name="aadhaar_number" class="fs-14 form-control"
                                placeholder="Aadhaar Number" value="{{ Auth::user()->aadhaar_number ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5 p-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="fs-5 fw-500">Add Other Documents</h1>
                    <button @click.prevent="create" type="button" class="btn btn-sm btn-outline-primary w-10"><i
                            class="fa fa-plus"></i>
                        Add New ID</button>
                </div>
                <div class="d-flex mt-3 p-1 justify-content-start flex-wrap gap-2">
                    <template x-for="(document, index) in documents" :key="index">
                        <div class="mt-4 mx-1 p-3 bg-light bdr-20" style="width: 500px !important">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-5 fw-500 mb-3">
                                    <input type="text" x-model="document.title" class="fs-14 form-control">
                                </div>
                                <div>
                                    <button @click="() => remove(index)" class="btn btn-outline-danger btn-sm"><i
                                            class="fa fa-close"></i></button>
                                </div>
                            </div>
                            <div class="fs-14 mb-3">
                                Your uploaded documents can be removed or updated anytime.
                            </div>

                            <div class="border-dotted bdr-20 p-4">
                                <label for="" class="fs-14 fw-500" x-text="document.title"></label>
                                <input type="text" class="fs-14 form-control" x-model="document.value"
                                    placeholder="Your Document Number">
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </section>
    </form>
    <section>
        <form id="user_document">
            <div class="container mt-5 ">
                <h4 class="mb-4">Documents List</h4>
                <p id="document_message" class="text-success text-center"></p>
                <div class="d-flex justify-content-end">
                    <button type="submit"
                        class="btn my-blue-btn blue-bg text-white rounded-pill h-35 fs-6">Upload</button>
                    <button type="button" id="add-file-button"
                        class="border-0 text-blue ms-2 btn btn-primary bg-my-light-blue rounded-pill h-35">Add
                        Document</button>
                </div>
                <div class="mb-3">
                    <label for="document-upload" class="form-label">Upload Additional Documents</label>
                    <div id="file-input-container" class="d-flex flex-wrap gap-2">

                    </div>
                </div>

                <div class="row" id="image-gallery">
                    @if (!empty($user_details->userDoc))
                        @foreach ($user_details->userDoc as $image)
                            <div class="col-md-4 mb-4">
                                <div class="card image-card">
                                    <img src="{{ asset('/storage/user-documents/' . $image->image_name) }}"
                                        class="card-img-top" alt="Image">
                                    <button class="btn btn-danger btn-sm delete-image position-absolute"
                                        data-id="{{ $image->id }}"
                                        style="top: 5px; right: 5px; background: rgb(187, 46, 46); width: 25px !important">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </form>
    </section>
    <style>
        .file-upload-box {
            width: 100px;
            height: 100px;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 14px;
            color: #999;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .file-upload-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .img-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            /* Initially hidden */
        }

        .btn-danger {
            width: 100px;
        }
    </style>
    <script>
        const fileInputContainer = document.getElementById('file-input-container');
        const addFileButton = document.getElementById('add-file-button');

        addFileButton.addEventListener('click', () => {
            // Create a container for the file input and remove button
            const fileUploadWrapper = document.createElement('div');
            fileUploadWrapper.className = 'd-flex flex-column align-items-center position-relative';

            // Create the square-shaped file input container
            const fileUploadBox = document.createElement('div');
            fileUploadBox.className = 'file-upload-box';
            fileUploadBox.innerHTML = '<span>Upload</span>';

            // Create the file input element
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'other_documents[]';
            fileInput.id = 'other_documents';
            fileInput.accept = 'image/*'; // Restrict to images only
            fileUploadBox.appendChild(fileInput);

            // Create the preview image element
            const previewImage = document.createElement('img');
            previewImage.className = 'img-preview';
            previewImage.style.display = 'none'; // Initially hidden
            fileUploadBox.appendChild(previewImage);

            // Handle file input change for image preview
            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block'; // Show the image
                        fileUploadBox.querySelector('span').style.display =
                            'none'; // Hide "Upload" text
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.style.display = 'none'; // Hide preview if no file is selected
                    fileUploadBox.querySelector('span').style.display = 'block'; // Show "Upload" text
                }
            });

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm mt-2';
            removeButton.textContent = 'Remove';

            // Add event listener to remove the wrapper
            removeButton.addEventListener('click', () => {
                fileInputContainer.removeChild(fileUploadWrapper);
            });

            // Append the file input box and remove button to the wrapper
            fileUploadWrapper.appendChild(fileUploadBox);
            fileUploadWrapper.appendChild(removeButton);

            // Append the wrapper to the container
            fileInputContainer.appendChild(fileUploadWrapper);
        });
    </script>

    @include('user.frontpage.footer')
@endsection
