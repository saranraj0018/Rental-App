<div class="modal fade" id="reschedule_model" tabindex="-1" role="dialog" aria-labelledby="riskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riskModalLabel">Reschedule Delivery Date</h5>
            </div>
            <div class="modal-body">
                <form id="risk-form" novalidate>
                    <input type="hidden" id="booking_id" name="booking_id">
                    <input type="hidden" id="model_id" name="model_id">

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="text" class="form-control" id="end_date" name="end_date" disabled>
                    </div>

                    <div id="comments-list" class="mb-3"></div>

                    <div class="form-group">
                        <label for="end_date">Reschedule Date</label>
                        <div class="col-6">
                            <div class="input-group">

                                <input type="text" class="form-control" id="dateTimeInput" placeholder="Select date and time" readonly>
                                <span class="input-group-text" id="dateIcon"><i class="fas fa-calendar-alt"></i></span>
                            </div>

                            <div class="w-75 picker p-3 card bg-light bg-gradient shadow border-0 my-5">
                                <!-- Tabs for Date and Time -->
                                <div class="d-flex justify-content-center">
                                    <ul class="nav nav-pills" id="dateTimeTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="date-tab" data-bs-toggle="tab" href="#dateTabContent"
                                               role="tab" aria-controls="dateTabContent" aria-selected="true">
                                                <i class="fas fa-calendar-alt"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="time-tab" data-bs-toggle="tab" href="#timeTabContent" role="tab"
                                               aria-controls="timeTabContent" aria-selected="false">
                                                <i class="fas fa-clock"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab content -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active p-3" id="dateTabContent" role="tabpanel"
                                         aria-labelledby="date-tab">
                                        <!-- Inline Calendar -->
                                        <div class="d-flex justify-content-center">
                                            <div id="inlineDatePicker"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade p-3 o-scrl" id="timeTabContent" role="tabpanel" aria-labelledby="time-tab">
                                        <div id="time-buttons" class="d-flex justify-content-between flex-wrap">
                                            <!-- Time Buttons for 24 hours with 30-minute intervals -->
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="00:00">00:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="00:30">00:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="01:00">01:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="01:30">01:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="02:00">02:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="02:30">02:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="03:00">03:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="03:30">03:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="04:00">04:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="04:30">04:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="05:00">05:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="05:30">05:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="06:00">06:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="06:30">06:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="07:00">07:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="07:30">07:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="08:00">08:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="08:30">08:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="09:00">09:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="09:30">09:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="10:00">10:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="10:30">10:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="11:00">11:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="11:30">11:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="12:00">12:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="12:30">12:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="13:00">13:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="13:30">13:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="14:00">14:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="14:30">14:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="15:00">15:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="15:30">15:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="16:00">16:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="16:30">16:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="17:00">17:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="17:30">17:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="18:00">18:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="18:30">18:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="19:00">19:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="19:30">19:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="20:00">20:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="20:30">20:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="21:00">21:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="21:30">21:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="22:00">22:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="22:30">22:30</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="23:00">23:00</button>
                                            <button class="btn btn-outline-primary btn-sm time-btn me-2 mb-2"
                                                    data-time="23:30">23:30</button>
                                            <!-- Add more buttons as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="price-details" class="mt-3">

                    </div>

                    <button type="button" id="calculate_price" class="btn btn-info">Calculate Price</button>
                    <button type="button" id="close_pop" class="btn btn-danger float-right">OK</button>
                    <button type="submit" class="btn btn-primary d-none" id="reschedule_pay">Pay</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="booking_model" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Booking Details</h5>
                <h7 id="booking_id"></h7>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Payment Details -->
                    <h6 class="mt-4 mb-3 font-weight-bold" >Payment Details</h6>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label>Total Days</label>
                            <input type="text" id="total_days" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Total Hours</label>
                            <input type="text" id="total_hours" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Total Price</label>
                            <input type="text" id="total_price" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-md-4">
                            <label>Festival Amount</label>
                            <input type="text" id="festival_amount" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Weekend Amount</label>
                            <input type="text" id="weekend_amount" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Weekdays Amount</label>
                            <input type="text" id="week_days_amount" class="form-control" disabled>
                        </div>
                    </div>

                    <!-- Car Details -->
                    <h6 class="mt-4 mb-3 font-weight-bold">Car Details</h6>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Model Name</label>
                            <input type="text" id="model_name" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Register Number</label>
                            <input type="text" id="register_number" class="form-control" disabled>
                        </div>
                    </div>

                    <!-- Coupon Details -->
                    <h6 class="mt-4 mb-3 font-weight-bold">Coupon Details</h6>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Coupon Code</label>
                            <input type="text" id="coupon_code" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Discount</label>
                            <input type="text" id="discount" class="form-control" disabled>
                        </div>
                    </div>
                </form>
            </div>
            <button type="button" id="details_close_pop" class="btn btn-danger float-right">OK</button>
        </div>
    </div>
</div>

<div class="modal fade" id="cancel_booking" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
            </div>
            <div class="modal-body">
                <form id="cancel_booking_form">
                    <input type="hidden" id="cancel_booking_id" name="cancel_booking_id">
                    <div class="form-group">
                        <h1>Cancel policy</h1>
                        <p class="text-danger">
                            1.Cancelling a booking within 24 hours incurs a fee of 500.
                            2.Cancelling a booking after 24 hours incurs a fee of 3000.
                        </p>
                        <label for="cancel-reason">Reason for Cancellation</label>

                        <textarea class="form-control" id="cancel_reason" name="cancel_reason" rows="3" placeholder="Enter reason..."></textarea>
                        <div class="invalid-feedback">
                            Please provide a reason for cancellation.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                    <button type="button" id="cancel_close_pop" class="btn btn-danger float-right">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).on('click', '#reschedule_pay', function(e) {
        let total_price = {{ session('reschedule_total_price') ?? 0 }};
        let bookingId = $('#booking_id').val();

        // Initialize Razorpay payment
        const options = {
            "key": "{{ config('services.razorpay.key') }}", // Replace with your Razorpay API key
            "amount": total_price * 100, // Amount is in paise
            "currency": "INR",
            "name": "{{Auth::user()->name}}",
            "description": "Reschedule Delivery",
            "handler": function (response) {
                // On successful payment, make an AJAX request to update the booking
                fetch(`/user/complete-payment`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ booking_id: bookingId, payment_id: response.razorpay_payment_id })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Payment successful!');
                            $('#reschedule_model').modal('hide');
                            window.location.reload();
                        } else {
                            alert('Payment failed. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while completing the payment.');
                    });
            },
            "prefill": {
                "name": "{{ Auth::user()->name }}",
                "email": "{{ Auth::user()->email }}",
                "contact": "{{ Auth::user()->phone }}"
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    });
</script>

