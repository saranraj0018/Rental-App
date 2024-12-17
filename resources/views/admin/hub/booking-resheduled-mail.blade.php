<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: lightcoral;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-content {
            padding: 20px;
        }
        .email-content h1 {
            font-size: 20px;
            margin: 0 0 20px;
        }
        .email-content p {
            margin: 10px 0;
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f9;
            color: #888888;
            font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Booking Cancelled Notification</h1>
        </div>
        <div class="email-content">
            <h1>Hello Admin</h1>
            <p>Booking for: ({{ $booking->user->name }}) - Booking ID: ({{ $booking->booking_id }}) has been Rescheduled,</p>
            <p>The reschuduled date is - ({{ $booking->reschedule_date }})</p>


            <br>
        </div>
        <div class="email-footer">
            <p>Thank you,<br> Valam Team</p>
        </div>
    </div>
</body>
</html>
