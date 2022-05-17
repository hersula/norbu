@extends('layouts.member')
@section('contents') 
<div class="container mt-3 ">
  <div class="row " >
      <div class="col-md-12">
        <div class="card" style="background:hsl(0, 0%, 100%)">
            <div class="card-header">
                <h2 class="font-monospace fw-bold"  style="color: rgb(23, 238, 209)"><i class="fas fa-cart-plus"></i> Pemesanan</h2>       
            </div>
          
            <div class="card-body fs-6">             
                    <div class="row mt-4 ">
                        <table class="table table-bordered text-center fs-6 ">
                            <thead>
                              <tr>
                                <th scope="col" style="background: rgb(23, 238, 209);">No</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Full Name</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Lokasi </th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Tindakan</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Harga</th>
                                <th scope="col" style="background: rgb(23, 238, 209);">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanan as $item)

                                <input type="hidden" id="harga" value="{{ $item->price }}">    
                                                          
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                 <td>{{ $item->namaPasien }}</td>
                                 <td>{{ $item->nmOutlet }}</td>
                                 <td>{{ $item->typeTindakan}}</td>
                                 <td>Rp.{{ number_format($item->price)  }}</td>
                                 <td><button class="btn btn-sm " type="button" id="btnDelete" data-cartId="{{ $item->idCart }}">Batalkan</button></td>
                                </tr>                    
                                
                                @endforeach
                                                             
                            </tbody>
                          </table>
                          <h5 class="text-end text-danger fw-bold fs-5 mr-5" id="totalGrand"></h5>
                          {{-- form checkOut --}}
                          <form action="{{ '/pemesanan' }}" method="POST">
                           @csrf
                           <input type="hidden" name="grandTotal" value="" id="grandTotal">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default" style="background: rgb(23, 238, 209);">Pilih Tanggal Tindakan</span>
                                    <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="tgl_tindakan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01" style="background: rgb(23, 238, 209);">Metode Pembayaran</label>
                                    <select class="form-select" id="inputGroupSelect01" name="metodePembayaran">
                                    <option selected hidden>Pilih</option>
                                    <option value="Transfer">Pembayaran Lainnya(Go-Pay, Transfer, dll)</option>
                                    <option value="Tunai">Tunai</option>                                  
                                    </select>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row mt-3 justify-content-center">
                            <div class="col-md-4 mt-3">             
                                <button  type="submit" class="btn btn-rounded btn-login "  style="" id="btnSave"> <i class="fas fa-location-arrow"></i> CheckOut</button>
                                
                            </div>
                        </div>
                        </form>
                        
                    </div>
                    <div class="row  justify-content-center">
                       <div class="col-md-4 mt-3">
                           <a href="{{ '/pendaftaran' }}">  <button  class="btn btn-rounded btn-login "  style="" id="tambahTindakan"> <i class="fas fa-medkit"></i> Tambahkan Tindakan Lainya</button></a> 
                       </div>
                    </div>
                    <div class="card-footer mt-2">       
                    </div>
                </div>      
            </div>     
        </div>
    </div>  
     </div>
<script>

    let harga=document.querySelectorAll('#harga');
    let stateHarga=document.querySelector('#totalGrand');
    let inputGrandTotal=document.querySelector('#grandTotal');
  let tmpHarga=[];
  
      for(let i=0;i<harga.length;i++){
        let hrg=parseInt(harga[i].value);
     tmpHarga.push(hrg)
    }
         let grandtotal=0;
            for(n=0;n<tmpHarga.length;n++){
            grandtotal+=tmpHarga[n];
            }
                  inputGrandTotal.value=grandtotal;
                 stateHarga.innerHTML=`Grand Total : Rp. ${grandtotal.toLocaleString()}`;
             let btnDelete=document.querySelectorAll('#btnDelete');
             for(let i=0;i<btnDelete.length;i++){
              btnDelete[i].addEventListener('click',function(e){
        swal({
						title: 'yakin ? ',
						text:"Pesanan akan di batalkan",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes',
								className : 'btn btn-sm btn btn-sm btnssweat'
							},
							cancel: {
								visible: true,
								text : 'Cancel',
								className: 'btn btn-sm btn-danger'
							}      			
						}
					}).then((willSave) => {
						if (willSave) {                    
                      e.preventDefault();
                      cartID=btnDelete[i].getAttribute('data-cartId');                   
                      let RequestData = new XMLHttpRequest();
                        RequestData.onreadystatechange = function () {
                            if (RequestData.readyState === 4) {
                            if (RequestData.status === 200) {
                                success(RequestData.response);
                            } else if (RequestData.status === 404) {
                                error();
                            }
                            }
                        };
                        console.log(cartID)
                        let url =`{{url('carts')  }}/${cartID}` ;
                        RequestData.open("get", url);
                        RequestData.send();     						
						} else {
							swal("Data tidak terhapus", {
                                title: 'info? ',
								buttons : {
									confirm : {
										className: 'btn btn-sm btn btn-sm btnssweat'
									}
								}
							});
						}
					});

                   });
                    }
                        function success(data) {     

                            swal("berhasil di batalkan", {
								icon: "success",
								buttons : {
									confirm : {
										className: 'btn btn btn-sm btnssweat'
									}
								}   
					});
                            setTimeout(() => {                   

                                location.reload();
                            }, 3000);                  
                    }
 
</script>
    @endsection