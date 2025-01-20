@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Tambah Kabupaten/Kota</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kab_kota.index') }}">Kabupaten/Kota</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Kabupaten/Kota</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kab_kota.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Kabupaten/Kota</label>
                            <input type="number" name="id" class="form-control @error('id') is-invalid @enderror" 
                                   value="{{ old('id') }}" required>
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_prov" class="form-label">Provinsi</label>
                            <select name="id_prov" class="form-select @error('id_prov') is-invalid @enderror" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces as $provinsi)
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
                            <label for="nama_kab_kota" class="form-label">Nama Kabupaten/Kota</label>
                            <input type="text" name="nama_kab_kota" 
                                   class="form-control @error('nama_kab_kota') is-invalid @enderror" 
                                   value="{{ old('nama_kab_kota') }}" required>
                            @error('nama_kab_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a href="{{ route('kab_kota.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection