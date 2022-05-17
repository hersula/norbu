@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Sample Hasil Antigen</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('hasil-tes-antigen.index') }}" method="POST">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <input type="date" class="form-control form-control-sm mr-3" placeholder="Input outlet name" aria-label="Recipient's username" aria-describedby="button-addon2" name="date_filter" value="">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <input type="date" class="form-control form-control-sm mr-3" placeholder="Input outlet name" aria-label="Recipient's username" aria-describedby="button-addon2" name="date_filter2" value="">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <select name="select_outlet" id="select_outlet" class="custom-select custom-select-sm mr-3" required>
                                      <option value="">Pilih Outlet</option>
                                      @foreach($outlet as $outlet)
                                      <option style="font-size:13px;" value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                      @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary btn-sm" type="submit" name="submit" id="button-addon2"><i class="fas fa-filter fa-sm"></i> Tampilkan</button>
                                </div>
                            </div>
                        </div>
                  </form>
                  <br/><br/>
                  <div class="table-responsive">
                    <table id="dataHasilTesAntigen" class="table table-bordered table-striped ">
                        <thead>
                            <tr class="text-center bg-secondary">
                                <th style="width: 70px;background-color:#60b577;" class="text-light">ID TRANSAKSI</th>
                                <th class="text-light" style="background-color:#60b577">NIK</th>
                                <th class="text-light" style="background-color:#60b577;">NAMA PASIEN</th>
                                <th class="text-light" style="background-color:#60b577;">JENIS TINDAKAN</th>
                                <th class="text-light" style="background-color:#60b577;">NAMA TINDAKAN</th>
                                <th class="text-light" style="background-color:#60b577;">TANGGAL TINDAKAN</th>
                                <th class="text-light" style="background-color:#60b577;">NAMA OUTLET</th>
                                <th class="text-light" style="background-color:#60b577;">STATUS</th>
                                <th class="text-light" style="background-color:#60b577;">HASIL TES</th>
                                <th style="width: 20%;background-color:#60b577;" class="text-light">AKSI</th>   
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($hasilantigens as $hasilantigen)
                          <tr>
                              <td style="text-align:center;">{{$hasilantigen->transaksiID}}</td>
                              <td>{{$hasilantigen->nik}}</td>
                              <td>{{$hasilantigen->name_pasien}}</td>
                              <td>{{$hasilantigen->typeTindakan}}</td>
                              <td>{{$hasilantigen->name_tindakan}}</td>
                              <td>{{$hasilantigen->typeTindakan}}</td>
                              <td>{{$hasilantigen->name_outlet}}</td>
                              <td>{{$hasilantigen->status}}</td>
                              <td>
                                {{$hasilantigen->hasil}}
                              </td>
                              <td style="text-align:center;">
  
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                   
                  </div>
                  <!--end of div class="table-responsive"> -->
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
      $('#dataHasilTesAntigen').DataTable({
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