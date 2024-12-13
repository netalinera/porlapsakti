@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Kegiatan</h1>
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
              <h5 class="card-title">Data Kegiatan</h5>

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
              <form method="POST" action="{{ url('store-event') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <div class="row mb-3">
                  <label for="inputnama_kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                  <div class="col-sm-10">
                    <input name="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required autocomplete="nama_kegiatan">
                              @error('nama_kegiatan')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputtahun" class="col-sm-2 col-form-label">Tahun</label>
                  <div class="col-sm-10">
                    <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" value="{{ old('tahun') }}" required autocomplete="tahun">
                              @error('tahun')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputprovinsi" class="col-sm-2 col-form-label">Provinsi</label>
                  <div class="col-sm-10">
                    <input name="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" value="{{ old('provinsi') }}" required autocomplete="provinsi">
                              @error('provinsi')
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