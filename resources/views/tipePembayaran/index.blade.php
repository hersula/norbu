@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> <i class="fas fa-list"></i> Data Tipe Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">     
                            <a href="{{ '/tipepembayaran/create' }}">  <button class="btn btn text-white  m-2" style="background:  rgb(16, 207, 144)">
                                <i class="fa fa-plus"></i>
                              Tipe Pembayaran
                            </button>   </a>
                                
                    <div class="table-responsive">
                        <table id="payment" class="display table table-striped table-hover text-center" >
                            <thead>
                                <tr class="" style="background:  rgb(16, 207, 144)" >
                                    <th style="width: 70px" class="text-light">NO</th>
                                    <th class="text-light">NAMA TIPE PEMBAYARAN</th>
                                    <th class="text-light" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($tipepembayarans as $tipepembayaran)
                                <tr>
                                  <td >{{$loop->iteration}}.</td>
                                  <td>{{$tipepembayaran->namePayment}}</td>
                                  <td >
                                    <a href="{{ '/tipepembayaran/' }}{{ $tipepembayaran->id }}"><button class="btn btn-xs btn-dark"><i class="fas fa-eye"></i></button></a>  
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
          <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Yakin Data Tipe Pembayaran akan  dihapus?</h2> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ '/tipepembayaran/delete' }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
        <input type="hidden" id="paymentid" value="paymentid" name="paymentid">
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
   const id_payment= $(this).data('idpayment');
  
   $('#paymentid').val(id_payment);
        });
        // tabel
    $("#payment").DataTable({
   

});
</script>

@endsection