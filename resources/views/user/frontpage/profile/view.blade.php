@extends('user.frontpage.list-cars.main')

@section('content')
    <section class="section-1-bg pb-3">
        <header>
            @include('user.frontpage.menus')
        </header>
    </section>


    <div x-data="{
        activeTab: 'profile',
        tabs: ['profile', 'update-password'],

        switchTabs(tab) {
            if(this.tabs.includes(tab)) {
                this.activeTab = tab
            }
        }
    }">

    <div class="my-5">
        <div class="container">
            <div class="d-flex text-white">
                <div>
                    <a href="{{ route('home') }}" class="border-2 rounded-circle px-2 py-2 me-2 back-btn"
                        role="button"><i class="fa fa-angle-left text-white fs-18 px-1"></i></a>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="my-auto">
                        <button @click.prevent="switchTabs('profile')" :class="{'text-blue fw-bold': activeTab == 'profile'}" style="font-size: .8em; background: transparent; border: none; outline: none;">Profile</button>
                    </div>

                    <div class="my-auto">
                        <button @click.prevent="switchTabs('update-password')" :class="{'text-blue fw-bold': activeTab == 'update-password'}" style="font-size: .8em; background: transparent; border: none; outline: none;">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div x-show="activeTab == 'profile'">

            <form id="user_profile">
                <section class="my-5">

                    <div class="container profile-bg py-3 px-2 bdr-20">

                        <div class="row">
                            <div class="col-12 col-lg-1">
                                <img src="{{ asset('user/img/saq.png') }}" alt="" class="img-fluid">
                            </div>

                            <div class="col-12 col-lg-3">
                                <label for="name" class="fs-14 fw-500">Your Name</label>
                                <input type="text" class=" form-control fs-14" name="profile_name" id="profile_name"
                                    value="{{ Auth::user()->name ?? '' }}" placeholder="Enter Your name">
                            </div>
                            <div class="col-12 col-lg-3">
                                <label for="name" class="fs-14 fw-500">Email Address</label>
                                <input disabled type="text" class=" form-control fs-14" name="user_email" id="user_mobile"
                                    value="{{ Auth::user()->email ?? '' }}" placeholder="Enter Your Email Address">
                            </div>
                            <div class="col-12 col-lg-3">
                                <label for="name" class="fs-14 fw-500">Mobile Number</label>
                                <input disabled type="text" class=" form-control fs-14" name="user_mobile" id="user_mobile"
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
                    <p id="profile_message" style="display: none" class="text-success text-center"></p>
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
                                    <input type="text" disabled id="driving_licence" name="driving_licence" class="fs-14 form-control"
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
                                    <input type="number" disabled id="aadhaar_number" name="aadhaar_number" class="fs-14 form-control"
                                        placeholder="Aadhaar Number" value="{{ Auth::user()->aadhaar_number ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

            <form x-data="{
                documents: JSON.parse('{{ auth()->user()->documents ?? '[]' }}'),

                create() {
                    this.documents.push({
                        title: '',
                        value: ''
                    });
                },

                remove(index) {
                    this.documents.splice(index, 1);
                },
            }" id="user_profile_docs">

                <input type="hidden" :value="JSON.stringify(documents.filter(doc => doc.title != ''))" name="documents"
                    id="documents">

                <div class="container mt-5 p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="fs-5 fw-500">Add Other Documents</h1>
                        <div>
                            <button type="submit" class="btn btn-sm btn-primary w-10"><i class="fa fa-plus"></i>
                                Save Documents</button>

                            <button @click.prevent="create" type="button" class="btn btn-sm btn-outline-primary w-10"><i
                                    class="fa fa-plus"></i>
                                Add New ID</button>
                        </div>
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
            </form>

            <section>
                <form id="user_document">
                    <div class="container mt-5 ">
                        <h4 class="mb-4">Documents List</h4>
                        <p id="document_message" class="text-success text-center"></p>
                        <div class="d-flex justify-content-start justify-content-md-end ">
                            <button type="submit"
                                class="btn my-blue-btn blue-bg text-white rounded-pill h-35 fs-6">Upload</button>
                            <button type="button" id="add-file-button"
                                class="border-0 text-blue ms-2 btn btn-primary bg-my-light-blue rounded-pill h-35">Add
                                Document</button>
                        </div>
                        <div class="my-5">
                            <label for="document-upload" class="form-label">Upload Additional Documents</label>
                            <div id="file-input-container" class="d-flex flex-wrap gap-2">

                            </div>
                        </div>

                        <div class="row" id="image-gallery">
                            @if (!empty($user_details->userDoc))
                                @foreach ($user_details->userDoc as $image)
                                    <div class="col-md-4 mb-4">
                                        <div class="card image-card">

                                            @php
                                                $_src = asset('/storage/user-documents/' . $image->image_name);
                                            @endphp

                                            <x-image :src="$_src"
                                                class="card-img-top" alt="Image" />
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

                <div class="modal fade" id="alert-model" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Profile</h4>
                            </div>

                            <div class="modal-body">
                                <p><i class="fa fa-check px-2 text-success"></i> User Profile Updated Successfully</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>


        <div x-show="activeTab == 'update-password'" style="min-height: 40vh">

            <form x-data="{
                old_password: null,
                password: null,
                password_confirmation: null,
                error: '',

                errors: {
                    old_password: '',
                    password: '',
                    password_confirmation: '',
                },

                validate() {
                    this.errors.old_password = '';
                    this.errors.password = '';
                    this.errors.password_confirmation = '';

                    if (!this.old_password) {
                      this.errors.old_password = 'Old password is required.';
                    }

                    if (!this.password) {
                      this.errors.password = 'New password is required.';
                    } else {
                      if (this.old_password && this.old_password === this.password) {
                        this.errors.password = 'New password must be different from the old password.';
                      } else if (this.password.length < 8) {
                        this.errors.password = 'New password must be at least 8 characters long.';
                      }
                    }

                    if (!this.password_confirmation) {
                      this.errors.password_confirmation = 'Confirm password is required.';
                    } else if (this.password && this.password_confirmation !== this.password) {
                      this.errors.password_confirmation = 'Confirm password does not match.';
                    }

                    return !this.errors.old_password && !this.errors.password && !this.errors.password_confirmation;
                }


            }" id="user_password_form" @submit.prevent="async() => {
                 if(!validate()) {
                    return false;
                 }

                try {
                    const response = await axios.post('{{ route('update-password') }}', {
                        old_password, password, password_confirmation,
                    });

                    if(response.status == 200) {
                       $('#password-model').modal('show');
                       setTimeout(() => {
                        window.location.reload(true)
                       }, 2000)
                    }

                } catch(e) {
                    error = e?.response?.data?.message
                }
            }">
                <section class="my-5">
                    <div class="container profile-bg py-3 px-2 bdr-20">
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh">
                            <div class=" p-3" style="width: 400px">
                                <h5 class="mb-0 fw-bold">Update Password</h5>
                                <p style="font-size: .8em; color: gray">Change your password for the user</p>
                                <span class="text-danger" style="font-size: .8em" x-text="error"></span>

                                <!-- Current Password -->
                                <div class="mt-3 position-relative" x-data="{ show: false }">
                                    <label for="old_password" class="fs-14 fw-500">Current Password</label>
                                    <input x-model="old_password" :type="show ? 'text' : 'password'" class="form-control fs-14 pe-5"
                                           name="old_password" id="old_password" placeholder="Enter Your Current Password">
                                    <i @click="show = !show"
                                       :class="show ? 'fa fa-eye-slash' : 'fa fa-eye'"
                                       style="position: absolute; top: 38px; right: 15px; cursor: pointer; color: #6c757d;"></i>
                                    <span class="text-danger" style="font-size: .8em" x-text="errors.old_password"></span>
                                </div>

                                <!-- New Password -->
                                <div class="mt-3 position-relative" x-data="{ show: false }">
                                    <label for="password" class="fs-14 fw-500">New Password</label>
                                    <input x-model="password" :type="show ? 'text' : 'password'" class="form-control fs-14 pe-5"
                                           name="password" id="password" placeholder="Enter New Password">
                                    <i @click="show = !show"
                                       :class="show ? 'fa fa-eye-slash' : 'fa fa-eye'"
                                       style="position: absolute; top: 38px; right: 15px; cursor: pointer; color: #6c757d;"></i>
                                    <span class="text-danger" style="font-size: .8em" x-text="errors.password"></span>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-3 position-relative" x-data="{ show: false }">
                                    <label for="password_confirmation" class="fs-14 fw-500">Confirm Password</label>
                                    <input x-model="password_confirmation" :type="show ? 'text' : 'password'" class="form-control fs-14 pe-5"
                                           name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                    <i @click="show = !show"
                                       :class="show ? 'fa fa-eye-slash' : 'fa fa-eye'"
                                       style="position: absolute; top: 38px; right: 15px; cursor: pointer; color: #6c757d;"></i>
                                    <span class="text-danger" style="font-size: .8em" x-text="errors.password_confirmation"></span>
                                </div>
                                <div class="w-100 mt-5">
                                    <button type="submit" class="btn my-blue-btn blue-bg text-white rounded-pill fs-14 fw-500 w-100"
                                        id="">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <div class="modal fade" id="password-model" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Profile</h4>
                    </div>

                    <div class="modal-body">
                        <p><i class="fa fa-check px-2 text-success"></i> Password Updated Successfully</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
