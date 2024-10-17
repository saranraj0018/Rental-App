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
                let selectedCity = $(this).val();
                if (selectedCity === 'coimbatore') {
                    map.setCenter({ lat: 11.0168, lng: 76.9558 });
                } else if (selectedCity === 'madurai') {
                    map.setCenter({ lat: 9.9252, lng: 78.1198 });
                }
                map.setZoom(12);
                $.ajax({
                    url: '/admin/get-city-coordinates', // Replace with your actual route or API endpoint
                    method: 'GET',
                    data: { city: selectedCity },
                    success: function(response) {
                        // If the response is a string, parse it into JSON
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }

                        // Make sure response is an array before mapping
                        if (Array.isArray(response)) {
                            let coordinates;
                            coordinates = response.map(coord => {
                                return { lat: parseFloat(coord.lat), lng: parseFloat(coord.lng) };
                            });

                            // Draw the polygon using the fetched coordinates
                            if (coordinates.length > 0) {
                                const cityPolygon = new google.maps.Polygon({
                                    paths: coordinates,
                                    strokeColor: '#FF0000',
                                    strokeOpacity: 0.8,
                                    strokeWeight: 2,
                                    fillColor: '#FF0000',
                                    fillOpacity: 0.35
                                });

                                // Remove any existing polygons on the map
                                if (window.currentPolygon) {
                                    window.currentPolygon.setMap(null);
                                }

                                // Set the new polygon on the map
                                cityPolygon.setMap(map);
                                window.currentPolygon = cityPolygon;
                            }
                        } else {
                            console.error('Invalid data format: Expected an array');
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching city coordinates:', error);
                    }
                });
            });

            // Save button click event
            $('#save-area').click(function() {
                let selectedCity = $('#city-select').val();
                if (saveData.coordinates && saveData.coordinates.length > 0) {
                    // Send data to the backend via AJAX
                    $.ajax({
                        url: '/admin/save-area',
                        method: 'POST',
                        data: {
                            coordinates: saveData.coordinates,
                            hub:selectedCity
                        },
                        success: function(response) {
                          window.location.reload();
                        },
                        error: function(error) {
                            alertify.error('Error saving area.');
                        }
                    });
                } else {
                    alertify.error('Please draw a polygon on the map.');
                }
            });
        };
    });
});
