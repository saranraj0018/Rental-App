@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Car Availability</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="d-flex w-25">
            <label for="car_model"></label><select id="car_model" class="form-control">
                <option selected disabled>Select Model</option>
                @foreach ($car_model as $id => $model)
                    <option value="{{$id}}">{{$model}}</option>
                @endforeach
            </select>
            <label for="booking_type"></label><select id="booking_type" class="form-control">
                <option selected disabled>Select Hub</option>
                <option value="603">Coimbatore</option>
            </select>
        </div>
        <!-- /.container-fluid -->
    </section>
    <div id="car-details-table" style="display: none;">
    <div style="overflow-x: auto; overflow-y: auto; max-height: 400px;">
        <table class="table" id="dynamic-table">
        <thead>
        <tr id="date-header"></tr>
        <tr id="hours-header"></tr>
        </thead>
        <tbody id="registration-numbers-body"></tbody>

    </table>
    </div>
        <button id="prev-week" class="btn btn-secondary">Previous Week</button>
        <button id="next-week" class="btn btn-secondary">Next Week</button>
    </div>
    <style>
        #car-details-table {
            border-collapse: collapse; /* Ensures borders are collapsed */
            width: 100%; /* Make the table full width */
        }

        #car-details-table th,
        #car-details-table td {
            border: 1px solid #000; /* Set a solid black border */
            padding: 8px; /* Add some padding for better spacing */
            text-align: center; /* Center align text */
        }

        #car-details-table th {
            background-color: #f2f2f2; /* Optional: Set a light gray background for header */
        }
    </style>



@endsection

@section('customJs')
    <script src="{{ asset('admin/js/available.js') }}"></script>
@endsection
