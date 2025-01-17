@extends('admin.layout.app')
@section('content')
    <form id="brand_section" action="{{ route('brand.save') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="brand_id" id="brand_id" value="{{ $brand_id ?? 0 }}">
        <!-- Car Information Section -->
        <div class="text-center py-2">
            <div class="editable-field">
                <span id="brand_title">{{ $brand_titles['brand_title'] ?? 'Popular Brands' }}</span>
                <i class="fas fa-pencil-alt"></i>
                <input type="text" class="editable-input d-none" id="brand_title_input" name="brand_title" value="{{ $brand_titles['brand_title'] ?? 'Popular Brands' }}">
                @if (in_array('brands_and_vacation_create', getAdminPermissions()))
                <button id="add-car-btn" class="btn btn-primary ml-auto d-flex" type="button">Add Car</button>
                @endif
            </div>
        </div>
        {{--        Brand Edit section --}}
        @if(!empty($brand_id) && !empty($brand_image))
            <div class="row" id="car-card-container">
                <!-- Initial 6 Edit car cards -->
                @php $i = 1;@endphp
                @foreach($brand_image as $key => $image)
                    @if(!empty($image->slug) && $image->slug == 'brand-image')
                        <div class="col-2 card-col mb-3" id="car_card_{{$i}}">
                            <div class="card">
                                <div class="card-body position-relative">
                                    <img id="car_image_preview_{{$i}}" src=" {{ !empty($image->name) ? asset('storage/brand-section/' . $image->name) : asset('admin/img/01.png') }}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                                    <input type="file" class="brand form-control car" name="car_image_{{$image->id}}" id="car_image_{{$i}}" accept=".png, .jpg, .jpeg" onchange="previewImage(event, {{$i++}}, 'car_image_preview_')">
                                    <div class="invalid-feedback">
                                        Please choose the Image.
                                    </div>
                                    @if($i == 8)
                                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 btn-remove delete-brand" data-id="{{$image->id}}" type="button" >X</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @elseif(empty($brand_id) && empty($brand_image))
            <div class="row" id="car-card-container">
                <!-- Initial 6 Add car cards -->
                <script>
                    const carImages = [
                        "{{ asset('admin/img/01.png') }}",
                        "{{ asset('admin/img/02.png') }}",
                        "{{ asset('admin/img/03.png') }}",
                        "{{ asset('admin/img/05.png') }}",
                        "{{ asset('admin/img/06.png') }}",
                        "{{ asset('admin/img/07.png') }}",
                    ];


                    for (let i = 0; i < carImages.length; i++) {
                        document.write(`
                <div class="col-2 card-col mb-3" id="car_card_${i}">
                    <div class="card">
                        <div class="card-body position-relative">
                            <img id="car_image_preview_${i}" src="${carImages[i]}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                            <input type="file" class="brand form-control car" name="car_image_${i}" id="car_image_${i}" accept=".png, .jpg, .jpeg" onchange="previewImage(event, ${i}, 'car_image_preview_')">
                                <div class="invalid-feedback">
                                    Please choose the Image.
                                </div>
                        </div>
                    </div>
                </div>`);
                    }
                </script>
            </div>
        @endif

        <!-- Vacation Trip Section -->
        <div class="text-center py-2 mt-4">
            <div class="editable-field">
                <span id="vacation_trip">{{ $brand_titles['vacation_trip'] ?? 'Where to next vacation trip?' }}</span>
                <i class="fas fa-pencil-alt"></i>
                <input type="text" class="editable-input d-none" id="vacation_trip_input" name="vacation_trip" value="{{ $brand_titles['vacation_trip'] ?? 'Where to next vacation trip?' }}">
                 @if (in_array('brands_and_vacation_create', getAdminPermissions()))
                    <button id="add-vacation-btn" class="btn btn-primary ml-auto d-flex"  type="button">Add Vacation</button>
                @endif

            </div>
        </div>
        @if(!empty($brand_id) && !empty($brand_image))
            <div class="row" id="vacation-card-container">
                <!-- Initial 6 vacation cards -->
                @php $i = 1;@endphp
                @foreach($brand_image as $key => $image)
                    @if(!empty($image->slug) && $image->slug == 'vacation-image')
                        <div class="col-2 card-col mb-3" id="vacation_card_{{$i}}">
                            <div class="card">
                                <div class="card-body position-relative">
                                    <img id="vacation_image_preview_{{$i}}" src="{{ !empty($image->name) ? asset('storage/vacation-section/' . $image->name) :  asset('admin/img/maruthamalai.png') }}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                                    <input type="file" class="brand form-control vacation" name="vacation_image_{{$image->id}}" id="vacation_image_{{$i}}" accept=".png, .jpg, .jpeg" onchange="previewImage(event, {{$i++}}, 'vacation_image_preview_')">
                                    <div class="invalid-feedback">
                                        Please choose the Image.
                                    </div>
                                    <label for="basic-url">Location Name</label>
                                    <textarea name="vacation_description_{{$image->id}}" id="vacation_description_{{$i}}" rows="3" class="form-control vacation-description" placeholder="Vacation Title">{{ $image->description }}</textarea>
                                    <div class="invalid-feedback">
                                        Please Enter the Description.
                                    </div>
                                    <label for="basic-url">Route</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control vacation-url" id="vacation_url_{{$i}}" name="vacation_url_{{$image->id}}" aria-describedby="basic-addon3" placeholder="Vacation link" value="{{ $image->title }}">
                                        <div class="invalid-feedback">
                                            Please add the Vacation Url.
                                        </div>
                                    </div>
                                    @if($i == 8)
                                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 btn-remove delete-brand" data-id="{{$image->id}}" type="button" >X</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="row" id="vacation-card-container">
                <!-- Initial 6 vacation cards -->
                <script>
                    const vacationImages = [
                        "{{ asset('admin/img/museum.png') }}",
                        "{{ asset('admin/img/isha.png') }}",
                        "{{ asset('admin/img/maruthamalai.png') }}",
                        "{{ asset('admin/img/kovai-kondattam.png') }}",
                        "{{ asset('admin/img/vellingiri.png') }}",
                        "{{ asset('admin/img/maruthamalai.png') }}",
                    ];
                    for (let i = 0; i < vacationImages.length; i++) {
                        document.write(`
                   <div class="col-2 card-col mb-3" id="vacation_card_${i}">
                        <div class="card">
                            <div class="card-body position-relative">
                                   <img id="vacation_image_preview_${i}" src="${vacationImages[i]}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                                      <input type="file" class="brand form-control vacation" name="vacation_image_${i}" id="vacation_image_${i}" accept=".png, .jpg, .jpeg" onchange="previewImage(event, ${i}, 'vacation_image_preview_')">
                                          <div class="invalid-feedback">
                                             Please choose the Image.
                                          </div>
                                           <textarea name="vacation_description_${i}" id="vacation_description_${i}" rows="3" class="form-control vacation-description" placeholder="Vacation Title"></textarea>
                                            <div class="invalid-feedback">
                                               Please Enter the Description.
                                            </div>
                                                <label for="basic-url">Vacation URL</label>
                                         <div class="mb-3">
                                            <input type="text" class="form-control vacation-url" id="vacation_url_${i}" name="vacation_url_${i}" aria-describedby="basic-addon3" placeholder="Vacaton link">
                                            <div class="invalid-feedback">
                                                  Please add the Vacation Url.
                                           </div>
                                        </div>
                            </div>
                        </div>
                   </div>`);
                    }
                </script>
            </div>
        @endif
        @if (in_array('brands_and_vacation_create', getAdminPermissions()))
        <button type="submit" id="vacation_submit" class="btn btn-primary btn-block">Submit</button>
        @endif
    </form>
    <div class="container-fluid py-4 px-5 mx-3">
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="delete_brand_model" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm_delete_image">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles and Scripts -->
    <style>
        .brand {
            border: none !important;
        }
        input.brand {
            font-size: 10px !important;
        }
        .card-body {
            position: relative;
        }
        .btn-remove {
            position: absolute !important;
            top: 0;
            z-index: 10;
            left: 80%;
        }
    </style>
    <script>
        let carCardCount = 6;
        let vacationCardCount = 6;

        document.getElementById('add-car-btn').addEventListener('click', function() {
            addNewCard('car', carCardCount, '{{ asset('admin/img/01.png') }}');
            carCardCount++;
        });

        document.getElementById('add-vacation-btn').addEventListener('click', function() {
            addNewCard('vacation', vacationCardCount, '{{ asset('admin/img/maruthamalai.png') }}');
            vacationCardCount++;
        });

        function addNewCard(type, count, defaultImage) {
            const cardContainer = document.getElementById(`${type}-card-container`);
            const newCard = document.createElement('div');
            newCard.classList.add('col-2', 'card-col', 'mb-3');
            newCard.id = `${type}_card_${count}`;

            // Common content for all card types
            let cardContent = `
        <div class="card">
            <div class="card-body position-relative">
                <img id="${type}_image_preview_${count}" src="${defaultImage}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                <input type="file" class="brand form-control ${type}" name="${type}_image_${count}" id="${type}_image_${count}" accept=".png, .jpg, .jpeg" onchange="previewImage(event, ${count}, '${type}_image_preview_')">
               <div class="invalid-feedback">
                                    Please choose the Image.
                                </div>
                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 btn-remove"  type="button" onclick="removeCard('${type}_card_${count}')">X</button>`;

            // Additional content for vacation type
            if (type === 'vacation') {
                cardContent += `
                 <label for="basic-url">Location Name</label>
                <textarea name="vacation_description_${count}" id="vacation_description_${count}" rows="3" class="form-control vacation-description" placeholder="Vacation Title"></textarea>
                <div class="invalid-feedback">Please Enter the Description.</div>

                <label for="basic-url">Route</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control vacation-url" id="vacation_url_${count}" name="vacation_url_${count}" aria-describedby="basic-addon3" placeholder="Vacation link">
                    <div class="invalid-feedback">Please add the Vacation URL.</div>
                </div>`;
            }

            cardContent += `
            </div>
        </div>`;

            newCard.innerHTML = cardContent;
            cardContainer.appendChild(newCard);
        }

        function removeCard(cardId) {
            const card = document.getElementById(cardId);
            if (card) {
                card.remove();
            }
        }

        function previewImage(event, cardIndex, prefix) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById(`${prefix}${cardIndex}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@section('customJs')
    <script src="{{ asset('admin/js/frontend.js') }}"></script>
@endsection
