@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Swap Cars </h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="d-flex mb-3">
            <div class="form-group w-25 mr-3">
                <label for="booking_type">Select Hub</label>
                <select id="booking_type" class="form-control">
                    <option selected disabled>Select Hub</option>
                    <option value="603">Coimbatore</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="booking_id_1">Booking ID </label>
                <input type="number" id="booking_id" class="form-control" name="booking_id_1" placeholder="Enter Booking ID">
            </div>
            <div class="form-group col-md-3">
                <label for="booking_id_2">Start Date</label>
                <input type="text" id="start_date" class="form-control" placeholder="Start Date" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="booking_id_3">End Date</label>
                <input type="text" id="end_date" class="form-control" placeholder="End Date" disabled>
            </div>
            <div class="form-group col-md-3">
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
    <div id="car-card-container" class="d-flex flex-wrap"></div>
 @include('admin.swap-cars.model')
@endsection

@section('customJs')
    <script src="{{ asset('admin/js/swap.js') }}"></script>
@endsection
