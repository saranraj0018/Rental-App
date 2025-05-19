<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTML</title>
</head>

<body style="background: #f4f4f4; font-family: sans, arial; padding: 1em">

    <div>
        <p style="font-size: 1.5em; margin-bottom: 1em">Dear <b>{{ $booking->user->name }}</b>,</p>
        <p style="font-style: italic; color: #555; font-size: .9em">Your booking with Valam Cars has been successfully
            modified. Below are your updated booking details:</p>

        <div style="padding: .3em; background: lightgray; border-radius: 5px">
            <span style="font-style: italic; color: #111; font-size: .8em; padding: 0 1em">Updated Booking
                Details</span>

            <ul style="font-size: .7em">
                <li>Booking ID: <b>{{ $booking->booking_id }}</b></li>
                <li>Car Model: <b>{{ $booking?->Car?->carModel?->model_name }}</b></li>
                <li>Drop-off Location: <b>{{ $booking->location()->dropoff }}</b></li>
                <li>Drop-off Date/Time: <b>{{ $booking->booking_type == 'delivery' ? ($booking->reschedule_date ? $booking->reschedule_date : $booking->start_date) :  $booking->start_date }}</b></li>
                <li>Pick-up Location: <b>{{ $booking->location()->pickup }}</b></li>
                <li>Pick-up Date/Time: <b>{{ $booking->booking_type == 'pickup' ? ($booking->reschedule_date ? $booking->reschedule_date : $booking->end_date) : $booking->end_date }}</b></li>
            </ul>
        </div>

        <hr />

        <div style="padding: .3em; background: lightgray; border-radius: 5px">
            <span style="font-style: italic; color: #111; font-size: .8em; padding: 0 1em">Important Information</span>

            <p style="font-size: .7em; padding: 0 1em">Please ensure that the modified details meet your requirements.
                If you have any questions or need further assistance, you can:</p>
            <ul style="font-size: .7em">
                <li>Visit our website: <a href="www.valamcars.com">www.valamcars.com</a></li>
                <li>Contact us at +91-9363065901</li>
            </ul>
        </div>

        <p style="font-size: .8em; margin-top: 2em">Thank you for choosing Valam Cars. We’re here to make your
            self-drive journey smooth and enjoyable!</p>

        <div style="margin-top: 1em">
            <h5 style="margin: 0">Best regards,</h5>
            <p style="margin: 0; font-size: .8em">Team Valam Cars.</p>
        </div>
    </div>
</body>

</html>
