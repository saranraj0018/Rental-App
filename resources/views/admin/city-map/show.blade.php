@extends('admin.layout.app')

@section('content')
    <!-- Main content -->
    <div class="container">
        <input id="search-city" type="text" placeholder="Search city" class="form-control">
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>

    <style>
        #search-city {
            margin-bottom: 15px;
            max-width: 400px;
        }
    </style>
@endsection
@section('customJs')
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places,drawing&callback=initMap">
    </script>
    <script src="{{asset("admin/js/map.js")}}"></script>
@endsection
