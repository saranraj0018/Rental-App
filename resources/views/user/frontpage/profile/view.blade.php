@extends('user.frontpage.list-cars.main')

@section('content')
    <section class="other-heads-bg py-4">
        <header>
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="d-flex text-white">
                        <div>
                            <button class="border-2 rounded-pill px-3 py-2 me-3 back-btn"><i class="fa fa-angle-left text-white fs-18"></i></button>
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
    </section>

    <section class="my-5">
        <div class="container profile-bg">
            <div class="row">
                <!-- Driving License Section -->
                <div class="col-12 col-lg-6">
                    <div class="fs-5 fw-500 mb-1">
                        Driving License
                    </div>
                    <div class="fs-14 mb-3">
                        Your uploaded documents can be removed or updated anytime.
                    </div>
                    <div class="border-dotted bdr-20 p-4">
                        <!-- File List for Driving License -->
                        <div id="fileListDL" class="file-list">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ $user_details->userDoc[1]->image_name ?? '' }}" readonly>
                                    <div class="input-group-append">
                                        <button type="button" id="download-btn" class="btn btn-primary" data-filename="{{ $user_details->userDoc[0]->image_name ?? '' }}">Download</button>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" name="driving_licence_id" value="{{  $user_details->userDoc[1]->id ?? '' }}">
                        <input type="file" id="driving_licence_doc" name="driving_licence_doc" class="form-control form-control-sm my-3" accept=".png, .jpg, .jpeg, .pdf">
                        <label for="dl" class="fs-14 fw-500">Driving License</label>
                        <input type="text" id="driving_licence" name="driving_licence" class="fs-14 form-control" placeholder="Driving License Number" value="{{ Auth::user()->driving_licence ?? '' }}">
{{--                        <input type="submit" value="Upload Files" class="btn btn-sm w-100 btn-white border border-secondary rounded-pill mt-4">--}}
                    </div>
                </div>
                <!-- Aadhar Card Section -->
                <div class="col-12 col-lg-6">
                    <div class="fs-5 fw-500 mb-1">
                        Aadhaar Card
                    </div>
                    <div class="fs-14 mb-3">
                        Your uploaded documents can be removed or updated anytime.
                    </div>
                    <div class="border-dotted bdr-20 p-4">
                        <!-- File List for Aadhar Card -->
                        <div id="fileListAadhar" class="file-list">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $user_details->userDoc[0]->image_name ?? '' }}" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="download-btn" class="btn btn-primary" data-filename="{{ $user_details->userDoc[0]->image_name ?? '' }}">Download</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="aadhaar_number_id" value="{{  $user_details->userDoc[0]->id ?? '' }}">
                        <input type="file" id="aadhaar_number_doc" name="aadhaar_number_doc" class="form-control form-control-sm my-3" accept=".png, .jpg, .jpeg, .pdf">
                        <label for="aadhaar" class="fs-14 fw-500">Aadhaar Number</label>
                        <input type="number" id="aadhaar_number" name="aadhaar_number" class="fs-14 form-control" placeholder="Aadhaar Number" value="{{ Auth::user()->aadhaar_number ?? '' }}">
{{--                        <input type="submit" value="Upload Files" class="btn btn-sm w-100 btn-white border border-secondary rounded-pill mt-4">--}}
                    </div>
                </div>
            </div>
        </div>

    </section>
    </form>
    @include('user.frontpage.footer')
        <!-- Bootstrap 5 JS (for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Separate file storage for Driving License and Aadhar Card
        let selectedFilesDL = [];
        let selectedFilesAadhar = [];

        // Handle Driving License file input change
        document.getElementById('driving_licence_doc').addEventListener('change', function(event) {
            handleFileInput(event, selectedFilesDL, 'fileListDL');
        });

        // Handle Aadhar Card file input change
        document.getElementById('aadhaar_number_doc').addEventListener('change', function(event) {
            handleFileInput(event, selectedFilesAadhar, 'fileListAadhar');
        });

        // General function to handle file input for both Driving License and Aadhar
        function handleFileInput(event, fileArray, fileListId) {
            let files = event.target.files;

            // Clear the file array first
            fileArray.length = 0;

            // Add files to the file array
            for (let i = 0; i < files.length; i++) {
                fileArray.push(files[i]);
            }

            // Display files in the respective file list
            displayFileList(fileArray, fileListId);
        }

        // Function to display the list of files
        function displayFileList(fileArray, fileListId) {
            let fileList = document.getElementById(fileListId);
            fileList.innerHTML = ''; // Clear current file list

            fileArray.forEach((file, index) => {
                // Create a file item div
                let fileItem = document.createElement('div');
                fileItem.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2', 'p-2', 'border', 'rounded');

                // File name span
                let fileName = document.createElement('span');
                fileName.textContent = file.name;

                // Delete button
                let deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-link', 'p-0');
                deleteButton.innerHTML = '<i class="fa fa-trash-o" style="color:red;"></i>';
                deleteButton.onclick = function() {
                    removeFile(index, fileArray, fileListId);
                };

                // Append file name and delete button to file item
                fileItem.appendChild(fileName);
                fileItem.appendChild(deleteButton);

                // Append file item to file list
                fileList.appendChild(fileItem);
            });
        }

        // Function to remove a file from the file array
        function removeFile(index, fileArray, fileListId) {
            fileArray.splice(index, 1);
            displayFileList(fileArray, fileListId); // Refresh the displayed file list
        }

        // Function to save files (can be extended to upload files via server)
        function saveFiles(fileArray) {
            if (fileArray.length === 0) {
                alert('No files selected.');
            } else {
                alert('Files saved successfully!');
                console.log(fileArray);
            }
        }


    </script>



@endsection
