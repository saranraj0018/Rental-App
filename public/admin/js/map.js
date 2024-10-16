$(function () {
    'use strict'
    $(document).ready(function() {
            let map, cityCircle, searchBox;

        window.initMap = function() {
            // Initialize the map, centered on a default location (optional)
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 11.0168, lng: 76.9558}, // Coimbatore, as an example
                zoom: 12,
            });

            // Create the search box and link it to the input element
            const input = document.getElementById('search-city');
            searchBox = new google.maps.places.SearchBox(input);

            // Bias the SearchBox results towards current map's viewport
            map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

            // Event listener for search results
            searchBox.addListener('places_changed', function () {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
            return;
        }

            // Get the first place (the searched city)
            const city = places[0];

            // Zoom into the city
            map.setCenter(city.geometry.location);
            map.setZoom(14);

            // Draw a boundary (circle or polygon) around the city
            if (cityCircle) {
            cityCircle.setMap(null); // Remove existing circle
        }

            cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.2,
            map: map,
            center: city.geometry.location,
            radius: 5000, // Adjust this radius as needed
        });
        });
        }

    });
});
