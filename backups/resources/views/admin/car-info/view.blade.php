@extends('admin.layout.app')
@section('content')
    <form id="car_info_section" action="{{ route('car-info.save') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="car_info_id" value="{{ $car_info_id ?? 0 }}">
        <div class="container-fluid py-4 px-5 mx-3">
            <div class="text-center py-2">
                <div class="editable-field">
                    <span id="car_information">{{ $car_data['car_information'] ?? 'Coimbatore Car Rental: Real Time Information' }}</span>
                    <i class="fas fa-pencil-alt"></i>
                    <input type="text" class="editable-input d-none" id="car_information" name="car_information" value="{{ $car_data['car_information'] ?? 'Coimbatore Car Rental: Real Time Information' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img src="{{asset("admin/img/Group 6564.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" placeholder="₹1500" id="daily_price" name="daily_price" value="{{ $car_data['daily_price'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Price (number).
                                </div>
                                <input type="text" class="form-control" id="daily_price_title" name="daily_price_title" placeholder="Avg Daily Price Title" value="{{ $car_data['daily_price_title'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset("admin/img/car.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="car_model" name="car_model" placeholder="Swift"  value="{{ $car_data['car_model'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Model.
                                </div>
                                <input type="text" class="form-control" id="car_model_title" name="car_model_title" placeholder="Model Title"  value="{{ $car_data['car_model_title'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset("admin/img/hand-money.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="hour_rate" name="hour_rate" placeholder="₹120 per hour"  value="{{ $car_data['hour_rate'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Rate (number).
                                </div>
                                <input type="text" class="form-control" id="hour_rate_title" name="hour_rate_title" placeholder="Cheapest Rate Title"  value="{{ $car_data['hour_rate_title'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset("admin/img/Group 6564.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="rating" name="rating" placeholder="4.5"  value="{{ $car_data['rating'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Rating (number).
                                </div>
                                <input type="text" class="form-control" id="rating_title" name="rating_title" placeholder="Rating Title"  value="{{ $car_data['rating_title'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-2 text-center editable-field">
                <span id="valam_title">{{ $car_data['valam_title'] ?? 'Why Valam?' }}</span>
                <i class="fas fa-pencil-alt"></i>
                <input type="text" class="editable-input d-none" id="valam_title" name="valam_title" value="{{ $car_data['valam_title'] ?? 'Why Valam?' }}">
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src='{{asset("admin/img/drive.svg")}}' alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="flexibility" name="flexibility" placeholder="Book with flexibility"  value="{{ $car_data['flexibility'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the flexibility.
                                </div>
                                <textarea name="flexibility_description" id="flexibility_description" rows="3" class="form-control"
                                          placeholder="Filter offers with free cancellation, unlimited mileage etc..">{{ $car_data['flexibility_description'] ?? '' }}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset("admin/img/car-balance.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="maintained" name="maintained" placeholder="Well maintained cars" value="{{ $car_data['maintained'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Details.
                                </div>
                                <textarea name="maintained_description" id="maintained_description" rows="3" class="form-control"
                                          placeholder="Regular service & maintenance; Inspected before each trip">{{ $car_data['maintained_description'] }}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset("admin/img/car-garages.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="delivery" name="delivery" placeholder="Home delivery & return" value="{{ $car_data['delivery'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Delivery Details.
                                </div>
                                <textarea name="delivery_description" id="delivery_description" rows="3" class="form-control"
                                          placeholder="On-time doorstep service at your preferred location and time.">{{ $car_data['delivery_description'] }}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img id="image_preview_2" src="{{asset('admin/img/car-garages.svg')}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="price" name="price" placeholder="Price transparency" value="{{ $car_data['price'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the price.
                                </div>
                                <textarea name="price_description" id="price_description" rows="3" class="form-control"
                                          placeholder="See the total cost up front so there are no surprises..">{{ $car_data['price_description'] ?? ''}}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-2 text-center editable-field">
                <span id="car_title">{{ $car_data['car_title'] ?? 'Car Info' }}</span>
                <i class="fas fa-pencil-alt"></i>
                <input type="text" class="editable-input d-none" id="car_title" name="car_title" value="{{ $car_data['car_title'] ?? 'Car Info' }}">
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-header editable-field">
                                <span id="travel">{{ $car_data['travel'] ?? "LET'S TRAVEL TOGETHER!" }}</span>
                                <i class="fas fa-pencil-alt"></i>
                                <input type="text" class="editable-input d-none" id="travel" name="travel" value="{{ $car_data['travel'] ?? "LET'S TRAVEL TOGETHER!" }}">
                            </div>
                            <div class="form-group">
                                <textarea name="travel_description" id="travel_description" rows="3" class="form-control"
                                          placeholder="With Valam, every mile turns into a personal adventure on the road.">{{ $car_data['travel_description'] ?? ''}}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-header editable-field">
                                <span id="valam_ride">{{ $car_data['valam_ride'] ?? 'Ride Safe with Valam' }}</span>
                                <i class="fas fa-pencil-alt"></i>
                                <input type="text" class="editable-input d-none" id="valam_ride" name="valam_ride" value="{{ $car_data['valam_ride'] ?? 'Ride Safe with Valam' }}">
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="description" rows="3" class="form-control" placeholder="Description">{{ $car_data['description'] ?? '' }}
                                </textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Get 15% To 20% OFF" value="{{ $car_data['discount'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Discount.
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="front_car_image" id="front_car_image" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Image Preview</h5>
                            <img id="image_preview" src="{{ !empty($car_image->first()->name) ? asset('storage/car-info-section/' . $car_image->first()->name) : asset('admin/img/Component 11.png') }}" alt="Your Image" class="img-fluid mb-2" style="max-height: 300px;">
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" id="car_info_submit" class="btn btn-primary btn-block">Submit</button>

        </div>
    </form>
@endsection
@section('customJs')
    <script src="{{asset("admin/js/frontend.js")}}"></script>
@endsection
