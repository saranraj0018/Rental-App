@extends('admin.layout.app')

@section('content')


    {{-- {{ dd(getAdminPermissions() ) }} --}}

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

        .m-left {
            margin-left: 56%;
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
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Holidays History</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a class="btn btn-primary mb-3" href="{{ route('holidays.list') }}">Back to Car Details</a>
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
                            <input type="text" id="holiday_search" name="keyword" class="form-control"
                                placeholder="Search Event ....">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="holiday_table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Email</th>
                                <th>Action Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($holidays))
                                @foreach ($holidays as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->event }}</td>
                                        <td>{{ showDate($item->event_date) }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ showDateTime($item->updated_at) }}</td>
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
            <div class="d-flex justify-content-end w-100 mt-t pt-5 pagination" id="pagination">
                {{ $holidays->links() }}
            </div>
        </div>
        @include('admin.holiday.model')
    </section>
@endsection
@section('customJs')
    <script src="{{ asset('admin/js/holiday.js') }}"></script>
@endsection
