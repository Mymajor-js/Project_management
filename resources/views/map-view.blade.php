<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arts & Science CPRU Activity</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="../css/gb.css">
    <link rel="stylesheet" href="../css/newmap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content">
        <h2 class="title">ข้อมูลหมุด</h2>
        <div id="map" style="height: 60vh; width: 80vw;"></div>
        <div class="back">
            <a href="{{route('alldata')}}" class="btn btn-primary">ย้อนกลับ</a>
            <a href="{{route('dashboard')}}" class="btn btn-success">เพิ่มหมุด</a>
        </div>
    </div>

    <!-- ใส่สคริปต์ของ Leaflet ที่นี่ -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
        var map; // สร้างตัวแปร global สำหรับแผนที่

        document.addEventListener('DOMContentLoaded', function() {
            loadMapData(); // โหลดข้อมูลแผนที่เมื่อหน้าเว็บโหลดเสร็จ
        });

        function loadMapData() {
        if (map !== undefined) {
            map.remove();
        }

        map = L.map('map').setView([16.0, 101.0], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let bounds = [];

        @foreach ($markers as $marker)
            // ถ้ามีค่า latitude, longitude
            if ({{ $marker->latitude }} && {{ $marker->longitude }}) {
                let lat = {{ $marker->latitude }};
                let lng = {{ $marker->longitude }};
                let name = '{{ $marker->Nactivity }}';

                let popupContent = `
                    <p>พิกัด: ${lat}, ${lng}</p>
                    <p>ชื่อโครงการ/กิจกรรม: ${name}</p>
                    <br><button class="btn btn-primary" onclick="viewMarkerInfo(${lat}, ${lng}, '${name}')">ดูข้อมูล</button>
                `;

                let greenIcon = L.icon({
                    iconUrl: '../img/greenmark.png',
                    iconSize: [45, 45],
                    iconAnchor: [8, 16],
                    popupAnchor: [0, -32]
                });

                L.marker([lat, lng], { icon: greenIcon })
                    .addTo(map)
                    .bindPopup(popupContent)
                    .on('click', function () { this.openPopup(); });

                bounds.push([lat, lng]);
            }
        @endforeach

            if (bounds.length > 0) {
                map.fitBounds(bounds);
            }
        }

        // ฟังก์ชันเมื่อคลิกที่หมุด
        function viewMarkerInfo(latitude, longitude, Nactivity) {

            var url = 'show-data?lat=' + latitude + '&lng=' + longitude + '&Nac=' + Nactivity;
            window.location.href = url;
        }
</script>

</body>
</html>
