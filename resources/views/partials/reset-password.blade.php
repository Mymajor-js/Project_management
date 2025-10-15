<h3>ตั้งรหัสผ่านใหม่</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group mb-3">
        <label>อีเมล</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>รหัสผ่านใหม่</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>ยืนยันรหัสผ่านใหม่</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">ตั้งรหัสผ่านใหม่</button>
</form>
