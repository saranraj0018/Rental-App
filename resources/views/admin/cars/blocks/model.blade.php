<div class="modal fade" id="create_block" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="car_block_label">Add New Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Success Alert -->
            <div class="modal-body">
                <form id="car_block_form">
                    <div class="form-row">
                        <label for="booking_id">Select Block Type</label>
                    </div>
                    <div class="form-row">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="block_type" id="maintenance" value="0" checked>
                            <label class="form-check-label" for="maintenance">Maintenance</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input discretionary" type="radio" name="block_type" id="discretionary" data-discretionary="discretionary" value="1">
                            <label class="form-check-label" for="discretionary">Discretionary</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="block_type" id="availability_type" value="2" >
                            <label class="form-check-label" for="availability_type">Availability Type</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="block_type" id="refurbish" value="3" >
                            <label class="form-check-label" for="refurbish">U-Refurbish</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="block_type" id="recovery" value="4" >
                            <label class="form-check-label" for="recovery">U-Recovery</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="block_type" id="reserve" value="5" >
                            <label class="form-check-label" for="reserve">LT-RESERVE</label>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="start_date"></label>
                            <div class="input-group" id="datetimepicker">
                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Select date and time" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the start date.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="end_date"></label>
                            <div class="input-group ">
                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Select end date and time" />
                                <div class="input-group-append" >
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the end date.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row gx-3">
                        <div class="form-group col-md-3 mt-3">
                            <select id="hub_city" name="hub_city" class="form-select w-100" data-live-search="true">
                                <option selected disabled>Hub</option>
                                @if(filled($city_list))
                                    @foreach($city_list as $id => $list)
                                        <option value="{{$id}}"> {{$list}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Please choose a hub.
                            </div>
                        </div>

                        <div class="form-group col-md-3 mt-3">
                            <select id="car_model" name="car_model" class="form-select w-100" data-live-search="true">
                                <option selected disabled>Model</option>
                            </select>
                            <div class="invalid-feedback">
                                Please choose a car model.
                            </div>
                        </div>
                        <div class="form-group col-md-3 mt-3 ">
                            <input type="text" class="form-control w-100 " id="booking_id" name="booking_id" placeholder="Booking ID">
                            <div class="invalid-feedback">
                                Please enter your car booking ID.
                            </div>
                        </div>
                        <div class="form-group col-md-3 mt-3">
                            <select id="block_car_register_number" name="block_car_register_number" class="form-select w-100" data-live-search="true">
                                <option selected disabled>Car Register Number</option>
                            </select>
                            <div class="invalid-feedback">
                                Please choose a register number.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="comment">Comments</label>
                        <input type="text" class="form-control" id="comment" name="comment" placeholder="Comments">
                        <div class="invalid-feedback">
                            Please enter the comments.
                        </div>
                    </div>
                    <div id="reason_maintenance">
                    <div class="form-row">
                        <div class="form-group col-md-6 mt-3">
                            <label >Please select the reason for Maintenance:</label>
                            <div class="invalid-feedback maintenance_error" id="maintenance_error">
                                Please select any  reason for Discretionary.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="major_repair" value="0">
                                <label class="form-check-label" for="major_repair">
                                    Major Repair
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="accident" value="1">
                                <label class="form-check-label" for="accident">
                                    Accident
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="running_repair" value="2">
                                <label class="form-check-label" for="running_repair">
                                    Running Repair
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="service" value="3">
                                <label class="form-check-label" for="service">
                                    Service
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="others" value="4">
                                <label class="form-check-label" for="others">
                                    Others
                                </label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="reason_discretionary">
                        <div class="form-row">
                            <div class="form-group col-md-6 mt-3">
                                <label >Please select the reason for Discretionary:</label>
                                <div class="invalid-feedback discretion_error" id="discretion_error">
                                    Please select any reason for Discretionary.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason_discretion" id="buffer" value="5">
                                    <label class="form-check-label" for="buffer">
                                        Buffer
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason_discretion" id="gps_issue" value="6">
                                    <label class="form-check-label" for="gps_issue">
                                        GPS Issue
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason_discretion" id="forced_extension" value="7">
                                    <label class="form-check-label" for="forced_extension">
                                        Forced Extension
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason_discretion" id="others" value="9">
                                    <label class="form-check-label" for="others">
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="" id="block_id"  name="block_id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" id="submit_block" class="btn btn-primary mb-2">Submit</button>
                        </div>
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
