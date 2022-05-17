@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"><i class="fas fa-list"></i> Data Tindakan</h4>
                </div>
                <div class="card-body">
                <a href="{{ route('tindakan.create') }}"  title="Tambah Data">  <button class="btn btn text-light" style="background:  rgb(16, 207, 144)"><i class="fas fa-plus"></i> Tindakan</button> </a>
                    <div class="table-responsive">
                      <table id="dataTindakan" class="table table-bordered table-striped">
                        <thead>
                          <tr class="" style="background:  rgb(16, 207, 144)">
                            <th class="text-light text-center" style="width:70px">NO.</th>
                            <th class="text-light text-center">NAMA TINDAKAN</th>
                            <th class="text-light text-center">DESKRIPSI</th>
                            <th class="text-light text-center">JENIS</th>
                            <th class="text-light text-center">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($tindakan as $item)
                            <tr>
                              <td style="text-align:center;">{{$loop->iteration}}</td>
                              <td  style="width:200px;" >{{$item->name}}</td>
                              <td style="width:300px;">{{$item->description}}</td>
                              {{-- {{ dd($item) }} --}}
                              <td>{{$item->typeTindakan}}</td>
                              <td class="text-center">
                                <a href="{{ '/tindakan/' }}{{ $item->id }}"><button class="btn btn-xs btn-dark"><i class="fas fa-eye"></i></button></a>  
                                <a href="{{ '/tindakan/' }}{{ $item->id }}/edit"> <button class="btn btn-xs btn-success  "><i class="fas fa-edit"></i></i></button></a>                        
                                  <button class="btn btn-xs btn-danger" id="hapusTindakan" data-idtarget="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
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
        <div class="modal-header "  style="background:  rgb(16, 207, 144)">
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin data Tindakan akan dihapus?</h2></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/tindakan/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="tindakanid" value="tindakanid" name="tindakanid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs " data-dismiss="modal" style="background:  rgb(16, 207, 144)">Cancel</button>
          <button type="submit" class="btn btn-xs btn-danger">Hapus</button>
        </form>
        </div>
      </div>
    </div>
  </div>

<script>

  // event
  $(document).on("click",'#hapusTindakan', function (e) {  
   const id_tindakan= $(this).data('idtarget');
  
   $('#tindakanid').val(id_tindakan);
        });


      $('#dataTindakan').DataTable({
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