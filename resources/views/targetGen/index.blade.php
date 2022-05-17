@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Data Target Gen</h4>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">     
                        <a href="{{ route('targetgen.create') }}">  <button class="btn btn m-2 text-light" style="background:  rgb(16, 207, 144)" >
                            <i class="fa fa-plus"></i>
                            Target Gen
                        </button> 
                        </a> 
                    <div class="table-responsive">
                      <table id="targetGen" class="display table table-striped table-hover text-center" >
                        <thead>
                            <tr class="bg"style="background:  rgb(16, 207, 144)">
                                <th style="width: 70px" class="text-light">NO</th>
                                <th class="text-light">NAMA TARGET GEN</th>
                                <th class="text-light" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($target as $targetgen)
                            <tr>
                              <td style="text-align:center;">{{$loop->iteration}}</td>
                              <td>{{$targetgen->nameTargetGen}}</td>
                              <td style="text-align:center;">
                                <a href="{{ route('targetgen.show', $targetgen->id)}}" class="btn btn-xs btn-dark" title="Lihat Data"> <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('targetgen.edit', $targetgen->id)}}" class="btn btn-xs btn-success"  title="Ubah Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-xs btn-danger" id="btnhapus" data-idtarget="{{ $targetgen->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></button>   
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--end of div class="table-responsive"> -->
                    </div>
                    <!--end of class="col-md-12"> --> 
                </div>
                <!--end of class row-->
                </div>
                <!--end of class card-body-->
            </div>
        </div> 
    </div>
</div>
  
<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-danger">
        <div class="modal-header " style="background:  rgb(16, 207, 144)" >
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin Data Target Gen ini akan dihapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/targetgen/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="targetid" value="targetid" name="targetid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm " data-dismiss="modal" style="background:  rgb(16, 207, 144)">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
        </div>
      </div>
    </div>
<script>
// event
$(document).on("click",'#btnhapus', function (e) {  
    const id_target= $(this).data('idtarget');
    $('#targetid').val(id_target);
});
$("#targetGen").DataTable({
   
});
</script>
@endsection