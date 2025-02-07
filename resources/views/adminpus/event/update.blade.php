@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Kegiatan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('event') }}">Kegiatan</a></li>
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detail Kegiatan</h5>
                            
              <!-- General Form Elements -->
              <form method="POST" action="{{ route('process-event', $event->id) }}">

                {{ @csrf_field() }}

                <input type="hidden" name="id" value="{{ $event->id }}"> <br/>
                
                <div class="row mb-3">
                  <label for="nama-kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                  <div class="col-sm-10">
                    <input name="nama_kegiatan" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" value="{{ old('nama_kegiatan', $event->nama_kegiatan) }}" required autocomplete="nama_kegiatan">
                              @error('nama_kegiatan')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                  <div class="col-sm-10">
                    <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" value="{{ old('tahun', $event->tahun) }}" required autocomplete="tahun">
                              @error('tahun')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                  <div class="col-sm-10">
                    <input name="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" value="{{ old('provinsi', $event->provinsi) }}" required autocomplete="provinsi">
                              @error('provinsi')
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
                    <a type="button" class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>

  </section>
@endsection
