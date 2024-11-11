<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lomba Perpustakaan</title>
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

  <!-- ======= Header ======= -->
  @include('include.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('include.sidebar')
  <!-- End Sidebar-->

  <!-- MAIN CONTENT -->
  <main id="main" class="main">
       @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('include.footer')
  <!-- End Footer -->

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

  {{-- sweetalert2 --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.12/sweetalert2.all.js"></script>

  @yield('script')

</body>

</html>