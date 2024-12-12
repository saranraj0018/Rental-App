<div class="modal fade" id="reschedule_model" tabindex="-1" role="dialog" aria-labelledby="riskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riskModalLabel">Reschedule Pickup Date</h5>
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
                        <label for="delivery_date">Pickup Date</label>
                        <input type="text" class="form-control" id="delivery_date" name="delivery_date" required>
                        <div class="invalid-feedback">
                            Please provide a valid delivery date.
                        </div>
                    </div>

                    <div id="price-details" class="mt-3">

                    </div>

                    <button type="button" id="calculate_price" class="btn btn-info">Calculate Price</button>
                    <button type="button" id="close_pop" class="btn btn-danger float-right">Close</button>
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
            <button type="button" id="details_close_pop" class="btn btn-danger float-right">Close</button>
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
                        <h1>Cancel Policy</h1>

                        <label for="cancel_reason">Reason for Cancellation</label>
                        <textarea class="form-control" id="cancel_reason" name="cancel_reason" rows="3" placeholder="Enter reason..."></textarea>
                        <div class="invalid-feedback">
                            Please provide a reason for cancellation.
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="accept_terms">
                        <label class="form-check-label" for="accept_terms">
                            I agree to the <a href="{{ route('cancellation') }}" id="termsLink" target="_blank" class="text-primary">terms and conditions</a>.
                        </label>
                        <div class="invalid-feedback">
                            You must accept the terms and conditions before proceeding.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger mt-3" id="confirm_cancel_btn" disabled>Confirm Cancellation</button>
                </form>
                <button type="button" id="cancel_close_pop" class="btn btn-danger  float-right">Close</button>
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

