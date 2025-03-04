<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Map Search & Save</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ปรับตำแหน่งช่องค้นหาให้อยู่บนแผนที่ */
        #searchBox {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            width: 75%;
            padding: 12px;
            border-radius: 8px;
            background: white;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 16px;
        }
        ,
        .form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background: white !important; /* บังคับให้มีพื้นหลังสีขาว */
    color: black !important; /* บังคับให้ตัวอักษรเป็นสีดำ */
}

    </style>
</head>
<body class="bg-gray-100 p-4">
    <a href="{{ route('map.show') }}" class="btn btn-success">Show All</a>


    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md relative">
        <h2 class="text-2xl font-bold mb-4">ค้นหาสถานที่ & บันทึกลงฐานข้อมูล</h2>

        <!-- ควบคุมตำแหน่งของแผนที่และช่องค้นหา -->
        <div id="map-container" class="relative">
            <!-- ช่องค้นหาอยู่ข้างบนแผนที่ -->
            <input id="searchBox" type="text" placeholder="ค้นหาสถานที่...">
            <div id="map" class="w-full h-96"></div>
        </div>

      

        <form id="locationForm" class="mt-3 bg-white p-4 rounded-lg shadow-md">
            <div class="mb-3">
                <label for="firstName" class="form-label text-lg font-bold">ชื่อ:</label>
                <input type="text" id="firstName" name="firstName" class="form-control border border-gray-300 rounded-lg p-2 w-full" required>
            </div>
            
            <div class="mb-3">
                <label for="lastName" class="form-label text-lg font-bold">นามสกุล:</label>
                <input type="text" id="lastName" name="lastName" class="form-control border border-gray-300 rounded-lg p-2 w-full" required>
            </div>

            <button id="saveLocation" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">บันทึกสถานที่</button>
        </form>
        
    </div>

    

    <script>
        let map;
        let marker;
        let searchBox;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 13.736717, lng: 100.523186 }, // Bangkok
                zoom: 12,
            });

            // กำหนด SearchBox และให้ช่องค้นหาอยู่บนแผนที่
            let input = document.getElementById("searchBox");
            searchBox = new google.maps.places.SearchBox(input);

            // อัปเดตขอบเขตของแผนที่ให้เหมาะสมกับการค้นหา
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener("places_changed", () => {
                let places = searchBox.getPlaces();
                if (places.length === 0) return;

                let place = places[0];

                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    map,
                    position: place.geometry.location,
                    title: place.name
                });

                map.setCenter(place.geometry.location);
                map.setZoom(15);

                document.getElementById("saveLocation").setAttribute("data-name", place.name);
                document.getElementById("saveLocation").setAttribute("data-lat", place.geometry.location.lat());
                document.getElementById("saveLocation").setAttribute("data-lng", place.geometry.location.lng());
            });
        }

        document.getElementById("saveLocation").addEventListener("click", function() {
            let name = this.getAttribute("data-name");
            let latitude = this.getAttribute("data-lat");
            let longitude = this.getAttribute("data-lng");
            let firstName = document.getElementById("firstName").value;
            let lastName = document.getElementById("lastName").value;

            if (!name || !latitude || !longitude) {
                alert("กรุณาเลือกสถานที่ก่อนบันทึก!");
                return;
            }
            
            console.log("📌 First Name:", firstName);
    console.log("📌 Last Name:", lastName);
    console.log("📌 Latitude:", latitude);
    console.log("📌 Longitude:", longitude);
    

            axios.post('/map/save', {
    fname: firstName,  // ✅ เปลี่ยน first_name เป็น fname
    lname: lastName,   // ✅ เปลี่ยน last_name เป็น lname
    lat: parseFloat(latitude),  // ✅ แปลงค่า lat เป็น float
    lng: parseFloat(longitude)   // ✅ แปลงค่า lng เป็น float
    })
    .then(response => {
        alert("✅ Location saved: " + JSON.stringify(response.data));
    })
    .catch(error => {
        console.error("❌ Error sending location:", error.response ? error.response.data : error);
    });

        });


        // กำหนด initMap เป็น Global Function
        window.initMap = initMap;
    </script>

    <!-- โหลด Google Maps API -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB38ClEA6wcIw-6PEomjW297jb7Rx9GNo4&libraries=places&callback=initMap">
    </script>

</body>
</html>
