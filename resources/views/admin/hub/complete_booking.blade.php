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
        
        .apply-width {
            min-width: 100px !important;
            padding: .5em !important;
        }

        
        
        
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pickup/Delivery Completed List</h1>
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
                            <label for="complete_hub_type"></label>
                            <select id="complete_hub_type" class="form-control">
                                <option selected disabled>Select Hub</option>
                                @if(!empty($city_list))
                                    @foreach($city_list as $id => $list)
                                        <option value="{{$id}}" >{{ $list }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="input-group" style="width: 250px;">
                            <select id="complete_booking_type" class="form-control">
                                <option value="both">Delivery/Pickup</option>
                                <option value="delivery">Delivery</option>
                                <option value="pickup">Pickup</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="complete_booking_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Booking<br>Type</th>
                            @if (in_array('booking_revert', getAdminPermissions()))

                            <th>Revert</th>
                            @endif
                            <th>Time</th>
                            <th>
                                <input type="text" id="complete_customer_name" name="complete_customer_name" class="form-control apply-width" placeholder="Name">
                            </th>
                             <th>Mobile Number</th>
                            <th> <input type="text" id="complete_car_model" name="complete_car_model" class="form-control apply-width" placeholder="Model" style="padding: 0%;"></th>
                            <th><input type="text" id="complete_register_number" name="complete_register_number" class="form-control apply-width" placeholder="Registration Number"></th>
                            <th>Address</th>
                            <th>User Details</th>
                            <th>D/L Number</th>
                            <th><input type="text" id="complete_booking_id" name="complete_booking_id" class="form-control apply-min-width" style="padding: 0%    ;" placeholder="Booking ID"></th>
                            <th>Reschedule</th>
                            <th>Security Dep</th>
                            <th>Amount</th>
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
                                <tr class="bg-light-green">
                                    <td>  {!! $item->booking_type == 'pickup' ? '<h3>P</h3>' : '<h3>D</h3>' !!}</td>
                                    <td>
                                        <button class="btn btn-warning open-risk-modal" data-id="{{ $item->id }}" data-commend="{{ json_encode($comments) }}">
                                            <h3>i</h3>
                                        </button>
                                    </td>
                                    <td>{{ $item->booking_type == 'pickup' ? showDateTime($item->end_date) :  showDateTime($item->start_date) }}<br>
                                        @if(!empty($item->reschedule_date))
                                            <p class="text-danger">{{ showDateTime($item->reschedule_date) }}</p>
                                        @endif</td>
                                    <td>{{ $item->user->name ?? '' }}</td>
                                    <td>{{ $car_model->model_name ?? '' }}</td>
                                    <td>{{ $booking_details->register_number ?? '' }}</td>
                                    <td class="truncate-text" title="{{ $item->address }}">{{ $item->address }}</td>
                                    <td>
                                        <button class="btn btn-warning user-details-modal" data-id="{{ $item->user_id }}" data-mobile="{{ $item->user->mobile }}" data-booking="{{ !empty($item->user->bookings->count()) ? $item->user->bookings->count() / 2 : 0 }}" data-aadhaar_number="{{ $item->user->aadhaar_number }}">
                                            User details
                                        </button>
                                    </td>
                                    <td>{{ $item->user->driving_licence ?? '' }}</td>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ showDateTime($item->reschedule_date) ?? ($item->booking_type == 'pickup' ? showDateTime($item->end_date) : showDateTime($item->start_date)) }}

                                    </td>
                                    <td>{{ $car_model->dep_amount ?? 0 }}</td>
                                    <td>
                                        <button class="btn btn-warning amount-modal" data-id="{{ $item->booking_id }}" data-week_days_amount="{{ $booking_payment_details['week_days_amount'] ?? 0 }}" data-week_end_amount="{{ $booking_payment_details['week_end_amount'] ?? 0 }}" data-festival_amount="{{ $booking_payment_details['festival_amount'] ?? 0 }}" data-delivery_fee="{{ $item->delivery_fee ?? '' }}" data-dep_fee="{{ $car_model->dep_amount ?? '' }}" data-coupon="{{ $booking_coupon->discount ?? '' }}" data-type="{{ $booking_coupon->type ?? '' }}">
                                            Amount Details
                                        </button>
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
{{--            <div class="d-flex justify-content-center">--}}
{{--                {{ $bookings->links() }}--}}
{{--            </div>--}}
        </div>
        @include('admin.hub.model')
    </section>
@endsection

@section('customJs')
    <script src="{{asset('admin/js/complete_booking.js')}}"></script>
@endsection
