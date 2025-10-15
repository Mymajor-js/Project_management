      <div class="container mt-5">
        <div class="row tm-content-row">
          <div class="col-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">Setting Account</h2>
              <p class="text-white">Account Level : {{$userLoggedIn->level}}</p>
            </div>
          </div>
        </div>
        <!-- row -->
         <br>
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title">Change Avatar</h2>
              <div class="tm-avatar-container">
                <img
                  src="https://img2.pic.in.th/pic/user_7718888.th.png" 
                  alt="Avatar"
                  class="tm-avatar img-fluid mb-4"
                />
                <a href="#" class="tm-avatar-delete-link">
                  <i class="far fa-trash-alt tm-product-delete-icon"></i>
                </a>
              </div>
              <button class="btn btn-primary btn-block text-uppercase">
                Upload New Photo
              </button>
            </div>
          </div>
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Your Account</h2>
                <div class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name">Account Name</label>
                  <p class="colorw" style="font-size: 17px;">{{$userLoggedIn->my_name}}</p>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Position</label>
                    <p class="colorw" style="font-size: 17px;">{{$userLoggedIn->position}}</p>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Email</label>
                    <p class="colorw" style="font-size: 17px;">{{$userLoggedIn->email}}</p>
                </div>
                <div class="form-group col-lg-6">
                  <label for="password">Username</label>
                  <p class="colorw" style="font-size: 17px;">{{$userLoggedIn->name}}</p>
                </div>
                <form id="changePasswordForm" action="{{ route('user.change-password') }}"class="tm-signup-form row" method="POST">
                    @csrf
                    <div class="form-group col-lg-6">
                        <label for="current_password">Old Password</label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="new_password">New Password</label>
                        <input
                            id="new_password"
                            name="new_password"
                            type="password"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            type="password"
                            class="form-control"
                            required
                        />
                        <small id="passwordError" class="text-danger d-none">รหัสผ่านใหม่ไม่ตรงกัน</small>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">
                            Update Your Password
                        </button>
                    </div>
                </form>

            </div>
            </div>
          </div>
        </div>
      </div>

<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('new_password_confirmation').value;
        const errorMessage = document.getElementById('passwordError');

        if (newPassword !== confirmPassword) {
            e.preventDefault(); // ยกเลิกการ submit
            errorMessage.classList.remove('d-none');
        } else {
            errorMessage.classList.add('d-none');
        }
    });
</script>