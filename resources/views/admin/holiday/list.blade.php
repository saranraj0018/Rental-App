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
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Holidays</h1>
                </div>
                 <div class="col-sm-6 text-right">
                    @if (in_array('holidays_history', getAdminPermissions()))
                        <a class="btn btn-primary mb-3" href="{{ route('holidays.history') }}">View
                            History</a>
                    @endif

                    @if (in_array('holidays_create', getAdminPermissions()))
                        <button class="btn btn-primary mb-3" id="add_holiday">Add Holidays</button>
                    @endif
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
                            <input type="text" id="holiday_search" name="keyword" class="form-control" placeholder="Search Event ....">
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
                            <th>Email</th>
                            <th>Update At</th>
                           @if (in_array('holidays_delete', getAdminPermissions()) || in_array('holidays_update', getAdminPermissions()))
                            <th>Action </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($holidays))
                            @foreach($holidays as $item)
                                <tr>
                                      <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->event_name }}</td>
                                    <td>{{ showDate($item->event_date) }}</td>
                                    <td>{{ $item->user->email ?? '' }}</td>
                                    <td>{{ showDateTime($item->updated_at) }}</td>
                                    <td>
                                         @if (in_array('holidays_update', getAdminPermissions()))
                                        <a href="javascript:void(0)" class="holiday_edit" data-id="{{ $item->id }}"
                                           data-event_name="{{ $item->event_name }}" data-description="{{ $item->notes }}"
                                           data-event_date="{{ showDate($item->event_date) }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
  @endif

                                    @if (in_array('holidays_delete', getAdminPermissions()))
                                        <a href="#" class="holiday_delete text-danger w-4 h-4 mr-1"  data-id="{{ $item->id }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                         @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr >
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
    <script src="{{asset("admin/js/holiday.js")}}"></script>
@endsection
