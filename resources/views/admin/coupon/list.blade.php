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
                    <h1>Coupon</h1>
                </div>

                @if (in_array('coupon_create', getAdminPermissions()))
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary mb-3" id="add_coupon">Add Coupon</button>
                    </div>
                @endif
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
                            <select id="status" name="type" class="form-control">
                                <option selected>Both</option>
                                <option value="1">Activate</option>
                                <option value="2">DeActivate</option>
                            </select>
                        </div>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" id="coupon_search" name="keyword" class="form-control"
                                placeholder="Search Coupon....">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="coupon_table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Coupon</th>
                                <th>status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Email</th>
                                <th>Update At</th>

                                @if (in_array('coupon_update', getAdminPermissions()) || in_array('coupon_delete', getAdminPermissions()))
                                    <th>Action </th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>

                            @if (filled($coupons))
                                @foreach ($coupons as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            @if ($item->type == 1)
                                                Percentage
                                            @else
                                                Fixed
                                            @endif
                                        </td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge badge-secondary"
                                                    style="background-color: green">Activate</span>
                                            @else
                                                <span class="badge badge-danger"
                                                    style="background-color: red">Deactivate</span>
                                            @endif
                                        </td>
                                        <td>{{ showDate($item->start_date) }}</td>
                                        <td>{{ showDate($item->end_date) }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ showDateTime($item->updated_at) }}</td>

                                        <td>
                                            @if (in_array('coupon_update', getAdminPermissions()))
                                                <a href="javascript:void(0)" class="coupon_edit"
                                                    data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                                    data-description="{{ $item->description }}"
                                                    data-start_date="{{ $item->start_date }}"
                                                    data-end_date="{{ $item->end_date }}"
                                                    data-amount="{{ $item->amount }}" data-type="{{ $item->type }}"
                                                    data-prefix="{{ $item->prefix }}" data-code="{{ $item->code }}"
                                                    data-status="{{ $item->status }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif

                                            @if (in_array('coupon_delete', getAdminPermissions()))
                                            <a href="#" class="coupon_delete text-danger w-4 h-4 mr-1"
                                                data-id="{{ $item->id }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                            @endif
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
            <div class="d-flex justify-content-end w-100 mt-t pt-5 pagination" id="pagination">
                {{ $coupons->links() }}
            </div>
        </div>
        @include('admin.coupon.model')
    </section>
@endsection
@section('customJs')
    <script src="{{ asset('admin/js/coupon.js') }}"></script>
@endsection
