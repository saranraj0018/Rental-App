$(function () {
    'use strict';
    $(document).ready(function() {
        let map, marker, searchBox, car_map, car_marker;

        window.initMarker = function() {
            // Initialize the map, centered on a default location (optional)
            map = new google.maps.Map(document.getElementById('custom_map'), {
                center: {lat: 11.0168, lng: 76.9558}, // Coimbatore, as an example
                zoom: 12,
            });

            // Create the search box and link it to the input element
            const input = document.getElementById('custom-city');
            searchBox = new google.maps.places.SearchBox(input);

            // Bias the SearchBox results towards the current map's viewport
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            // Event listener for search results
            searchBox.addListener('places_changed', function () {
                const places = searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }

                // Get the first place (the searched city)
                const city = places[0];

                // Zoom into the city
                map.setCenter(city.geometry.location);
                map.setZoom(14);

                // Remove any existing marker
                if (marker) {
                    marker.setMap(null);
                }

                // Add a marker at the city location
                marker = new google.maps.Marker({
                    position: city.geometry.location,
                    map: map,
                    title: city.name,
                });
            });
        }

        // Initialize the map when the modal is shown
        $('#secondModal').on('shown.bs.modal', function () {
            window.initMarker();
            $('#custom-city').focus();
        });

        let car_latitude_current = parseFloat($('#car_latitude_current').val()) || 11.0168;
        let car_longitude_current = parseFloat($('#car_longitude_current').val()) || 76.9558;
        window.carMarker = function() {
            let lat = car_latitude_current;
            let lng = car_longitude_current;
            // Initialize the map, centered on a default location (optional)
            car_map = new google.maps.Map(document.getElementById('car_location_map'), {
                center: {lat: lat, lng: lng}, // Coimbatore, as an example
                zoom: 12,
            });
             lat = car_latitude_current;
             lng = car_longitude_current;
            // Add a marker at the provided lat/lng (default is Coimbatore)
            car_marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: car_map,
                title: "Selected Location",
            });
        }
    });
});
