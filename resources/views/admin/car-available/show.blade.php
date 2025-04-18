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
            <label for="booking_type"></label>
            <select id="hub_available" class="form-control">
                <option selected disabled>Select Hub</option>
                @if(!empty($city_list))
                    @foreach($city_list as $id => $list)
                        <option value="{{$id}}">{{$list}}</option>
                    @endforeach
                @endif
            </select>
            <label for="car_model"></label>
            <select id="car_available_model" class="form-control">
                <option selected disabled>Select Model</option>
            </select>
        </div>
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
         /* Sticky column styles */
        th:first-child,
        td:first-child {
            position: sticky;
            left: 0px;
            background-color: #f9f9f9;
            z-index: 2;
        }

        #date-header th {
            position: unset !important;
        }
    </style>



@endsection

@section('customJs')
    <script src="{{ asset('admin/js/available.js') }}"></script>
@endsection
