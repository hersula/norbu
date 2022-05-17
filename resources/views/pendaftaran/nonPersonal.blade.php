@extends('layouts.member')
@section('contents') 
<div class="container mt-3 ">
  <div class="row " >
      <div class="col-md-12"  >
        <div class="card  " style="border:1px solid  rgb(23, 238, 209);">
            <div class="card-header pt-3">
                <div class="card-title " style="color: rgb(16, 207, 144)"> <i class="fas fa-id-card"></i> Pendaftaran Untuk Orang Lain</div>
            </div>
            <div class="card-body">                                        
                        <form action="{{ '/nonPersonal' }}" method="POST" id="myform">
                           
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input type="text" class="form-control input-pill  @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}">
                                            @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="name">full name</label>
                                            <input type="text" class="form-control input-pill  @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name') }}">
                                            @error('name')
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
                               <label for="address">Address</label>
                               <input type="text" class="form-control input-pill  @error('address') is-invalid @enderror" id="address" name="address" placeholder="" value="{{ old('address') }}">
                               @error('address')
                               <div class="invalid-feedback">
                                   {{ $message }}
                               </div>
                           @enderror
                           </div>
                       </div>
                       <div class="col-md-6 ">
                           <div class="form-group">
                               <label for="phone">Phone</label>
                               <input type="text" class="form-control input-pill  @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="" value="{{ old('phone') }}">
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
                                   <label for="plaseOfbirth">Place Of birth</label>
                                   <input type="text" class="form-control input-pill  @error('placeOfbirth') is-invalid @enderror" id="plaseOfbirth" placeholder="" name="placeOfbirth" value="{{ old('placeOfbirth') }}">
                                   @error('placeOfbirth')
                                   <div class="invalid-feedback">
                                       {{ $message }}
                                   </div>
                               @enderror
                               </div>

                           </div>
                           <div class="col-md-6 ">
                               <div class="form-group">
                                   <label for="dateOfBirth">Date Of birth</label>
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
                            <label>Jenis kelamin</label><br>
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
                    <div class="form-group   ">          
                        <div class="form-check input-pill form-control @error('kewarganegaraan') is-invalid @enderror ">
                            <label>Kewarganegaraan</label><br>
                            <label class="form-radio-label mt-3">
                                <input class="form-radio-input " type="radio" name="kewarganegaraan" value="WNI" >
                                <span class="form-radio-sign">WNI</span>
                            </label>
                            <label class="form-radio-label ms-5">
                                <input class="form-radio-input" type="radio" name="kewarganegaraan" value="WNA">
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
                        <label for="passport" class="placeholder">Passport (<span class="text-success">optional</span> )</label>
                        <input  id="passport" name="passport" type="passport" class="form-control input-pill "  value="{{ old('passport') }}">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pillSelect">Country</label>
                        <select class="form-control input-pill  @error('country') is-invalid @enderror" id="country" name="country">
                            <div class="form-control input-pill " >
                                <option hidden>pilih</option>
                                <option value="indonesia" class="bg-white border-0" style="">Indonesia</option>                 
                            </div>
                        </select>
                        @error('country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
        
                    </div>
                </div>
              
            </div>     
          </div>
          <div class="row m-3 justify-content-center  text-center">
            <div class="col-md-3 ">
                <button  type="submit" class="btn btn-rounded btn-login "  style="" id="btnSave"> <i class="fas fa-location-arrow"></i> Send</button>
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
    @endsection