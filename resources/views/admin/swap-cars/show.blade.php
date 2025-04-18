@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Swap Cars </h1>
                </div>
                    @if (in_array('swap_cars_history', $permissions))
                <div class="col-sm-6 text-right">
                    <a href="{{ route('car-swap.table') }}" class="btn btn-primary mb-3" id="add_role" role="button">Swap History</a>
                </div>
                @endif
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="d-flex mb-3">
            <div class="form-group w-25 mr-3">
                <label for="booking_type">Select Hub</label>
                   <select id="hub_city" name="hub_city" class="form-select w-100" data-live-search="true">
                    <option selected disabled>Hub</option>
                    @if(!empty($city_list))
                        @foreach($city_list as $id => $list)
                            <option value="{{$id}}"> {{$list}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="booking_id_1">Booking ID </label>
                <input type="number" id="booking_id" class="form-control" name="booking_id_1" placeholder="Enter Booking ID">
            </div>
            <div class="form-group col-md-2">
                <label for="booking_id_2">Start Date</label>
                <input type="text" id="start_date" class="form-control" placeholder="Start Date" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="booking_id_3">End Date</label>
                <input type="text" id="end_date" class="form-control" placeholder="End Date" disabled>
            </div>
              <div class="form-group col-md-2">
                <label for="car_name">Car Name</label>
                <input type="text" id="car_name" class="form-control" placeholder="Car Name" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="car_number">Car Number</label>
                <input type="text" id="car_number" class="form-control" placeholder="Car Number" disabled>
            </div>
            <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-secondary" id="search_cars" style="margin-top: 30px" disabled>Search Available Cars</button>
            </div>
        </div>
    </section>

    <!-- Table to display available cars -->
    <div id="car-swap-table" style="display: none;">
        <div style="overflow-x: auto; max-height: 400px;">
            <table class="table" id="dynamic-table">
                <thead>
                <tr>
                    <th>Available Cars</th>
                </tr>
                </thead>
                <tbody id="car-list"></tbody>
            </table>
        </div>
    </div>

    <!-- Placeholder for Bootstrap cards for cars with the same model -->
    <div id="car-card-container" class="d-flex flex-wrap">
    </div>
 @include('admin.swap-cars.model')
@endsection

@section('customJs')
    <script src="{{ asset('admin/js/swap.js') }}"></script>
@endsection
