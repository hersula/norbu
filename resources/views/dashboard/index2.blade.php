@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
	<div class="card">
        <div class="card-header">
            <h4 style="font-weight:bold;">Dashboard</h4>
        </div>
		<br/>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body bg-info">
								<div class="row align-items-center">
									<div class="col-8">
										@foreach($jml_trx_open as $jmlOpen)
										<h1 class="text-c-purple">{{$jmlOpen->count_trx_open}}
										</h1>
										@endforeach
										<p class="card-category" 
											style="color:#000000;font-size:20px;">Open
										</p>
									</div>
									<div class="col-4 text-right" style="font-size:62px">
										<i class="ion-ios-cart-outline"></i>
									</div>
								</div>
							</div>
							<a href="" class="small-box-footer" style="text-align:center;">More info
								<i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body bg-success">
								<div class="row align-items-center">
									<div class="col-8">
										@foreach($jml_trx_paid as $Paid)
										<h1 class="text-c-purple">{{$Paid->count_trx_paid}}
										</h1>
										@endforeach
										<p class="card-category" 
											style="color:#000000;font-size:20px;">Paid
										</p>
									</div>
									<div class="col-4 text-right" style="font-size:62px;">
										<i class="ion-cash"></i>
									</div>
								</div>
							</div>
							<a href="" class="small-box-footer" style="text-align:center;">More info
								<i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body bg-warning">
								<div class="row align-items-center">
									<div class="col-8">
										@foreach($jml_trx_onprocess as $onProcess)
										<h1 class="text-c-purple">{{$onProcess->count_trx_onprocess}}
										</h1>
										@endforeach
										<p class="card-category" 
											style="color:#000000;font-size:20px;">On Process</p>
									</div>
									<div class="col-4 text-right" style="font-size:62px;">
										<i class="ion-checkmark"></i>
									</div>
								</div>
							</div>
							<a href="" class="small-box-footer" style="text-align:center;">More info
								<i class="ion-ios-checkmark"></i>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card card-stats card-round">
							<div class="card-body bg-secondary">
								<div class="row align-items-center">
									<div class="col-8">
										@foreach($jml_trx_close as $Close)
										<h1 class="text-c-purple">{{$Close->count_trx_close}}
										</h1>
										@endforeach
										<p class="card-category" 
											style="color:#000000;font-size:20px;">Close</p>
									</div>
									<div class="col-4 text-right" style="font-size:62px;">
										<i class="ion-android-remove-circle"></i>
									</div>
								</div>
							</div>
							<a href="" class="small-box-footer" style="text-align:center;">More info
								<i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</div>
				<br/><br/>
				<!-- Main row -->
				<div class="row">
				  <div class="col-md-12">
					<div class="card">
						<div class="card-body">
							
							<h3 class="m-0 pb-4 font-weight-bold">Laporan Transaksi {{ $getOutletLapTrx}}</h3>
							
							<form action="{{ route('dashboard.store') }}" method="POST">
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
											<select name="selected_outlet" id="selected_outlet" class="custom-select custom-select-sm mr-3">
												<option style="font-size:13px;" value="0" {{ Request::get('selected_outlet')==0 ?'selected':'' }}>Semua Outlet</option>
												@foreach($outlet as $outlet)
												@if ($outlet->id==Request::get('selected_outlet')) 
												<option style="font-size:13px;" value="{{ $outlet->id }}" {{ $outlet->id==Request::get('selected_outlet')?'selected':'' }}>{{ $outlet->name }}</option>
												@elseif (Request::get('selected_outlet')=='')
												<option style="font-size:13px;" value="{{ $outlet->id }}" {{ $outlet->id==session('idOutlet')?'selected':'' }}>{{ $outlet->name }}</option>
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
								<table id="dataLaporanTransaksi" class="table table-bordered table-striped ">
									<thead>
										<tr style="background:  rgb(16, 207, 144)">
											<th class="text-light">NO.</th>
											<th class="text-light">NAMA PASIEN</th>
											<th class="text-light">JENIS TINDAKAN</th>
											<th class="text-light">NAMA OUTLET</th>
											<th class="text-light">METODE PEMBAYARAN</th>
											<th class="text-light">TANGGAL TINDAKAN</th>
											<th class="text-light">STATUS</th>
											<th class="text-light">HARGA SATUAN</th>
											<th class="text-light">DISCOUNT</th>
											<th class="text-light">TAX</th>
											<th class="text-light">TOTAL HARGA</th>
										</tr>
									</thead>
									<tbody>
									@if (!empty($laporanTransaksi))
										@foreach($laporanTransaksi as $item)
									  <tr>
										  <td style="text-align:center;">{{$loop->iteration}}.</td>
										  <td>{{$item->name_pasien}}</td>
										  <td>{{$item->jenis_tindakan}}</td>
										  <td>{{$item->namaOutlet}}</td>
										  <td>{{$item->namePayment}}</td>
										  <td>{{$item->tglTindakan}}</td>
										  <td>{{$item->status}}</td>
										  <td>{{$item->price}}</td>
										  <td style="text-align:right;">{{$item->totalDisc}}%</td>
										  <td style="text-align:right;">{{$item->Tax}}</td>
										  <td>@currency($item->grandTotal)</td>
										</tr>
										@endforeach
									@endif
									</tbody>
									<tfoot>
										<tr>
											<td colspan="9"><center><label style="visibility: hidden;">&nbsp;</label></center></td>
											<td style="font-weight:bold;"><center>TOTAL</center></td>
											@if (!empty($laporanTransaksi))
												@foreach($totalLaporanTransaksiOutlet as $grandTot)
											<td class="text-right"><h4 style="font-weight:bold;">@currency($grandTot->Total)</h4></td>
												@endforeach
											@endif
										</tr>
									</tfoot>
								</table>
							  </div>
							  <!--end of div class="table-responsive"> -->
						</div>
						<!-- /.card-body -->
					</div>
				  </div>
				   <!--/.col -->
				</div>
				 <!--/.row -->
				 <div class="row">
				  <div class="col-md-12">
					<div class="card">
						<div class="card-body">
						
							<h3 class="m-0 pb-4 font-weight-bold">Laporan Transaksi Tindakan {{session('outlet')}}</h3>
			
							<div class="table-responsive">
								<table id="dataLaporanTindakan" class="table table-bordered table-striped ">
									<thead>
										<tr style="background:  rgb(16, 207, 144)">
											<th class="text-light" style="text-align:center;">NO.</th>
											<th class="text-light" style="text-align:center;">JENIS TINDAKAN</th>
											<th class="text-light" style="text-align:center;">JUMLAH TINDAKAN</th>
											<th class="text-light" style="text-align:center;">TOTAL HARGA</th>
										</tr>
									</thead>
									<tbody>
									@if (!empty($laporanTransaksi))
										@foreach($getLaporanGrupTindakan as $hasilGrupTindakan)
										<tr>
											<td>{{$loop->iteration}}.</td>
											<td>{{$hasilGrupTindakan->nama_tindakan}}</td>
											<td style="text-align:center;">{{$hasilGrupTindakan->totalTindakan}}</td>
											<td class="text-right">@currency($hasilGrupTindakan->totalPrice)</td>
										</tr>
										@endforeach
									@endif
									</tbody>
								</table>
							  </div>
							  <!--end of div class="table-responsive"> -->
							<!--end of class table-responsive-->
						</div>
						<!-- /.card-body -->
					</div>
				  </div>
				   <!--/.col -->
				</div>
				 <!--/.row -->
				 <!--/.row -->
				 <div class="row">
				  <div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<h3 class="m-0 pb-4 font-weight-bold">Laporan Transaksi Pembayaran {{session('outlet')}}</h3>
							<div class="table-responsive">
								<table id="dataLaporanPembayaran" class="table table-bordered table-striped text-xs">
									<thead>
										<tr style="background:  rgb(16, 207, 144)">
											<th class="text-light" style="text-align:center;">NO.</th>
											<th class="text-light" style="text-align:center;">JENIS PEMBAYARAN</th>
											<th class="text-light" style="text-align:center;">JUMLAH</th>
											<th class="text-light" style="text-align:center;">TOTAL HARGA</th>
										</tr>
									</thead>
									<tbody>
									@if (!empty($laporanTransaksi))
										@foreach($getLaporanGrupPembayaran as $hasilGrupPembayaran)
											<tr>
												<td>{{$loop->iteration}}.</td>
												<td>{{$hasilGrupPembayaran->nama_payment}}</td>
												<td style="text-align:center;">{{$hasilGrupPembayaran->totalPayment}}</td>
												<td class="text-right">@currency($hasilGrupPembayaran->totalPrice)</td>
											</tr>
										@endforeach
									@endif
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
				  </div>
				   <!--/.col -->
	
				   <div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<h3 class="m-0 pb-4 font-weight-bold">Laporan Transaksi Status {{session('outlet')}}</h3>
							<div class="table-responsive">
								<table id="dataLaporanStatus" class="table table-bordered table-striped text-xs">
									<thead>
										<tr style="background:  rgb(16, 207, 144)">
											<th class="text-light" style="text-align:center;">NO.</th>
											<th class="text-light" style="text-align:center;">JENIS STATUS</th>
											<th class="text-light" style="text-align:center;">JUMLAH</th>
										</tr>
									</thead>
									<tbody>
									@if (!empty($laporanTransaksi))
										@foreach($getLaporanGrupStatus as $hasilGrupStatus)
										<tr>
											<td>{{$loop->iteration}}.</td>
											<td>{{$hasilGrupStatus->nama_status}}</td>
											<td style="text-align:center;">{{$hasilGrupStatus->totalStatus}}</td>
										</tr>
										@endforeach
									</tbody>
									@endif
								</table>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
				  </div>
				   <!--/.col -->
				</div>
				 <!--/.row -->
			</div><!-- /.container-fluid -->
		</section>        
	</div>      
</div>
 
  <!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content text-center">
			<div class="modal-header " style="background:rgb(13, 225, 179) ">
		
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			 <form action="">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<h3 class="m-2">Pilih Outlet</h3>
						<select class="form-control   @error('outlet') is-invalid @enderror" id="outlet" name="outlet">						
							<option hidden value="">--Pilih--</option>   
							   
						</select>
				</div>
				</div>
			</div>
			 </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn btn-sm" data-dismiss="modal" style="background: rgb(225, 200, 13)">Cancel</button>
				<button type="button" class="btn btn btn-sm" style="background: rgb(13, 225, 179)">Ubah Outlet</button>
			</div>
		  </div>
		</div>
	  </div>
<script>
	$(document).ready(function() {
		$('#dataLaporanTransaksi').DataTable({
			"responsive": true,
			"autoWidth": false,
			"lengthChange": false,
			"pageLength": 10,
			"order": [
			[0, "asc"],
			],
			dom: "Blfrtip",
			buttons: [
                    {
                        text: '<i class="fas fa-file-excel text-green fa-fw"></i> Excel',
						className: 'btn btn-secondary',
                        extend: 'excelHtml5',
						title: 'LAPORAN TINDAKAN',
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
						className: 'btn btn-secondary',
                        extend: 'pdfHtml5',
						title: 'LAPORAN TINDAKAN',
						orientation: 'landscape',
						pageSize: 'LEGAL'
                    },
                     
                ],
			
      }).buttons().container().appendTo('#dataLaporanTransaksi_wrapper .col-md-6:eq(0)'); 
	});
</script>
<script>
	 $('#dataLaporanTindakan').DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": false,
        "pageLength": 10,
        "order": [
          [0, "asc"],
        ],
      }).buttons().container().appendTo('#dataLaporanTindakan_wrapper .col-md-6:eq(0)'); 
</script>	
<script>
	$('#dataLaporanPembayaran').DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": false,
        "pageLength": 10,
        "order": [
          [0, "asc"],
        ],
      }).buttons().container().appendTo('#dataLaporanPembayaran_wrapper .col-md-6:eq(0)'); 
</script>
<script>
	$('#dataLaporanStatus').DataTable({
        "responsive": true,
        "autoWidth": false,
        "lengthChange": false,
        "pageLength": 10,
        "order": [
          [0, "asc"],
        ],
      }).buttons().container().appendTo('#dataLaporanStatus_wrapper .col-md-6:eq(0)'); 
</script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
@endsection