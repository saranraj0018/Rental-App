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
        .table-responsive td, .table-responsive th {
            white-space: nowrap; /* Keeps text on a single line */
            vertical-align: middle; /* Aligns text vertically to the middle */
        }
        .table-responsive .truncate-text {
            overflow: hidden;
            text-overflow: ellipsis; /* Adds ellipsis (...) for overflowing text */
            max-width: 150px; /* Adjust the width as needed */

        }
        .table-responsive td, .table-responsive th {
            white-space: nowrap; /* Keeps text on a single line */
            vertical-align: middle; /* Aligns text vertically to the middle */
        }
        svg.w-5.h-5{
            height:20px;
            width:20px;
        }
        p.text-sm.text-gray-700.leading-5.dark\:text-gray-400{
            margin:30px 0;
            text-align:center;
        }
        a.relative.inline-flex.items-center.px-4.py-2.ml-3.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md.hover\:text-gray-500.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:text-gray-300.dark\:focus\:border-blue-700.dark\:active\:bg-gray-700.dark\:active\:text-gray-300{
            margin-left:50px !important;
        }
        .toggle-wrapper {
            display: inline-block;
            width: 53px;
            height: 25px;
            background-color: #ccc;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
            user-select: none;
        }
        .m-left{
            margin-left:56%;
        }

        .toggle-switch {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: #000000;
            border-radius: 50%;
            transition: 0.3s;
        }
        .toggle-wrapper.on .toggle-switch {
            left: 32px;
        }

        .toggle-wrapper .label {
            position: absolute;
            top: 5px;
            font-weight: bold;
            font-size: 12px;
        }

        .toggle-wrapper .label.off {
            top: 4px;
            left: 27px;
            color: black;
        }

        .toggle-wrapper .label.on {
            top: 4px;
            right: 27px;
            color: black;
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
                    <div class="d-flex text-center">
                        <!-- Search for Booking ID -->
                        <div class="input-group" style="width: 250px;">
                            <label for="cancel_hub_type"></label>
                            <select id="pending_hub_type" class="form-control">
                                <option selected disabled>Select Hub</option>
                                @if(!empty($city_list))
                                    @foreach($city_list as $id => $list)
                                        <option value="{{$id}}" >{{ $list }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="input-group" style="width: 250px;">
                            <select id="pending_booking_type" class="form-control">
                                <option value="both">Delivery/Pickup</option>
                                <option value="delivery">Delivery</option>
                                <option value="pickup">Pickup</option>
                            </select>
                        </div>
                        <div class="input-group" style="width: 250px;">
                            <select id="booking_history" class="form-control">
                                <option value="1">Current Booking</option>
                                <option value="2">Upcoming Booking</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="pending_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Booking<br>Type</th>
                            <th>Risk</th>
                            <th>Done</th>
                            <th>Time</th>
                            <th>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Name">
                            </th>
                            <th> <input type="text" id="car_model" name="car_model" class="form-control" placeholder="Model" style="padding: 0%;"></th>
                            <th><input type="text" id="register_number" name="register_number" class="form-control" placeholder="Registration Number"></th>
                            <th>Address</th>
                            <th>User Details</th>
                            <th>D/L Number</th>
                            <th><input type="text" id="booking_id" name="booking_id" class="form-control" style="padding: 0%    ;" placeholder="Booking ID"></th>
                            <th>Reschedule</th>
                            <th>Security Dep</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($bookings) && $bookings->isNotEmpty())
                            @foreach($bookings as $item)

                                @php
                                    $booking_details = !empty($item->details[0]) ? json_decode($item->details[0]->car_details) : [];
                                    $booking_payment_details = !empty($item->details[0]) ? json_decode($item->details[0]->payment_details, true) : [];
                                    $car_model = !empty($booking_details->car_model) ? $booking_details->car_model : [];
                                    $comments = !empty($item->comments) ? $item->comments : [];
                                @endphp
                                <tr class="@if($item->risk == 1 && $item->status != 2) bg-light-red @elseif($item->status == 2) bg-light-green @endif">
                                    <td>  {!! $item->booking_type == 'pickup' ? '<h3>P</h3>' : '<h3>D</h3>' !!}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="checkbox" class="risk-checkbox" data-id="{{ $item->id }}" @if($item->risk == 1) checked @endif>
                                        </div>
                                        <br>
                                        <button class="btn btn-warning open-risk-modal" data-id="{{ $item->id }}" data-commend="{{ json_encode($comments) }}">
                                            <h3>i</h3>
                                        </button>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <input type="checkbox" class="done-checkbox" data-id="{{ $item->id }}" @if($item->status == 2) checked @endif>
                                    </td>
                                    <td>{{ $item->booking_type == 'pickup' ? showDateTime($item->end_date) :  showDateTime($item->start_date) }}<br>
                                        @if(!empty($item->reschedule_date))
                                            <p class="text-danger">{{ showDateTime($item->reschedule_date) }}</p>
                                        @endif</td>
                                    <td>{{ $item->user->name ?? '' }}</td>
                                    <td>{{ $car_model->model_name ?? 'Dummy Car' }}</td>
                                    <td>{{ $booking_details->register_number ?? '' }}</td>
                                    <td class="truncate-text" title="{{ $item->address }}">{{ $item->address }}</td>
                                    <td>
                                        <button class="btn btn-warning user-details-modal" data-id="{{ $item->user_id }}" data-mobile="{{ $item->user->mobile }}" data-booking="{{ !empty($item->user->bookings->count()) ? $item->user->bookings->count() / 2 : 0 }}" data-aadhaar_number="{{ $item->user->aadhaar_number }}">
                                            User details
                                        </button>
                                    </td>
                                    <td>{{ $item->user->driving_licence ?? '' }}</td>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ showDateTime($item->reschedule_date ?? ($item->booking_type == 'pickup' ? $item->end_date : $item->start_date)) }}

                                    </td>
                                    <td>{{ $car_model->dep_amount ?? 0 }}</td>
                                    <td>
                                        <button class="btn btn-warning amount-modal" data-id="{{ $item->booking_id }}" data-week_days_amount="{{ $booking_payment_details['week_days_amount'] ?? 0 }}" data-week_end_amount="{{ $booking_payment_details['week_end_amount'] ?? 0 }}" data-festival_amount="{{ $booking_payment_details['festival_amount'] ?? 0 }}" data-delivery_fee="{{ $item->delivery_fee ?? '' }}" data-dep_fee="{{ $car_model->dep_amount ?? '' }}" data-coupon="{{ $booking_coupon->discount ?? '' }}" data-type="{{ $booking_coupon->type ?? '' }}">
                                            Amount Details
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger cancel_booking" data-id="{{ $item->booking_id }}">Cancel Order</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="15" class="text-center">Record Not Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="d-flex justify-content-center">
                {{ !empty($bookings) ? $bookings->links() : '' }}
            </div>
        </div>
        @include('admin.hub.model')
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script src="{{asset('admin/js/pending_booking.js')}}"></script>
@endsection