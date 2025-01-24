@extends('adminpus.index')

@section('content')
<div class="pagetitle">
    <h1>Kabupaten/Kota</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('adminpus') }}">Home</a></li>
            <li class="breadcrumb-item active">Kabupaten/Kota</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Kabupaten/Kota</h5>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="{{ route('kab_kota.create') }}" class="btn btn-success mb-3">
                        <i class="ri-add-circle-fill"></i> Tambah Kabupaten/Kota
                    </a>
                    <form action="{{ route('kab_kota.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Kabupaten/Kota atau Provinsi..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-search-line"></i>
                            </button>
                        </div>
                    </form>
                    

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Provinsi</th>
                                <th>Nama Kabupaten/Kota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kab_kotas as $index => $kab_kota)
                            <tr>
                                <td>{{ ($kab_kotas->currentPage() - 1) * $kab_kotas->perPage() + $index + 1 }}
                                <td>{{ $kab_kota->id }}</td>
                                <td>{{ $kab_kota->provinsi->nama_provinsi }}</td>
                                <td>{{ $kab_kota->nama_kab_kota }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('kab_kota.edit', $kab_kota->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="ri-edit-2-fill"></i>
                                        </a>
                                        <form action="{{ route('kab_kota.destroy', $kab_kota->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="ri-delete-bin-2-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $kab_kotas->appends(['search' => request('search')])->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection