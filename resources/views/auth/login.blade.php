<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset ('admins/img/favicon.png') }}" rel="icon">
  <link href="{{ asset ('admins/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset ('admins/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset ('admins/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset ('admins/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset ('admins/img/LogoPerpusnasCenter.png') }}" alt="">
                  <span class="d-none d-lg-block">P3SMPT</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun Anda</h5>
                    <p class="text-center small">Masukkan nama pengguna & kata sandi Anda untuk login</p>
                  </div>

                    {{-- jika username & password salah --}}
                  <!-- @if (session()->has('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif -->

                  <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Nama Pengguna</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" required>
                        <div class="invalid-feedback">Silakan masukkan nama pengguna Anda.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Kata Sandi</label>
                      <div class="input-group">
                        <span class="input-group-text" onclick="password();">
                          <i class="ri-eye-line" id="show"></i>
                          <i class="ri-eye-off-line d-none" id="hide"></i>
                        </span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Silakan masukkan kata sandi.</div>
                      </div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-">Punya akun? Hubungi Admin Pusat. <a href="{{ url('/') }}">Kembali</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset ('admins/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset ('admins/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('admins/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset ('admins/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset ('admins/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset ('admins/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset ('admins/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset ('admins/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset ('admins/js/main.js') }}"></script>

  {{-- password show hide --}}
  <script>
    function password() {
      var x = document.getElementById("password");
      var show_eye = document.getElementById("show");
      var hide_eye = document.getElementById("hide");
      hide_eye.classList.remove("d-none");
      if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
      } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
      }
    }
  </script>

</body>

</html>