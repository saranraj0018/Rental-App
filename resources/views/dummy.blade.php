<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-success">Booking Successful!</h1>
    <div class="alert alert-success" role="alert">
        Thank you for your booking! Here are the details:
    </div>

    @php
        $bookingDetails = session('booking_details');
    @endphp

    <h4>Booking Details</h4>
    <ul class="list-group">
        <li class="list-group-item"><strong>Car ID:</strong> {{ $bookingDetails['car_id'] ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Start Date:</strong> {{ $bookingDetails['start_date'] ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>End Date:</strong> {{ $bookingDetails['end_date'] ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Coupon:</strong> {{ $bookingDetails['coupon'] ?? 'N/A' }}</li>
    </ul>

    <div class="mt-4">
        <h5>Car Details:</h5>
        <div class="row">
            @if(isset($bookingDetails['car_details']))
                @foreach($bookingDetails['car_details'] as $image)
                    <div class="col-md-4 mb-2">
                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Car Image">
                    </div>
                @endforeach
            @else
                <p>No car images available.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
        <a href="{{ url('/my-bookings') }}" class="btn btn-secondary">View My Bookings</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
