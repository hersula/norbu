@extends('layouts.member')
@section('contents')

<div class="container ">
  <div class="row mt-5" >
      <div class="col-md-12">
        
            <div class="card mt-2 " style="background: hsl(0, 0%, 100%)">
              <div class="card-header">
                <h2 class=" mt-3 font-monospace" style="color: rgb(16, 207, 144)"><i class="fas fa-indent"></i> Daftar Lokasi Outlet Dan Faskes Norbu Medika</h2>

              </div>
             <div class="row ms-3  ">
               <div class="col-md-4 ">             
                <input class="form-control mt-3 " id="cari" placeholder="search...">                
              </div>
               </div>   
         @foreach ($outlet as $item)
             
         <div class="row  justify-content-center m-2" >
           <div class="col-md-12">        
             <div class="card ">
               <div class="card-body">
                 <h5 class="card-title text-success font-weight-bold">{{ $item->name }}</h5>
                 <h3 class="card-text">{{ $item->address }}</h3>
                <a href="{{ '/pendaftaran/' }}{{ $item->id.'t-kn'.$tknpasien }}"> <button class="btn    float-end" id="pilihLokasi"> <i class="fas fa-map-marker-alt text-warning"></i>Pilih Lokasi</button></a>
                </div>
              </div>      
            </div>   
          </div>          
          @endforeach              
            <div class="modal-footer">      
            </div>  
            </div>
      </div>
  </div>
</div>


@endsection