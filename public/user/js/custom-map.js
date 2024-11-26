$(function () {
    'use strict';
    $(document).ready(function() {
        let c_map, d_map, marker, c_searchBox, d_searchBox, car_map, car_marker;

        window.initMarker = function() {
            // Initialize the pickup map
            c_map = new google.maps.Map(document.getElementById('custom_map'), {
                center: {lat: 11.0168, lng: 76.9558}, // Coimbatore, as an example
                zoom: 12,
            });

            // Initialize the delivery map
            d_map = new google.maps.Map(document.getElementById('delivery_map'), {
                center: {lat: 11.0168, lng: 76.9558}, // Coimbatore, as an example
                zoom: 12,
            });

            // Pickup and Delivery SearchBoxes
            const pickupInput = document.getElementById('custom-city');
            const deliveryInput = document.getElementById('delivery-city');
            const c_searchBox = new google.maps.places.SearchBox(pickupInput);
            const d_searchBox = new google.maps.places.SearchBox(deliveryInput);

            // Bias the SearchBox results towards the current map's viewport
            c_map.addListener('bounds_changed', function () {
                c_searchBox.setBounds(c_map.getBounds());
            });

            d_map.addListener('bounds_changed', function () {
                d_searchBox.setBounds(d_map.getBounds());
            });


            // Event listener for the current location button click
            $('#drop_current_location').click(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        // Update the latitude and longitude input fields
                        $('#dly_latitude').val(lat);
                        $('#dly_longitude').val(lng);

                        // Use Geocoding API to get the address from the latitude and longitude
                        const geocoder = new google.maps.Geocoder();
                        const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

                        geocoder.geocode({ location: latlng }, function (results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    const address = results[0].formatted_address;
                                    $('.current_delivery_address').val(address);
                                    $('#dly_address').val(address);
                                    // Set the map center to the current location
                                    c_map.setCenter(latlng);
                                    c_map.setZoom(14);

                                    // Place a marker on the current location
                                    if (marker) {
                                        marker.setMap(null);
                                    }
                                    marker = new google.maps.Marker({
                                        position: latlng,
                                        map: c_map,
                                        title: "Current Location",
                                    });
                                } else {
                                    alert('No address found for this location.');
                                }
                            } else {
                                alert('Geocoder failed due to: ' + status);
                            }
                        });
                    }, function () {
                        alert('Geolocation failed. Please enable location services.');
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            $('#pick_current_location').click(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        // Update the latitude and longitude input fields
                        $('#pic_latitude').val(lat);
                        $('#pic_longitude').val(lng);

                        // Use Geocoding API to get the address from the latitude and longitude
                        const geocoder = new google.maps.Geocoder();
                        const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

                        geocoder.geocode({ location: latlng }, function (results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    const address = results[0].formatted_address;
                                    $('.current_pickup_address').val(address);
                                    $('#pic_address').val(address);
                                    // Set the map center to the current location
                                    c_map.setCenter(latlng);
                                    c_map.setZoom(14);

                                    // Place a marker on the current location
                                    if (marker) {
                                        marker.setMap(null);
                                    }
                                    marker = new google.maps.Marker({
                                        position: latlng,
                                        map: c_map,
                                        title: "Current Location",
                                    });
                                } else {
                                    alert('No address found for this location.');
                                }
                            } else {
                                alert('Geocoder failed due to: ' + status);
                            }
                        });
                    }, function () {
                        alert('Geolocation failed. Please enable location services.');
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            // Event listener for pickup search box results
            c_searchBox.addListener('places_changed', function () {
                const places = c_searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }

                // Get the first place (the searched city)
                const city = places[0];

                let c_latitude = city.geometry.location.lat();
                let c_longitude = city.geometry.location.lng();
                let c_address = city.formatted_address;
                $('#pic_latitude').val(c_latitude);
                $('#pic_longitude').val(c_longitude);
                $('#pic_address').val(c_address);

                // Zoom into the city
                c_map.setCenter(city.geometry.location);
                c_map.setZoom(14);

                // Remove any existing marker
                if (marker) {
                    marker.setMap(null);
                }

                // Add a marker at the city location
                marker = new google.maps.Marker({
                    position: city.geometry.location,
                    map: c_map,
                    title: city.name,
                });
            });


            // Event listener for delivery search box results
            d_searchBox.addListener('places_changed', function () {
                const places = d_searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }

                // Get the first place (the searched city)
                const city = places[0];

                let d_latitude = city.geometry.location.lat();
                let d_longitude = city.geometry.location.lng();
                let d_address = city.formatted_address;
                $('#dly_latitude').val(d_latitude);
                $('#dly_longitude').val(d_longitude);
                $('#dly_address').val(d_address);

                // Zoom into the city
                d_map.setCenter(city.geometry.location);
                d_map.setZoom(14);

                // Remove any existing marker
                if (marker) {
                    marker.setMap(null);
                }

                // Add a marker at the city location
                marker = new google.maps.Marker({
                    position: city.geometry.location,
                    map: d_map,
                    title: city.name,
                });
            });
        };

        $(document).on('click', '.pickup_location', function() {
            window.initMarker();
            $.ajax({
                url: '/user/verify-location',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#secondModal').modal('show');
                        window.initMarker();
                        $('#custom-city').focus();
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.message) {
                        let errors = response.responseJSON.message;
                        if (errors === 'Unauthenticated.') {
                            $('#mobileModal').modal('show');
                        }
                    }
                }
            });
        });

        $(document).on('click', '.pickup_location', function() {

        });


        // Example values for car location
        let car_latitude_current = parseFloat($('#car_latitude_current').val()) || 11.0168;
        let car_longitude_current = parseFloat($('#car_longitude_current').val()) || 76.9558;

        window.carMarker = function() {
            let lat = car_latitude_current;
            let lng = car_longitude_current;

            // Initialize the map centered on the car's location
            car_map = new google.maps.Map(document.getElementById('car_location_map'), {
                center: {lat: lat, lng: lng},
                zoom: 12,
            });

            // Add a marker at the car's location
            car_marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: car_map,
                title: "Car Location",
            });
        };

        $('#same_address').click(function() {

            const pickupLat = $('#dly_latitude').val();
            const pickupLng = $('#dly_longitude').val();
            const delivery_address = $('#dly_address').val();

            if (pickupLat === '' && pickupLng === ''){
                $('#delivery_outside_area').text('Please Select the Pickup Location');
                return;
            }

            if (pickupLat && pickupLng) {
                checkLocation('same_location',pickupLat, pickupLng,delivery_address, function(isInside) {
                    if (isInside) {
                        $('#secondModal').modal('hide');
                        $('#pickup_address').text(delivery_address);
                        $('#drop_address').text(delivery_address);
                        $('#drop_address_pine').val(true);
                        $('#pickup_address_pine').val(true);
                    } else {
                        $('#pick_outside_area').text(' ');
                        $('#delivery_outside_area').text(' ').text('Pickup location is outside the designated area. Please select a different location.');
                    }
                });
            } else {
                alert('Please enter a valid pickup location.');
            }
        });

        $('#conform_address').click(function() {

            const pickupLat = $('#pic_latitude').val();
            const pickupLng = $('#pic_longitude').val();
            const pickup_address = $('#pic_address').val();
            if (pickupLat === '' && pickupLng === ''){
                $('#pickup_outside_area').text('Please Select the Pickup Location');
                return;
            }

            if (pickupLat && pickupLng) {
                checkLocation('delivery_location',pickupLat, pickupLng,pickup_address, function(isInside) {
                    if (isInside) {
                        $('#secondModal').modal('hide');
                        $('#pickup_address').text(pickup_address);
                        $('#pickup_address_pine').val(true);
                    } else {
                        $('#pickup_outside_area').text('').text('Pickup location is outside the designated area. Please select a different location.');
                    }
                });
            } else {
                alert('Please enter a valid pickup location.');
            }
        });

        $('#delivery_address').click(function() {

            const pickupLat = $('#dly_latitude').val();
            const pickupLng = $('#dly_longitude').val();
            const delivery_address = $('#dly_address').val();

            if (pickupLat === '' && pickupLng === ''){
                $('#delivery_outside_area').text('Please Select the Pickup Location');
                return;
            }

            if (pickupLat && pickupLng) {
                checkLocation('pickup_location',pickupLat, pickupLng,delivery_address, function(isInside) {
                    if (isInside) {
                        $('#delivery-section').addClass('d-none');
                        $('#pickup-section').removeClass('d-none');
                        $('#drop_address').text(delivery_address);
                        $('#drop_address_pine').val(true);
                    } else {
                        $('#delivery_outside_area').text('').text('Pickup location is outside the designated area. Please select a different location.');
                    }
                });
            } else {
                alert('Please enter a valid pickup location.');
            }
        });
        function checkLocation(type,pickupLat,pickupLng,address,callback) {
            $.ajax({
                url: '/user/check-location',
                method: 'POST',
                data: {
                    lat: pickupLat,
                    lng: pickupLng,
                    type:type,
                    address:address
                },
                success: function(response) {
                    if (response.message) {
                        $('#pick_outside_area').text('').text('response.message.');
                        return;
                    }

                    if (response.inside) {
                        callback(true);
                        // Proceed to the next steps or show the delivery section.
                    } else {
                        callback(false);
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.message) {
                        let errors = response.responseJSON.message;
                        if (errors) {
                            $('#pick_outside_area').text('').text('Please Login your Account');
                        }
                    }
                }
            });
        }

    });
});
