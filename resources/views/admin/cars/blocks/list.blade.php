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
                    <h1>Cars Blocking List</h1>
                </div>
                @if(in_array('car_av_add',$permissions))
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary mb-3" id="add_block">Add New Block</button>
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
                            <select id="block_type" class="form-control">
                                <option value="">All Block Types</option>
                                @foreach(block_type() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group" style="width: 250px;">
                            <input type="text" id="resister_id" name="resister_id" class="form-control" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="car_block_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Car ID</th>
                            <th>Block Type</th>
                            <th>Reason</th>
                            <th>Created By</th>
                            <th>Comments</th>
                            <th>Car Register Number</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(filled($car_block))
                            @foreach($car_block as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ block_type()[$item->block_type] ?? '' }}</td>
                                    <td>{{ reason_type()[$item->reason] ?? '' }}</td>
                                    <td>{{ $item->user->email ?? '' }}</td>
                                    <td>{{ $item->comment }}</td>
                                    <td>{{ $item->car_register_number }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    <td>
                                        @if(in_array('car_av_edit',$permissions))
                                        <a href="javascript:void(0)" class="edit_block_model" data-id="{{ $item->id }}"
                                           data-car_register_number="{{$item->car_register_number}}"
                                           data-start_date="{{$item->start_date}}"
                                           data-end_date="{{$item->end_date}}"
                                           data-comment="{{$item->comment}}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        @endif
{{--                                        <a href="#" class="delete_btn text-danger w-4 h-4 mr-1"  data-id="{{ $item->id }}">--}}
{{--                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
                                    </td>
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
                {{ $car_block->links() ?? ''}}
            </div>
        </div>
        @include('admin.cars.blocks.model')
        @include('admin.cars.blocks.edit')
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script src="{{asset("admin/js/car-block.js")}}"></script>
@endsection
