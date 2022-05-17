@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
  <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" style="font-weight:bold;">Riwayat Tindakan</h4>
            </div>
            <div class="card-header d-flex p-0">
              <ul class="nav nav-pills ml-auto p-2" id="myTab">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Riwayat Hari ini</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Riwayat Periode</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form action="{{ route('riwayatTindakan.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                          <div class="row" style="padding-right:30px;">
                              <div class="col-md-3">
                                <div class="form-group mb-3">
                                  <select name="select_outlet" id="select_outlet" class="custom-select custom-select-sm mr-3" required>
                                    <option style="font-size:13px;" value="0" {{ old('select_outlet')=='0' ?'selected':'' }}>Semua Outlet</option>
                                    @foreach($outlet as $outlet)
                                    @if ($outlet->id==Request::get('select_outlet')) 
                                    <option style="font-size:13px;" value="{{ $outlet->id }}" {{ $outlet->id==Request::get('select_outlet')?'selected':'' }}>{{ $outlet->name }}</option>
                                    @elseif (Request::get('select_outlet')=='')
                                    <option style="font-size:13px;" value="{{ $outlet->id }}" {{ $outlet->name==session('outlet')?'selected':'' }}>{{ $outlet->name }}</option>
                                    @endif
                                    @endforeach
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
                      <table id="dataRiwayatTindakan" class="table table-bordered table-striped text-xs">
                          <thead>
                            <tr style="background:  rgb(16, 207, 144)">
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
                            @if (!empty($riwayatTindakanNow))
                              @foreach($riwayatTindakanNow as $item)
                            <tr>
                                <td>{{$loop->iteration}}.</td>
                                <td style="text-align:center;">{{$item->transaksiID}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->namaPasien}}</td>
                                <td>{{$item->typeTindakan}}</td>
                                <td>{{ date('d/m/Y', strtotime($item->tglTindakan))}}</td>
                                <td>{{$item->createdAt}}</td>
                                <td>{{$item->namaOutlet}}</td>
                                <td>@currency($item->grandTotal)</td>
                                <td>{{$item->namePayment}}</td>
                                <td>
                                  @if ($item->hasil=="Negatif")
                                  <span class="badge badge-info">Negatif</span>
                                  @elseif ($item->hasil=="Positif")  
                                  <span class="badge badge-danger">Positif</span>
                                  @elseif ($item->hasil=="Inkonklusif")
                                  <span class="badge badge-secondary">Inkonklusif</span>
                                  @else
                                  <span class="badge badge-warning">Waiting</span>
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
                     <!--end of div class responsive-->
                  </div>
                  <!--end of div class="tab-pane" id="tab_1"-->

                  <div class="tab-pane" id="tab_2">
                    <form action="#" method="POST">
                      @csrf
                      <div class="row pb-4 pl-4">
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input required type="date" class="form-control form-control-sm mr-3" value="{{Request::get('date_filter')}}" name="date_filter" >
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="input-group">
                            <input required type="date" class="form-control form-control-sm mr-3" value="{{Request::get('date_filter2')}}" name="date_filter2" >
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="input-group">
                          <select name="select_outlet_periode" id="select_outlet_periode" class="custom-select custom-select-sm mr-3" required>
                            <option style="font-size:13px;" value="0" {{ old('select_outlet_periode')=='0' ?'selected':'' }}>Semua Outlet</option>
                            @foreach($stan1 as $stan)
                            @if ($stan->id==Request::get('select_outlet_periode')) 
                            <option style="font-size:13px;" value="{{ $stan->id }}" {{ $stan->id==Request::get('select_outlet_periode')?'selected':'' }}>{{ $stan->name }}</option>
                            @elseif (Request::get('select_outlet_periode')=='')
                            <option style="font-size:13px;" value="{{ $stan->id }}" {{ $stan->name==session('outlet')?'selected':'' }}>{{ $stan->name }}</option>
                            @endif
                            @endforeach
                          </select>
                          </div>
                        </div>
                        <div class="col-xs-6">
                        <div class="input-group">
                          <button class="btn btn-primary btn-sm" type="submit" name="submit" id="button-addon2" required><i class="fas fa-filter fa-sm"></i> Tampilkan</button>
                        </div>
                        </div>
                      </div>
                    </form>
                    <div class="table-responsive">
                      <table id="dataRiwayatTindakanPeriode" class="table table-bordered table-striped text-xs">
                          <thead>
                            <tr style="background:  rgb(16, 207, 144)">
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
                              @foreach($riwayatTindakanPeriode as $itemPeriode)
                            <tr>
                                <td>{{$loop->iteration}}.</td>
                                <td style="text-align:center;">{{$itemPeriode->transaksiID}}</td>
                                <td>{{$itemPeriode->nik}}</td>
                                <td>{{$itemPeriode->namaPasien}}</td>
                                <td>{{$itemPeriode->typeTindakan}}</td>
                                <td>{{ date('d/m/Y', strtotime($itemPeriode->tglTindakan))}}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($itemPeriode->createdAt))}}
                                </td>
                                <td>{{$itemPeriode->namaOutlet}}</td>
                                <td>@currency($itemPeriode->grandTotal)</td>
                                <td>{{$itemPeriode->namePayment}}</td>
                                <td>
                                  @if ($itemPeriode->hasil=="Negatif")
                                  <span class="badge badge-info">Negatif</span>
                                  @elseif ($itemPeriode->hasil=="Positif")  
                                  <span class="badge badge-danger">Positif</span>
                                  @elseif ($itemPeriode->hasil=="Inkonklusif")
                                  <span class="badge badge-secondary">Inkonklusif</span>
                                  @else
                                  <span class="badge badge-warning">Waiting</span>
                                  @endif
                                </td>
                                <td>{{$itemPeriode->status}}</td>
                                <td style="text-align:center;">
                                                                                 
                                </td>
                              </tr>
                              @endforeach
                            @endif
                          </tbody>
                      </table>
                    </div>
                     <!--end of div class responsive-->
                  </div>
                  <!--end of div class="tab-pane" id="tab_2"-->

              </div>
                <!--end of div class="tab-content"-->
            </div>
            <!-- /.card-body -->
          </div>
          <!--end of class card-->
      </div>
      <!--end of col-md-12-->
  </div>
  <!--end of class row-->
</div>
<!--end of class="container-fluid mt-3"-->
<script>
$(document).ready(function() {
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
  }).buttons().container().appendTo('#dataRiwayatTindakan_wrapper .col-md-6:eq(0)'); 
});
</script>
<script>
$(document).ready(function() {
    $('#dataRiwayatTindakanPeriode').DataTable({
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
    }).buttons().container().appendTo('#dataRiwayatTindakanPeriode_wrapper .col-md-6:eq(0)'); 
  });
  </script>

@endsection