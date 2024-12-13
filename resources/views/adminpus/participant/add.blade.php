@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Peserta Kegiatan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('event') }}">Kegiatan</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Peserta Kegiatan</h5>

              {{-- pop up validasi --}}
              {{-- @if ($errors->any())
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
              @endif --}}
                            
              <!-- General Form Elements -->
              <form method="POST" action="" class="row g-3 needs-validation" novalidate>
                @csrf

                <div class="row mb-3">
                  <label for="inputnpp" class="col-sm-2 col-form-label">NPP</label>
                  <div class="col-sm-10">
                    <input name="npp" type="text" class="form-control @error('npp') is-invalid @enderror" id="npp" value="{{ old('npp') }}" required autocomplete="npp">
                              @error('npp')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputnama_peserta" class="col-sm-2 col-form-label">Nama Peserta</label>
                  <div class="col-sm-10">
                    <input name="nama_peserta" type="text" class="form-control @error('nama_peserta') is-invalid @enderror" id="nama_peserta" value="{{ old('nama_peserta') }}" required autocomplete="nama_peserta">
                              @error('nama_peserta')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputno_wa" class="col-sm-2 col-form-label">Nomor WA</label>
                  <div class="col-sm-10">
                    <input name="no_wa" type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" value="{{ old('no_wa') }}" required autocomplete="no_wa">
                              @error('no_wa')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputemail" class="col-sm-2 col-form-label">Provinsi</label>
                  <div class="col-sm-10">
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autocomplete="email">
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>

  </section>
@endsection