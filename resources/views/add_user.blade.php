<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ดูแลโครงการ</title>
    <link rel="stylesheet" href="../css/gb.css">
    <link rel="stylesheet" href="../css/add_user_style.css">
    <link rel="stylesheet" href="../css/scroobar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('img/iconx2.png') }}" type="image/png">


</head>

<body>
    <div class="container mt-5">
        @if (session('success'))
        <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: '{{ session("success") }}',
            confirmButtonText: 'ตกลง'
        });
        </script>
        @endif

        @if (session('error'))
        <script>
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด!',
            text: '{{ session("error") }}',
            confirmButtonText: 'ตกลง'
        });
        </script>
        @endif


        <h2>เพิ่มข้อมูลผู้ใช้</h2>
        <form action="{{ route('registerx') }}" class="form-group" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name"placeholder="กรอก Username" required>
            </div>

            <div class="mb-3">  
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"placeholder="กรอก Email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"placeholder="กรอก Password" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"placeholder="กรอก Password อีกครั้ง" required>
            </div>

            <div class="mb-3">
                <label for="my_name" class="form-label">Name & Lastname</label>
                <input type="text" class="form-control" id="my_name" name="my_name"placeholder="กรอก ชื่อ-สกุล" required>
            </div>
            <input type="hidden" name="my_name" value="user"disabled>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="/map"><i class="fa-solid fa-arrow-left"></i> กลับไปยังแผนที่</a>
        </form>
    </div>

    <script>
document.getElementById("passwordForm").addEventListener("submit", function(event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์ม

    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("cpassword").value;

    if (password === confirmPassword) {
        Swal.fire({
            icon: "success",
            title: "สำเร็จ!",
            text: "รหัสผ่านตรงกัน",
            confirmButtonText: "ตกลง"
        }).then(() => {
            this.submit(); // ส่งฟอร์มหากผ่านการตรวจสอบ
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "ผิดพลาด!",
            text: "รหัสผ่านไม่ตรงกัน กรุณาลองใหม่",
            confirmButtonText: "ตกลง"
        });
    }
});
</script>

</body>

</html>