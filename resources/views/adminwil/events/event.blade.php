@extends('adminwil.index')

@section('content')
    <div class="pagetitle">
      <h1>Kegiatan</h1>
      {{-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Kegiatan</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Kegiatan</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->
    
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Kegiatan</th>
                    <th>Tahun</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($event as $p => $data)
                  <tr>
                    <td>{{ $p+1 }}</td>
                    <td>{{ $data->nama_kegiatan }}</td>
                    <td>{{ $data->tahun }}</td>
                    <td>{{ $data->provinsi }}</td>
                    <td>
                      <centre>
                        <div class="btn-group" role="group" aria-label="grup aksi">
                          <a href="{{ route('participants', $data->id) }}" type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="List Peserta"><i class="ri-team-fill"></i></a>
                        </div>
                      </centre>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
  </section>
@endsection

