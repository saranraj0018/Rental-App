@extends('admin.layout.app')

@section('content')
    <div class="container">
        <label for="city-select">Choose a city:</label>
        <select id="city-select" class="form-control">
            <option value="coimbatore">Coimbatore</option>
            <option value="madurai">Madurai</option>
        </select>

        <!-- Search bar for city -->
        <input id="search-city" type="text" placeholder="Search city" class="form-control mt-3">

        <!-- Map -->
        <div id="map" style="height: 500px; width: 100%; margin-top: 15px;"></div>

        <!-- Save button -->
        <button id="save-area" class="btn btn-primary mt-3">Save Area</button>
    </div>

    <style>
        #city-select {
            margin-bottom: 15px;
            max-width: 400px;
        }

        #search-city {
            margin-bottom: 15px;
            max-width: 400px;
        }
    </style>
@endsection
@section('customJs')
    <!-- Include Google Maps API with Drawing Library -->
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places,drawing&callback=initMap">
    </script>
    <script src="{{ asset("admin/js/map.js") }}"></script>
@endsection
