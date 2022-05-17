@extends('layouts.admin')
@section('contents') 
<div class="container-fluid mt-3">
    <div class="row" >
    <div class="col-md-12"  >
        <div class="card">
            <div class="card-header p-3">
                <h1 style="color: rgb(16, 207, 144)""> <i class="fas fa-id-card"></i> Form Pendaftaran Tes</h2>
              
            </div>
            <div class="card-body">                                        
                <form action="{{ '/faskes' }}" method="POST" id="myform">
                @csrf
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
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="passport" class="text-lg font-weight-bold">Passport (<span class="text-success">optional</span>)</label>
                            <input  id="passport" name="passport" type="passport" class="form-control input-pill "  placeholder="Identity Number (Passport)"  value="{{ old('passport') }}">
                        </div>
                    </div>
                </div>
                       
                <div class="row mt-2">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="name" class="text-lg font-weight-bold">Nama<span class="text-warning">*</span></label>
                            <input type="text" class="form-control input-pill  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="phone" class="text-lg font-weight-bold">Nomor Handphone<span class="text-warning">*</span></label>
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
                        <div class="form-group   ">          
                            <div class="form-check input-pill form-control @error('kewarganegaraan') is-invalid @enderror ">
                                <label class="text-lg font-weight-bold">Kewarganegaraan<span class="text-warning">*</span></label><br>
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
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">               
                            <div class="form-check input-pill form-control  @error('gander') is-invalid @enderror ">
                                <label class="text-lg font-weight-bold">Jenis Kelamin<span class="text-warning">*</span></label><br>
                            <label class="form-radio-label mt-3">
                                <input class="form-radio-input   " type="radio" name="gander" value="laki-laki" >
                                <span class="form-radio-sign">laki-laki</span>
                            
                            </label>
                            <label class="form-radio-label ms-5">
                                <input class="form-radio-input " type="radio" name="gander" value="perempuan">
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
                        <div class="form-group">
                            <label class="text-lg font-weight-bold" for="address">Alamat<span class="text-warning">*</span></label>
                            <input type="text" class="form-control input-pill  @error('address') is-invalid @enderror" id="address" name="Address" placeholder="addres" value="{{ old('address') }}">
                            @error('address')
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
                            <label class="text-lg font-weight-bold" for="placeOfBirth">Tempat Lahir (Kota)<span class="text-warning">*</span></label>
                            <input type="text" class="form-control input-pill  @error('placeOfBirth') is-invalid @enderror" id="placeOfBirth" placeholder="Place of Birth" name="placeOfBirth" value="{{ old('placeOfBirth') }}">
                            @error('placeOfBirth')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label class="text-lg font-weight-bold" for="dateOfBirth">Tanggal Lahir<span class="text-warning">*</span></label>
                            <input type="date" class="form-control input-pill  @error('dateOfbirth') is-invalid @enderror" id="dateOfBirth" placeholder="" name="dateOfBirth"  value="{{ old('dateOfBirth') }}">
                            @error('dateOfBirth')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                        <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Apakah Kamu Memiliki Gejala?<span class="text-warning">*</span></h5>
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
                <div class="col-md-6">
                    <div class="form-group">             
                        <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Nama Faskes<span class="text-warning">*</span></h5>
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
                <div class="col-md-6">
                    <div class="form-group">             
                        <h5 class="pl-3" style="font-weight:bold;font-size: 0.75rem;">Jenis Tindakan<span class="text-warning">*</span></h5>
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
                </div>
                <!--end of class row nama faskes dan jenis tindakan-->
                <div class="row mt-2">
                    <div class="col-md-6 mt-2">
                      <h2 style="color:rgb(16, 207, 144) "> <i class="fab fa-angellist"></i> Pernyataan Persetujuan NAR (New All Records)</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-lg font-weight-bold">
                                Data pasien setuju dimasukkan ke NAR?
                                <span class="text-warning">*</span>
                            </label>
                            <div class="col-sm-6">
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="rbYa">
                                    <input type="radio" class="form-check-input" id="isDontNAR" name="isDontNAR" value="0">Ya
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="rbTidak">
                                    <input type="radio" class="form-check-input" id="isDontNAR" name="isDontNAR" value="1">Tidak
                                    </label>
                                </div>
                            </div>
                            <!--Akhir form group Radio Button Data pasien setuju di NAR-->
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row justify-content-center  text-center m-3">
                <div class="col-md-4 mt-2">
                    <button  type="submit" id="btnSave"class="btn btn-rounded"  style="width:100%;background:rgb(16, 207, 144)" id="btnSave"> <i class="fas fa-location-arrow"></i> Kirim</button>
                </div>
            </div>                          
            </form>	      
            <div class="card-footer">
            </div>      
        </div>
    </div>
    </div>
    <!--end of div class row-->
</div>
<!--end of class="container-fluid mt-3"-->
<script>
    $(document).on("change",'#gejala', function (e) {    
        let i=$(this).val();
        if(i==='iya'){    
            let n=$('#skopGejala').show(); 
        }else{    
            let n=$('#skopGejala').hide();
        }           
    });   
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
@endsection