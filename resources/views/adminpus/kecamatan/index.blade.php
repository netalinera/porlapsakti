<!-- File: resources/views/adminpus/kecamatan/index.blade.php -->
@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
        <h1>Kecamatan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('adminpus') }}">Home</a></li>
                <li class="breadcrumb-item active">Kecamatan</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kecamatan</h5>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <a href="{{ route('kecamatan.create') }}" class="btn btn-success mb-3">
                            <i class="ri-add-circle-fill"></i> Tambah Kecamatan
                        </a>

                        <form action="{{ route('kecamatan.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari Kecamatan, Provinsi, atau Kabupaten..."
                                    value="{{ request('search') }}">
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
                                    <th>Kabupaten/Kota</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kecamatans as $index => $kecamatan)
                                    <tr>
                                        <td>{{ ($kecamatans->currentPage() - 1) * $kecamatans->perPage() + $index + 1 }}
                                        </td>
                                        <td>{{ $kecamatan->id }}</td>
                                        <td>{{ isset($kecamatan->provinsi) ? $kecamatan->provinsi->nama_provinsi : 'Data tidak tersedia' }}
                                        </td>
                                        <td>{{ isset($kecamatan->kabKota) ? $kecamatan->kabKota->nama_kab_kota : 'Data tidak tersedia' }}
                                        </td>
                                        <td>{{ $kecamatan->nama_kecamatan }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('kecamatan.edit', $kecamatan->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="ri-edit-2-fill"></i>
                                                </a>
                                                <form action="{{ route('kecamatan.destroy', $kecamatan->id) }}"
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
                            {{ $kecamatans->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
