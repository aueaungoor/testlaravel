<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Map with Current Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <style>
        #map { width: 100%; height: 500px; }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2>📍 Show All Map</h2>
        <a href="{{ route('map.show') }}" class="btn btn-success">Show All</a>

        <div id="map"></div>

    </div>

    <script>
        let map;
        let marker;

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                   
                    function (position) {
                        let userPos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        map = new google.maps.Map(document.getElementById("map"), {
                            center: userPos,
                            zoom: 15
                        });

                        marker = new google.maps.Marker({
                            position: userPos,
                            map: map,
                            draggable: true
                        });
                    },
                    function () {
                        alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้");
                        // loadDefaultMap();
                    }
                );
            } else {
                alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
                // loadDefaultMap();
            }
        }

        axios.get("/map/getallmap")
            .then(response => {
                let locations = response.data; // รับข้อมูลจาก API
                console.log("📌 ข้อมูลที่ดึงมา:", locations);

                locations.forEach(location => {
                    let marker = new google.maps.Marker({
                        position: { lat: parseFloat(location.lat), lng: parseFloat(location.lng) },
                        map: map,
                        title: location.fname + " " + location.lname
                    });

                    let infoWindow = new google.maps.InfoWindow({
                        content: `<strong>${location.fname} ${location.lname}</strong><br>Lat: ${location.lat}, Lng: ${location.lng}`
                    });

                    marker.addListener("click", () => {
                        infoWindow.open(map, marker);
                    });
                });
            })
            .catch(error => {
                console.error("❌ ไม่สามารถดึงข้อมูลตำแหน่งได้:", error);
            });



             


         

    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=initMap" async defer></script>

</body>
</html>
