@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('akun') }}">Akun</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Akun</h5>
                            
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
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
  </section>
@endsection