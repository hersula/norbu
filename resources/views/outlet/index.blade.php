@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"><i class="fas fa-list"></i> Data Outlet</h4>
                </div>
                <div class="card-body">
                <a href="{{ route('outlet.create') }}" class="btn text-white " style="background:  rgb(16, 207, 144)" title="Tambah Data"> <i class="fas fa-plus"></i> <b>Outlet</b></a>
                    <div class="table-responsive">
                      <table id="dataOutlet" class="table table-bordered table-striped ">
                        <thead>                        
                            <tr style="background:  rgb(16, 207, 144)">
                                <th style="width: 70px;text-align:center;" class="text-light">NO.</th>
                                <th style="text-align:center;" class="text-light">NAMA OUTLET</th>
                                <th style="text-align:center;" class="text-light">ALAMAT</th>
                                <th style="text-align:center;"class="text-light">TELP.</th>
                                <th style="width: 20%;text-align:center;" class="text-light">AKSI</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($outlet as $item)
                            <tr>
                              <td style="text-align:center;">{{$loop->iteration}}.</td>
                              <td>{{$item->name}}</td>
                              <td style="width:400px;">{{$item->address}}</td>
                              <td>{{$item->phone}}</td>
                              <td style="text-align:center;">
                                <a href="{{ '/outlet/' }}{{ $item->id }}"><button class="btn btn-xs btn-dark" title="Lihat Data"><i class="fas fa-eye"></i></button></a>  
                                <a href="{{ '/outlet/' }}{{ $item->id }}/edit"> <button class="btn btn-xs btn-success" title="ubah Data"><i class="fas fa-edit"></i></i></button></a>                        
                                <button class="btn btn-xs btn-danger" id="btn_hapus_outlet" title="Hapus Data" data-idtarget="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
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
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-danger">
        <div class="modal-header  " style="background:  rgb(16, 207, 144)" >
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin data outlet akan dihapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/outlet/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="otletID"  name="otletID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm " data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<script>

 // event
 $(document).on("click",'#btn_hapus_outlet', function (e) {  
   const id_ot= $(this).data('idtarget');
  
   $('#otletID').val(id_ot);
        });



      $('#dataOutlet').DataTable({
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