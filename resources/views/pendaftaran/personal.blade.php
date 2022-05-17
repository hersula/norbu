@extends('layouts.member')
@section('contents') 
<div class="container mt-3 ">
  <div class="row " >
      <div class="col-md-12">
        <div class="card" style="background:hsl(0, 0%, 100%)">
            <div class="card-header">
              <h2 class=" mt-3 font-monospace" style="color: rgb(16, 207, 144)"><i class="fas fa-thermometer-three-quarters "></i> Penyelidikan Epidemiologi</h3>
                
            </div>
            <form action="{{ '/carts' }}" method="POST" id="formTindakan">
              @csrf
          
            <div class="card-body">
                <h2 class="text-center">Apakah Kamu Memiliki Gejala ?</h2>
                <div class="row justify-content-center mx-3">
                    <div class="col-md-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gejala" id="iya" value="iya">
                            <label class="form-check-label" for="flexRadioDefault1" >
                              iya
                            </label>
                          </div>                 
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gejala" id="tidak"value="tidak" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Tidak
                                </label>
                            </div>
                          </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6" >
                            <div class="form-group">                                                                          
                                <h3 class="text-center m-2" id="labelGejala"></h3>
                                <div id="transition" class="transition">      
                                <div id="gejala" >
                                    <textarea class="form-control text-start border-0 d-none" id="keteranganGejala" rows="2"  name="keteranganGejala">
                                    </textarea>                         
                               </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="transitionHarga" id="transitionHarga">
                    <div  id="listHarga" class="daftar d-none">
                    <div class="row mt-2 " >
                      {{-- state value --}}
                        <span id="stateTidak" data-tidak=""></span>
                            <span id="stateiya" data-iya=""></span>
                            <span id="stateTindakan" ></span>
                        <h3 class="text-center " style="color:rgb(12, 185, 162); font-weight: bold;"><i class="fas fa-indent"></i> Daftar Paket Tes {{$keteranganTindakan}}</h3>     
                             {{-- state Value --}}
                        <input type="hidden" name="OutletID" value="{{ $outletId }}">
                        <input type="hidden" name="idTindakan" id="idTindakan">
                        <input type="hidden" name="tokenPasien" value="">
                        <input type="hidden" name="hargaTindakan" id="hargaTindakan">
                        <input type="hidden" name="registTo" value="{{ $keteranganTindakan }}">
                     @foreach ($tindakan as $item) 
                        <div class="col-md-4 mt-2" >
                          <div class="card text-center" id="daftarharga"  >
                            <div class="card-header" >
                               
                             <h3 class="fw-bold">  {{$item->name}} </h3>  
                                </div>
                                <div class="card-body" style="width:100% ;height:170px">
                                  <h5 class="card-title">RP.{{ $item->harga }}</h5>
                                  <div class="custom-control custom-checkbox mt-2" >
                                    <label class="custom-control-label" for="tindakan"> {{$item->description}}</label>
                                  </div>
                                </div>
                                <div class="card-footer " id="footHarga">
                                  <button class="btn btn-sm " id="btnSave" type="button" data-tindakanID="{{ $item->id }}"
                                   data-price="{{ $item->harga }}
                                    "><h4>Pilih Tindakan</h4> </button>                    
                                </div>
                              </div>
                        </div>                         
                                                 
                        @endforeach                     
                                               
                    </div>
                    </div>     
                </div>                
                </div>
              </form>
              <div class="card-footer">         
              </div>
            </div>      
          </div>
  </div>
</div>
<script>   
let iya=document.querySelector('#iya');
let labelGejala=document.querySelector('#labelGejala');
iya.addEventListener("change", myFunction);
function myFunction() {
    labelGejala.textContent='Jelaskan gejala yang kamu alami ?'
    let stateiya=document.querySelector('#stateiya').setAttribute('data-iya',1);
 let tidak=document.querySelector('#stateTidak').getAttribute('data-Tidak');
 if(tidak==1){

     let gejala=document.querySelector('#keteranganGejala');
     gejala.classList.toggle("d-none");
     let transitiona=document.querySelector('#transition');
     transitiona.classList.add("transitioncss");
     let transitionaHarga=document.querySelector('#transitionHarga');
     transitionaHarga.classList.add("transitionHargacss");
    }else{
        
        let gejala=document.querySelector('#keteranganGejala');
        gejala.classList.toggle("d-none");
        let transitiona=document.querySelector('#transition');
        transitiona.classList.add("transitioncss");
          let listHarga=document.querySelector('#listHarga');
          listHarga.classList.toggle("d-none");
          let transitionaHarga=document.querySelector('#transitionHarga');
     transitionaHarga.classList.add("transitionHargacss");
 }

}

let tidak=document.querySelector('#tidak');
tidak.addEventListener("change", function (e) {
    let labelGejala=document.querySelector('#labelGejala');
    labelGejala.textContent='Tidak ada Gejala'
    let gejala=document.querySelector('#gejala');
    let stateTidak=document.querySelector('#stateTidak').setAttribute('data-tidak',1);
    if (e.target.id == "tidak") {
        let iya=document.querySelector('#stateiya').getAttribute('data-iya');
        if(iya==1){
            let textGejala=document.querySelector('#keteranganGejala');
            textGejala.classList.toggle("d-none");
            let transitionaHarga=document.querySelector('#transitionHarga');
     transitionaHarga.classList.add("transitionHargacss");
            
        }else{
            let listHarga=document.querySelector('#listHarga');
           listHarga.classList.toggle("d-none");
           let transitionaHarga=document.querySelector('#transitionHarga');
     transitionaHarga.classList.add("transitionHargacss");
        }
                  
    }  
});
  </script>
  <script>
       let tindakan=document.querySelectorAll('#tindakan');
          let jmlTindakan=1;
        for(let i=0; i<tindakan.length;i++){
      tindakan[i].addEventListener('change',function(){
    let stateTindakan=document.querySelector('#stateTindakan').setAttribute('data-tindakan',jmlTindakan++);
     
         })
        }
       let save=document.querySelectorAll('#btnSave');
       for(let i=0;i<save.length;i++){

       save[i].addEventListener('click',function(e){

      let tindakanID=   save[i].getAttribute('data-tindakanID');
      let tindakanPrice=   save[i].getAttribute('data-price');
       document.querySelector('#idTindakan').value=tindakanID;
       document.querySelector('#hargaTindakan').value=tindakanPrice;
        swal({
     
						title: 'info? ',
						text: " Pastikan kembali data anda sudah benar",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes',
								className : 'btn btn-sm btnsweat'
							},
							cancel: {
								visible: true,
								text : 'Cancel',
								className: 'btn btn-danger'
							}      			
						}
					}).then((willSave) => {
						if (willSave) {                    
              let form=document.querySelector('#formTindakan');  
              form.submit();			
						} else {
							swal("Data tidak di simpan", {
                                title: 'info? ',
								buttons : {
									confirm : {
										className: 'btn btn-sm btnsweat'
									}
								}
							});
						}
					});
       })
      }
  </script>
    @endsection