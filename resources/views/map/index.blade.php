<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Map with Current Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; }
        #coordinates { margin-top: 10px; font-size: 16px; }
         button {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>📍 Custom Map with Draggable Marker</h2>

    <div>
        <a href="{{ route('map.show')}}" class="btn btn-success">Show All</a>
      
    </div>
    <!-- <div id="map"></div> -->
    <div id="googleMap" style="width:100%;height:400px;"></div>
    <form id="locationForm">
        <div>
            <label for="firstName">ชื่อ:</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        
        <div>
            <label for="lastName">นามสกุล:</label>
            <input type="text" id="lastName" name="lastName" required>
        </div>
        <label>Selected Location:</label>
        <p id="lat">Lat: -</p>
        <p id="lng">Lng: -</p>
        {{-- <p id="coordinates">Lat: -, Lng: -</p> --}}
       
        <div>
        <button type="submit">บันทึกข้อมูล</button>
        </div>
    </form>
 

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // ตรวจสอบว่าบราวเซอร์รองรับ Geolocation หรือไม่
//         const apiKey = "AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4";
//         if ("geolocation" in navigator) {
//             navigator.geolocation.getCurrentPosition(function(position) {
//                 let userLat = position.coords.latitude;
//                 let userLng = position.coords.longitude;

//                 // สร้างแผนที่และกำหนดตำแหน่งเริ่มต้น
//                 let map = L.map('map').setView([userLat, userLng], 13);

//                 // ใช้ OpenStreetMap เป็น Tile Layer
//                 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                     attribution: '© OpenStreetMap contributors'
//                 }).addTo(map);

//                 // เพิ่ม Marker และกำหนดให้ลาก (draggable) ได้
//                 let marker = L.marker([userLat, userLng], { draggable: true }).addTo(map);

//                 // แสดงค่าพิกัดเริ่มต้น
//                 // document.getElementById("coordinates").innerHTML = `Lat: ${userLat.toFixed(6)}, Lng: ${userLng.toFixed(6)}`;
//                 document.getElementById("lat").innerHTML = `Lat: ${userLat.toFixed(6)}`;
//                 document.getElementById("lng").innerHTML = `Lng: ${userLng.toFixed(6)}`;

//                 // อัปเดตพิกัดเมื่อมีการลาก Marker
//                 marker.on('dragend', function(e) {
//                     let newLatLng = e.target.getLatLng();
//                     // document.getElementById("coordinates").innerHTML = `Lat: ${newLatLng.lat.toFixed(6)}, Lng: ${newLatLng.lng.toFixed(6)}`;
//                     document.getElementById("lat").innerHTML = `Lat: ${newLatLng.lat.toFixed(6)}`;
//                     document.getElementById("lng").innerHTML = `Lng: ${newLatLng.lng.toFixed(6)}`;
//                 });

//             }, function(error) {
//                 alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้! โปรดเปิด GPS.");
//             });
//         } else {
//             alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation!");
//         }
//         document.getElementById("locationForm").addEventListener("submit", function(event) {
//             event.preventDefault(); // ป้องกันการโหลดหน้าใหม่

//             let firstName = document.getElementById("firstName").value;
//             let lastName = document.getElementById("lastName").value;  // แก้จาก "lasttName" -> "lastName"
//             let lat = parseFloat(document.getElementById("lat").textContent.replace("Lat: ", ""));
//             let lng = parseFloat(document.getElementById("lng").textContent.replace("Lng: ", ""));

// // ✅ ใช้ console.log() เพื่อตรวจสอบค่าใน Developer Console
// console.log("📌 First Name:", firstName);
// console.log("📌 Last Name:", lastName);
// console.log("📌 Latitude:", lat);
// console.log("📌 Longitude:", lng);

            
 
// axios.post('/map/save', {
//     fname: firstName,  // ✅ เปลี่ยน first_name เป็น fname
//     lname: lastName,   // ✅ เปลี่ยน last_name เป็น lname
//     lat: parseFloat(lat),  // ✅ แปลงค่า lat เป็น float
//     lng: parseFloat(lng)   // ✅ แปลงค่า lng เป็น float
// })

//             .then(response => {
//                 alert("Location saved: " + JSON.stringify(response.data));
//             })
//             .catch(error => {
//                 console.error("❌ Error sending location:", error.response ? error.response.data : error);
//             });
//         });
        
//     </script>
    <script>
        function myMap() {
            var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&callback=myMap"></script>
</body>
</html>
