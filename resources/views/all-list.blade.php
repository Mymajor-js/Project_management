<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการทั้งหมด</title>
    <link rel="stylesheet" href="../css/list.css" />
    <link rel="stylesheet" href="{{ asset('css/loginshow.css') }}">
    <link rel="stylesheet" href="../css/scroobar.css">

    <!-- เพิ่มการโหลด jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <style>
        
    </style>

</head>


<body>
    @if(Auth::check() && Auth::user()->name)
    <div class="container mt-4">
        <div class="gb">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="text-center fixed-header">รายการกิจกรรมทั้งหมด</h2>

            <div class="text-end mb-3 fixed-button">
                <button class="btn btn-primary" onclick="toggleView()">ปรับมุมมอง</button>
                @if (Auth::check() && Auth::user()->level === 'admin')
                    <a href="{{ route('chart') }}" class="btn btn-success">ดูแผนภูมิ</a>
                @endif
                <a href="../map" class="btn btn-info">เปิดยังแผนที่</a>
            </div>

            <div class="search-form">
            <input 
                type="text" 
                id="searchInput" 
                name="query" 
                placeholder="🔍 ค้นหาข้อมูล..." 
                value="{{ request()->input('query') }}" 
                class="search-input">
                </div>
            <div id="tableView">
                @include('partials.marker_table', ['markers' => $markers, 'images' => $images])
            </div>

            <div id="tableView">
                @include('partials.grid', ['markers' => $markers, 'images' => $images])
            </div>
            
        </div>
    </div>
    

    @else
    <div class="login-alert">
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}" class="btn btn-primary">Go To Login</a>
    </div>
    @endif


<script>
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function () {
            const query = this.value;

            fetch(`{{ url('/alldata') }}?search=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('tableView').innerHTML = html;
            });
        });

        // จับ pagination ด้วย event delegation
        document.addEventListener('click', function (e) {
            if (e.target.matches('.pagination a')) {
                e.preventDefault();
                const url = e.target.getAttribute('href');

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('tableView').innerHTML = html;
                });
            }
        });
    });

        function confirmDelete(nactivity) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถกู้คืนกิจกรรมนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งฟอร์มลบเมื่อผู้ใช้ยืนยัน
                    const form = document.getElementById(`delete-form-${nactivity}`);
                    form.submit();
                }
            });
        }

        // เพิ่ม Event Listener ให้ปุ่มลบทุกปุ่ม
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const nactivity = this.getAttribute('data-nactivity');  // ดึงค่า Nactivity จาก attribute
                confirmDelete(nactivity);  // เรียกฟังก์ชัน confirmDelete
            });
        });

        function viewMarkerInfo(latitude, longitude, Nactivity) {
            console.log("Latitude: " + latitude);  // ตรวจสอบค่าของ latitude
            console.log("Longitude: " + longitude);  // ตรวจสอบค่าของ longitude
            console.log("Nactivity: " + Nactivity);  // ตรวจสอบค่าของ Nactivity

            var url = 'show-data?lat=' + latitude + '&lng=' + longitude + '&Nac=' + Nactivity;
            window.location.href = url;
        }
        function toggleView() {
            let tableView = document.getElementById("tableView");
            let gridView = document.getElementById("gridView");
            let graphView = document.getElementById("graphView");

            if (tableView && gridView) {
                if (tableView.style.display === "none") {
                    tableView.style.display = "block";
                    gridView.style.display = "none";
                    graphView.style.display = "none";
                } else {
                    tableView.style.display = "none";
                    gridView.style.display = "block";
                    graphView.style.display = "none";
                }
            } else {
                console.error("❌ tableView หรือ gridView ไม่พบใน DOM");
            }
        }

    function toggleViewgraph() {
        let tableView = document.getElementById("tableView");
        let gridView = document.getElementById("gridView");
        let graphView = document.getElementById("graphView");
        graphView.style.display = "block";  // ทำให้แสดงกราฟ
        tableView.style.display = "none";
        gridView.style.display = "none";
    }

    
</script>

</body>

</html>
