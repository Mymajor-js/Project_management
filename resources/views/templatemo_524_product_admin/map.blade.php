<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arts & Science CPRU Activity</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/osmtogeojson"></script> <!-- ใช้แปลง OSM เป็น GeoJSON -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- ใช้ jQuery ส่งข้อมูลไป Backend -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginshow.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: -5;
        width: 110%;
        height: 105%;
        background-image: url('../img/tex.png');
        background-size: cover;
        background-position: center;
        filter: blur(5px);
        z-index: -1;
    }

    #info {
        width: 35%;
        padding: 10px;
        border: 2px solid #ddd;
        background: #f9f9f9;
    }

    #markerList {
        list-style: none;
        padding: 0;
    }

    .add-marker-btn {
        width: 80px;
        height: 80px;
    }
    .nonborder{
        border:none;
        border-radius: 20px;
        color: black;
        background: none;
        display:flex;
        gap:15px;
        flex-direction: column;
    }
    </style>
</head>

<body>

    @if(Auth::check() && Auth::user()->name)
    <div class="contentx">

        <div id="map"></div>
        <div class="function-button">
            <button onclick="enableAddMarker()" id="addMarkerBtn" class="add-marker-btn">
                <span>📌</span>
                <span>เพิ่มหมุด</span>
            </button>

            <button onclick="disableAddMarker()" id="disableMarkerBtn" class="add-marker-btn" style="display: none;">
                <span>📌</span>
                <span>เลิกหมุด</span>
            </button>

            <a href="{{route('mesavex')}}" id="disableMarkerBtn" class="list-marker-btn">
                <span>✒️</span>
                <span>กรอกพิกัดเอง</span>
            </a>
            <a href="{{route('alldata')}}" id="disableMarkerBtn" class="list-marker-btn">
                <span>🗂️</span>
                <span>ข้อมูล</span>
            </a>
            @if (Auth::check() && Auth::user()->level === 'admin')
            <a href="{{route ('add_user')}}" class="list-marker-btn">
                <span>👤</span>
                <span>เพิ่มผู้ดูแลโครงการ</span>
            </a>
            <a href="{{route ('add_activity')}}" class="list-marker-btn">
                <span>📜</span>
                <span>เพิ่มโครงการ</span>
            </a> 
            <a href="{{route('sent_activity')}}" id="disableMarkerBtn" class="list-marker-btn">
                <span>🗃️</span>
                <span>มอบหมายโครงการ</span>
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="list-marker-btn">
                @csrf
                <button type="submit" class="nonborder">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
        @else
        <div id="map"></div>
        @endif
    </div>
    <script>

    document.addEventListener("DOMContentLoaded", function() {
        if (/Mobi|Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent)) {
            let functionButton = document.querySelector('.function-button'); // ใช้ querySelector แทน
            if (functionButton) { // เช็คว่ามี element นี้จริงหรือไม่
            }
        }
    });

    var map = L.map('map').setView([15.8106, 102.0285], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var markersLayer = L.layerGroup().addTo(map); 
        var canAddMarker = false; 

        function loadMarkers(year = '') {
            markersLayer.clearLayers(); 

            fetch('/get-markers?year=' + year)
    .then(response => response.json())
    .then(markersData => {
        var markersArray = Object.values(markersData);
        markersArray.forEach(marker => {
            var popupContent = `
                <p>พิกัด: ${marker.latitude}, ${marker.longitude}</p>
                <p>ชื่อโครงการ/กิจกรรม: ${marker.Nactivity}</p>
                <p>ผู้รับผิดชอบ: ${marker.my_name}</p>
                <p>ปีงบประมาณ: ${marker.year_money}</p>
                ${marker.image ? `<img src="${marker.image}" alt="กิจกรรม" style="width: 100px; height: auto;">` : '<p>ไม่มีรูปภาพ</p>'}
                <br><br><button class="btn btn-primary" onclick="viewMarkerInfo(${marker.latitude}, ${marker.longitude},'${marker.Nactivity}')">ดูข้อมูล</button>
            `;

            var greenIcon = L.icon({
                iconUrl: '../img/greenmark.png',
                iconSize: [45, 45],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            L.marker([marker.latitude, marker.longitude], { icon: greenIcon })
                .addTo(markersLayer)
                .bindPopup(popupContent)
                .on('click', function() { this.openPopup(); });
        });
    })
    .catch(error => console.error("เกิดข้อผิดพลาดในการดึงหมุด:", error));
        }

        // ✅ โหลดหมุดทั้งหมดเมื่อเปิดหน้าเว็บ
        loadMarkers();

        // ✅ ฟังก์ชันเปิดหน้า Form
        function openForm(lat, lng, Nactivity, my_name) {
            window.location.href =
                `/add-marker-info?lat=${lat}&lng=${lng}&project=${encodeURIComponent(Nactivity)}&responsible=${encodeURIComponent(my_name)}`;
        }

        function viewMarkerInfo(latitude, longitude, Nactivity) {

            var url = 'show-data?lat=' + latitude + '&lng=' + longitude + '&Nac=' + Nactivity;
            window.location.href = url;
        }

        // ✅ ฟังก์ชันอนุญาตให้ปักหมุด
        function enableAddMarker() {
            canAddMarker = true;
            document.querySelector('.function-button').classList.add('black');
            document.querySelector('.function-button').classList.remove('before');
            document.getElementById('addMarkerBtn').style.display = 'none';
            document.getElementById('disableMarkerBtn').style.display = 'block';
        }

        // ✅ ฟังก์ชันปิดการเพิ่มหมุด
        function disableAddMarker() {
            canAddMarker = false;
            document.querySelector('.function-button').classList.add('before');
            document.querySelector('.function-button').classList.remove('black');
            document.getElementById('addMarkerBtn').style.display = 'block';
            document.getElementById('disableMarkerBtn').style.display = 'none';
        }

        // ✅ ฟังก์ชันการคลิกแผนที่เพื่อเพิ่มหมุด
        map.on('click', function(e) {
            if (!canAddMarker) {
                console.log('ไม่สามารถปักหมุดได้');
                return; // ถ้ายังไม่ได้อนุญาตให้ปักหมุด จะไม่ทำอะไร
            }

            var lat = e.latlng.lat.toFixed(6);
            var lng = e.latlng.lng.toFixed(6);

            var marker = L.marker([lat, lng]).addTo(markersLayer)
                .bindPopup("กำลังดึงข้อมูล...");

            var url =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=10&addressdetails=1`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var Nactivity = "ชื่อโครงการ/กิจกรรม"; // เปลี่ยนเป็นค่าจริง   
                    var my_name = "ชื่อผู้รับผิดชอบ"; // เปลี่ยนเป็นค่าจริง

                    marker.setPopupContent(`
                        <p>พิกัด: ${lat}, ${lng}</p>
                        <p>ชื่อโครงการ/กิจกรรม: ${Nactivity}</p>
                        <p>ผู้รับผิดชอบ: ${my_name}</p>
                        <button class="btn btn-success" 
                            onclick="openForm(${lat}, ${lng}, '${Nactivity}', '${my_name}')">
                            เพิ่มข้อมูล
                        </button>
                    `);
                })
                .catch(error => {
                    console.error("ดึงข้อมูลที่อยู่ล้มเหลว:", error);
                    marker.setPopupContent(`
                        <p>พิกัด: ${lat}, ${lng}</p>
                        <p>ไม่สามารถดึงข้อมูลที่อยู่ได้</p>
                    `);
                });
        });

    </script>
</body>

</html>