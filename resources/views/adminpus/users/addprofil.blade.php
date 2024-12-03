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
              <h5 class="card-title">Tambah Detail Akun</h5>
                            
              <!-- General Form Elements -->
              <form method="POST" action="{{ route('store-PU', $user->id) }}">

                {{ @csrf_field() }}

                <input type="hidden" name="user_id" value="{{ $user->id }}"> <br/>

                <div class="row mb-3">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" value="{{$user->username}}" readonly>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="nama_pj" class="col-sm-2 col-form-label">Nama PJ</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_pj" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="no_wa" class="col-sm-2 col-form-label">Nomor WA</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_wa" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    {{-- <a href="{{ url()->previous() }}">Back</a> --}}
                  </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>

  </section>
@endsection

@section('script')

@endsection