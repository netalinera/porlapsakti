@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Tambah Kelurahan/Desa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kel_desa.index') }}">Kelurahan/Desa</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Kelurahan/Desa</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kel_desa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_kel_desa" class="form-label">Kode Kelurahan/Desa</label>
                            <input type="text" name="kode_kel_desa" class="form-control @error('kode_kel_desa') is-invalid @enderror"
                                   value="{{ old('kode_kel_desa') }}" required>
                            @error('kode_kel_desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kode_prov" class="form-label">Provinsi</label>
                            <select id="kode_prov" name="kode_prov" class="form-select @error('kode_prov') is-invalid @enderror" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $provinsi)
                                    <option value="{{ $provinsi->kode_prov }}" {{ old('kode_prov') == $provinsi->kode_prov ? 'selected' : '' }}>
                                        {{ $provinsi->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_prov')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kode_kab_kota" class="form-label">Kabupaten/Kota</label>
                            <select id="kode_kab_kota" name="kode_kab_kota" class="form-select" disabled required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kode_kec" class="form-label">Kecamatan</label>
                            <select id="kode_kec" name="kode_kec" class="form-select" disabled required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                                          
                        <div class="mb-3">
                            <label for="nama_kel_desa" class="form-label">Nama Kelurahan/Desa</label>
                            <input type="text" name="nama_kel_desa"
                                   class="form-control @error('nama_kel_desa') is-invalid @enderror"
                                   value="{{ old('nama_kel_desa') }}" required>
                            @error('nama_kel_desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a href="{{ route('kel_desa.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        // Saat Provinsi berubah
        $('#kode_prov').change(function () {
            const provinsiId = $(this).val();
            if (provinsiId) {
                $('#kode_kab_kota').prop('disabled', true).empty().append('<option value="">Memuat...</option>');
                $('#kode_kec').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
                
                $.ajax({
                    url: '/get-kabupaten-kota/' + provinsiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#kode_kab_kota').prop('disabled', false).empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                        $.each(data, function (key, value) {
                            $('#kode_kab_kota').append('<option value="' + value.kode_kab_kota + '">' + value.nama_kab_kota + '</option>');
                        });
                    },
                    error: function () {
                        $('#kode_kab_kota').prop('disabled', true).empty().append('<option value="">Gagal memuat data</option>');
                    }
                });
            } else {
                $('#kode_kab_kota').prop('disabled', true).empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                $('#kode_kec').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
            }
        });

        // Saat Kabupaten/Kota berubah
        $('#kode_kab_kota').change(function () {
            const kabupatenId = $(this).val();
            if (kabupatenId) {
                $('#kode_kec').prop('disabled', true).empty().append('<option value="">Memuat...</option>');

                $.ajax({
                    url: '/get-kecamatan/' + kabupatenId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#kode_kec').prop('disabled', false).empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function (key, value) {
                            $('#kode_kec').append('<option value="' + value.kode_kec + '">' + value.nama_kecamatan + '</option>');
                        });
                    },
                    error: function () {
                        $('#kode_kec').prop('disabled', true).empty().append('<option value="">Gagal memuat data</option>');
                    }
                });
            } else {
                $('#kode_kec').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
            }
        });
    });
</script>
@endsection