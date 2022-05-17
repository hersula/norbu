@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Riwayat Tindakan</h4>
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs small justify-content-end" role="tablist">
                    <li class="nav-item"><a style="background-color:#668cff;color:#ffffff;" class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Riwayat Hari Ini</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Riwayat Periode</a></li>
                  </ul>
                  <br/>
                  <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row" style="padding-right:30px;">
                            <div class="col-md-3">
                              <div class="form-group mb-3">
                                <select name="select_outlet" id="select_outlet" class="custom-select custom-select-sm">
                                <option value="">Pilih Outlet</option>
                                <option value=""></option>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-2">
                              <div class="form-group mb-3">
                              <button class="btn btn-outline-secondary btn-sm" type="submit" name="submit" id="button-addon2"><i class="fas fa-filter fa-sm"></i> Tampilkan</button>
                              </div>
                            </div>
                        </div>
                        <!--end of div class="row"--> 
                  </form>
                  <div class="table-responsive">
                    <table id="dataRiwayatTindakan" class="table table-bordered table-striped ">
                        <thead>
                            <tr class="text-center bg-secondary">
                                <th style="width: 70px;background-color:#60b577;" class="text-light">NO.</th>
                                <th class="text-light" style="background-color:#60b577">ID TRANSAKSI</th>
                                <th class="text-light" style="background-color:#60b577;">NIK/ PASSPORT</th>
                                <th class="text-light" style="background-color:#60b577;">NAMA PASIEN</th>
                                <th class="text-light" style="background-color:#60b577;">JENIS TINDAKAN</th>
                                <th class="text-light" style="background-color:#60b577;">TANGGAL TINDAKAN</th>
                                <th class="text-light" style="background-color:#60b577;">DIBUAT PADA</th>
                                <th class="text-light" style="background-color:#60b577;">NAMA OUTLET</th>
                                <th class="text-light" style="background-color:#60b577;">HARGA</th>
                                <th class="text-light" style="background-color:#60b577;">PEMBAYARAN</th>
                                <th class="text-light" style="background-color:#60b577;">HASIL TES</th>
                                <th class="text-light" style="background-color:#60b577;">STATUS</th>
                                <th style="width: 20%;background-color:#60b577;" class="text-light">AKSI</th>  
                            </tr>
                        </thead>
                        <tbody>                         
                          @if (!empty($riwayatTindakanPeriode))
                            @foreach($riwayatTindakanPeriode as $item)
                          <tr>
                              <td>{{$loop->iteration}}.</td>
                              <td style="text-align:center;">{{$item->transaksiID}}</td>
                              <td>{{$item->nik}}</td>
                              <td>{{$item->namaPasien}}</td>
                              <td>{{$item->typeTindakan}}</td>
                              <td>{{$item->tglTindakan}}</td>
                              <td>{{$item->createdAt}}</td>
                              <td>{{$item->namaOutlet}}</td>
                              <td>{{$item->price}}</td>
                              <td>{{$item->paymentType}}</td>
                              <td>
                                @if ($item->hasil=="Negatif")
                                <span class="badge badge-info">Negatif</span>
                                @else   
                                <span class="badge badge-danger">Positif</span>
                                @endif
                              </td>
                              <td>{{$item->status}}</td>
                              <td style="text-align:center;">
                               
                                                                                 
                              </td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                  </div>
                </div>
                <!--end of class card-body-->
            </div>
            <!--end of class card-->
        </div>
        <!--end of col-md-12-->
    </div>
    <!--end of class row-->
</div>
<!--end of class="container-fluid mt-3"-->

<script>
  $(document).on("click",'#btn_hapus_outlet', function (e) {  
   const id_ot= $(this).data('idtarget');
    $('#otletID').val(id_ot);
  });
      $('#dataRiwayatTindakan').DataTable({
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