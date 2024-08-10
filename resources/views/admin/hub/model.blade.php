<div class="modal fade" id="create_car" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="car_label">Add New Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="car_form">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="service_city">Choose Service City</label>
                            <select id="service_city" name="service_city" class="form-control" data-live-search="true">
                                <option selected disabled>City</option>
                                <option value="632">Coimbatore</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hub">Choose a Hub</label>
                            <select id="hub" class="form-control" data-live-search="true">
                                <option selected disabled>Hub</option>
                                <option value="632">Coimbatore</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="car_model">Choose a Car Model</label>
                            <select id="car_model" class="form-control" data-live-search="true">
                                <option selected disabled>Model</option>
                                <option value="1">EcoSport</option>
                                <option value="2">Grandi10</option>
                                <option value="3">Xuv</option>
                                <option value="4">Scorpio</option>
                                <option value="5">City</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="register_number">Car Registration Number</label>
                            <input type="number" class="form-control" id="register_number" placeholder="Registration Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="current_km">Current KM Reading</label>
                            <input type="text" class="form-control" id="current_km" placeholder="4 KM">
                        </div>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" id="submitBtn" class="btn btn-primary mb-2">Submit</button>
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


