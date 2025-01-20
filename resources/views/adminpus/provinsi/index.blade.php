@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
        <h1>Provinsi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('adminpus') }}">Home</a></li>
                <li class="breadcrumb-item active">Provinsi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Provinsi</h5>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <a href="{{ route('provinsi.create') }}" class="btn btn-success mb-3">
                            <i class="ri-add-circle-fill"></i> Tambah Provinsi
                        </a>
                        <form action="{{ route('provinsi.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari ID atau Nama Provinsi..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-search-line"></i>
                                </button>
                            </div>
                        </form>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Provinsi</th>
                                    <th>Nama Provinsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provinces as $index => $province)
                                    <tr>
                                        <td>{{ ($provinces->currentPage() - 1) * $provinces->perPage() + $index + 1 }}
                                        <td>{{ $province->id }}</td>
                                        <td>{{ $province->nama_provinsi }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('provinsi.edit', $province->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="ri-edit-2-fill"></i>
                                                </a>
                                                <form action="{{ route('provinsi.destroy', $province->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus provinsi ini?')"
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
                            {{ $provinces->appends(['search' => request('search')])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
