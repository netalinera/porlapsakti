@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Edit Lembaga</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('lembaga.index') }}">Lembaga</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Lembaga</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lembaga.update', $lembaga->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nama Lembaga -->
                        <div class="mb-3">
                            <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                            <input type="text" name="nama_lembaga" class="form-control" value="{{ old('nama_lembaga', $lembaga->nama_lembaga) }}" required>
                        </div>

                        <!-- Nama Perpustakaan -->
                        <div class="mb-3">
                            <label for="nama_perpus" class="form-label">Nama Perpustakaan</label>
                            <input type="text" name="nama_perpus" class="form-control" value="{{ old('nama_perpus', $lembaga->nama_perpus) }}" required>
                        </div>

                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label for="kode_prov" class="form-label">Provinsi</label>
                            <select name="kode_prov" id="provinsi" class="form-select" required>
                                <option value="" selected>Pilih Provinsi</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->kode_prov }}" {{ $lembaga->kode_prov == $prov->kode_prov ? 'selected' : '' }}>{{ $prov->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kabupaten/Kota -->
                        <div class="mb-3">
                            <label for="kode_kab_kota" class="form-label">Kabupaten/Kota</label>
                            <select name="kode_kab_kota" id="kabupaten_kota" class="form-select" required>
                                <option value="" selected>Pilih Kabupaten/Kota</option>
                                @foreach ($kabupatenKotas as $kabupatenKota)
                                    <option value="{{ $kabupatenKota->kode_kab_kota }}" {{ $lembaga->kode_kab_kota == $kabupatenKota->kode_kab_kota ? 'selected' : '' }}>{{ $kabupatenKota->nama_kab_kota }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-3">
                            <label for="kode_kec" class="form-label">Kecamatan</label>
                            <select name="kode_kec" id="kecamatan" class="form-select" required>
                                <option value="" selected>Pilih Kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->kode_kec }}" {{ $lembaga->kode_kec == $kecamatan->kode_kec ? 'selected' : '' }}>{{ $kecamatan->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kelurahan/Desa -->
                        <div class="mb-3">
                            <label for="kode_kel_desa" class="form-label">Kelurahan/Desa</label>
                            <select name="kode_kel_desa" id="kelurahan_desa" class="form-select" required>
                                <option value="" selected>Pilih Kelurahan/Desa</option>
                                @foreach ($kelurahanDesas as $kelurahanDesa)
                                    <option value="{{ $kelurahanDesa->kode_kel_desa }}" {{ $lembaga->kode_kel_desa == $kelurahanDesa->kode_kel_desa ? 'selected' : '' }}>{{ $kelurahanDesa->nama_kel_desa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NPP -->
                        <div class="mb-3">
                            <label for="NPP" class="form-label">NPP</label>
                            <input type="text" name="NPP" class="form-control" value="{{ old('NPP', $lembaga->NPP) }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $lembaga->alamat) }}" required>
                        </div>

                        <!-- RT -->
                        <div class="mb-3">
                            <label for="rt" class="form-label">RT</label>
                            <input type="text" name="rt" class="form-control" value="{{ old('rt', $lembaga->rt) }}" required>
                        </div>

                        <!-- RW -->
                        <div class="mb-3">
                            <label for="rw" class="form-label">RW</label>
                            <input type="text" name="rw" class="form-control" value="{{ old('rw', $lembaga->rw) }}" required>
                        </div>

                        <!-- Email Lembaga -->
                        <div class="mb-3">
                            <label for="email_lembaga" class="form-label">Email Lembaga</label>
                            <input type="email" name="email_lembaga" class="form-control" value="{{ old('email_lembaga', $lembaga->email_lembaga) }}">
                        </div>

                        <!-- Email Perpustakaan -->
                        <div class="mb-3">
                            <label for="email_perpus" class="form-label">Email Perpustakaan</label>
                            <input type="email" name="email_perpus" class="form-control" value="{{ old('email_perpus', $lembaga->email_perpus) }}">
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#provinsi').on('change', function() {
                var provinsiId = $(this).val();
    
                // Reset dan disable dropdown di bawahnya
                $('#kabupaten_kota').empty().append('<option value="" disabled selected>Pilih Kabupaten/Kota</option>').prop('disabled', true);
                $('#kecamatan').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan_desa').empty().append('<option value="" disabled selected>Pilih Kelurahan/Desa</option>').prop('disabled', true);
    
                if (provinsiId) {
                    $.ajax({
                        url: '/get-kabupaten-kota/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kabupaten_kota').prop('disabled', false);
                            $.each(data, function(key, value) {
                                $('#kabupaten_kota').append('<option value="' + value.kode_kab_kota + '">' + value.nama_kab_kota + '</option>');
                            });
                        }
                    });
                }
            });
    
            $('#kabupaten_kota').on('change', function() {
                var kabupatenKotaId = $(this).val();
    
                // Reset dan disable dropdown di bawahnya
                $('#kecamatan').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>').prop('disabled', true);
                $('#kelurahan_desa').empty().append('<option value="" disabled selected>Pilih Kelurahan/Desa</option>').prop('disabled', true);
    
                if (kabupatenKotaId) {
                    $.ajax({
                        url: '/get-kecamatan/' + kabupatenKotaId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kecamatan').prop('disabled', false);
                            $.each(data, function(key, value) {
                                $('#kecamatan').append('<option value="' + value.kode_kec + '">' + value.nama_kecamatan + '</option>');
                            });
                        }
                    });
                }
            });
    
            $('#kecamatan').on('change', function() {
                var kecamatanId = $(this).val();
    
                // Reset dan disable dropdown di bawahnya
                $('#kelurahan_desa').empty().append('<option value="" disabled selected>Pilih Kelurahan/Desa</option>').prop('disabled', true);
    
                if (kecamatanId) {
                    $.ajax({
                        url: '/get-kelurahan-desa/' + kecamatanId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kelurahan_desa').prop('disabled', false);
                            console.log(data);
                            
                            $.each(data, function(key, value) {
                                $('#kelurahan_desa').append('<option value="' + value.kode_kel_desa + '">' + value.nama_kel_desa + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
    
</section>
@endsection
