@extends('layouts.member')
@section('contents')

<div class="container ">
  <div class="row mt-5" >
      <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-7">Hello, {{ session('fullName') }}</h2>
            <h3 class="text-success font-weight-bold  fst-italic">Mari bersama kita perangi covid 19 dengan tetap menjaga protokol kesehatan</h3>
            <hr class="my-2">
          </div>
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
                <button class="btn    float-end"  id="pilihLokasi"  type="button" id="pilihLokasi" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                data-idOutlet="{{ $item->id }}"
                data-nmOutlet="{{ $item->name }}"
                data-addressOutlet="{{ $item->address }}"
              
                > <i class="fas fa-map-marker-alt text-warning" ></i>  Pilih Lokasi</button>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
   
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(23, 238, 209);color:rgb(139, 135, 13);">
        <h2 class="modal-title " id="staticBackdropLabel" ><h2 id="nm"></h2></h2>    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>  
      <div class="modal-body">
        <p>  <i class="fas fa-map-marker-alt text-warning"  id="textAlamat"></i> </p>
     <div class="row mt-3">
       <div class="col-md-12">
         <h3>Pendaftaran untuk?</h3>
       </div>      
     </div>
     <div class="row mt-2">
       <div class="col-md-12">
        <form action="{{'personal'}}" method="post">
          @csrf     
          <input type="hidden" name="id_outlet" id="id_outlet">
          <input type="hidden" name="registTo" id="registTo" value="sendiiri">        
         <?php if($token===""){?>
          <button class="btn  btn-round"  id="sendiri" type="submit"  
          ><h3>Personal</h3> </button>    
          <?php } else{ ?>
            <button class="btn  btn-round"  id="sendiri" type="submit"  
            disabled>   <h3>Personal</h3> </button>      
          <?php }  ?>
        
        </form>
      </div>      
    </div>
    <div class="row mt-2">
      <div class="col-md-12">
        
          <a href="{{ '/nonPersonal/create' }}">
       <button class="btn  btn-round"  id="sendiri" type="submit"> <h3>Orang lain</h3> </button></a>
      
       </div>      
     </div>
    </div>
  </div>
</div>
<script>     
  let pilihLokasi=document.querySelectorAll('#pilihLokasi');
  for(let i=0;i<pilihLokasi.length;i++){
   pilihLokasi[i].addEventListener('click',function(){
 let alamat = pilihLokasi[i].getAttribute("data-addressOutlet");
 let nama = pilihLokasi[i].getAttribute("data-nmOutlet");
 let idOutlet = pilihLokasi[i].getAttribute("data-idOutlet");
  let textAl=document.querySelector('#textAlamat');
  let ids=document.querySelector('#id_outlet');
  ids.value=idOutlet;

  let nmOutlet=document.querySelector('#nm');
  textAl.innerHTML=alamat;
  nmOutlet.innerHTML=nama;
 
   })
  }
      </script>
@endsection