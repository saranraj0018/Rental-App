<div class="modal fade" id="reschedule_model" tabindex="-1" role="dialog" aria-labelledby="riskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riskModalLabel">Reschedule Delivery Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                        <label for="delivery_date">Delivery Date</label>
                        <input type="text" class="form-control" id="delivery_date" name="delivery_date" required>
                        <div class="invalid-feedback">
                            Please provide a valid delivery date.
                        </div>
                    </div>

                    <div id="price-details" class="mt-3">

                    </div>

                    <button type="button" id="calculate_price" class="btn btn-info">Calculate Price</button>
                    <button type="submit" class="btn btn-primary d-none" id="reschedule_pay">Pay</button>
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

