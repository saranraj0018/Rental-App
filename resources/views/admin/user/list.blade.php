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
                    <h1>User</h1>
                </div>
                  @if (in_array('user_export', $permissions))
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('user.list.export') }}?v=csv" class="btn btn-primary ">Export CSV</a>
                        <a href="{{ route('user.list.export') }}?v=pdf" class="btn btn-primary ">Export PDF</a>
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
                            <input type="text" id="name_search" name="keyword" class="form-control" placeholder="Search Name ....">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="user_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Type</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Aadhaar Number</th>
                            <th>Driving Licence</th>
                            <th>Update At</th>
                            @if (in_array('user_view_docs', $permissions))
                                    <th>Action</th>
                                @endif
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($user))
                            @foreach($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="bg-{{ $item->is_offline_booking == 0 ? 'success' : 'warning' }} text-white p-1 rounded">
                                            {{ $item->is_offline_booking == 0 ? 'Online' : 'Offline' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->email ?? ''}}</td>
                                    <td>{{ $item->aadhaar_number ?? ''}}</td>
                                    <td>{{ $item->driving_licence ?? '' }}</td>
                                    <td>{{ showDateTime($item->updated_at) }}</td>
                                      @if (in_array('user_view_docs', $permissions))
                                            <td><a href="#" class="user_view text-primary w-4 h-4 mr-1"
                                                    data-id="{{ $item->id }}"
                                                    data-images="{{ json_encode($item->userDoc->pluck('image_name')) }}"   data-documents="{{ $item->documents ?? '' }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M12 4.5c4.636 0 8.604 3.094 10.314 7.5-1.71 4.406-5.678 7.5-10.314 7.5S3.396 16.406 1.686 12C3.396 7.594 7.364 4.5 12 4.5zm0 2.25a5.25 5.25 0 100 10.5 5.25 5.25 0 000-10.5zM12 9a3 3 0 110 6 3 3 0 010-6z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        @endif
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
                {{ $user->links() }}
            </div>
        </div>
        @include('admin.user.model')
    </section>
@endsection
@section('customJs')
    <script src="{{asset("admin/js/user.js")}}"></script>
@endsection
