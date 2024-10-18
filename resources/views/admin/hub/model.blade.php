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
                    <div class="form-group">
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
                        <label for="start_date">Choose Date & Time</label>
                        <div class="input-group date datetimepicker" id="datetimepicker" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker" id="start_date" name="start_date" placeholder="Select date and time" />
                            <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
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

<div class="modal fade" id="amount_modal" tabindex="-1" role="dialog" aria-labelledby="amountModalLabel" aria-hidden="true">
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
                        <strong>Total Normal Fare:</strong> ₹<span id="week_days_amount">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Total festival Fare:</strong> ₹<span id="festival_amount">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Total Weekend Fare:</strong> ₹<span id="week_end_amount">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Total Base Fare:</strong> ₹<span id="modal_base_fare">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Doorstep Delivery & Pickup:</strong> ₹<span id="delivery_fee">0</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Refundable Security Deposit:</strong> ₹<span id="dep_fee">0</span>
                    </li>
{{--                    <li class="list-group-item">--}}
{{--                        <strong>Coupon Amount :</strong> ₹<span id="modal_security_deposit">0</span>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
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
                        <textarea class="form-control" id="cancel-reason" name="reason" rows="3" placeholder="Enter reason..."></textarea>
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



