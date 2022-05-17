@extends('layouts.admin')
@section('contents') 
<div class="container-fluid mt-3 ">
    
  <div class="row" >
    <meta name="csrf-token" content="{{ csrf_token() }}" />
      <div class="col-md-12"  >
        <div class="card" style="border:1px solid rgb(16, 207, 144) ">
            <div class="card-header p-3">
                <h2 style="color: rgb(16, 207, 144)"> <i class="fas fa-id-card"></i> Form Pendaftaran Tes</h2>
              
            </div>
            <div class="card-body">                                        
                        <form action="{{ route('rawatjalan.store') }}" method="POST" id="myform">
                                @csrf
                            <div class="alert alert-info d-none" role="alert" id='alertdatapasien'>
                                Data pasien ditemukan ...
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label class="text-lg font-weight-bold" for="nik">NIK (Nomor Induk Kependudukan)</label>
                                            <input type="text" class="form-control input-pill  @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" placeholder="Identity Number (KTP/Passport)">
                                            @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label class="text-lg font-weight-bold" for="name">Nama</label>
                                            <input type="text" class="form-control input-pill  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" id="name">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                    </div>
                                </div>
                       
                   <div class="row mt-2">
                       <div class="col-md-6 ">
                           <div class="form-group">
                               <label class="text-lg font-weight-bold" for="address">Alamat</label>
                               <input type="text" class="form-control input-pill  @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address" value="{{ old('address') }}" id="addres">
                               @error('address')
                               <div class="invalid-feedback">
                                   {{ $message }}
                               </div>
                           @enderror
                           </div>
                       </div>
                       <div class="col-md-6 ">
                           <div class="form-group">
                               <label class="text-lg font-weight-bold" for="phone">Nomor Handphone</label>
                               <input type="text" class="form-control input-pill  @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Example:081398xxxx" value="{{ old('phone') }}">
                               @error('phone')
                               <div class="invalid-feedback">
                                   {{ $message }}
                               </div>
                           @enderror
                           </div>      
                       </div>
                       </div> 
                       <div class="row mt-3">
                           <div class="col-md-6 ">
                               <div class="form-group">
                                   <label class="text-lg font-weight-bold" for="plaseOfbirth">Tempat Lahir (Kota)</label>
                                   <input type="text" class="form-control input-pill  @error('placeOfbirth') is-invalid @enderror" id="plaseOfbirth" placeholder="Place of Birth (City)" name="placeOfbirth" value="{{ old('placeOfbirth') }}">
                                   @error('placeOfbirth')
                                   <div class="invalid-feedback">
                                       {{ $message }}
                                   </div>
                               @enderror
                               </div>

                           </div>
                           <div class="col-md-6 ">
                               <div class="form-group">
                                   <label class="text-lg font-weight-bold" for="dateOfBirth">Tanggal Lahir</label>
                                   <input type="date" class="form-control input-pill  @error('dateOfbirth') is-invalid @enderror" id="dateOfBirth" placeholder="" name="dateOfbirth"  value="{{ old('dateOfbirth') }}">
                                   @error('dateOfbirth')
                                   <div class="invalid-feedback">
                                       {{ $message }}
                                   </div>
                               @enderror
                               </div>

                           </div>
                       </div>
            <div class="row  mt-3">
                <div class="col-md-6">
                    <div class="form-group   ">               
                        <div class="form-check input-pill form-control  @error('gander') is-invalid @enderror ">
                            <label class="text-lg font-weight-bold">Jenis Kelamin</label><br>
                        <label class="form-radio-label mt-3">
                            <input class="form-radio-input" type="radio" name="gander" value="laki-laki" id="laki-laki" >
                            <span class="form-radio-sign">laki-laki</span>
                        
                        </label>
                        <label class="form-radio-label ms-5">
                            <input class="form-radio-input " type="radio" name="gander" value="perempuan" id="perempuan">
                            <span class="form-radio-sign">perempuan</span>
                        </label>               
                    </div>   
                    @error('gander')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group   ">          
                        <div class="form-check input-pill form-control @error('kewarganegaraan') is-invalid @enderror ">
                            <label class="text-lg font-weight-bold">Kewarganegaraan</label><br>
                            <label class="form-radio-label">
                                <input class="form-radio-input " type="radio" name="kewarganegaraan" value="WNI" id="WNI">
                                <span class="form-radio-sign">WNI</span>
                            </label>
                            <label class="form-radio-label ml-3">
                                <input class="form-radio-input" type="radio" name="kewarganegaraan" value="WNA" id="WNA">
                                <span class="form-radio-sign">WNA</span>
                            </label>
                        </div>
                        @error('kewarganegaraan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row  mt-3">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="passport" class="text-lg font-weight-bold">Passport (<span class="text-success">optional</span>)</label>
                        <input  id="passport" name="passport" type="passport" class="form-control input-pill " placeholder="Identity Number (Passport)" value="{{ old('passport') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-lg font-weight-bold" for="country">Country</label>
                        <input type="text" class="form-control  input-pill" id="isWni" placeholder="" name="country[]">
                        <div  id="isWna" style="display:none;">          
                            <select class=" form-control  input-pill" name="country[]">
                                <option hidden_value>Country</option>
                                @foreach ($country as $item)         
                                <option  class="bg-white border-0" style="" value="{{ $item->id }}">{{ $item->country_name }}</option>                 
                                @endforeach              
                            </select>   
                        </div>     
                    </div>
                </div>
            </div>     
          <div class="row mt-3   p-2" >
              <div class="col-md-12">
                  <h2 style="color:rgb(16, 207, 144) " > <i class="fas fa-thermometer-three-quarters "></i> Penyelidikan Epidemologi</h2>

              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Apakah Kamu Memiliki Gejala?</h5>

              </div>
          </div>
          <div class="row ">      
          <div class="col-md-6">
              <div class="form-group">             
                <select class="form-control   @error('gejala') is-invalid @enderror" id="gejala" name="gejala">                 
                        <option hidden>Pilih Pernyataan</option>
                        <option value="iya" style="">Iya</option>                 
                        <option value="tidak"  style="">Tidak</option>                                   
                </select>
                @error('gejala')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            </div>
        </div>
          </div>

          <div class="row mt-2 " id="skopGejala" style="display: none">
              <div class="col-md-6">
                  <div class="form-group">                 
                    <label class="text-lg font-weight-bold" for="ketGejala">Jelaskan gejala yang pasien alami !</label>
                    <textarea class="form-control" id="ketGejala" rows="2">
                    </textarea>
                </div>
              </div>
          </div>
          <div class="row mt-2">
              <div class="col-md-6 mt-2">
                <h2 style="color:rgb(16, 207, 144) "> <i class="la flaticon-list"></i> Data Transaksi</h2>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">             
                    <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Nama Outlet/Faskes</h5>
                    <select class="form-control   @error('outletID') is-invalid @enderror" id="outletID" name="outletID">                 
                        <option hidden>Pilih Outlet</option>
                        @foreach ($outlet as $item)    
                        <option value="{{ $item->id }}"  {{ $item->name==$sesOutlet  ? 'selected' : '' }}>{{ $item->name }}</option> 
                        @endforeach                                 
                    </select>
                    @error('outletID')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                       @enderror
    
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">             
                    <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Jenis Tindakan</h5>
                    <select class="form-control   @error('tindakanID') is-invalid @enderror" id="tindakanID" name="tindakanID">                                                 
                        <option value="">Pilih Tindakan</option>
                        @foreach ($tindakan as $item1)    
                        <option value="{{ $item1->id }}">{{ $item1->jenis_tindakan}}</option> 
                        @endforeach   
                    </select>
                    @error('tindakanID')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                       @enderror
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">             
                    <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Diskon (Nominal)</h5>
                    <input type="text" class="form-control   @error('dicon') is-invalid @enderror" id="discon" placeholder="Contoh:100000" name="discon" value="{{ old('discon') }}" onkeyup="testPrice()">
                    @error('discon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                       @enderror
    
                </div>
                  
              </div>
              <div class="col-md-2">
                <div class="form-group">             
                    <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Pajak (%)</h5>
                    <input type="text" class="form-control   @error('pajak') is-invalid @enderror" id="pajak" name="pajak" value="{{ old('pajak') }}" onkeyup="testPrice()">
                    @error('pajak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                       @enderror
    
                </div>
                  
              </div>
          </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h4 class="m-2" style="font-weight:bold;font-size: 0.75rem;">Type Pembayaran</h4>
                        <select class="form-control   @error('paymentType') is-invalid @enderror" id="paymentType" name="paymentType">
                            <option hidden>Pilih Pembayaran</option>
                            @foreach ($tipepembayaran as $item)         
                            <option  class="bg-white border-0" style="" value="{{ $item->id }}">{{ $item->namePayment }}</option>                 
                            @endforeach                 
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="penjelasanBillTo" style="display:none;">
                        <label class="text-lg font-weight-bold" for="ketPembayaranCityLedger">Pembayaran City Ledger Untuk </label>
                      <input type="text" class="form-control" id="billTo" name="billTo" placeholder="Pembayaran Untuk" {{ old('billTo') }}/>
                    </div>
                </div>
            </div>
          
          <div class="row">
              <div class="col-md-6 mt-2">
              </div>
          </div>
          <div class="row mt-3">
              <div class="col-md-6 mt-2">           
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             <h3 style="font-weight:bold;font-size: 0.75rem;">SubTotal</h3> 
                              <span class="btn btn-sm-secondary"><h3 id="textprice">Rp </h3></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                           
                            <h3 style="font-weight:bold;font-size: 0.75rem;"> Tax</h3>
                              <span class="btn btn-sm-secondary"><h3 id="textTax">Rp </h3></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h3 style="font-weight:bold;font-size: 0.75rem;" >Discount</h3>
                             
                              <span class="btn btn-sm-secondary"><h3 id="textdiskon">Rp </h3></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h3 style="font-weight:bold;font-size: 0.75rem;">Total</h3>
                           
                              <span class="btn btn-sm-secondary"><h3 id="texthasil">Rp </h3></span>
                            </li>
                          </ul>
                    
              </div>
          </div>
             
        </div>
        </div>
          <div class="row justify-content-center  text-center m-3">
            <div class="col-md-4 mt-2">
                <button  type="button" id="btnSave"class="btn btn-rounded "  style="width:100%;background:rgb(16, 207, 144)" id="btnSave"> <i class="fas fa-location-arrow"></i> Kirim</button>
            </div>
        </div>                          
      </form>	      
      <div class="card-footer">  
    </div>      
     </div>
    </div>
    </div>
  </div>
</div>
<script>
// event
$(document).on("change",'#gejala', function (e) {    
    let i=$(this).val();
    if(i==='iya'){    
        let n=$('#skopGejala').show(); 
    }else{    
        let n=$('#skopGejala').hide();
    }           
});   
$(document).on("change",'#outlet', function (e) {   
    $('#jTindakan')
                .empty(); 
    let outletID=$(this).val();
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/requestTindakan",
        data:{
          outlet_id:outletID,        
          _token: _token
                },
                dataType: "JSON",
                success: function(data) {
                    $('#jTindakan').append($('<option>', { 
                        value: 'hidden',
                        text :'Pilih Tindakan' 
                    }));
                    dataT=data.data;                
                        $.each(dataT, function (i, item) {
                        $('#jTindakan').append($('<option>', { 
                            value: item.idList_tindakan,
                            text : item.name 
                        }));
                        
                    });                                     
                }
    });               
});   
// eventRequestData
$(document).on("change",'#nik', function (e) {    
  let nikPasien=$(this).val()
  console.log(nikPasien)
  let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/requestPasien",
        data:{
          pasien_id:nikPasien,        
          _token: _token
        },
        dataType: "JSON",
        success: function(data) {
            dataP=data.data;
            $('#name').val(dataP.name);
            $('#address').val(dataP.address);
            $('#email').val(dataP.email);
            $('#phone').val(dataP.phone);
            $('#dateOfBirth').val(dataP.dateOfBirth);
            $('#plaseOfbirth').val(dataP.placeOfBirth);
            $('#passport').val(dataP.passport);
            if(dataP.gender=="Laki-laki"){
            $('#laki-laki').attr('checked', true);  
            }else{
            $('#perempuan').attr('checked', true);  
            }
            if(dataP.isWNA==0){
            $('#WNI').attr('checked', true);  
            }else{
            $('#WNA').attr('checked', true);  
            }
            $('#isWni').val(dataP.country);  
        }
    });                    
});      
  
$(document).on("change",'#jTindakan', function (e) {    
    let idTindakan=$(this).val() 
    let _token   = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        type: "post",
        url: "/requestListTindakan",
        data:{
          list_id:idTindakan,        
          _token: _token
        },
        dataType: "JSON",
            success: function(data) {
                $('#hrgTindakan').text(`Rp. ${data.data.price.toLocaleString()}`)
                $('#grandTotal').text(`Rp. ${data.data.price.toLocaleString()}`)                                    
        }
    });
                           
});  
</script>
<script>  
$(document).ready(function () {   
    $('#btnSave').click(function(e) {
        swal({
            title: 'yakin? ',
            text: "Data anda sudah benar",
            type: 'warning',
            buttons:{
                confirm: {
                    text : 'Yes',
                    className : 'btn btnsweat btn-sm'
                },
                cancel: {
                    visible: true,
                    text : 'Cancel',
                    className: 'btn btn-danger btn-sm'
                }      			
            }
        }).then((willSave) => {
        
            if (willSave) {                    
                formSubmit(e);						
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
    });
    
        function formSubmit(e){            
        $('#myform').submit();     
        e.preventDefault()                 
        }
        });
</script>
 @if(session('error'))
<script>
    swal("{{ session('error') }}", {
                icon : "error",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-danger'
                    }
                },
    });
</script>
@endif
<script>
    $(document).ready(function () {
        $("#WNI").change(function() {
            let CountryWni = $("#WNI").val();           
        if(CountryWni=="WNI"){
            $("#isWni").val("indonesia").show();
                $("#isWna").hide();                                                                    
        }                    
        });
        $("#WNA").change(function() {
            let CountryWna = $("#WNA").val();  
            if(CountryWna=="WNA"){
            $("#isWni").hide();
                $("#isWna").val("").trigger('change').show();                                        
            }            
        });
    });
</script>
<script>
    $(document).ready(function () {
       $("#WNI").change(function() {
           let CountryWni = $("#WNI").val();           
           if(CountryWni=="WNI"){
           $("#isWni").val("Indonesia").show();
               $("#isWna").hide();    
           }                    
       });
       $("#WNA").change(function() {
           let CountryWna = $("#WNA").val();  
           if(CountryWna=="WNA"){
           $("#isWni").hide();
               $("#isWna").val("").trigger('change').show();                   
           }            
       });
   });
   $('.select2bs4').select2({
           theme: 'bootstrap4',
           width: 'null',
       });
</script>
<script>
$(document).ready(function(){
    $("#paymentType").change(function() {
      var selectedPayment= $(this).val();
      if($(this).val() == "5"){
          $("#penjelasanBillTo").show();
      }else {
          $("#penjelasanBillTo").hide();
      }
    });
  });
  function testPrice() {
      var valOutletID = $(".outletID option:selected").val();
      var valIdTindakan = document.getElementById('tindakanID').value;
      var valueTextPrice = document.getElementById('textprice');
      var el1 = document.getElementById("textdiskon");
      var val = $("input[id='tax']").val() 
      var el2 = document.getElementById("discon").val == '' ? '0' : document.getElementById("discon");
      el1.innerHTML = new Intl.NumberFormat('id-ID').format(el2.value);
      var textHasil = document.getElementById('texthasil');
      $.ajax({
        type: "POST",
        url: "{{ url('displayPrice') }}"
        data: {
          jTindakan: valIdTindakan,
          outlet: valOutletID
        }
      }).done(function(data) {
        valueTextPrice.innerHTML = new Intl.NumberFormat('id-ID').format(data);
        var val2 = document.getElementById("textTax");
        var price = data;
        var diskon = el2.value == '' ? '0' : el2.value;
        var tax = val == '' ? 0 : parseInt(val)/100;
        var hasil = parseInt(price) + parseInt(price * tax) - parseInt(diskon);
        
        val2.innerHTML = !isNaN(parseInt(price * tax)) ? Intl.NumberFormat('id-ID').format(parseInt(price * tax)) : 0;
        
        textHasil.innerHTML = !isNaN(hasil) ? new Intl.NumberFormat('id-ID').format(parseInt(hasil)) : new Intl.NumberFormat('id-ID').format(parseInt(data));
      });

    }
</script>
@endsection


    