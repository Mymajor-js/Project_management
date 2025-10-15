<style>
    .form-add-content {
    max-width: 100%;
    background-color:rgba(255, 255, 255, 0);
    border-radius: 10px;
    padding: 20px;
    color: rgb(255,255,255);
}

.form-add-content h2 {
    margin-bottom: 25px;
    font-weight: bold;
    color:rgb(255, 255, 255);
}

.form-add-content label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: rgb(255,255,255);
}

.select2-container--default .select2-selection--single {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 6px;
    height: 42px;
    padding: 6px 12px;
    transition: border-color 0.3s ease-in-out;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 28px;
}

/* เมื่อ focus */
.select2-container--default .select2-selection--single:focus,
.select2-container--default .select2-selection--single:active {
    border-color: #007bff;
    outline: none;
}

/* ปรับลูกศร dropdown */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 10px;
    right: 8px; /* ปรับให้ชิดขอบขวานิดนึง */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ช่องค้นหาด้านบนใน dropdown */
.select2-container .select2-search--dropdown .select2-search__field {
    padding: 6px;
    border-radius: 4px;
    border: 1px solid #ced4da;
}

/* Hover และ active list item */
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #007bff;
    color: white;
}




.form-add-content a {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #007bff;
    font-size: 15px;
}

.form-add-content a:hover {
    text-decoration: underline;
}

/* 🔔 Alert Styles */
.alert-container {
    margin-bottom: 20px;
}
#my_names{
    font-size:15px;
    padding:20px;
}
.alert {
    padding: 12px 15px;
    border-radius: 6px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 6px solid #28a745;
}
.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 6px solid #dc3545;
}
</style>
<div class="form-add-content">
    <h2>เพิ่มข้อมูล</h2>
    
    <form action="{{ route('admin_add') }}" method="POST">
        @csrf
        <label>📌 ชื่อโครงการ</label>
        <input type="text" name="Nactivity"class="form-control" placeholder="กรอกชื่อโครงการ" required>
<br>
        <label>👤 ชื่อผู้รับผิดชอบโครงการ</label>
        <select name="my_name" id="my_names"class="custom-select2" style="width: 100%">
            <option value="">-- เลือกชื่อ --</option>
            @if (!empty($users))
                @foreach($users as $user)
                    <option value="{{ $user->my_name }}">{{ $user->my_name }}</option>
                @endforeach
            @endif
        </select>
<br>

        <label>📅 ปีงบประมาณ</label>
        <input type="text" name="year_money"class="form-control" placeholder="กรอกปีงบประมาณ" required>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-check"></i> บันทึก
            </button>
            
        </div>
    </form>
</div>

<script>
       $(document).ready(function() {
        $('#my_names').select2({
            placeholder: "🔍 ค้นหาชื่อผู้รับผิดชอบ...",
            allowClear: true
        });
    });
</script>