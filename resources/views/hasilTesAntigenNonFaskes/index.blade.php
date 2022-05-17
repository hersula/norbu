@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Sample Hasil Antigen {{session('outlet') }}</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('hasil-tes-antigen-nonFaskes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row" style="padding-right:20px;">
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
                                      <option value="" hidden>Pilih Outlet</option>
                                      @foreach($outlet as $outlet)
                                      <option style="font-size:13px;" value="{{ $outlet->id }}" {{ $outlet->name==session('outlet')?'selected':'' }}>{{ $outlet->name }}</option>
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
                        <!--end of div class="row"-->
                      
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
                          @if (!empty($hasilAntigens))
                            
                            @foreach ($hasilAntigens as $result => $item)
                           
                            
                          <tr>
                              <td style="text-align:center;">{{$item->transaksiID}}</td>
                              <td>{{$item->nik}}</td>
                              <td>{{$item->namaPasien}}</td>
                              <td>{{$item->typeTindakan}}</td>
                              <td>{{$item->namaTindakan}}</td>
                              <td>{{$item->tglTindakan}}</td>
                              <td>{{$item->namaOutlet}}</td>
                              <td>{{$item->status}}</td>
                              <td>
                             
                                @if ($item->hasil=="Negatif")
                                <span class="badge badge-info">Negatif</span>
                                @elseif ($item->hasil=="Positif") 
                                <span class="badge badge-danger">Positif</span>
                                @endif
      
                              </td>
                              <td style="text-align:center;">
                                <a href="#"><button class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i></button></a>  
                                <a href="https://api.whatsapp.com/send?phone={{$item->phone}}&text=Halo%2C%20%0AYth%20Mr%2FMrs%20 {{$item->namaPasien}} .%0AKami%20dari%20Norbu%20Medika%20ingin%20memberikan%20informasi%20bahwa%20hasil%20tes%20Antigen%20sudah%20selesai.%20Silahkan%20kunjungi%20halaman%20berikut%20ini%20%3A%20%0A' . BASE_URL . 'PDF/hasil_pasien.php?idTransaction=' {{$item->transaksiID}}'%26noPasien={{$item->pasienID}} %0AGunakan%20tanggal%20lahir%20Anda%20dalam%20bentuk%20DDMM%20(dua%20digit%20tanggal%20lahir%20dan%20dua%20digit%20bulan)%20untuk%20membuka%20file%20tersebut.%0A%0ABilamana%20Anda%20membuka%20alamat%20diatas%20menggunakan%20ponsel%20tipe%20ANDROID%2C%20maka%20hasil%20test%20akan%20langsung%20terunduh%20ke%20dalam%20folder%20Document%20%2F%20Download%20di%20ponsel%20Anda" class="btn btn-success btn-sm title="Kirim Hasil" target="blank"><i class="fab fa-whatsapp fa-md" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                   
                  </div>
                 
                </div>
               
            </div>
           
        </div>
       
    </div>
   
</div>

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