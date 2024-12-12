@extends('admin.layout.app')

@section('content')
    <div class="container">
        <label for="city-select">Choose a city:</label>
        <select id="city-select" class="form-control">
            <option selected disabled>Select City</option>
            @if (!empty($city_list))
                @foreach ($city_list as $id => $list)
                    <option value="{{ $list['code'] }}">{{ $list['name'] }}</option>
                @endforeach
            @endif
        </select>

        <!-- Search bar for city -->
        <input id="search-city" type="text" placeholder="Search city" class="form-control mt-3">

        <!-- Map -->
        <div id="map" style="height: 500px; width: 100%; margin-top: 15px;"></div>

        @if (in_array('cities_map_create', $permissions))
        <!-- Save button -->
        <button id="save-area" class="btn btn-primary mt-3">Save Area</button>
        @endif
    </div>

    <style>
        #city-select,
        #search-city {
            margin-bottom: 15px;
            max-width: 400px;
        }
    </style>
@endsection

@section('customJs')
    <!-- Include Google Maps API with Drawing Library -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places,drawing&callback=initMap">
    </script>

    <script>
        // Define initMap globally to be called by Google Maps API
        function initMap() {
            let map, drawingManager, marker, searchBox, polygons = [];

            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 11.0168,
                    lng: 76.9558
                }, // Coimbatore
                zoom: 12,
            });

            // Search box for city search
            const input = document.getElementById('search-city');
            searchBox = new google.maps.places.SearchBox(input);

            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function() {
                const places = searchBox.getPlaces();
                if (places.length === 0) return;

                const city = places[0];
                map.setCenter(city.geometry.location);
                map.setZoom(14);

                if (marker) marker.setMap(null);
                marker = new google.maps.Marker({
                    map: map,
                    position: city.geometry.location,
                    title: city.name
                });
            });

            // Drawing Manager
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon']
                },
                polygonOptions: {
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    strokeWeight: 2,
                    strokeColor: '#FF0000',
                    editable: true,
                    zIndex: 1
                }
            });
            drawingManager.setMap(map);

            // Event listener for completed polygon
            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                polygons.push(polygon);

                let coordinates = [];
                polygon.getPath().forEach(function(vertex) {
                    coordinates.push({
                        lat: vertex.lat(),
                        lng: vertex.lng()
                    });
                });

                polygon.coordinates = coordinates;
            });



            // Dropdown to fetch and display saved polygons for a city
            $('#city-select').change(function() {
                let selectedCity = $(this).val();
                if (cityCoords[selectedCity]) {
                    const coords = cityCoords[selectedCity];
                    console.log(coords)
                    if (Number.isFinite(coords.lat) && Number.isFinite(coords.lng)) {
                        map.setCenter({
                            lat: coords.lat,
                            lng: coords.lng
                        });
                        map.setZoom(12);
                    }

                    const cityCoords = @json($city_list->mapWithKeys(fn($city) => [
                        $city->code => ['name' => $city->name, 'lat' => (float) $city->latitude, 'lng' => (float) $city->longitude]]));

                    $.ajax({
                        url: '/admin/get-city-coordinates',
                        method: 'GET',
                        data: {
                            city: selectedCity
                        },
                        success: function(response) {
                            if (typeof response === 'string') response = JSON.parse(response);

                            if (Array.isArray(response)) {
                                if (window.currentPolygons) window.currentPolygons.forEach(p => p
                                    .setMap(null));
                                window.currentPolygons = [];

                                response.forEach(coords => {
                                    const polygon = new google.maps.Polygon({
                                        paths: coords.map(coord => ({
                                            lat: parseFloat(coord.lat),
                                            lng: parseFloat(coord.lng)
                                        })),
                                        strokeColor: '#FF0000',
                                        strokeOpacity: 0.8,
                                        strokeWeight: 2,
                                        fillColor: '#FF0000',
                                        fillOpacity: 0.35
                                    });
                                    polygon.setMap(map);
                                    window.currentPolygons.push(polygon);
                                });
                            }
                        },
                    });
                }
            });

            // Save all drawn polygons
            $('#save-area').click(function() {
                let selectedCity = $('#city-select').val();
                if (polygons.length > 0) {
                    const dataToSave = polygons.map(p => p.coordinates);

                    $.ajax({
                        url: '/admin/save-area',
                        method: 'POST',
                        data: {
                            polygons: dataToSave,
                            hub: selectedCity
                        },
                        success: function() {
                            alertify.success('Area saved successfully!');
                            window.location.reload();
                        },
                        error: function() {
                            alertify.error('Error saving area.');
                        }
                    });
                } else {
                    alertify.error('Please draw at least one polygon on the map.');
                }
            });
        }
    </script>
@endsection
