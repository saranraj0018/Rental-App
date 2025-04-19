<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTML</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: #f4f4f4; font-family: sans, arial; padding: 1em">

    <div>
        <p style="font-size: 1.5em; margin-bottom: 1em">Hi <b>{{ $booking->user->name }}</b>,</p>

        <p style="font-style: italic; color: #555; font-size: .9em">Thanks for booking with Valam cars! <strong
                style="color: #000;font-size: .8em">This email confirms your booking details</strong> and lists some
            important points that we request you to read beforehand.</p>

        <div style="padding: .3em; background: lightgray; border-radius: 5px">
            <span style="font-style: italic; color: #111; font-size: .8em; padding: 0 1em">For further questions or
                help, please visit <a href="https://www.valamcars.com">www.valamcars.com</a> or call us at <a
                    href="#">+91-9363065901.</a></span>

            <h5 style="padding: 0 1em; margin-bottom: 0">Booking details:</h5>
            <ul style="font-size: .7em">
                <li>Booking ID: <b>{{ $booking->booking_id }}</b></li>
                <li>Customer contact: <b>{{ $booking->user->mobile }}</b></li>
                <li>Booking duration:
                    <b>{{ \Carbon\Carbon::parse($booking->start_date)->diff(\Carbon\Carbon::parse($booking->end_date))->format('%d day(s), %h hour(s), %i minute(s)') }}</b>
                </li>
                <li>Car: <b>{{ $booking->Car->carModel->model_name }}</b></li>
                <li>Delivery address: <b>{{ $booking->location()->dropoff }}</b></li>
                <li>Pickup address: <b>{{ $booking->location()->pickup }}</b></li>
            </ul>
        </div>

        <hr />

        @php
            $prices = [ 
                'festival' =>  $booking->Car->carModel->peak_reason_surge ?? 0,
                'weekend' => $booking->Car->carModel->weekend_surge ?? 0,
                'weekday' =>  $booking->Car->carModel->price_per_hour ?? 0
            ];

            $price_list = \App\Http\Controllers\User\UserController::calculatePrice($prices,session('start_date'),session('end_date'));
            $paymentDetails = json_decode($booking->details[0]->payment_details); 
            $coupon = json_decode($booking->details[0]->coupon); 
        @endphp

        <div style="padding: .3em;  border-radius: 5px; width: 50%">
            <h5 style="padding: 0 1em; margin-bottom: 0">Payment details:</h5>
            <ul style="font-size: .7em">
                <li>Total fare: <b>Rs. {{ 
                    (isNull($paymentDetails?->week_days_amount, 0) + 
                    isNull($paymentDetails?->week_end_amount, 0) + 
                    isNull($paymentDetails?->festival_amount, 0) + 
                    isNull($booking?->delivery_fee, 0) + 
                    isNull($booking?->Car?->carModel?->dep_amount, 0)) -
                    (isNull($coupon?->discount, 0) + isNull($booking?->payment?->discount, 0))
                }}</b></li>
                <li>Total paid: <b>Rs. {{ ($booking?->payment?->amount) - (isNull($coupon?->discount, 0) + isNull($booking?->payment?->discount, 0)) }}</b></li>
            </ul>
        </div>

       

        <div style="padding: .3em;  border-radius: 5px">
            
            <h5 style="padding: 0 1em; margin-bottom: 0">Fare break-up:</h5>
            <ul style="font-size: .7em">
                <li>Weekdays Fare <b>Rs. {{ $paymentDetails?->week_days_amount }}</b></li>
                <li>Weekends Fare <b>Rs. {{ $paymentDetails?->week_end_amount }}</b></li>
                <li>Festival Fare <b>Rs. {{ $paymentDetails?->festival_amount }}</b></li>
                <li>Base fare (incl. discount for long bookings) <b>Rs. {{ 
                    (isNull($paymentDetails?->week_days_amount, 0) + 
                    isNull($paymentDetails?->week_end_amount, 0) + 
                    isNull($paymentDetails?->festival_amount, 0))
                }}</b></li>
                
                <li>Doorstep delivery and pick-up charges: <b>Rs. {{ $booking?->delivery_fee ?? '0.00' }}</b></li>
                <li>Discounts: <b>Rs. {{ isNull($coupon?->discount, 0) +
                        isNull($booking?->payment?->discount, 0) }}</b></li>
                <li>Refundable security deposit: <b>Rs. {{ $booking?->Car?->carModel?->dep_amount }}</b></li>
                <li>Grand Total: <b> Rs. {{ 
                    (isNull($paymentDetails?->week_days_amount, 0) + 
                    isNull($paymentDetails?->week_end_amount, 0) + 
                    isNull($paymentDetails?->festival_amount, 0) + 
                    isNull($booking?->delivery_fee, 0) + 
                    isNull($booking?->Car?->carModel?->dep_amount, 0)) -
                    (isNull($coupon?->discount, 0) + isNull($booking?->payment?->discount, 0))
                }}</b></li>
                
                <br />
                <br />
                <li>Insurance and GST: <b>Included</b></li>
                
                
                <li>Pricing plan: <b>{{ !empty($booking->Car->carModel->per_day_km) && !empty($price_list['different_hours'])
    ? $booking->Car->carModel->per_day_km * $price_list['different_hours'] : 0 }} Kms/Hr</b></li>
                <li>Extra Kilometres charge: <b>{{ $booking->Car->carModel->extra_km_charge }}</b></li>
                <li>Extra Hour charge: <b>{{ $booking->Car->carModel->extra_hours_price }}</b></li>

            </ul>
        </div>

        <hr />
        <div style="padding: .3em; background: lightgray; border-radius: 5px; margin-top: 1em">
            <span style="font-style: italic; color: #111; font-size: .8em; padding: 0 1em">Important Points to Keep in
                Mind:</span>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">1. ID Verification</h6>
                <ul style="font-size: .7em">
                    <li>Please have your original Driving License and original ID proof (the same documents you provided
                        during booking) <br /> ready for verification at the time of delivery.</li>
                    <li>Our executive will verify these documents, and this step is mandatory.</li>
                    <li>Note: If you cannot provide these documents, we will be unable to hand over the car,<br /> and
                        it will be treated as a late cancellation (100% of the fare will be charged).</li>
                    <li>Important: Driving licenses printed on A4 sheets (original or otherwise) will not be accepted.
                    </li>
                </ul>
            </div>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">2. Modification Policy</h6>
                <ul style="font-size: .7em">
                    <li>Once the booking is made, the pricing plan (13 kms/hr, with fuel) cannot be modified.</li>
                    <li>Our executive will verify these documents, and this step is mandatory.</li>
                    <li>For more details, refer to the Payments and Refunds section in our FAQs.</li>
                </ul>
            </div>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">3. Tolls, Parking, MCD, and Inter-State Taxes</h6>
                <ul style="font-size: .7em">
                    <li>Cars equipped with Fastag will automatically deduct tolls on National Highways, which will be
                        added to your invoice.</li>
                    <li>All other tolls, parking fees, MCD, and inter-state taxes are your responsibility and must be
                        paid separately.</li>
                </ul>
            </div>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">4. Pre-Handover Inspection</h6>
                <ul style="font-size: .7em">
                    <li>Before starting your trip, inspect your Valam car and its fuel gauge, and approve the checklist
                        provided by our executive.</li>
                </ul>
            </div>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">5. Traveling to Leh/Ladakh</h6>
                <ul style="font-size: .7em">
                    <li>Additional terms and conditions apply when taking Valam vehicles to the Leh/Ladakh region.</li>
                </ul>
            </div>

            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">6. Customer Liability</h6>
                <ul style="font-size: .7em">
                    <li>In case of violations of Valam’s Terms and Conditions, your liability may exceed ₹30,000.</li>
                </ul>
            </div>


            <div style="margin: 0 1.3em">
                <h6 style="font-weight: 900; margin-bottom: 0">7. Trip Extensions</h6>
                <ul style="font-size: .7em">
                    <li>If you need to extend your trip, inform us at least 3 hours in advance. Extensions are subject
                        to availability.</li>
                    <li>Late returns will incur a penalty of ₹300 per hour.</li>
                </ul>
            </div>
        </div>

        <hr />


        <div style="padding: .3em; background: lightgray; border-radius: 5px">
            <span style="font-style: italic; color: #111; font-size: .8em; padding: 0 1em; ">Valam Terms and
                Conditions:</span>
            <p style="padding: 0 1em; margin: 1em 0 0 0; font-size: .7em; font-weight: 500">We recommend familiarizing
                yourself with Valam’s terms and conditions. You can find them:</p>
            <ul style="font-size: .7em">
                <li>Within the app menu</li>
                <li>On our <a href="https://www.valamcars.com">website</a>: Valam Terms and Conditions</li>
            </ul>
        </div>


        <p style="font-size: .8em; margin-top: 2em">For further assistance or questions, please visit our website at <a
                href="https://www.valamcars.com">www.valamcars.com</a> or call us at <a href="#">+91-9363065901.</a>.
            <br />Thank you for choosing Valam Cars! Enjoy your ride!
        </p>

        <div style="margin-top: 1em">
            <h5 style="margin: 0">Best regards,</h5>
            <p style="margin: 0; font-size: .8em">Team Valam</p>
        </div>
    </div>
</body>

</html>
