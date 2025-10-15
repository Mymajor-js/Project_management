<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลหมุด</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/showcss.css">
    <link rel="stylesheet" href="../css/scroobar.css">
    <link rel="stylesheet" href="{{ asset('css/loginshow.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
</head>

<body>
    <div class="container">
        
        <div class="form-container">
            <h2>
                <center>เพิ่มรูปภาพ</center>
            </h2>

            @if ($marker)
            <h3>
                <center>โครงการ {{ $marker->Nactivity }}</center>
            </h3><br>
            <div class="container">
                {{-- ผู้รับผิดชอบ --}}
                <div class="info-card">
                    <h5>👥 ผู้รับผิดชอบ</h5>
                    @foreach($marker->person as $index => $person)
                        <p><strong>{{$index +1}}: ชื่อ :</strong> {{ $person->name_lastname }}</p>
                        <p><strong>ตำแหน่ง :</strong> {{ $person->position }}</p>
                    @endforeach
                </div>

                {{-- ข้อมูลงบประมาณ --}}
                <div class="info-card">
                    <h5>💰 ข้อมูลงบประมาณ</h5>
                    <p><strong>แหล่งงบประมาณ :</strong> {{ $marker->arear_money }}</p>
                    <p><strong>ปีงบประมาณ:</strong> {{ $marker->year_money }}</p>
                </div>

                {{-- วัตถุประสงค์หลัก (O) --}}
                <div class="info-card">
                    <h5>🎯 วัตถุประสงค์หลัก (O)</h5>
                    @foreach($marker->target as $index => $target)
                        <p><strong>{{$index + 1}} :</strong> {{ $target->target }}</p>
                    @endforeach
                </div>

                {{-- ผลลัพธ์หลัก (KR) --}}
                <div class="info-card">
                    <h5>📊 ผลลัพธ์หลัก (KR)</h5>
                    @foreach($marker->result as $index => $result)
                        <p><strong>{{$index + 1}} :</strong> {{ $result->target }}</p>
                    @endforeach
                </div>
                <div class="tablx">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th rowspan="2"><center>🔢 ลำดับ</center></th>
                                <th rowspan="2"><center>📊 ผลลัพธ์หลัก</center></th>
                                <th colspan="2"><center>🎯 เป้าหมาย</center></th>
                                <th colspan="2"><center>📈 ผลการดำเนินงาน</center></th>
                            </tr>
                            <tr>
                                <th><center>📌 หน่วยนับ</center></th>
                                <th><center>🔢 จำนวน</center></th>
                                <th><center>📌 หน่วยนับ</center></th>
                                <th><center>🔢 จำนวน</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marker->maintarget as $index => $maintarget)
                            <tr>
                                <td><center>{{$index}}</center></td>
                                <td>{{$maintarget->result_main}}</td>
                                <td>{{$maintarget->goal_unit}}</td>
                                <td>{{$maintarget->goal_amount}}</td>
                                <td>{{$maintarget->performance_unit}}</td>
                                <td>{{$maintarget->performance_amount}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>

                {{-- ข้อมูลพื้นที่ --}}
                <div class="info-card">
                    <h5>📍 ข้อมูลพื้นที่</h5>
                    <p><strong>อำเภอ :</strong> {{ $marker->district }}</p>
                    <p><strong>ตำบล :</strong> {{ $marker->subdistrict }}</p>
                    <p><strong>หมู่บ้าน :</strong> {{ $marker->mauban }}</p>
                    <p><strong>หมู่ที่ :</strong> {{ $marker->mautee }}</p>
                </div>

                {{-- สรุปผลการดำเนินงาน --}}
                <div class="info-card">
                    <h5>📑 สรุปผลการดำเนินงาน</h5>
                    <p>{{ $marker->performancex }}</p>
                </div>

                {{-- กิจกรรมที่ดำเนินการ --}}
                <div class="info-card">
                    <h5>🛠️ กิจกรรมที่ดำเนินการ</h5>
                    @foreach($marker->activity as $index => $activity)
                        <p><strong>กิจกรรม {{$index + 1}} :</strong> {{ $activity->name_activity }}</p>
                        <p><strong>ชื่อ-สกุล :</strong> {{ $activity->person_pj }}</p>
                        <p><strong>ผลลัพธ์ :</strong> {{ $activity->resultx }}</p>
                    @endforeach
                </div>

                {{-- ประโยชน์ที่ได้รับ --}}
                <div class="info-card">
                    <h5>🏆 ประโยชน์ที่ได้รับ</h5>
                    @foreach($marker->benefit as $index => $benefit)
                        <p><strong>ประโยชน์ {{$index + 1}} :</strong> {{ $benefit->benefit }}</p>
                    @endforeach
                </div>

                {{-- ระยะเวลาโครงการ --}}
                <div class="info-card">
                    <h5>⏳ ระยะเวลาโครงการ</h5>
                    <p><strong>เริ่มต้น :</strong> {{ $marker->time_pj }}</p>
                    <p><strong>สิ้นสุด :</strong> {{ $marker->time_pj_end }}</p>
                </div>
            </div>

            @else
            <p>ไม่พบข้อมูลสำหรับพิกัดนี้</p>
            @endif
            @if(Auth::check() && Auth::user()->name)

            <form action="{{ route('upload-multiple-images') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" id="latitude" name="latitude" value="{{ $marker->latitude }}" readonly required>
                </div>
                <div class="form-group">
                    <input type="hidden" id="longitude" name="longitude" value="{{ $marker->longitude }}"readonly required>
                    <input type="hidden" id="Nactivity" name="Nactivity" value="{{ $marker->Nactivity }}"readonly required>
                </div>
                <div class="form-group">
                    <label for="images">เลือกภาพ:</label>
                    <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/gif,image/webp" class="form-control" required>

                </div>
                <button type="submit" class="btn btn-success btn-block">อัพโหลดรูปภาพ</button>
            </form>
            @endif

            <br>
            <a href="javascript:history.back()" class="btn btn-success">
                ⬅️ กลับ
            </a>
            <a href="../dashboard" class="btn btn-info">🌍 กลับไปยังแผนที่</a>
            
            @if(Auth::check())
            <a href="{{ route('download.pdf', $marker->id) }}" class="btn btn-danger" target="_blank">
                ⬆️ Export
            </a>
            @if (Auth::check() && Auth::user()->level === 'admin')
                <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-primary">
                    🔧 Update
                </a>
            @elseif (Auth::check() && Auth::user()->my_name === $marker->my_name)
                <a href="{{ route('updatex', $marker->Nactivity) }}" class="btn btn-primary">
                    🔧 Update
                </a>
            @endif

                <button id="delete-selected" class="btn btn-danger">🗑️ ลบรูปที่เลือก</button>
            @endif

            @if ($imgx->isEmpty())
                
            @else
                
            
            <button id="download-selected" class="btn btn-success">📥 ดาวน์โหลดรูปที่เลือก</button>
            @endif
            <!-- แสดงรูปภาพที่อัพโหลดหรือที่มีอยู่ -->
            <div class="contenta">
                <div class="headerx">
                <h2>แสดงรูปภาพ</h2>
               
                </div>
                <div class="row">
                @if ($imgx->isEmpty())
                    <p>ไม่พบรูปภาพสำหรับหมุดนี้</p>
                @else
                    @foreach ($imgx as $img)
                    <div class="col-md-2 mb-3 position-relative" data-id="{{ $img->id }}">
                        <input type="checkbox" class="select-img" style="position: absolute; top: 5px; left: 5px;">
                        <img src="{{ asset('storage/images/' . $img->image_path) }}" 
                            alt="Image" class="img-fluid" loading="lazy" 
                            width="250" height="200" style="object-fit: cover;"
                            ondblclick="showLargeImage('{{ asset('storage/images/' . $img->image_path) }}')">

                        <span class="position-absolute top-50 start-50 translate-middle text-white delete-btn" 
                            style="cursor: pointer; font-size: 20px; display: none;">&times;</span>
                    </div>
                    @endforeach
                @endif
            </div>
                <div id="imageModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="largeImage" src="" alt="Large Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- Script to handle the click event -->
<script>
    document.querySelectorAll('.col-md-2').forEach(function(col) {
        const img = col.querySelector('img');
        const deleteBtn = col.querySelector('.delete-btn');
        const checkbox = col.querySelector('.select-img');  // ตัวเลือกสำหรับ checkbox

        // เมื่อคลิกที่รูปภาพ
        img.addEventListener('click', function() {
            // toggle แสดงปุ่มลบ
            deleteBtn.style.display = deleteBtn.style.display === 'none' ? 'block' : 'none';
            img.classList.toggle('dark');

            // toggle การติ๊ก checkbox
            checkbox.checked = !checkbox.checked; // เปลี่ยนสถานะ checkbox
            col.classList.toggle('selected', checkbox.checked); // เพิ่มคลาส 'selected' ให้กับรูปที่ถูกเลือก
        });

        // เมื่อคลิกที่ปุ่มลบ ให้ลบรูปออกจากฐานข้อมูล
        deleteBtn.addEventListener('click', function() {
            const imgId = col.getAttribute('data-id');
            Swal.fire({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณจะไม่สามารถกู้คืนรูปนี้ได้!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่, ลบเลย!",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('{{ route('deleteImage') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: imgId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    col.remove();
                    Swal.fire({
                        title: "ลบสำเร็จ!",
                        text: "รูปของคุณถูกลบแล้ว",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด!",
                        text: "ลบไม่สำเร็จ กรุณาลองใหม่",
                        icon: "error"
                    });
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

        });

        // ทำให้ checkbox เป็นแบบ toggle
        checkbox.addEventListener('change', function() {
            col.classList.toggle('selected', checkbox.checked);
        });
    });

    // เมื่อคลิกที่ปุ่ม "ลบรูปที่เลือก"
    document.getElementById('delete-selected').addEventListener('click', function() {
        // หา image ที่ถูกเลือก
        const selectedImages = document.querySelectorAll('.col-md-2.selected');

        if (selectedImages.length > 0) {
            Swal.fire({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณจะไม่สามารถกู้คืนรูปที่เลือกได้!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่, ลบเลย!",
        cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                selectedImages.forEach(function(col) {
                    const imgId = col.getAttribute('data-id');

                    fetch('{{ route('deleteImage') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: imgId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            col.remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });

                Swal.fire({
                    title: "ลบสำเร็จ!",
                    text: "รูปที่เลือกถูกลบแล้ว",
                    icon: "success"
                });
            }
        });

            } else {
                alert('กรุณาเลือกภาพที่ต้องการลบ');
            }
        });
        function showLargeImage(imagePath) {
                // แสดง modal
                var modal = document.getElementById('imageModal');
                var largeImage = document.getElementById('largeImage');
                largeImage.src = imagePath;
                modal.style.display = 'block';
            }

            function closeModal() {
                // ซ่อน modal เมื่อคลิกปิด
                var modal = document.getElementById('imageModal');
                modal.style.display = 'none';
            }

            // ปิด modal เมื่อคลิกที่พื้นที่นอก modal
            window.onclick = function(event) {
                var modal = document.getElementById('imageModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
            document.querySelectorAll('.select-img').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const selectedImages = document.querySelectorAll('.col-md-2.selected');

            // ตรวจสอบว่ามีรูปภาพที่ถูกเลือกหรือไม่
            if (selectedImages.length > 0) {
                document.getElementById('download-selected').style.display = 'block'; // แสดงปุ่มดาวน์โหลด
            } else {
                document.getElementById('download-selected').style.display = 'none'; // ซ่อนปุ่มดาวน์โหลด
            }
        });
    });

    document.getElementById('download-selected').addEventListener('click', function() {
        // หา image ที่ถูกเลือก
        const selectedImages = document.querySelectorAll('.col-md-2.selected');
        
        if (selectedImages.length > 0) {
            selectedImages.forEach(function(col) {
                const imgPath = col.querySelector('img').src;  // ได้ path ของรูปภาพที่เลือก
                const link = document.createElement('a');  // สร้างลิงก์ดาวน์โหลด
                link.href = imgPath;  // ตั้งค่า href เป็น path ของรูปภาพ
                link.download = imgPath.split('/').pop();  // ตั้งชื่อไฟล์ที่ดาวน์โหลดจากชื่อไฟล์ใน URL
                document.body.appendChild(link);
                link.click();  // คลิกลิงก์เพื่อดาวน์โหลด
                document.body.removeChild(link);
            });
        } else {
            alert('กรุณาเลือกภาพที่ต้องการดาวน์โหลด');
        }
    });
</script>
        
</body>

</html>