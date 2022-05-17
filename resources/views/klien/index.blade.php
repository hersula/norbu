@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> <i class="fas fa-list"></i> Data Klien</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">     
                            <a href="{{ '/klien/create' }}">  <button class="btn btn text-white  m-2" style="background:  rgb(16, 207, 144)">
                                <i class="fa fa-plus"></i>
                              Klien
                            </button>   </a>
                                
                    <div class="table-responsive">
                        <table id="klien" class="display table table-striped table-hover text-center" >
                            <thead>
                                <tr class="" style="background:  rgb(16, 207, 144)" >
                                    <th style="width: 70px" class="text-light">NO.</th>
                                    <th class="text-light">NAMA KLIEN</th>
                                    <th class="text-light" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($kliens as $klien)
                                <tr>
                                  <td >{{$loop->iteration}}.</td>
                                  <td>{{$klien->nameClient}}</td>
                                  <td >
                                    <a href="{{ '/klien/' }}{{ $klien->id }}"><button class="btn btn-xs btn-dark"><i class="fas fa-eye"></i></button></a>  
                                    <a href="{{ '/klien/' }}{{ $klien->id }}/edit"> <button class="btn btn-xs btn-success  "><i class="fas fa-edit"></i></i></button>
                                    </a>
                                    <button class="btn btn-xs btn-danger" id="btnhapus" data-idklien="{{ $klien->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin Data Klien akan  dihapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/klien/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="klienid" value="klienid" name="klienid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm " data-dismiss="modal" style="background:  rgb(16, 207, 144)">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<script>

     // event
$(document).on("click",'#btnhapus', function (e) {  
   const id_klien= $(this).data('idklien');
  
   $('#klienid').val(id_klien);
        });
        // tabel
    $("#klien").DataTable({
   

});
</script>

@endsection