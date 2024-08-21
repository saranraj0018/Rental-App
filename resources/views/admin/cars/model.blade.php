<div class="modal fade" id="create_car" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="car_label">Add New Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Success Alert -->
            <div class="modal-body">
                <form id="car_form">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="service_city" class="form-label">Choose Service City</label>
                            <select id="service_city" name="service_city" class="form-select" data-live-search="true">
                                <option selected disabled>City</option>
                                <option value="632-Coimbatore">Coimbatore</option>
                            </select>
                            <div class="invalid-feedback">
                                Please choose a service city.
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="hub_city">Choose a Hub</label>
                            <select id="hub_city" name="hub_city" class="form-control" data-live-search="true">
                                <option selected disabled>Hub</option>
                                <option value="632-Coimbatore">Coimbatore</option>
                            </select>
                            <div class="invalid-feedback">
                                Please choose a hub.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="car_model">Choose a Car Model</label>
                            <select id="car_model" name="car_model" class="form-control" data-live-search="true">
                                <option selected disabled>Model</option>
                               @if(filled($car_models))
                                @foreach($car_models as $model)
                                    <option value="{{$model->car_model_id}}"> {{$model->model_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Please choose a car model.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="register_number">Car Registration Number</label>
                            <input type="text" class="form-control" id="register_number" name="register_number" value="{{ old('register_number') }}" placeholder="Registration Number">
                            <div class="invalid-feedback">
                                Please enter your car registration number.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="current_km">Current KM Reading</label>
                            <input type="number" class="form-control" id="current_km" name="current_km" value="{{ old('current_km') }}" placeholder="4 KM">
                            <div class="invalid-feedback">
                                Please enter the current KM reading.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" id="car_id"  name="car_id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" id="submit_btn" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--Add the car Model Popup --}}
<div class="modal fade" id="create_car_modal" tabindex="-1" role="dialog" aria-labelledby="carModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="car_modal_label">Add a New Car Model</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="car_model_form" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="producer">Producer</label>
                            <input type="text" class="form-control" id="producer" name="producer" placeholder="Producer">
                            <div class="invalid-feedback">
                                Please enter your Producer.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="model_name">Car Model Name</label>
                            <input type="text" class="form-control" id="model_name" name="model_name" placeholder="Swift Vdi">
                            <div class="invalid-feedback">
                                Please enter your Car Model Name.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="seats">Seats</label>
                            <input type="text" class="form-control" id="seats" name="seats" placeholder="4">
                            <div class="invalid-feedback">
                                Please enter your Seats Count.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fuel_type">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Petrol/Diesel/CNG">
                            <div class="invalid-feedback">
                                Please enter the Fuel Type.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="transmission">Transmission</label>
                            <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Automatic/Manual">
                            <div class="invalid-feedback">
                                Please enter the Transmission.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="engine_power">Engine Power</label>
                            <input type="text" class="form-control" id="engine_power" name="engine_power" placeholder="Horsepower">
                            <div class="invalid-feedback">
                                Please enter the Engine Power.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price_per_hours">Price per Hours</label>
                            <input type="number" class="form-control" id="price_per_hours" name="price_per_hours" placeholder="50">
                            <div class="invalid-feedback">
                                Please enter the Price Per Hours.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekend_surge">Weekend Surge</label>
                            <input type="number" class="form-control" id="weekend_surge" name="weekend_surge" placeholder="0">
                            <div class="invalid-feedback">
                                Please enter the Weekend Surge.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="peak_season">Peak Season Surge</label>
                            <input type="number" class="form-control" id="peak_season" name="peak_season" placeholder="0">
                            <div class="invalid-feedback">
                                Please enter the Peak Season Surge.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="extra_km_charge">Extra Kms Charge</label>
                            <input type="number" class="form-control" id="extra_km_charge" name="extra_km_charge" placeholder="4">
                            <div class="invalid-feedback">
                                Please enter the Extra Kms Charge.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="car_image" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="car_image" name="car_image" accept=".png, .jpg, .jpeg">
                            <div class="invalid-feedback">
                                Please upload your car image.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="car_other_image">Other Images (Minimum 2)</label>
                            <input type="file" class="form-control" id="car_other_image" name="car_other_image[]"
                                   accept=".png, .jpg, .jpeg" multiple/>
                            <div class="file-names mt-2"></div>
                            <div class="invalid-feedback">
                                Please upload your car image (Minimum Two Images).
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="model_id"  name="model_id">
                    <div class="col-auto my-1">
                        <button type="submit" id="car_model_Submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>




