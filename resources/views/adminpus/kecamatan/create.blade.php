<!-- File: resources/views/adminpus/kecamatan/create.blade.php -->
@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Kecamatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kecamatan.index') }}">Kecamatan</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Kecamatan</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kecamatan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="id" class="form-label">ID Kecamatan</label>
                                <input type="number" name="id" class="form-control @error('id') is-invalid @enderror"
                                    value="{{ old('id') }}" required>
                                @error('id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_prov" class="form-label">Provinsi</label>
                                <select id="id_prov" name="id_prov"
                                    class="form-select @error('id_prov') is-invalid @enderror" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $provinsi)
                                        <option value="{{ $provinsi->id }}"
                                            {{ old('id_prov') == $provinsi->id ? 'selected' : '' }}>
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
                                <select id="id_kab_kota" name="id_kab_kota"
                                    class="form-select @error('id_kab_kota') is-invalid @enderror" required disabled>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>

                                @error('id_kab_kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                                <input type="text" name="nama_kecamatan"
                                    class="form-control @error('nama_kecamatan') is-invalid @enderror"
                                    value="{{ old('nama_kecamatan') }}" required>
                                @error('nama_kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a href="{{ route('kecamatan.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#id_prov').change(function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    // Tampilkan loading (opsional)
                    $('#id_kab_kota').prop('disabled', true).empty().append(
                        '<option value="">Memuat...</option>');

                    // Ambil data kabupaten/kota berdasarkan provinsi
                    $.ajax({
                        url: '/get-kabupaten-kota/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_kab_kota').prop('disabled', false).empty().append(
                                '<option value="">Pilih Kabupaten/Kota</option>');
                            $.each(data, function(key, value) {
                                $('#id_kab_kota').append('<option value="' + value.id +
                                    '">' + value.nama_kab_kota + '</option>');
                            });
                        },
                        error: function() {
                            $('#id_kab_kota').prop('disabled', true).empty().append(
                                '<option value="">Gagal memuat data</option>');
                        }
                    });
                } else {
                    // Kosongkan dropdown jika provinsi tidak dipilih
                    $('#id_kab_kota').prop('disabled', true).empty().append(
                        '<option value="">Pilih Kabupaten/Kota</option>');
                }
            });
        });
    </script>
@endsection
