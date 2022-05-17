@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title" style="font-weight:bold;"> <i class="fas fa-list"></i> Data Pasien</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('pasien.store') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group mb-3">
                          <label class="text-xs font-weight-bold">NIK Pasien</label>
                          <input type="text" class="form-control form-control-sm" id="nik" name="nik" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group mb-3">
                          <label class="text-xs font-weight-bold">Nama Pasien</label>
                          <input type="text" class="form-control form-control-sm" id="name" name="name" value="">
                        </div>
                      </div>
                    </div>
                   
                    <div class="col-md-12 text-left">
                      <button class="btn btn-outline-secondary btn-sm" type="submit" name="submit" id="button-addon2">
                        <i class="fas fa-filter fa-sm"></i> Tampilkan
                      </button>
                    </div>
                  </form>
                    <div class="table-responsive">
                      <table id="dataPasien" class="display table table-striped table-hover text-center" >
                        <thead>
                          <tr style="background:  rgb(16, 207, 144)">
                            <th  class="text-light text-center">NO.</th>
                            <th  class="text-light text-center">NIK</th>
                            <th  class="text-light text-center">NAMA</th>
                            <th  class="text-light text-center">ALAMAT</th>
                            <th  class="text-light text-center">TANGGAL LAHIR</th>
                            <th  class="text-light text-center">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($pasiens as $pasien)
                            <tr>
                              <td >{{$loop->iteration}}</td>
                              <td>{{$pasien->nik}}</td>
                              <td >{{$pasien->name}}</td>
                              <td>{{$pasien->address}}</td>
                              <td>{{$pasien->dateOfBirth}}</td>
                              <td >
                                <a href="{{ '/pasien/' }}{{ $pasien->id }}"><button class="btn btn-xs btn-dark"><i class="fas fa-eye"></i></button></a>  
                                 <a href="{{ route('pasien.edit', $pasien->id)}}"> <button class="btn btn-xs btn-success  "><i class="fas fa-edit"></i></i></button></a>  
                                <button class="btn btn-xs btn-danger" id="btnhapus" data-idpasien="{{ $pasien->id }}" data-toggle="modal" data-target="#exampleModal" title="Hapus Data"><i class="fas fa-trash"></i></button>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--end of div class="table-responsive"> -->
                </div>
            </div>
        </div> 
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content border border-danger">
            <div class="modal-header " style="background:  rgb(16, 207, 144)" >
              <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin data Pasien akan dihapus?</h2> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ '/pasien/delete' }}" method="POST">
                @csrf
                @method('delete')
            <div class="modal-body">
            <input type="hidden" id="pasienid"  name="pasienid">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-xs " style="background:  rgb(16, 207, 144)" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-xs btn-danger">Hapus</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    <script>
      // event
      $(document).on("click",'#btnhapus', function (e) {  
          const id_pasien= $(this).data('idpasien');
          $('#pasienid').val(id_pasien);
          });
        // tabel
      $("#dataPasien").DataTable({
        "searching": false,
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 20,
        "order": [
          [1, "asc"],
        ],
      }).buttons().container().appendTo('#dataPasien_wrapper .col-md-6:eq(0)');
 </script>
@endsection