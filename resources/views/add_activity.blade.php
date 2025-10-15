<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลหมุด</title>
    <link rel="stylesheet" href="../css/gb.css" />
    <link rel="stylesheet" href="../css/scroobar.css">
    <link rel="stylesheet" href="../css/addmarker.css" />
    <link rel="stylesheet" href="../css/admin_add.css" />
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
@if(Auth::check() && Auth::user()->name)
    <div class="content">
        <h2>เพิ่มข้อมูล</h2>
        @if (session('success') || session('error'))
            <div class="alert-container">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-error">
                        <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif
            </div>
        @endif


        <form action="{{ route('admin_add') }}" method="POST">
            @csrf
            <label>ชื่อโครงการ :</label>
            <input type="text" name="Nactivity" placeholder="กรอกชื่อโครงการ" required>
            
            <label>ชื่อผู้รับผิดชอบโครงการ :</label>
            <select name="my_name" id="my_name">
                <option value="">-- เลือกชื่อ --</option>
                @foreach($users as $user)
                    <option value="{{ $user }}">{{ $user }}</option>
                @endforeach
            </select>
            

            <label>ปีงบประมาณ :</label>
            <input type="text" name="year_money" placeholder="กรอกปีงบประมาณ" required>

            <button type="submit">บันทึก</button>
        </form>

        <br>
        <a href="/map"><i class="fa-solid fa-arrow-left"></i> กลับไปยังแผนที่</a>
    </div>
@else
    <div class="login-alert">
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}" class="btn btn-primary">Go To Login</a>
    </div>
@endif

<script>
    function addInputField() {
        // สร้าง input ใหม่
        const inputContainer = document.getElementById("inputContainer");
        const inputCount = inputContainer.children.length; // หาจำนวน input ที่มีอยู่แล้ว

        // สร้าง input ใหม่
        const newInput = document.createElement("div");
        newInput.innerHTML = `
            <label>กิจกรรมที่ ${inputCount + 1} :</label>
            <input type="text" name="inputs[]" id="input${inputCount}" required>
            <label>อ่านรายมือไม่ออก ${inputCount + 1} :</label>
            <input type="text" name="detail_xs[]" id="detail_x${inputCount}" required>
            <label>ผลลัพธ์ ${inputCount + 1} :</label>
            <input type="text" name="resultxs[]" id="resultx${inputCount}" required>
        `;
        
        // เพิ่ม input ใหม่ไปที่ container
        inputContainer.appendChild(newInput);
    }
</script>
</body>

</html>
