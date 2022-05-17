@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> <i class="fas fa-list"></i> Data Roles Karyawan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">     
                            <a href="{{ '/roles/create' }}">  <button class="btn btn text-white  m-2" style="background:  rgb(16, 207, 144)">
                                <i class="fa fa-plus"></i>
                              Role
                            </button>   </a>
                                
                    <div class="table-responsive">
                        <table id="roles" class="display table table-striped table-hover text-center" >
                            <thead>
                                <tr class="" style="background:  rgb(16, 207, 144)" >
                                    <th style="width: 70px" class="text-light">NO</th>
                                    <th class="text-light">NAMA ROLE</th>
                                    <th class="text-light" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                  <td >{{$loop->iteration}}.</td>
                                  <td>{{$role->roleName}}</td>
                                  <td >
                                    <a href="{{ '/roles/' }}{{ $role->id }}"><button class="btn btn-xs btn-dark" title="Lihat Data"><i class="fas fa-eye"></i></button></a>  
                                    <a href="{{ '/roles/' }}{{ $role->id }}/edit"> <button class="btn btn-xs btn-success" title="Ubah Data"><i class="fas fa-edit"></i></i></button>
                                    </a>
                                    <button class="btn btn-xs btn-danger" id="btnhapus" title="Hapus Data" data-idrole="{{ $role->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>
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
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin Data Role Akan  dihapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/roles/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="roleid" value="roleid" name="roleid">
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
   const id_role= $(this).data('idrole');
  $('#roleid').val(id_role);
});
// tabel
$("#roles").DataTable({
});
</script>
@endsection