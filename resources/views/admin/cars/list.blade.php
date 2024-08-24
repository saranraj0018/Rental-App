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
                    <h1>Cars List</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @if(in_array('car_list_add',$permissions))
                        <button class="btn btn-primary mb-3" id="add_car">Add Car</button>
                    @endif
                    @if(in_array('car_list_add_model',$permissions))
                        <button class="btn btn-primary mb-3" id="add_car_model">Add Model</button>
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
                        <button type="button" onclick="window.location.href=''" class="btn btn-default btn-sm">Reset</button>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" id="search_item" name="keyword" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button type="button" id="searchBtn" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="car_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Car Info ID</th>
                            <th>Car Model</th>
                            <th>Car Model ID</th>
                            <th>Car Registration No</th>
                            <th>Hub</th>
                            <th>Till</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(filled($car_list))
                            @foreach($car_list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->carModel->model_name ?? '' }}
                                        @if(in_array('car_list_model_edit',$permissions))
                                        -  <a href="javascript:void(0)" class="edit_model" data-id="{{ $item->id }}"
                                                                                      data-producer="{{ $item->carModel->producer}}"
                                                                                      data-model_name="{{ $item->carModel->model_name}}"
                                                                                      data-seat="{{ $item->carModel->seat}}"
                                                                                      data-fuel_type="{{ $item->carModel->fuel_type}}"
                                                                                      data-transmission="{{ $item->carModel->transmission}}"
                                                                                      data-engine_power="{{ $item->carModel->engine_power}}"
                                                                                      data-price_per_hour="{{ $item->carModel->price_per_hour}}"
                                                                                      data-weekend_surge="{{ $item->carModel->weekend_surge}}"
                                                                                      data-peak_reason_surge="{{ $item->carModel->peak_reason_surge}}"
                                                                                      data-extra_km_charge="{{ $item->carModel->extra_km_charge}}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        @endif
                                    </td>
                                    <td>{{ $item->model_id }}</td>
                                    <td>{{ $item->register_number }}</td>
                                    <td>{{ $item->hub }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if(in_array('car_list_edit',$permissions))
                                        <a href="javascript:void(0)" class="btnEdit" data-id="{{ $item->id }}"
                                           data-city="{{$item->city_code}}-{{$item->city_name}}"
                                           data-hub="{{$item->hub_code}}-{{$item->hub}}"
                                           data-model="{{$item->model_id}}"
                                           data-register_number="{{$item->register_number}}"
                                           data-current_km="{{$item->current_km}}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        @endif
                                            @if(in_array('car_list_delete',$permissions))
                                        <a href="#" class="delete_btn text-danger w-4 h-4 mr-1"  data-id="{{ $item->id }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
            <div class="d-flex justify-content-end w-100 mt-t pt-5">
                {{ $car_list->links() }}
            </div>
        </div>
        @include('admin.cars.model')
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script src="{{asset("admin/js/car-details.js")}}"></script>
@endsection
