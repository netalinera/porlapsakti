@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('users') }}">Akun</a></li>
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
              <form method="POST" action="{{ route('process-account', $user->id) }}">

                {{ @csrf_field() }}

                <input type="hidden" name="id" value="{{ $user->id }}"> <br/>
                
                <div class="row mb-3">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $user->username) }}" required autocomplete="username">
                              @error('username')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

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
                    <input name="nama_pj" type="text" class="form-control @error('nama_pj') is-invalid @enderror" id="nama_pj" value="{{ old('nama_pj', $user->profil_user->nama_pj) }}" required autocomplete="nama_pj">
                              @error('nama_pj')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat', $user->profil_user->alamat) }}" required autocomplete="alamat">
                              @error('alamat')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="no_wa" class="col-sm-2 col-form-label">Nomor WA</label>
                  <div class="col-sm-10">
                    <input name="no_wa" type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" value="{{ old('no_wa', $user->profil_user->no_wa) }}" required autocomplete="no_wa">
                              @error('no_wa')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    {{-- <a href="{{ url()->previous() }}">Back</a> --}}
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
              <form action="{{ route('user-change-pw', $user->id) }}" method="post"> 

                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}"> <br/>

                <div class="row mb-3">
                  <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Kata sandi saat ini</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      {{-- <input name="current_password" type="password" class="form-control" id="current_password">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="ri-eye-fill" id="show_eye"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_eye"></i>
                      </span> --}}
                      <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" value="{{ old('current_password') }}" required autocomplete="current_password">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="ri-eye-fill" id="show_eye"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_eye"></i>
                      </span>
                          @error('current_password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Kata sandi baru</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      {{-- <input name="new_password" type="password" class="form-control" id="new_password">
                      <span class="input-group-text" onclick="new_password();">
                        <i class="ri-eye-fill" id="show_new"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_new"></i>
                      </span> --}}
                      <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" value="{{ old('new_password') }}" required autocomplete="new_password">
                      <span class="input-group-text" onclick="new_password();">
                        <i class="ri-eye-fill" id="show_new"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_new"></i>
                      </span> 
                          @error('new_password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="new_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Konfirmasi kata sandi baru</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="input-group">
                      {{-- <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation">
                      <span class="input-group-text" onclick="new_password_confirmation();">
                        <i class="ri-eye-fill" id="show_confirm"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_confirm"></i>
                      </span> --}}
                      <input name="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required autocomplete="new_password_confirmation">
                      <span class="input-group-text" onclick="new_password_confirmation();">
                        <i class="ri-eye-fill" id="show_confirm"></i>
                        <i class="ri-eye-off-fill d-none" id="hide_confirm"></i>
                      </span>
                          @error('new_password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
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