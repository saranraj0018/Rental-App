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
                            <select id="service_city" name="service_city" class="form-select @error('service_city') is-invalid @enderror" data-live-search="true">
                                <option selected disabled>City</option>
                                <option value=632-Coimbatore" {{ old('service_city') == 632 ? 'selected' : '' }}>Coimbatore</option>
                            </select>
                            <div class="invalid-feedback">
                                Please choose a service city.
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="hub_city">Choose a Hub</label>
                            <select id="hub_city" name="hub_city" class="form-control @error('hub') is-invalid @enderror" data-live-search="true">
                                <option selected disabled>Hub</option>
                                <option value="632-Coimbatore" {{ old('hub') == 632 ? 'selected' : '' }}>Coimbatore</option>
                            </select>
                            @error('hub')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback">
                                Please choose a hub.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="car_model">Choose a Car Model</label>
                            <select id="car_model" name="car_model" class="form-control @error('car_model') is-invalid @enderror" data-live-search="true">
                                <option selected disabled>Model</option>
                                <option value="1" {{ old('car_model') == 1 ? 'selected' : '' }}>EcoSport</option>
                                <option value="2" {{ old('car_model') == 2 ? 'selected' : '' }}>Grandi10</option>
                                <option value="3" {{ old('car_model') == 3 ? 'selected' : '' }}>Xuv</option>
                                <option value="4" {{ old('car_model') == 4 ? 'selected' : '' }}>Scorpio</option>
                                <option value="5" {{ old('car_model') == 5 ? 'selected' : '' }}>City</option>
                            </select>
                            @error('car_model')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback">
                                Please choose a car model.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="register_number">Car Registration Number</label>
                            <input type="text" class="form-control @error('register_number') is-invalid @enderror" id="register_number" name="register_number" value="{{ old('register_number') }}" placeholder="Registration Number">
                            @error('register_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter your car registration number.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="current_km">Current KM Reading</label>
                            <input type="number" class="form-control @error('current_km') is-invalid @enderror" id="current_km" name="current_km" value="{{ old('current_km') }}" placeholder="4 KM">
                            @error('current_km')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter the current KM reading.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" id="car_id"  name="car_id">
                    <div class="col-auto my-1">


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" id="submit_btn" class="btn btn-primary mb-2">Submit</button>
                        </div>
                        <div class="form-group col-md-6">
                            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                                <strong>Success!</strong> Your message has been sent successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
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
                <form  id="car_model_form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="producer">Producer</label>
                            <input type="text" class="form-control" id="producer" placeholder="Producer">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="car_model">Car Model Name</label>
                            <input type="text" class="form-control" id="car_model" placeholder="Swift Vdi">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="seats">Seats</label>
                            <input type="number" class="form-control" id="seats" placeholder="4">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fuel_type">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" placeholder="Petrol/Diesel/CNG">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="transmission">Transmission</label>
                            <input type="text" class="form-control" id="transmission" placeholder="Automatic/Manual">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="engine_power">Engine Power</label>
                            <input type="text" class="form-control" id="engine_power" placeholder="Horsepower">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price_per_hours">Price per Hours</label>
                            <input type="number" class="form-control" id="price_per_hours" placeholder="50">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekend_surge">Weekend Surge</label>
                            <input type="number" class="form-control" id="weekend_surge" placeholder="0">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="peak_season">Peak Season Surge</label>
                            <input type="number" class="form-control" id="peak_season" placeholder="0">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="extra_km_charge">Extra Kms Charge</label>
                            <input type="number" class="form-control" id="extra_km_charge" placeholder="4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="car_file" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="other_files">Other Images (Minimum 2)</label>
                            <input type="file" class="form-control" id="customFile" />
                        </div>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



