<aside id="sidebar" class="sidebar">

  @if (auth()->user()->role_id === 1) 
  {{-- admin pusat --}}
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin') ? 'active' : 'collapsed'}}" href="{{ url('adminpus') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Lembaga</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Provinsi</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Kabupaten/Kota</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Kecamatan</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Kelurahan/Desa</span>
            </a>
          </li>
        </ul>
      </li><!-- End master Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('users') ? 'active' : 'collapsed'}}" href="{{ url('users') }}">
          <i class="ri-admin-line"></i>
          <span>Akun</span>
        </a>
      </li><!-- End Akun Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('event') ? 'active' : 'collapsed'}}" href="{{ url('event') }}">
          <i class="ri-book-2-fill"></i>
          <span>Kegiatan</span>
        </a>
      </li><!-- End Event Page Nav -->


      {{-- <li class="nav-item">
        <a class="nav-link {{ request()->is('juara') ? 'active' : 'collapsed'}}" href="{{ url('juara') }}">
          <i class="ri-medal-line"></i>
          <span>Juara</span>
        </a>
      </li><!-- End Winner Page Nav --> --}}

    </ul>
{{-- =================== --}}
  @else
    {{-- admin wilayah --}}
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->is('adminwil') ? 'active' : 'collapsed'}}" href="{{ url('adminwil') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('events') ? 'active' : 'collapsed'}}" href="{{ url('events') }}">
          <i class="ri-open-arm-line"></i>
          <span>Kegiatan</span>
        </a>
      </li><!-- End Peserta Page Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link {{ request()->is('juara') ? 'active' : 'collapsed'}}" href="{{ url('juara') }}">
          <i class="ri-medal-line"></i>
          <span>Juara</span>
        </a>
      </li><!-- End Winner Page Nav --> --}}

    </ul>
  
  @endif

</aside>