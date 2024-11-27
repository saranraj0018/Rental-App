@extends('admin.layout.app')
@section('content')
    <form id="ipr_info_section" >
        <input type="hidden" name="ipr_info_id" value="{{ $ipr_id ?? 0  }}">
        <div class="container-fluid py-4 px-5 mx-3">
            <div class="my-2 text-center editable-field">
                <span id="point_title">{{ $ipr_data['point_title'] ?? 'Important Points To Remember' }}</span>
                <i class="fas fa-pencil-alt"></i>
                <input type="text" class="editable-input d-none" id="point_title" name="point_title" value="{{  $ipr_data['point_title'] ?? 'Important Points To Remember' }}">
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img src='{{asset("admin/img/currency.svg")}}' alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="price_plan" name="price_plan" placeholder="Change In Pricing Plan"  value="{{  $ipr_data['price_plan'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Price plan.
                                </div>
                                <textarea name="price_description" id="price_description" rows="3" class="form-control"
                                          placeholder="The pricing plan (10 kms/hr, without fuel) cannot be changed after the booking is made">{{$ipr_data['price_description'] ?? ''}}</textarea>
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
                                <img src="{{asset("admin/img/bunk.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="fuel" name="fuel" placeholder="Well maintained cars" value="{{ $ipr_data['fuel'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the Fuel.
                                </div>
                                <textarea name="fuel_description" id="fuel_description" rows="3" class="form-control"
                                          placeholder="Regular service & maintenance; Inspected before each trip">{{ $ipr_data['fuel_description'] ?? '' }}</textarea>
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
                                <img src="{{asset("admin/img/picture_id.svg")}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="picture_id" name="picture_id" placeholder="Home delivery & return" value="{{ $ipr_data['picture_id'] ?? '' }}">
                                <div class="invalid-feedback">
                                    Please Enter the ID Verification.
                                </div>
                                <textarea name="picture_description" id="picture_description" rows="3" class="form-control"
                                          placeholder="In case you are returning the car at a lower fuel level than what was received">{{$ipr_data['picture_description'] ?? ''}}</textarea>
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
                                <img src="{{asset('admin/img/key_lock.svg')}}" alt="Your Image" class="img-fluid mb-2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" id="car_key" name="car_key" placeholder="Price transparency" value="{{$ipr_data['car_key'] ?? ''}}">
                                <div class="invalid-feedback">
                                    Please Enter the Pre-Handover.
                                </div>
                                <textarea name="car_key_description" id="car_key_description" rows="3" class="form-control"
                                          placeholder="Please inspect the car (including the fuel gauge and odometer) thoroughly before approving the checklist.">{{ $ipr_data['car_key_description'] ?? '' }}</textarea>
                                <div class="invalid-feedback">
                                    Please Enter the Description.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="ipr_info_submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
@endsection
@section('customJs')
    <script src="{{asset("admin/js/points.js")}}"></script>
@endsection
