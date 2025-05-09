<div class="modal fade" id="riskModal" tabindex="-1" role="dialog" aria-labelledby="riskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riskModalLabel">Add Risk Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="risk-form">
                    <input type="hidden" id="risk-booking-id" name="booking_id">
                    <div id="comments-list" class="mb-3"></div> <!-- This div will hold the list of comments -->
                    <div class="form-group">
                        <label for="risk-comment">New Comment</label>
                        <textarea class="form-control" id="risk-comment" name="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="alert-modal-admin" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Profile</h4>
            </div>

            <div class="modal-body">
                <p><i class="fa fa-check px-2 text-success"></i> Booking Created Successfully</p>

                <ul>
                    <li>Booking ID: <span id="response_booking_id"></span></li>
                    <li>Start Date: <span id="response_start_date"></span></li>
                    <li>End Date: <span id="response_end_date"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="user_model" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group d-none">
                        <label for="user_mobile">User Mobile</label>
                        <input type="number" id="user_mobile" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="user_aadhaar">User Aadhaar</label>
                        <input type="text" id="user_aadhaar" class="form-control" disabled>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Number Of Booking</button>
                        <p id="booking_count"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="date_model" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Reschedule Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="booking_date">
                    <div class="form-group">
                        <input type="hidden" id="date_booking_id" name="booking_id">
                        <input type="hidden" id="date_booking_type" name="booking_type">
                        <input type="hidden" id="date_start_date" name="start_date">
                        <input type="hidden" id="model_id" name="model_id">
                        <input type="hidden" id="car_id" name="car_id">
                        <label for="start_date">Choose Date & Time</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="end_date" name="end_date"
                                placeholder="Select date and time" />
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="amount_modal" tabindex="-1" role="dialog" aria-labelledby="amountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="booking_id">Booking Id</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Week Days Fare:</strong> ₹<span id="week_days_amount">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Festival Fare:</strong> ₹<span id="festival_amount">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Weekend Fare:</strong> ₹<span id="week_end_amount">0</span>
                    </li>

                    <li class="list-group-item bg-secondary">
                        <strong>Base Fare:</strong> ₹<span id="modal_base_fare">0</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Doorstep Delivery & Pickup:</strong> ₹<span id="delivery_fee">0</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Coupon Amount:</strong> ₹<span id="coupon">0</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Manual Discount:</strong> ₹<span id="manual_discount">0</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Refundable Security Deposit:</strong> ₹<span id="dep_fee">0</span>
                    </li>

                    <li class="list-group-item bg-secondary">
                        <strong>Grand Total:</strong> ₹<span id="grand_total">0</span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancel-booking-form">
                    <input type="hidden" id="cancel-booking-id" name="booking_id">
                    <div class="form-group">
                        <label for="cancel-reason">Reason for Cancellation</label>
                        <textarea class="form-control" id="cancel-reason" name="reason" rows="3"
                            placeholder="Enter reason..."></textarea>
                        <div class="invalid-feedback">
                            Please provide a reason for cancellation.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create_user_booking" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="user_booking_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>

                </div>
                <div class="modal-body">
                    <!-- Form fields with horizontal layout -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control autofill_user_details" id="name" name="name">
                            <div class="invalid-feedback">
                                Please enter the Name.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control autofill_user_details" id="email" name="email">
                            <div class="invalid-feedback">
                                Please enter the Email.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control mobile_field" id="mobile" name="mobile">
                            <div class="invalid-feedback">
                                Please enter the Mobile.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pickup_location" class="form-label">Delivery Location</label>
                            <input type="text" class="form-control" id="drop_location" name="drop_location">
                            <div class="invalid-feedback">
                                Please enter the Delivery Location.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="drop_location" class="form-label">Pickup Location</label>
                            <input type="text" class="form-control" id="pickup_location" name="pickup_location">
                            <div class="invalid-feedback">
                                Please enter the Pickup Location.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="license_number" class="form-label">License Number</label>
                            <input type="text" class="form-control autofill_user_details" id="license_number" name="license_number">
                            <div class="invalid-feedback">
                                Please enter the License Number.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="aadhaar_card" class="form-label">Aadhaar Card Number</label>
                            <input type="number" class="form-control autofill_user_details" id="aadhaar_card" name="aadhaar_card">
                            <div class="invalid-feedback">
                                Please enter the Aadhaar Card Number.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date">Start Date & Time</label>
                            <div class="input-group" id="start_date_picker">
                                <input type="text" class="form-control" id="user_start_date" name="user_start_date"
                                    placeholder="Select date and time" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the start date.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date">End Date & Time</label>
                            <div class="input-group" id="user_end_date_picker" data-target-input="nearest">
                                <input type="text" class="form-control" id="user_end_date" name="user_end_date"
                                    placeholder="Select date and time" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the End date.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="hub_list" class="form-label">Hub List </label>
                            <select class="form-select" id="hub_list" name="hub_list" data-live-search="true">
                                <option disabled selected>Select City</option>
                                @if(!empty($city_list))
                                    @foreach($city_list as $id => $list)
                                        <option value="{{$id}}">{{$list}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px">
                            <button type="submit" class="btn btn-primary" id="car_available">Car Availability</button>
                        </div>

                        <div class="col-md-12 mt-3" id="car_availability_section" style="display: none;">
                            <label for="car_model" class="form-label">Available Cars</label>
                            <select class="form-select" id="user_car_model" name="user_car_model"
                                data-live-search="true">
                                <option value="">Select Car Model</option>
                                <!-- Dynamic options will be loaded here -->
                            </select>
                        </div>


                        <input type="hidden" id="user_amount" name="user_amount">

                        <div class="col-md-12 mt-3" id="price_list_section" style="display: none;" x-data="{
                            grandTotal: 0,
                            discount: 0,
                            mode_of_payment: '',

                            updateTotal() {
                                if(!isNaN(parseFloat($('#final_total_price').text()) - this.discount)) {
                                    this.grandTotal = parseFloat($('#final_total_price').text()) - this.discount
                                } else return 0;
                            }
                        }">
                            <h5>Price Details</h5>

                            <div class="row">
                                <ul class="list-group col-6">
                                    <li class="list-group-item">Model Name: <span id="model_name"></span></li>
                                    <li class="list-group-item">Total Days: <span id="total_days"></span></li>
                                    <li class="list-group-item">Total hours: <span id="total_hours"></span></li>
                                    <li class="list-group-item">Weekdays Amount: ₹<span
                                            id="user_week_days_amount"></span>
                                    </li>
                                    <li class="list-group-item">Weekend Amount: ₹<span id="user_week_end_amount"></span>
                                    </li>
                                    <li class="list-group-item">Festival Amount: ₹<span
                                            id="user_festival_amount"></span>
                                    </li>
                                    <li class="list-group-item">Total Price: ₹<span id="total_price"></span></li>
                                    <li class="list-group-item">Doorstep delivery & pickup: ₹<span
                                            id="user_delivery_fee"></span></li>
                                    <li class="list-group-item">Refundable security deposit: ₹<span
                                            id="security_dep"></span></li>
                                    <li class="list-group-item">Total Price: ₹<span id="final_total_price"></span>
                                    </li>

                                    <li class="list-group-item">Grand Total ₹<span id="grand_total"
                                            x-text="grandTotal"></span></li>
                                </ul>

                                <ul class="list-group col-6">
                                    <li class="list-group-item">Mode of Payment: <input x-on:change="updateTotal"
                                        class="form-control" id="mode_of_payment" type="text" name="mode_of_payment"
                                        x-model="mode_of_payment" :value="mode_of_payment" placeholder="Enter payment mode"></li>

                                    <li class="list-group-item">Discount: <input x-on:change="updateTotal"
                                            class="form-control" id="discount" type="number" name="discount"
                                            x-model="discount" :value="discount" placeholder="Fixed Eg.., 200.00"></li>
                                    <span class="text-sm p-3">* The discount will be added to the Grand Total
                                        automatically
                                    </span>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <p id="payment_success" class="text-success"></p>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="user_payment_link">Send Payment Link</button>
                    <button type="submit" id="manual_booking" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>

</div>
