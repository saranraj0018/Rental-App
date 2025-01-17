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
            background-color: #4caf50;
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
        .button {
            display: inline-block;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Booking Notification</h1>
        </div>
        <div class="email-content">
            <h1>Hello {{ $admin->name }}</h1>
            <p>A new booking has been made by a user, and the payment has been successfully completed.</p>
            <p><strong>Booking Details:</strong></p>
            <ul>
                <li><strong>User Name:</strong> {{ auth()?->user()?->name }}</li>
                <li><strong>Booking ID:</strong> {{ session('booking_id') }}</li>
            </ul>

            <p>You can log in to the admin panel to review the booking details or take any necessary actions.</p>
        </div>
        <div class="email-footer">
            <p>Thank you,<br> Valam Team</p>
        </div>
    </div>
</body>
</html>
