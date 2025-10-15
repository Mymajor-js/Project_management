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

    <h4 class="mb-4 colorw">เพิ่มข้อมูลผู้ใช้</h4>

    {{-- ฟอร์มลงทะเบียน --}}
    <form action="{{ route('registerx') }}" method="POST" class="form-group" id="passwordForm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">👤 Username</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="กรอก Username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="กรอก Email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">🔒 Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="กรอก Password" required>
        </div>

        <div class="mb-3">
            <label for="cpassword" class="form-label">🔒 Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="กรอก Password อีกครั้ง" required>
        </div>

         <div class="mb-3">
            <label for="my_name" class="form-label">👨‍💼 เลือก ชื่อ - นามสกุล</label>
            <select name="my_name" id="teacher" class="form-control" required onchange="updatePosition()">
                <option value="">-- เลือกอาจารย์ --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->name }}" data-position="{{ $teacher->position }}">
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="my_name" class="form-label">⚙️ ตำแหน่ง</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="ตำแหน่ง" readonly>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-check"></i> บันทึก
            </button>
            
        </div>
    </form>
</div>

<script>
    document.getElementById("passwordForm").addEventListener("submit", function(event) {
        event.preventDefault(); // หยุดการส่งฟอร์มชั่วคราว

        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("cpassword").value;

        if (password === confirmPassword) {
            Swal.fire({
                icon: "success",
                title: "สำเร็จ!",
                text: "รหัสผ่านตรงกัน",
                confirmButtonText: "ตกลง"
            }).then(() => {
                this.submit(); // ส่งฟอร์มหลังยืนยัน
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
    function updatePosition() {
        const select = document.getElementById('teacher');
        const selectedOption = select.options[select.selectedIndex];
        const position = selectedOption.getAttribute('data-position') || '';
        document.getElementById('position').value = position;
    }
</script>
