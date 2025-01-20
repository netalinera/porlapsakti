@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
        <h1>Kelurahan/Desa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('adminpus') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelurahan/Desa</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kelurahan/Desa</h5>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <a href="{{ route('kel_desa.create') }}" class="btn btn-success mb-3">
                            <i class="ri-add-circle-fill"></i> Tambah Kelurahan/Desa
                        </a>
                        <form action="{{ route('kel_desa.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari ID, Nama Kelurahan/Desa, Kecamatan, Kabupaten/Kota, atau Provinsi..."
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
                                    <th>Kecamatan</th>
                                    <th>Nama Kelurahan/Desa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelDesas as $index => $kelDesa)
                                    <tr>
                                        <td>{{ ($kelDesas->currentPage() - 1) * $kelDesas->perPage() + $index + 1 }}</td>
                                        <td>{{ $kelDesa->id }}</td>
                                        <td>{{ $kelDesa->provinsi->nama_provinsi ?? 'Data tidak tersedia' }}</td>
                                        <td>{{ $kelDesa->kabKota->nama_kab_kota ?? 'Data tidak tersedia' }}</td>
                                        <td>{{ $kelDesa->kecamatan->nama_kecamatan ?? 'Data tidak tersedia' }}</td>
                                        <td>{{ $kelDesa->nama_kel_desa }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('kel_desa.edit', $kelDesa->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="ri-edit-2-fill"></i>
                                                </a>
                                                <form action="{{ route('kel_desa.destroy', $kelDesa->id) }}" method="POST"
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
                            {{ $kelDesas->appends(['search' => request('search')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
