@extends('adminpus.index')

@section('content')
    <div class="pagetitle">
      <h1>Kegiatan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">Kegiatan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Kegiatan</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->

              
              <p><!-- button -->
              <a type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Kegiatan" href=""><i class="ri-add-circle-fill"></i></a></p>


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
                          @if (isset($data->nama_pj))
                            <a href="{{ route('update-account', $data->id) }}" type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Data"><i class="ri-edit-2-fill"></i></a>  
                          @else
                            <a href="{{ route('add-profile', $data->id) }}" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Profil"><i class="ri-user-add-fill"></i></a>
                          @endif
                          <button type="submit" class="btn btn-danger" onclick=" destroy({{ $data->id }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Data"><i class="ri-delete-bin-2-fill"></i></button>
                              
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

@section('script')

{{-- sweet alert (alert hapus) --}}
<script type="text/javascript">

    const destroy = (id)=>{
        swal({
            title:"Apakah Anda Yakin?",
            text:"Anda Tidak Akan Dapat Mengembalikan Data Ini!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: '#20489b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then(result=>{
            if(result.value){
                let access = {
                    id:id,
                    _method:'delete',
                    _token:"{{csrf_token()}}"
                }
                $.post("destroy-account/"+id,access)
                .done(res=>{
                    console.log(res);
                    swal({
                        title:"Berhasil",
                        text:"Anda Berhasil menghapus Data",
                        type:"success",
                    }).then(result=>{
                        window.location.reload();
                    })
                }).fail(err=>{
                    console.log(err);
                }); 
            }
        });
    }

</script>
@endsection