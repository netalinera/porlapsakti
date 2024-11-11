@extends('admin.index')

@section('content')
    <div class="pagetitle">
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('users') }}">Akun</a></li>
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

              {{-- pop up validasi --}}
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ implode('', $errors->all(':message')) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><br>
              @elseif(Session::get('success') && Session::get('success') != null)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ Session::get('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><br>
                @php
                  Session::put('success', null)
                @endphp 
              @endif
                            
              <!-- General Form Elements -->
              <form method="POST" action="{{ url('store-akun') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Username" value="{{ old('Username') }}" required>
                    <div class="invalid-feedback">Silakan masukkan username.</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="Password" required>
                    <div class="invalid-feedback">Silakan masukkan password.</div>
                  </div>
                </div>

                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0"></legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role_id" id="ad" value="1" checked>
                      <label class="form-check-label">
                        Admin Pusat
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role_id" id="op" value="2">
                      <label class="form-check-label">
                        Admin Wilayah
                      </label>
                    </div>
                  </div>
                </fieldset>

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