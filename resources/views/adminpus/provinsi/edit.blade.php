@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Edit Provinsi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('provinsi.index') }}">Provinsi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Provinsi</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('provinsi.update', $provinsi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Provinsi</label>
                            <input type="number" class="form-control" value="{{ $provinsi->id }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                            <input type="text" name="nama_provinsi" 
                                   class="form-control @error('nama_provinsi') is-invalid @enderror" 
                                   value="{{ old('nama_provinsi', $provinsi->nama_provinsi) }}" required>
                            @error('nama_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a href="{{ route('provinsi.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection