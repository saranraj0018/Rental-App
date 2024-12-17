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
                    <h1>Cars Blocking History</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('car-block.export') }}?v=csv" class="btn btn-primary mb-3" id="">Export CSV</a>
                    <a href="{{ route('car-block.export') }}?v=pdf" class="btn btn-primary mb-3" id="">Export PDF</a>
                    <a href="{{ route('car-block.list') }}" class="btn btn-primary mb-3" id="">Back to Car
                        Blocks</a>
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

                <div class="card-body table-responsive p-0">
                    <table id="car_block_table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Block Type</th>
                                <th>Reason</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Car Register Number</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (filled($car_block))
                                @foreach ($car_block as $item)
                                    <tr>
                                        <td>{{ $item->action }}</td>
                                        <td>{{ block_type()[$item->block_type] ?? '' }}</td>
                                        <td>{{ reason_type()[$item->reason] ?? '' }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ !$item->created_at ? '' : Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A') }}</td>
                                        <td>{{ $item->register_number }}</td>
                                        <td>{{ !$item->start_date ? '' :  Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                        <td>{{ !$item->end_date ? '' :  Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2"> Record Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="d-flex justify-content-end w-100 mt-t pt-5">
                {{ $car_block->links() ?? '' }}
            </div>
        </div>
        {{-- @include('admin.cars.blocks.model')
        @include('admin.cars.blocks.edit') --}}
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script src="{{ asset('admin/js/car-block.js') }}"></script>
@endsection
