$(function () {
    'use strict';
    $(document).ready(function() {
        let map, drawingManager, selectedShape, marker, searchBox, saveData = {};

        window.initMap = function() {
            // Initialize the map, centered on Coimbatore as an example
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 11.0168, lng: 76.9558 }, // Coimbatore
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

                if (places.length === 0) {
                    return;
                }

                // Get the first place (the searched city)
                const city = places[0];

                // Zoom into the city
                map.setCenter(city.geometry.location);
                map.setZoom(14);

                // Clear any existing marker
                if (marker) {
                    marker.setMap(null);
                }

                // Place a marker on the searched city
                marker = new google.maps.Marker({
                    map: map,
                    position: city.geometry.location,
                    title: city.name
                });
            });

            // Add a Drawing Manager to allow users to draw shapes
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon'] // Allow polygon drawing
                },
                polygonOptions: {
                    fillColor: '#FF0000',
                    fillOpacity: 0.2,
                    strokeWeight: 2,
                    strokeColor: '#FF0000',
                    clickable: false,
                    editable: true,
                    zIndex: 1
                }
            });
            drawingManager.setMap(map);

            // Event listener for polygon completion
            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                if (selectedShape) {
                    selectedShape.setMap(null); // Remove previous shape
                }
                selectedShape = polygon;

                // Capture the vertices of the polygon
                const vertices = polygon.getPath();
                let coordinates = [];
                vertices.forEach(function(vertex) {
                    coordinates.push({
                        lat: vertex.lat(),
                        lng: vertex.lng()
                    });
                });

                // Store the data to save later
                saveData = {
                    coordinates: coordinates
                };
            });

            // Event listener for dropdown city change
            $('#city-select').change(function() {
                const selectedCity = $(this).val();
                if (selectedCity === 'coimbatore') {
                    map.setCenter({ lat: 11.0168, lng: 76.9558 });
                } else if (selectedCity === 'madurai') {
                    map.setCenter({ lat: 9.9252, lng: 78.1198 });
                }
                map.setZoom(12);
            });

            // Save button click event
            $('#save-area').click(function() {
                if (saveData.coordinates && saveData.coordinates.length > 0) {
                    // Send data to the backend via AJAX
                    $.ajax({
                        url: '/admin/save-area',
                        method: 'POST',
                        data: {
                            coordinates: saveData.coordinates
                        },
                        success: function(response) {
                            alert('Area saved successfully!');
                        },
                        error: function(error) {
                            console.error(error);
                            alert('Error saving area.');
                        }
                    });
                } else {
                    alert('Please draw a polygon on the map.');
                }
            });
        };
    });
});
