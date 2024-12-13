@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1> My Profile</h1>
      <nav>
        <ol class="breadcrumb">
          {{-- <li class="breadcrumb-item"></li> --}}
          <li class="breadcrumb-item active">Data Diri Akun</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              @if(isset($user->profil_user->photo) && !empty($user->profil_user->photo))
                  <img src="{{ asset('storage/photos/'.$user->profil_user->photo) }}" class="rounded-circle">
              @else
                  <img src="{{ asset('admins/img/profile-img.jpg') }}" class="rounded-circle">
              @endif
              
              <h2>{{ Auth::user()->username }}</h2>

                {{-- =======modal upload photo======= --}}
                <!-- Button trigger modal -->
              @if(isset($user->profil_user))
              <div class="pt-2">
                <button type="button" class="btn btn-primary btn-sm bi bi-upload" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Unggah foto profil">
                </button>
                <a type="submit" class="btn btn-danger btn-sm" href="{{ route('destroyImg', $user->profil_user->id) }}" title="Hapus foto profil"><i class="ri-delete-bin-2-fill"></i></a>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Update Photo Profile</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('updatePhoto', $user->profil_user->id) }}" enctype="multipart/form-data">
                      @method('PATCH')
                      @csrf
                    <div class="modal-body">
                      
                      <input class="form-control @error('photo') is-invalid @enderror" name="photo" type="file">
                                   
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              @endif
              {{-- =========end modal========== --}}
              
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                </li>

                <!--<li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Kata Sandi</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profil Detail</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>                  
                    <div class="col-lg-9 col-md-8">{{  optional(Auth::user()->profil_user)->nama_pj }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">{{ optional(Auth::user()->profil_user)->alamat }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nomor WA</div>
                    <div class="col-lg-9 col-md-8">{{ optional(Auth::user()->profil_user)->no_wa }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  {{-- ===================== --}}
                  {{-- @if(Session::get('success') && Session::get('success') != null)
                    <div style="color:green">{{ Session::get('success') }}</div>
                    @php
                      Session::put('success', null)
                    @endphp                 
                  @endif --}}
                  @if(isset($user->profil_user))
                  {{-- jika my profile sudah diinput, jadi tinggal diedit --}}
                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('update-profile', $user->profil_user->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama_pj" type="text" class="form-control @error('nama_pj') is-invalid @enderror" id="nama_pj" value="{{ $user->profil_user->nama_pj }}" required autocomplete="nama_pj">
                              @error('nama_pj')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ $user->profil_user->alamat }}" required autocomplete="alamat">
                              @error('alamat')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Nomor WA</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="no_wa" type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" value="{{ $user->profil_user->no_wa }}" required autocomplete="no_wa">
                            @error('no_wa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                  {{-- ============================== --}}
                  @else
                  {{-- jika my profil belum diinput, jadi diinput dulu --}}
                  <!-- Profile add Form -->
                  <form method="POST" action="{{ url('store-profile') }}" enctype="multipart/form-data">
                    
                    @csrf

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama_pj" type="text" class="form-control @error('nama_pj') is-invalid @enderror" id="nama_pj">
                              @error('nama_pj')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat">
                              @error('alamat')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Nomor WA</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="no_wa" type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa">
                            @error('no_wa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form><!-- End Profile ADD Form -->

                  @endif
                {{-- =========================== --}}

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                {{-- =========penanganan eror inputan============== --}}
                  {{-- @if($errors->any())
                  {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                  @endif

                  @if(Session::get('eror') && Session::get('eror') != null)
                    <div style="color:red">{{ Session::get('eror') }}</div>
                    @php
                      Session::put('eror', null)
                    @endphp
                  @endif

                  @if(Session::get('sukses') && Session::get('sukses') != null)
                    <div style="color:green">{{ Session::get('sukses') }}</div>
                    @php
                      Session::put('sukses', null)
                    @endphp                 
                  @endif --}}
                {{-- ==================== --}}
                  <form action="{{ route('postChangePassword') }}" method="post">

                    @csrf

                    <div class="row mb-3">
                      <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Kata sandi saat ini</label>
                      
                      <div class="col-md-8 col-lg-9">
                        <div class="input-group">
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

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
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
