

<!DOCTYPE html>
<html>
<head>
    <title>Geofencing Example</title>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(sendPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function sendPosition(position) {
            fetch('/update-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                })
            }).then(response => response.json())
                .then(data => {
                    console.log(data);
                });
        }
    </script>

</head>
<body>
<button onclick="getLocation()">Get Location</button>
</body>
</html>
