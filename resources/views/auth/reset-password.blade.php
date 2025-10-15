<h2>ลืมรหัสผ่าน</h2>

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="email">อีเมลของคุณ</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">ส่งลิงก์รีเซ็ตรหัสผ่าน</button>
</form>

@if (session('status'))
    <div class="alert alert-success mt-3">{{ session('status') }}</div>
@endif
