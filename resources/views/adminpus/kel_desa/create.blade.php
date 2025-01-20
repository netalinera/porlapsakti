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
                            <label for="id" class="form-label">ID Kelurahan/Desa</label>
                            <input type="number" name="id" class="form-control @error('id') is-invalid @enderror"
                                   value="{{ old('id') }}" required>
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_prov" class="form-label">Provinsi</label>
                            <select id="id_prov" name="id_prov" class="form-select @error('id_prov') is-invalid @enderror" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ old('id_prov') == $provinsi->id ? 'selected' : '' }}>
                                        {{ $provinsi->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_prov')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kab_kota" class="form-label">Kabupaten/Kota</label>
                            <select id="id_kab_kota" name="id_kab_kota" class="form-select" disabled required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_kecamatan" class="form-label">Kecamatan</label>
                            <select id="id_kecamatan" name="id_kecamatan" class="form-select" disabled required>
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
        $('#id_prov').change(function () {
            const provinsiId = $(this).val();
            if (provinsiId) {
                $('#id_kab_kota').prop('disabled', true).empty().append('<option value="">Memuat...</option>');
                $('#id_kecamatan').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
                
                $.ajax({
                    url: '/get-kabupaten-kota/' + provinsiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#id_kab_kota').prop('disabled', false).empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                        $.each(data, function (key, value) {
                            $('#id_kab_kota').append('<option value="' + value.id + '">' + value.nama_kab_kota + '</option>');
                        });
                    },
                    error: function () {
                        $('#id_kab_kota').prop('disabled', true).empty().append('<option value="">Gagal memuat data</option>');
                    }
                });
            } else {
                $('#id_kab_kota').prop('disabled', true).empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                $('#id_kecamatan').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
            }
        });

        // Saat Kabupaten/Kota berubah
        $('#id_kab_kota').change(function () {
            const kabupatenId = $(this).val();
            if (kabupatenId) {
                $('#id_kecamatan').prop('disabled', true).empty().append('<option value="">Memuat...</option>');

                $.ajax({
                    url: '/get-kecamatan/' + kabupatenId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#id_kecamatan').prop('disabled', false).empty().append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function (key, value) {
                            $('#id_kecamatan').append('<option value="' + value.id + '">' + value.nama_kecamatan + '</option>');
                        });
                    },
                    error: function () {
                        $('#id_kecamatan').prop('disabled', true).empty().append('<option value="">Gagal memuat data</option>');
                    }
                });
            } else {
                $('#id_kecamatan').prop('disabled', true).empty().append('<option value="">Pilih Kecamatan</option>');
            }
        });
    });
</script>
@endsection