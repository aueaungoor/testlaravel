<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps & GPS</title>
   
</head>
<body>
    <h2>ตำแหน่งของคุณ</h2>
    <button onclick="getLocation()">📍 แชร์ตำแหน่ง</button>
    <div id="map" style="width: 100%; height: 500px;"></div>

    <div class="mb-2">
        <label>Selected Location:</label>
        {{-- <p id="lat">Lat: -</p>
        <p id="lng">Lng: -</p> --}}
        <p>Latitude: <span id="latDisplay"></span></p>
        <p>Logtitude: <span id="lngDisplay"></span></p>
    </div>

    <script>
      let map;
let marker;

function initMap(lat = 13.736717, lng = 100.523186) { // ✅ ใช้ค่าเริ่มต้นถ้าไม่มีค่าพิกัด
    console.log("✅ พิกัดที่ใช้ใน Google Maps:", lat, lng);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                console.log("✅ พิกัด GPS ที่ได้รับ:", lat, lng);

                let userPos = { lat: lat, lng: lng };

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
            function (error) {
                console.error("❌ เกิดข้อผิดพลาดในการดึงพิกัด:", error.message);
                alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้: " + error.message);
                loadDefaultMap();
            },
            { enableHighAccuracy: true }
        );
    } else {
        alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
        loadDefaultMap();
    }



    var map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: lat, lng: lng },
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
        title: "ตำแหน่งของคุณ"
    });

    console.log("📌 พิกัดที่ได้จาก Google Maps:", marker.getPosition());


            // ส่งข้อมูลไปที่ Laravel
            fetch('/api/map/realtimee', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ latitude: lat, longitude: lng })
            })
            .then(response => response.json())
            .then(data => console.log("📡 ส่งพิกัดสำเร็จ", data))
            .catch(error => console.error("❌ ส่งพิกัดล้มเหลว", error));
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        initMap(lat, lng);
                    },
                    (error) => {
                        alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้: " + error.message);
                    }
                );
            } else {
                alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation");
            }
        }


        function updateLatLng(position) {
    if (!position) {
        console.error("❌ ไม่สามารถอัปเดตพิกัด: position เป็น undefined");
        return;
    }

    let lat = position.lat();
    let lng = position.lng();

    console.log("📌 พิกัด Marker อัปเดต:", lat, lng);

    // เช็คว่า element มีอยู่จริงก่อนที่จะอัปเดตค่า
    let latElement = document.getElementById("latDisplay");
    let lngElement = document.getElementById("lngDisplay");

    if (latElement && lngElement) {
        latElement.textContent = lat.toFixed(6);
        lngElement.textContent = lng.toFixed(6);
    } else {
        console.warn("⚠️ ไม่พบ element สำหรับแสดงค่าพิกัด!");
    }
}


    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=initMap" async defer></script>
</body>
</html>
