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

        <p style="font-style: italic; color: #555">Your booking <span
                style="color: #000">{{ $booking->booking_id }}</span> with Valam Cars has been canceled.</p>
        <p style="font-size: .8em">We’re truly sorry to miss the opportunity to provide you with a great experience, and
            we hope to serve you again in the future. The refundable amount will be processed back to your original
            payment method within 7 working days. Let us know how we can improve our services.</p>


        <div style="padding: .3em; background: lightgray; border-radius: 5px">
            <span style="font-style: italic; color: #555; font-size: .8em; padding: 0 1em">Please feel free to:</span>
            <ul style="font-size: .8em">
                <li>Visit our website: www.valamcars.com</li>
                <li>Call us at: +91-9363065901</li>
            </ul>
        </div>

        <p style="font-size: .8em">Thank you for considering Valam Cars. We hope to see you again soon!</p>

        <div style="margin-top: 1em">
            <h5 style="margin: 0">Warm regards,</h5>
            <p style="margin: 0; font-size: .8em">Team Valam Cars</p>
        </div>
    </div>


</body>

</html>
