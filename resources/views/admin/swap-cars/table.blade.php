@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <style>
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
    </style>
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Swap History</h1>
                </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('car-swap.list') }}" class="btn btn-primary mb-3" id="add_role" role="button">Back Swap Cars</a>
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
                    <div class="d-flex justify-content-between">
                        <div class="input-group" style="width: 250px;">
                            <label for="booking_id">
                            </label><input type="text" id="history_booking_id" name="history_booking_id" class="form-control" placeholder="Booking ID....">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="swap_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Booking Id</th>
                            <th>Email</th>
                            <th>Booking Car</th>
                            <th>Swap Car</th>
                            <th>Create At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(filled($swap_cars))
                            @foreach($swap_cars as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->booking_id }}</td>
                                    <td>{{ $item->user->email ?? '' }}</td>
                                    <td>{{ $item->car->carModel->model_name ?? '' }}</td>
                                    <td>{{ $item->swapCar->carModel->model_name ?? '' }}</td>
                                    <td>{{ showDateTime($item->updated_at) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Record Not Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="d-flex justify-content-end w-100 mt-t pt-5 pagination" id="pagination">
                {{ $swap_cars->links() }}
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script src="{{ asset('admin/js/swap.js') }}"></script>
@endsection
