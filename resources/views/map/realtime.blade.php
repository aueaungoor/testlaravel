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
let currentLat = 14.028928; // ค่าเริ่มต้น (สามารถใช้ค่าจาก GPS แทนได้)
let currentLng = 99.999274;
let deviceName = localStorage.getItem("deviceName") || "อุปกรณ์ 1";

function initMap(lat = currentLat, lng = currentLng) {
    console.log("✅ พิกัดที่ใช้ใน Google Maps:", lat, lng);

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

    marker.addListener("dragend", function () {
        let newPos = marker.getPosition();
        updateLatLng(newPos.lat(), newPos.lng(), deviceName);
    });

    // ✅ เรียก `simulateMovement()` ให้เริ่มจำลองการเคลื่อนที่
    simulateMovement();
}

function updateLatLng(lat, lng, deviceName) {
    console.log("📌 พิกัดอัปเดต:", lat, lng, "อุปกรณ์:", deviceName);

    let latElement = document.getElementById("latDisplay");
    let lngElement = document.getElementById("lngDisplay");

    if (latElement && lngElement) {
        latElement.textContent = lat.toFixed(6);
        lngElement.textContent = lng.toFixed(6);
    }

    // ✅ อัปเดต Marker บนแผนที่
    let newPosition = { lat: lat, lng: lng };
    marker.setPosition(newPosition);
    map.setCenter(newPosition);

    // ✅ ส่งพิกัดไปที่ Backend
    fetch('/api/map/realtimee', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            deviceName: deviceName,
            latitude: lat,
            longitude: lng
        })
    })
    .then(response => response.json())
    .then(data => console.log("📡 ส่งพิกัดสำเร็จ", data))
    .catch(error => console.error("❌ ส่งพิกัดล้มเหลว", error));
}

// ✅ ฟังก์ชันจำลองการเคลื่อนที่ (GPS Movement Simulation)
function simulateMovement() {
    setInterval(() => {
        // 🔄 เปลี่ยนค่าพิกัดทีละนิด (จำลองการขยับ)
        currentLat += (Math.random() - 0.5) * 0.0002; // ขยับไปทางเหนือ/ใต้
        currentLng += (Math.random() - 0.5) * 0.0002; // ขยับไปทางซ้าย/ขวา

        updateLatLng(currentLat, currentLng, deviceName);
    }, 500);  // ⏳ อัปเดตทุก 500 มิลลิวินาที
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                currentLat = position.coords.latitude;
                currentLng = position.coords.longitude;
                console.log("📍 พิกัด GPS:", currentLat, currentLng);
                initMap(currentLat, currentLng);
            },
            (error) => {
                console.error("❌ เกิดข้อผิดพลาดในการดึงพิกัด:", error.message);
                alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้: " + error.message);
                initMap();  // โหลดค่าเริ่มต้นถ้า GPS ใช้ไม่ได้
            },
            { enableHighAccuracy: true }
        );
    } else {
        alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation");
        initMap();
    }
}

window.onload = function () {
    getLocation();
};

    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=initMap" async defer></script>
</body>
</html>
