@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" style="font-weight:bold;">Sampel Hasil Antigen</h4>
              </div>
              <div class="card-header d-flex p-0">
               
                <ul class="nav nav-pills ml-auto p-2" id="myTab">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Sample Antigen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Antigen Periode</a></li>
                </ul>
              </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      <div class="table-responsive">
                        <table id="dataHasilAntigenFaskes" class="table table-bordered table-striped text-xs">
                            <thead>
                                <tr style="background:  rgb(16, 207, 144)">
                                    <th style="width:10px;text-align:center;" class="text-light">NO.</th>
                                    <th style="text-align:center;" class="text-light">NO. TRANSAKSI</th>
                                    <th style="text-align:center;" class="text-light">NIK/ PASSPORT</th>
                                    <th style="text-align:center;" class="text-light">NAMA PASIEN</th>
                                    <th style="text-align:center;" class="text-light">NAMA TINDAKAN</th>
                                    <th style="text-align:center;" class="text-light">NAMA FASKES</th>
                                    <th style="text-align:center;" class="text-light">TANGGAL TINDAKAN</th>
                                    <th style="text-align:center;" class="text-light">WAKTU SAMPEL</th>
                                    <th style="text-align:center;" class="text-light">HASIL TES</th>
                                    <th style="width:70px;text-align:center;" class="text-light">AKSI</th>  
                                </tr>
                            </thead>
                            <tbody>                         
                              @if (!empty($hasilAntigensFaskes))
                                @foreach($hasilAntigensFaskes as $result =>$item)
                              <tr>
                                  <td style="width:10px;text-align:center;">{{$loop->iteration}}.</td>
                                  <td style="text-align:center;">{{$item->transaksiID}}</td>
                                  <td>{{$item->nik}}</td>
                                  <td>{{$item->namaPasien}}</td>
                                  <td>{{$item->namaTindakan}}</td>
                                  <td>{{$item->name_outlet}}</td>
                                  <td>{{$item->tglTindakan}}</td>
                                  <td>{{$item->sampleTime}}</td>
                                  <td>
                                    @if($item->hasil=='Negatif')
                                       <span class="badge badge-info">Negatif</span>
                                    @elseif($item->hasil=='Positif')
                                       <span class="badge badge-danger">Positif</span>
                                    @else
                                      <span class="badge badge-warning">Waiting</span>
                                    @endif
                                  </td> 
                                  <td style="width:70px;text-align:center;">
                                    @if($item->hasil=='Negatif' || $item->hasil=='Positif')
                                        @if ($namaRole=='Superadmin') 
                                          <a href="#"><button class="btn btn-xs btn-info" title="Lihat Detail PDF"><i class="fas fa-file-pdf"></i></button></a> 
                                          <!--
                                          <a href="#"><button class="btn btn-xs btn-dark" title="Batalkan Hasil"><i style="color:#ffffff;" class="fa fa-trash fa-sm"></i></a></button></a> 
                                          -->
                                          <button class="btn btn-xs btn-dark" id="btnhapus" title="Batalkan Hasil" data-idrole="{{ $item->transaksiID }}" data-toggle="modal" data-target="#exampleModal"><i style="color:#ffffff;" class="fas fa-trash fa-sm"></i></button>  
                                        @else
                                        <a href="#"><button class="btn btn-xs btn-info" title="Lihat Detail PDF"><i class="fas fa-file-pdf"></i></button></a>  
                                        <a href="https://api.whatsapp.com/send?phone={{$item->phone}}&text=Halo%2C%20%0AYth%20Mr%2FMrs%20 {{$item->namaPasien}} .%0AKami%20dari%20Norbu%20Medika%20ingin%20memberikan%20informasi%20bahwa%20hasil%20tes%20Antigen%20sudah%20selesai.%20Silahkan%20kunjungi%20halaman%20berikut%20ini%20%3A%20%0A' . BASE_URL . 'PDF/hasil_pasien.php?idTransaction=' {{$item->transaksiID}}'%26noPasien={{$item->pasienID}} %0AGunakan%20tanggal%20lahir%20Anda%20dalam%20bentuk%20DDMM%20(dua%20digit%20tanggal%20lahir%20dan%20dua%20digit%20bulan)%20untuk%20membuka%20file%20tersebut.%0A%0ABilamana%20Anda%20membuka%20alamat%20diatas%20menggunakan%20ponsel%20tipe%20ANDROID%2C%20maka%20hasil%20test%20akan%20langsung%20terunduh%20ke%20dalam%20folder%20Document%20%2F%20Download%20di%20ponsel%20Anda" class="btn btn-success btn-xs" title="Kirim Hasil" target="blank"><i class="fab fa-whatsapp fa-md" aria-hidden="true"></i></a>                                                
                                        @endif
                                    @else
                                      <a href="#"><button class="btn btn-xs btn-warning" style="Input Hasil"><i class="fas fa-edit"></i></button></a>  
                                    @endif
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
                      <form action="{{route('hasil-tes-antigen-Faskes.store')}}" method="POST">
                        @csrf
                        <!--
                          <div class="row pb-4 pl-2">
                          -->
                          <div class="row pb-4 pl-4">
                            <div class="col-xs-4">
                              <label class="text-xs font-weight-bold">Tanggal Pertama</label>
                              <div class="input-group">
                                <input required type="date" class="form-control form-control-sm mr-3" value="" name="date_filter" >
                              </div>
                            </div>
                            <div class="col-xs-4">
                              <label class="text-xs font-weight-bold">Tanggal Kedua</label>
                              <div class="input-group">
                                <input required type="date" class="form-control form-control-sm mr-3" value="" name="date_filter2" >
                              </div>
                            </div>
                     
                           <div class="col-xs-6">
                            <label class="text-xs font-weight-bold"></label>
                            <div class="input-group">
                              <button class="btn btn-primary btn-sm" type="submit" name="submit" id="button-addon2" required><i class="fas fa-filter fa-sm"></i> Tampilkan</button>
                            </div>
                          </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="tableSamplePeriodeFaskes" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background:rgb(16, 207, 144)">
                                    <th style="width:10px;text-align:center;" class="text-light">NO.</th>
                                    <th style="text-align:center;" class="text-light">NO. TRANSAKSI</th>
                                    <th style="text-align:center;" class="text-light">NIK/ PASSPORT</th>
                                    <th style="text-align:center;" class="text-light">NAMA PASIEN</th>
                                    <th style="text-align:center;" class="text-light">NAMA TINDAKAN</th>
                                    <th style="text-align:center;" class="text-light">NAMA FASKES</th>
                                    <th style="text-align:center;" class="text-light">TANGGAL TINDAKAN</th>
                                    <th style="text-align:center;" class="text-light">WAKTU SAMPEL</th>
                                    <th style="text-align:center;" class="text-light">HASIL TES</th>
                                    <th style="width:90px;text-align:center;" class="text-light">AKSI</th>  
                                </tr>
                            </thead>
                            <tbody>                         
                              @if (!empty($hasilAntigensFaskesPeriode))
                                @foreach($hasilAntigensFaskesPeriode as $result2 =>$faskesPeriode)
                              <tr>
                                  <td>{{$loop->iteration}}.</td>
                                  <td style="width:10px;text-align:center;">{{$faskesPeriode->transaksiID}}</td>
                                  <td>{{$faskesPeriode->nik}}</td>
                                  <td>{{$faskesPeriode->namaPasien}}</td>
                                  <td>{{$faskesPeriode->namaTindakan}}</td>
                                  <td>{{$faskesPeriode->name_outlet}}</td>
                                  <td>{{$faskesPeriode->tglTindakan}}</td>
                                  <td>{{$faskesPeriode->sampleTime}}</td>
                                  <td>
                                    @if($faskesPeriode->hasil=='Negatif')
                                       <span class="badge badge-info">Negatif</span>
                                    @elseif($faskesPeriode->hasil=='Positif')
                                       <span class="badge badge-danger">Positif</span>
                                    @else
                                      <span class="badge badge-warning">Waiting</span>
                                    @endif
                                  </td> 
                                  <td style="width:90px;text-align:center;">
                                    @if($faskesPeriode->hasil=='Negatif' || $faskesPeriode->hasil=='Positif')
                                     
                                        @if ($namaRole=='Superadmin') 
                                          <a href="#"><button class="btn btn-xs btn-info" title="Lihat Detail PDF"><i class="fas fa-file-pdf"></i></button></a> 
                                          <a href="#"><button class="btn btn-xs btn-dark" title="Batalkan Hasil"><i style="color:#ffffff;" class="fa fa-trash fa-sm"></i></a></button></a>   
                                        @else
                                        <a href="#"><button class="btn btn-xs btn-info" title="Lihat Detail PDF"><i class="fas fa-file-pdf"></i></button></a>  
                                        <a href="https://api.whatsapp.com/send?phone={{$faskesPeriode->phone}}&text=Halo%2C%20%0AYth%20Mr%2FMrs%20 {{$faskesPeriode->namaPasien}} .%0AKami%20dari%20Norbu%20Medika%20ingin%20memberikan%20informasi%20bahwa%20hasil%20tes%20Antigen%20sudah%20selesai.%20Silahkan%20kunjungi%20halaman%20berikut%20ini%20%3A%20%0A' . BASE_URL . 'PDF/hasil_pasien.php?idTransaction=' {{$item->transaksiID}}'%26noPasien={{$item->pasienID}} %0AGunakan%20tanggal%20lahir%20Anda%20dalam%20bentuk%20DDMM%20(dua%20digit%20tanggal%20lahir%20dan%20dua%20digit%20bulan)%20untuk%20membuka%20file%20tersebut.%0A%0ABilamana%20Anda%20membuka%20alamat%20diatas%20menggunakan%20ponsel%20tipe%20ANDROID%2C%20maka%20hasil%20test%20akan%20langsung%20terunduh%20ke%20dalam%20folder%20Document%20%2F%20Download%20di%20ponsel%20Anda" class="btn btn-success btn-xs" title="Kirim Hasil" target="blank"><i class="fab fa-whatsapp fa-md" aria-hidden="true"></i></a>                                                
                                        @endif
                                    @else
                                      <a href="#"><button class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button></a>  
                                    @endif
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border border-danger">
      <div class="modal-header  " style="background:  rgb(16, 207, 144)" >
        <h5 class="modal-title" id="exampleModalLabel"><h2 class="text-light">Anda yakin akan membatalkan hasil tindakan ini?</h2> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ '/hasil-tes-antigen-Faskes/delete' }}" method="POST">
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
$(document).ready(function() {
  $('#dataHasilAntigenFaskes').DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": false,
        "pageLength": 10,
        "order": [
          [0, "asc"],
        ],
      }).buttons().container().appendTo('#dataHasilAntigenFaskes_wrapper .col-md-6:eq(0)'); 
} );
</script>
<script>
$(document).ready(function() {
    $('#tableSamplePeriodeFaskes').DataTable({
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
    }).buttons().container().appendTo('#tableSamplePeriodeFaskes_wrapper .col-md-6:eq(0)'); 
  });
</script>
<script>
$(document).on("click",'#btnhapus', function (e) {  
   const id_role= $(this).data('idrole');
  $('#roleid').val(id_role);
});
</script>
<script>
//redirect to specific tab
$(document).ready(function () {
  $('#tabMenu a[class="nav-link" href="#{{ old('tab') }}"]').tab('show');
});
</script>
@endsection