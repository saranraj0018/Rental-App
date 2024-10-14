@extends('user.frontpage.list-cars.main')

@section('content')

<section class="other-heads-bg py-4">
    <header>
        <div class="container">
            <div class="text-center text-white fs-5">
                Booking Confirmed
            </div>
        </div>
    </header>
</section>

<section class="b-confirm-bg py-5">
    <div class="py-4 container">
        <div class="mx-auto card bdr-20 my-bc border border-0 py-4 px-3">
            <img src="{{ asset('user/img/Layer_1.png') }}" alt="" class="img-fluid check-icon mx-auto py-3">
            <div class="text-center fs-3">
                Congratulations
            </div>
            <div class="text-center fs-16 my-4">
                Your booking is confirmed! Please visit the Booking page
                to verify the details. Booking ID: [Your Booking ID].
            </div>
            <button class="btn bg-blue text-white w-fit mx-auto rounded-pill">View Update</button>
        </div>
    </div>
</section>
@include('user.frontpage.footer')
@endsection
