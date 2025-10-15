<div class="contentxr">
        <h3 class="colorw">เพิ่มข้อมูลอาจารย์</h3>
    <form action="{{ route('storex') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ-สกุล</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">ตำแหน่ง</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>