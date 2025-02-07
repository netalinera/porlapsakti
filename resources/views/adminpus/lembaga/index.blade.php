@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Lembaga</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('adminpus') }}">Home</a></li>
          <li class="breadcrumb-item active">Lembaga</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Lembaga</h5>

                        <!-- Tombol Tambah -->
                        <p>
                            <a type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Lembaga" href="{{ url('lembaga/create') }}">
                                <i class="ri-add-circle-fill"></i> Tambah Lembaga
                            </a>
                        </p>

                        <form action="{{ route('lembaga.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Cari ID, Nama Lembaga, Perpustakaan, atau Wilayah..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-search-line"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Tabel Data Lembaga -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lembaga</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>NPP</th>
                                    <th>Alamat</th>
                                    <th>Email Lembaga</th>
                                    <th>Email Perpustakaan</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lembagas as $index => $lembaga)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $lembaga->nama_lembaga }}</td>
                                        <td>{{ $lembaga->provinsi->nama_provinsi ?? '-' }}</td>
                                        <td>{{ $lembaga->kab_kota->nama_kab_kota ?? '-' }}</td>
                                        <td>{{ $lembaga->kecamatan->nama_kecamatan ?? '-' }}</td>
                                        <td>{{ $lembaga->kel_desa->nama_kel_desa ?? '-' }}</td>
                                        <td>{{ $lembaga->NPP }}</td>
                                        <td>{{ $lembaga->alamat }}</td>
                                        <td>{{ $lembaga->email_lembaga }}</td>
                                        <td>{{ $lembaga->email_perpus }}</td>
                                        <td>{{ $lembaga->rt }}</td>
                                        <td>{{ $lembaga->rw }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('lembaga.edit', $lembaga->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="ri-edit-2-fill"></i>
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('lembaga.destroy', $lembaga->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lembaga ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="ri-delete-bin-2-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>       
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Belum ada data lembaga.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $lembagas->appends(['search' => request('search')])->links() }}
                        </div>
                        <!-- End Tabel Data Lembaga -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection