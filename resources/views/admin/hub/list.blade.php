@extends('admin.layout.app')

@section('content')

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
                            <th>Booking Type</th>
                            <th>Risk</th>
                            <th>Done</th>
                            <th>Time</th>
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
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($booking))
                            @foreach($booking as $item)
                                @php
                                    $booking_details = !empty($item->details[0]) ? json_decode($item->details[0]->car_details) : [];
                                   $car_model = !empty($booking_details->car_model) ? $booking_details->car_model : [];
                                @endphp
                                <tr>
                                    <td> @if($item->booking_type == 'pickup')
                                            <h2>P</h2>
                                        @else
                                            <h2>D</h2>
                                        @endif</td>
                                    <td>
                                        <input type="checkbox" class="risk-checkbox" data-id="{{ $item->id }}">
                                        <button class="btn btn-warning open-risk-modal" data-id="{{ $item->id }}">
                                            Add Comment
                                        </button>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="done-checkbox" data-id="{{ $item->id }}">
                                    </td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td>{{ $car_model->model_name }}</td>
                                    <td>{{ $booking_details->register_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td> @if($item->status == 1)
                                            <span class="badge badge-secondary" style="background-color: green">Booking</span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: red">Complete</span>
                                        @endif</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="booking_edit">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
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
