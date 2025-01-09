@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <style>
        svg.w-5.h-5 {
            height: 20px;
            width: 20px;
        }

        p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
            margin: 30px 0;
            text-align: center;
        }

        a.relative.inline-flex.items-center.px-4.py-2.ml-3.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md.hover\:text-gray-500.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:text-gray-300.dark\:focus\:border-blue-700.dark\:active\:bg-gray-700.dark\:active\:text-gray-300 {
            margin-left: 50px !important;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cars History List</h1>
                </div>

                <div class="col-sm-6 text-right">


                    <a href="{{ route('export-csv') }}?type={{ request()->query('type') }}&v=csv" class="btn btn-primary mb-3"
                        id="export-csv">Export
                        CSV</a>
                    <a href="{{ route('export-csv') }}?type={{ request()->query('type') }}&v=pdf" class="btn btn-primary mb-3"
                        id="export-pdf">Export
                        PDF</a>

                    <a class="btn btn-primary mb-3" href="{{ url('/') }}/admin/cars/list">Back to Car Details</a>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="row mb-2">
                <div class="col">
                    <a class="btn btn-outline-primary mb-3 @if (request()->query('type') == 'details') active @endif"
                        href="{{ url('/') }}/admin/cars/history/list?type=details">Car
                        Details</a>
                    <a class="btn btn-outline-primary mb-3 @if (request()->query('type') == 'models') active @endif"
                        href="{{ url('/') }}/admin/cars/history/list?type=models">Car Model</a>
                </div>
            </div>
        </div>
    </section>

    @if (request()->query('type') == 'details')
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <button type="button" onclick="window.location.href=''"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="car_table" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>S. no</th>
                                    <th>Action</th>
                                    <th>Car Model ID</th>
                                    <th>Car Model Name</th>
                                    <th>Car Registration No.</th>
                                    <th>Hub</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (filled($car_list))
                                    @foreach ($car_list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item?->action }}</td>
                                            <td>{{ $item?->car_model_id }}</td>
                                            <td>{{ $item?->model_name }}</td>
                                            <td>{{ $item?->register_number }}</td>
                                            <td>{{ $item?->carDetails?->city->name }}</td>
                                            <td>{{ $item?->user?->email }}</td>
                                            <td>{{ !$item?->created_at ? '' : Carbon\Carbon::parse($item?->created_at)->format('d-m-Y H:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"> Record Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="d-flex justify-content-end w-100 mt-t pt-5">
                    {{-- {{ $car_list->links() }} --}}
                </div>
            </div>
            {{-- @include('admin.cars.model') --}}
            <!-- /.card -->
        </section>
    @else
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <button type="button" onclick="window.location.href=''"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="car_table" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Car Model ID</th>
                                    <th>Car Model Name</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (filled($car_list))
                                    @foreach ($car_list as $item)
                                        <tr>
                                            <td>{{ $item?->action }}</td>
                                            <td>{{ $item?->car_model_id }}</td>
                                            <td>{{ $item?->model_name }}</td>
                                            <td>{{ $item?->user?->email }}</td>
                                            <td>{{ !$item?->created_at ? '' : Carbon\Carbon::parse($item?->created_at)->format('d-m-Y H:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"> Record Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="d-flex justify-content-end w-100 mt-t pt-5">
                    {{ $car_list->links() }}
                </div>
            </div>
        </section>

    @endif

    <!-- /.content -->
@endsection
@section('customJs')
    <script src="{{ asset('admin/js/car-details.js') }}"></script>
@endsection
