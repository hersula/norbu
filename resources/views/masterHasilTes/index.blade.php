@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Data Hasil Tes</h4>
                </div>
                <div class="card-body">
              
                    <div class="table-responsive">
                      <table id="dataHasilTes" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="text-align:center;font-weight: bold;">NO.</th>
                            <th style="text-align:center;font-weight:bold;">ID TRANSAKSI</th>
                            <th style="text-align:center;font-weight:bold;">NAMA PASIEN</th>
                            <th style="text-align:center;font-weight:bold;">PEMERIKSAAN</th>
                            <th style="text-align:center;font-weight:bold;">SPESIMEN</th>
                            <th style="text-align:center;font-weight:bold;">HASIL</th>
                            <th style="text-align:center;font-weight:bold;">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($hasils as $hasil)
                            <tr>
                              <td style="text-align:center;">{{$loop->iteration}}</td>
                              <td>{{$hasil->idTransaction}}</td>
                              <td>{{$hasil->name}}</td>
                              <td>{{$hasil->pemeriksaan}}</td>
                              <td>{{$hasil->spesimen}}</td>
                              <td>{{$hasil->hasil}}</td>
                              <td style="text-align:center;">
                                  <a href="{{ route('hasiltes.show', $hasil->id)}}" class="btn btn-info btn-xs" title="Lihat Data"> <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="{{ route('hasiltes.edit', $hasil->id)}}" class="btn btn-warning btn-xs"  title="Ubah Data">
                                    <i class="fas fa-edit"></i>
                                  </a>        
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--end of div class="table-responsive"> -->
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
      $('#dataHasilTes').DataTable({
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