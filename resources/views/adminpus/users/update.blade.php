@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('akun') }}">Akun</a></li>
          <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detail Akun</h5>
                            
              <!-- General Form Elements -->
              <form method="POST" action="{{ route('proses-akun', $user->id) }}">

                {{ @csrf_field() }}

                <input type="hidden" name="id" value="{{ $user->id }}"> <br/>
                
                <div class="row mb-3">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" value="{{$user->username}}">
                  </div>
                </div>

                {{-- <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" value="{{$user->password}}" disabled>
                  </div>
                  <div class="col-sm-1">
                    <span data-bs-toggle="modal" data-bs-target="#basicModal">
                      <a type="button" class="btn btn-success" data-bs-placement="right" title="Tambah Akun" data-bs-toggle="tooltip"><i class="ri-add-circle-fill"></i></a>
                    </span>
                  </div>
                </div> --}}

                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role_id" id="ad" value="1" {{ $user->role_id == '1' ? 'checked' : ''}}>
                      <label class="form-check-label">
                        Admin Pusat
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role_id" id="op" value="2" {{ $user->role_id == '2' ? 'checked' : ''}}>
                      <label class="form-check-label">
                        Admin Wilayah
                      </label>
                    </div>
                  </div>
                </fieldset>

                <div class="row mb-3">
                  <label for="nama_pj" class="col-sm-2 col-form-label">Nama PJ</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_pj" value="{{$user->profil_user->nama_pj}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" value="{{$user->profil_user->alamat}}">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="no_wa" class="col-sm-2 col-form-label">Nomor WA</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_wa" value="{{$user->profil_user->no_wa}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a href="{{ url()->previous() }}">Back</a>
                  </div>
                  <div class="col-sm-1">
                    <!-- Basic Modal -->
                    <p><span data-bs-toggle="modal" data-bs-target="#resetpw">
                      <a type="button" class="btn btn-success" data-bs-placement="right" title="Reset Password" data-bs-toggle="tooltip"><i class="ri-admin-line"></i></a>
                    </span></p> </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>

      <!-- Edit Modal -->
      <div class="modal fade" id="resetpw" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Reset Password</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('user-change-password', $user->id) }}" method="post"> 

                @csrf
                <input type="text" name="id" value="{{ $user->id }}"> <br/>
                <div class="row mb-3">
                  <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Kata sandi saat ini</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      <input name="current_password" type="password" class="form-control" id="current_password">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="ri-eye-fill" id="show_eye"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Kata sandi baru</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      <input name="new_password" type="password" class="form-control" id="new_password">
                      <span class="input-group-text" onclick="new_password();">
                        <i class="ri-eye-fill" id="show_new"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_new"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Konfirmasi kata sandi baru</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation">
                      <span class="input-group-text" onclick="new_password_confirmation();">
                        <i class="ri-eye-fill" id="show_confirm"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_confirm"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  
                </div>
              </form><!-- End Change Password Form -->
          </div>
        </div>
      </div><!-- End Edit Modal-->

  </section>
@endsection

@section('script')
<script>
  function password_show_hide() {
    var x = document.getElementById("current_password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
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

  function new_password() {
    var x = document.getElementById("new_password");
    var show_eye = document.getElementById("show_new");
    var hide_eye = document.getElementById("hide_new");
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

  function new_password_confirmation() {
    var x = document.getElementById("new_password_confirmation");
    var show_eye = document.getElementById("show_confirm");
    var hide_eye = document.getElementById("hide_confirm");
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
@endsection