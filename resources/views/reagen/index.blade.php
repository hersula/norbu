@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> <i class="fas fa-list"></i> Data Reagen</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">     
                            <a href="{{ '/reagen/create' }}">  <button class="btn btn text-white   m-2" style="background:  rgb(16, 207, 144)">
                                <i class="fa fa-plus"></i>
                             Reagen
                            </button> </a>
                                
                    <div class="table-responsive">
                        <table id="targetGen" class="display table table-striped table-hover text-center" >
                            <thead>
                                <tr style="background:  rgb(16, 207, 144)">
                                    <th style="width: 70px" class="text-light">NO.</th>
                                    <th class="text-light">NAMA REAGEN</th>
                                    <th class="text-light">STATUS AKTIF DI PAKAI</th>
                                    <th class="text-light" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            @foreach($reagen as $item)
                            <tr>
                              <td >{{$loop->iteration}}.</td>
                              <td>{{$item->nameReagen}}</td>
                              <td>{{$item->isActive}}</td>
                              <td > 
                              <a href="{{ '/reagen/' }}{{ $item->id }}"><button class="btn btn-xs btn-dark"><i class="fas fa-eye"></i></button></a> 
                              <a href="{{ 'reagen/' }}{{ $item->id }}/edit"> <button class="btn btn-xs btn-success  "><i class="fas fa-edit"></i></i></button></a>                        
                                <button class="btn btn-xs btn-danger" id="btn_hapus" data-idtarget="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
                              </td>
                            </tr>
                            @endforeach
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
        <div class="modal-header " style="background:  rgb(16, 207, 144)"  >
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin data reagen akan di hapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/reagen/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="reagenid" value="reagenid" name="reagenid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm " style="background:  rgb(16, 207, 144)" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<script>

     // event
$(document).on("click",'#btn_hapus', function (e) {  
   const id_reagen= $(this).data('idtarget');
  
   $('#reagenid').val(id_reagen);
        });
        // tabel
    $("#targetGen").DataTable({
   

});
</script>

@endsection