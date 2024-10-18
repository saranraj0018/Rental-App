@extends('admin.layout.app')

@section('content')
<style>
    .bg-light-red {
        background-color: #f8d7da !important; /* Light red background */
        color: #721c24; /* Dark red text for contrast */
    }
    .bg-light-green {
        background-color: #d4edda !important; /* Light green background */
        color: #155724; /* Dark green text for contrast */
    }
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pickup/Delivery List</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-body table-responsive p-0">
                    <table id="booking_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Booking<br> Type</th>
                            <th>Risk</th>
                            <th>Done</th>
                            <th style="width:50px !important;">Time</th>
                            <th>Name</th>
                            <th>Modal</th>
                            <th>Register Number</th>
                            <th>Address</th>
                            <th>User Details</th>
                            <th>D/L Number</th>
                            <th>Booking Id</th>
                            <th>Reschedule</th>
                            <th>Security Dep</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($booking))
                            @foreach($booking as $item)
                                @php
                                    $booking_details = !empty($item->details[0]) ? json_decode($item->details[0]->car_details) : [];
                                    $booking_payment_details = !empty($item->details[0]) ? json_decode($item->details[0]->payment_details,true) : [];
                                    $car_model = !empty($booking_details->car_model) ? $booking_details->car_model : [];
                                    $commends = !empty($item->comments) ? $item->comments: [];
                                @endphp
                                <tr class="@if($item->risk == 1 && $item->status != 2) bg-light-red @elseif($item->status == 2) bg-light-green @endif">
                                    <td> @if($item->booking_type == 'pickup')
                                            <h2>P</h2>
                                        @else
                                            <h2>D</h2>
                                        @endif</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="checkbox" class="risk-checkbox" data-id="{{ $item->id }}"
                                                   @if($item->risk == 1) checked @endif>
                                        </div>
                                        <br>
                                        <button class="btn btn-warning open-risk-modal"
                                                data-id="{{ $item->id }}"
                                                data-commend="{{ json_encode($commends) }}">
                                            <h5>i</h5>
                                        </button>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <input type="checkbox" class="done-checkbox" data-id="{{ $item->id }}"
                                               @if($item->status == 2) checked @endif>
                                    </td>
                                    <td>{{ showDateTime($item->start_date) }}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td>{{ $car_model->model_name ?? ''}}</td>
                                    <td>{{ $booking_details->register_number ?? '' }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td> <button class="btn btn-warning user-details-modal" data-id="{{ $item->user_id }}"
                                                 data-mobile="{{ $item->user->mobile }}"
                                                 data-booking="{{ !empty($item->user->bookings->count()) ? $item->user->bookings->count()/2 : 0 }}"
                                                 data-aadhaar_number="{{ $item->user->aadhaar_number }}">
                                            User details
                                        </button></td>
                                    <td>{{ $item->user->driving_licence ?? ''}}</td>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ !empty($item->start_date) ? showDateTime($item->start_date) : showDateTime($item->end_date) }}
                                        <button class="btn btn-warning edit-booking-date" data-id="{{ $item->id }}"
                                                data-pickup_date="{{$item->start_date ?? 0}}"
                                                data-delivery_date="{{ $item->end_date ?? 0}}">
                                           Edit
                                        </button>
                                    </td>
                                    <td> {{$car_model->dep_amount ?? 0}}</td>
                                    <td><button class="btn btn-warning amount-modal" data-id="{{ $item->booking_id}}"
                                                data-week_days_amount="{{ $booking_payment_details['week_days_amount'] ?? 0}}"
                                                data-week_end_amount="{{ $booking_payment_details['week_end_amount'] ?? 0 }}"
                                                data-festival_amount="{{ $booking_payment_details['festival_amount'] ??0 }}"
                                                data-delivery_fee="{{ $item->delivery_fee ??''}}"
                                                data-dep_fee="{{ $car_model->dep_amount ??''}}"
                                                data-coupon="{{ $booking_coupon->discount ??''}}"
                                                data-type="{{ $booking_coupon->type ??''}}">
                                           Amount Details
                                        </button></td>
                                    <td>
                                        @if($item->booking_type == 'pickup')
                                            <button class="btn btn-danger cancel_booking"
                                                    data-id="{{ $item->id }}">
                                                Cancel Order
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr >
                                <td colspan="9"> Record Not Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
{{--                <div class="card-footer clearfix">--}}
{{--                    {{ $category->links() }}--}}
{{--                </div>--}}
            </div>
        </div>
        @include('admin.hub.model')
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script src="{{asset("admin/js/booking.js")}}"></script>
@endsection
