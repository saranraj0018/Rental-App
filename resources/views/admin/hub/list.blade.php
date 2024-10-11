@extends('admin.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pickup/Delivery List</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">New Task</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
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
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>user Name</th>
                            <th>Car Model</th>
                            <th>R/N No</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Pricing</th>
                            <th>Booking Status</th>
                            <th>Order Received Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($booking))
                            @foreach($booking as $item)
                                <tr>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ $item->user->name ?? ''}}</td>
                                    <td>{{ $item->car->model ?? '' }}</td>
                                    <td>{{ $item->car->register_number }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date}}</td>
                                    <td>{{ $item->total_price}}</td>
                                    <td>{{ $item->total_price}}</td>
                                    <td>{{ $item->updated_date}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="holiday_edit">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>

                                        <a href="#" class="holiday_delete text-danger w-4 h-4 mr-1" >
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')

@endsection
