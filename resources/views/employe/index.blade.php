@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"><i class="fas fa-list"></i> Data Karyawan</h4>
                </div>
                <div class="card-body">
                <a href="{{ route('karyawan.create') }}" class="btn btn text-white"style="background:  rgb(16, 207, 144)" title="Tambah Data"> <i class="fas fa-plus"></i> <b>Karyawan</b></a>
                    <div class="table-responsive">
                      <table id="dataEmployee" class="table table-bordered table-striped text-center">
                        <thead>
                          <tr style="background:  rgb(16, 207, 144)">
                            <th style="width: 70px" class="text-light">NO.</th>
                            <th class="text-light">NAMA KARYAWAN</th>
                            <th class="text-light">EMAIL</th>
                            <th class="text-light">PHONE</th>
                            <th class="text-light">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawan as $item)
                            <tr>
                              <td >{{$loop->iteration}}.</td>
                              <td>{{$item->name}}</td>
                              <td >{{$item->email}}</td>
                              <td>{{$item->phone}}</td>
                              
                            <td>
                                <a href="{{ '/karyawan/' }}{{ $item->id }}"><button class="btn btn-xs btn-dark" title="Lihat Data"><i class="fas fa-eye"></i></button></a>  
                                <a href="{{ '/karyawan/' }}{{ $item->id }}/edit"> <button class="btn btn-xs btn-success" title="Ubah Data"><i class="fas fa-edit"></i></i></button></a>                        
                                  <button class="btn btn-xs btn-danger" title="Hapus Data" id="hapusbtn" data-idtarget="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
                            </td>
                            </tr>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--end of div class="table-responsive"> -->
                </div>
            </div>
        </div> 
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-danger">
        <div class="modal-header "  style="background:  rgb(16, 207, 144)">
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin data karyawan akan di hapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/karyawan/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="karyawanid" value="karyawanid" name="karyawanid">
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
  $(document).on("click",'#hapusbtn', function (e) {  
   const id_karyawan= $(this).data('idtarget');
  
   $('#karyawanid').val(id_karyawan);
        });


      $('#dataEmployee').DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": false,
        "pageLength": 10,
        "order": [
          [0, "asc"],
        ],
        buttons: [
          { extend: 'excel',footer: true,},
          { extend: 'pdf',footer: true, }
         
        ]
      }).buttons().container().appendTo('#dataLaporanTindakan_wrapper .col-md-6:eq(0)'); 
</script>

@endsection