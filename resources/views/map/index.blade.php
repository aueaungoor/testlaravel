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
        <h2>📍 Custom Map with Draggable Marker</h2>
        <a href="{{ route('map.show') }}" class="btn btn-success">Show All</a>

        <div id="map"></div>

        <form id="locationForm" class="mt-3">
            <div class="mb-2">
                <label for="firstName" class="form-label">ชื่อ:</label>
                <input type="text" id="firstName" name="firstName" class="form-control" required>
            </div>
            
            <div class="mb-2">
                <label for="lastName" class="form-label">นามสกุล:</label>
                <input type="text" id="lastName" name="lastName" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Selected Location:</label>
                {{-- <p id="lat">Lat: -</p>
                <p id="lng">Lng: -</p> --}}
                <p>Latitude: <span id="lat"></span></p>
                <p>Logtitude: <span id="lng"></span></p>
            </div>

            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
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

                        updateLatLng(marker.getPosition());

                        marker.addListener("dragend", function () {
                            updateLatLng(marker.getPosition());
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

        function loadDefaultMap() {
            let defaultPos = { lat: 13.736717, lng: 100.523186 }; // Bangkok
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultPos,
                zoom: 15
            });

            marker = new google.maps.Marker({
                position: defaultPos,
                map: map,
                draggable: true
            });

            updateLatLng(marker.getPosition());

            marker.addListener("dragend", function () {
                updateLatLng(marker.getPosition());
            });
        }

        function updateLatLng(position) {
          
            document.getElementById("lat").textContent = `Lat: ${position.lat().toFixed(6)}`;
            document.getElementById("lng").textContent = `Lng: ${position.lng().toFixed(6)}`;
        }


          
        document.getElementById("locationForm").addEventListener("submit", function (e) {
    e.preventDefault(); // ป้องกันการโหลดหน้าใหม่

    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    let lat = document.getElementById("lat").textContent.replace("Lat: ", "");
    let lng = document.getElementById("lng").textContent.replace("Lng: ", "");

    console.log("📌 First Name:", firstName);
    console.log("📌 Last Name:", lastName);
    console.log("📌 Latitude:", lat);
    console.log("📌 Longitude:", lng);

    // ✅ ส่งข้อมูลไปยัง Backend ผ่าน Axios
    axios.post('/map/save', {
    fname: firstName,  // ✅ เปลี่ยน first_name เป็น fname
    lname: lastName,   // ✅ เปลี่ยน last_name เป็น lname
    lat: parseFloat(lat),  // ✅ แปลงค่า lat เป็น float
    lng: parseFloat(lng)   // ✅ แปลงค่า lng เป็น float
    })
    .then(response => {
        alert("✅ Location saved: " + JSON.stringify(response.data));
    })
    .catch(error => {
        console.error("❌ Error sending location:", error.response ? error.response.data : error);
    });
});



             


         

    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=initMap" async defer></script>

</body>
</html>
