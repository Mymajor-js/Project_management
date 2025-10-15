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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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
                <a href="{{ route('show.map') }}?query={{ request()->input('query') }}&Nactivity={{ implode(',', $markers->pluck('Nactivity')->toArray()) }}&latitude={{ implode(',', $markers->pluck('latitude')->toArray()) }}&longitude={{ implode(',', $markers->pluck('longitude')->toArray()) }}" class="btn btn-success">เปิดแผนที่</a>
                <a href="../map" class="btn btn-info">กลับไปยังแผนที่</a>
            </div>

            <form action="{{ url('/search') }}" method="GET" class="search-form">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="🔍 ค้นหาข้อมูล..." 
                    value="{{ request()->input('query') }}" 
                    class="search-input">
                <button type="submit" class="search-button">ค้นหา</button>
            </form>

            <div id="tableView">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>no</th>
                            <th>ชื่อโครงการ/กิจกรรม:</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>ปีงบประมาณ</th>
                            <th>จัดการ</th>
                            <th>เพิ่มเติม</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($markers as $index => $marker)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><div class="status-box">{{ $marker->Nactivity }}</div></td>
                            <td><div class="status-box">{{ $marker->my_name }}</div></td>
                            <td><div class="status-box">{{ $marker->year_money }}</div></td>
                            <td>
                                <div class="status-box gap">
                                    <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-primary btn-sm">Update</a>

                                    <form id="delete-form-{{ $marker->Nactivity }}" action="{{ route('delx', $marker->Nactivity) }}" method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-nactivity="{{ $marker->Nactivity }}">ลบ</button>
                                    </form>

                                </div>
                            </td>
                            <td>
                                <div class="status-box gap">
                                    @if(empty($marker->latitude) || empty($marker->longitude))
                                    <button class="btn btn-warning btn-sm">ข้อมูลยังไม่ครบ</button>
                                    @else
                                    <a href="javascript:void(0)" onclick="viewMarkerInfo({{ $marker->latitude }}, {{ $marker->longitude }},'{{$marker->Nactivity}}')" class="btn btn-info btn-sm">ดูรูปเพิ่มเติม</a>
                                    @endif
                                    @if($marker->status == 'Pending')
                                        @if (Auth::check() && Auth::user()->level === 'admin')
                                            @if(empty($marker->latitude) || empty($marker->longitude))
                                            
                                            @else
                                            <form action="{{route('update_success', ['Nactivity' => $marker->Nactivity])}}" method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-sm">เสร็จสิ้น</button>
                                            </form>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="status-box gap">
                                    <div class="status {{ $marker->status == 'finish' ? 'finish' : 'Pending' }}">
                                        <i class="fa-solid {{ $marker->status == 'finish' ? 'fa-circle-check' : 'fa-circle-exclamation' }}"></i>
                                        <span>{{ $marker->status == 'finish' ? 'เสร็จสิ้น' : 'รอดำเนินการ' }}</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div id="gridView" style="display: none;">
                <div class="row">
                    @foreach ($markers as $index => $marker)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            @php
                            $image = $images->firstWhere('Nactivity', $marker->Nactivity);
                            @endphp

                            @if ($image)
                            <img src="{{ asset('storage/images/' . $image->image_path) }}" class="card-img-top" alt="Image for {{ $image->Nactivity }}">
                            @else
                            <br>
                            <h5 class="color-red">โครงงาน/กิจกรรมนี้ ยังไม่มีรูปภาพ</h5>
                            @endif
                            <div class="card-body">
                                <div class="txt-body">
                                    <p class="card-text"><strong>ชื่อโครงการ/กิจกรรม :</strong> {{ $marker->Nactivity }}</p>
                                    <p class="card-text"><strong>ผู้รับผิดชอบ :</strong> {{ $marker->my_name }}</p>
                                    <p class="card-text"><strong>ปีงบประมาณ:</strong> {{ $marker->year_money }}</p>
                                    <p class="card-text"><strong>จังหวัด :</strong> {{ $marker->province }}</p>
                                    <p class="card-text"><strong>อำเภอ:</strong> {{ $marker->district }}</p>
                                    <p class="card-text"><strong>ระยะเวลา :</strong> {{ $marker->time_pj }} - {{ $marker->time_pj_end }}</p>

                                    <p class="card-text"><strong>ปัญหาและอุปสรรค :</strong> {{ $marker->description }}</p>
                                    <p class="card-text"><strong>ข้อเสนอแนะ :</strong> {{ $marker->suggestions }}</p>
                                </div>
                                <div class="status-box gap">

                                <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-primary btn-sm">Update</a>

                                @if (!empty($marker->Nactivity))
                                <form id="delete-form-{{ $marker->Nactivity }}" action="{{ route('delx', $marker->Nactivity) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-nactivity="{{ $marker->Nactivity }}">ลบ</button>
                                </form>
                                    @if(empty($marker->latitude) || empty($marker->longitude))
                                    <button class="btn btn-warning btn-sm">ข้อมูลยังไม่ครบ</button>
                                    @else
                                    <a href="javascript:void(0)" onclick="viewMarkerInfo({{ $marker->latitude }}, {{ $marker->longitude }})" class="btn btn-info btn-sm">ดูรูปเพิ่มเติม</a>
                                    @endif
                                    @if($marker->status == 'Pending')
                                        @if (Auth::check() && Auth::user()->level === 'admin')
                                            @if(empty($marker->latitude) || empty($marker->longitude))
                                            
                                            @else
                                            <form action="{{route('update_success', ['Nactivity' => $marker->Nactivity])}}" method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-sm">เสร็จสิ้น</button>
                                            </form>
                                            @endif
                                        @endif
                                    @endif
                                @else
                                <p class="text-danger">⚠ ไม่มีค่า Nactivity</p>
                                @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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

        if (tableView && gridView) {
            if (tableView.style.display === "none") {
                tableView.style.display = "block";
                gridView.style.display = "none";
            } else {
                tableView.style.display = "none";
                gridView.style.display = "block";
            }
        } else {
            console.error("❌ tableView หรือ gridView ไม่พบใน DOM");
        }
    }
    
    </script>

</body>

</html>
