@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Tambah Provinsi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('provinsi.index') }}">Provinsi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Provinsi</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('provinsi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Provinsi</label>
                            <input type="number" name="id" class="form-control @error('id') is-invalid @enderror" 
                                   value="{{ old('id') }}" required>
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                            <input type="text" name="nama_provinsi" 
                                   class="form-control @error('nama_provinsi') is-invalid @enderror" 
                                   value="{{ old('nama_provinsi') }}" required>
                            @error('nama_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a href="{{ route('provinsi.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection