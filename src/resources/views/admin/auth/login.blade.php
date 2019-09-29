<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/staradmin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/staradmin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/staradmin/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/staradmin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/staradmin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
					<div class="form-group">
						<label class="label">Email Address</label>
						<div class="input-group">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							
							<div class="input-group-append @error('email') is-invalid @enderror">
								<span class="input-group-text">
									@error('email')
										<i class="mdi mdi-close-circle text-danger"></i>
									@enderror
								</span>
							</div>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							{{-- <input type="text" class="form-control" placeholder="Username"> --}}
						</div>
					</div>
					<div class="form-group">
						<label class="label">Password</label>
						<div class="input-group">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							
							<div class="input-group-append">
								<span class="input-group-text">
									@error('password')
										<i class="mdi mdi-close-circle text-danger"></i>
									@enderror
								</span>
							</div>
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
					</div>
					<div class="form-group d-flex justify-content-between">
						<div class="form-check form-check-flat mt-0">
							<label class="form-check-label">

								 <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
							</label>
						</div>
						@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}" class="text-small forgot-password text-black">Forgot Password</a>
						@endif
					</div>
					{{-- <div class="form-group">
						<button class="btn btn-block g-login">
							<img class="mr-3" src="/staradmin/images/file-icons/icon-google.svg" alt="">Log in with Google</button>
					</div> --}}
					{{-- <div class="text-block text-center my-3">
						<span class="text-small font-weight-semibold">Not a member ?</span>
						<a href="register.html" class="text-black text-small">Create new account</a>
					</div> --}}
              	</form>
            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/staradmin/vendors/js/vendor.bundle.base.js"></script>
  <script src="/staradmin/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/staradmin/js/off-canvas.js"></script>
  <script src="/staradmin/js/misc.js"></script>
  <!-- endinject -->
</body>

</html>