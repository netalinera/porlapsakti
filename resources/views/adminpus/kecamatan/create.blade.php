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
                            <label for="kode_kec" class="form-label">Kode Kecamatan</label>
                            <input type="text" name="kode_kec" 
                                   class="form-control @error('kode_kec') is-invalid @enderror" 
                                   value="{{ old('kode_kec') }}" required>
                            @error('kode_kec')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kode_prov" class="form-label">Provinsi</label>
                            <select id="kode_prov" name="kode_prov" 
                                    class="form-select @error('kode_prov') is-invalid @enderror" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $provinsi)
                                    <option value="{{ $provinsi->kode_prov }}"
                                        {{ old('kode_prov') == $provinsi->kode_prov ? 'selected' : '' }}>
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
                            <select id="kode_kab_kota" name="kode_kab_kota"
                                    class="form-select @error('kode_kab_kota') is-invalid @enderror" required disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kode_kab_kota')
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
        $('#kode_prov').change(function() {
            var provinsiId = $(this).val();
            if (provinsiId) {
                // Tampilkan loading (opsional)
                $('#kode_kab_kota').prop('disabled', true).empty().append(
                    '<option value="">Memuat...</option>');

                // Ambil data kabupaten/kota berdasarkan provinsi
                $.ajax({
                    url: '/get-kabupaten-kota/' + provinsiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kode_kab_kota').prop('disabled', false).empty().append(
                            '<option value="">Pilih Kabupaten/Kota</option>');
                        $.each(data, function(key, value) {
                            $('#kode_kab_kota').append('<option value="' + value.kode_kab_kota +
                                '">' + value.nama_kab_kota + '</option>');
                        });
                    },
                    error: function() {
                        $('#kode_kab_kota').prop('disabled', true).empty().append(
                            '<option value="">Gagal memuat data</option>');
                    }
                });
            } else {
                // Kosongkan dropdown jika provinsi tidak dipilih
                $('#kode_kab_kota').prop('disabled', true).empty().append(
                    '<option value="">Pilih Kabupaten/Kota</option>');
            }
        });
    });
</script>
@endsection