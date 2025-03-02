<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Route</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        #map { width: 100%; height: 500px; }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2>📍 แสดงเส้นทางไปยังจุดหมาย</h2>
        <a href="{{ route('map.show') }}" class="btn btn-secondary">🔙 กลับหน้าหลัก</a>

        <div id="map"></div>
    </div>

    <script>
        let map, directionsService, directionsRenderer;
        let destinationLat = {{ $lat }};
        let destinationLng = {{ $lng }};

        function initMap() {
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
        polylineOptions: {
            strokeColor: "red",   // 🔥 เปลี่ยนสีเส้นเป็นสีแดง
            strokeWeight: 6,      // ปรับความหนาของเส้น
            strokeOpacity: 0.8    // ปรับความโปร่งใสของเส้น
        }
    });
           
            
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14
            });

            directionsRenderer.setMap(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        let userPos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        calculateAndDisplayRoute(userPos, { lat: destinationLat, lng: destinationLng });
                    },
                    function () {
                        alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้");
                    }
                );
            } else {
                alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
            }
        }

        function calculateAndDisplayRoute(start, end) {
            directionsService.route(
                {
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING'
                },
                function (response, status) {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);
                    } else {
                        alert("ไม่สามารถคำนวณเส้นทางได้: " + status);
                    }
                }
            );
        }

        window.initMap = initMap;
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=initMap" async defer></script>

</body>
</html>
