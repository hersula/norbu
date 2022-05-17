@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> Tambah Data Tindakan</h4>
                </div>
            
                <form action="{{ route('tindakan.store') }}" method="POST">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Tambah Data Tindakan</p>
                  <!-- Notifikasi menggunakan flash session data -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                    @endif

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Tindakan
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"  placeholder="Nama Tindakan"  value="{{ old('name') }}" autocomplete="off" />
                        <!-- error message untuk nama outlet -->
                        @error('name')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Jenis Tindakan
                          <span class="text-warning">*</span>
                        </label>
                        <select type="text" class="custom-select custom-select-sm" name="typeTindakan" id="typeTindakan" >
                          <option value="">--Pilih Jenis Tindakan--</option>
                          <option value="PCR">PCR</option>
                          <option value="Antigen">Antigen</option>
                          <option value="Non Result">Non Result</option>
                        </select>
                        <!-- error message untuk Jenis Tindakan -->
                        @error('typeTindakan')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                 

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Deskripsi
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" name="description" placeholder="Deskripsi Tindakan" id="description" value="{{ old('description') }}" autocomplete="off" />
                         <!-- error message untuk deskripsi tindakan -->
                        @error('description')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Jenis Spesimen
                          <span class="text-warning">*</span>
                        </label>
                        <select type="text" class="custom-select custom-select-sm" name="spesimen" id="spesimen">
                          <option value="">--Pilih Spesimen--</option>
                          <option value="nasopharyngeal">nasopharyngeal</option>
                          <option value="nasal">nasal</option>
                          <option value="nasopharyngeal & oropharyngeal">nasopharyngeal & oropharyngeal
                          </option>
                          <option value="oropharyngeal">oropharyngeal</option>
                        </select>
                        <!-- error message untuk Jenis Spesimen -->
                        @error('spesimen')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!--end of row Deskripsi Tindakan dan Jenis Spesimen-->


                <!--row outlet dan Harga -->
                  <div class="row fieldGroup">
                    <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-sm font-weight-bold">Outlet 
                        <span class="text-warning">*</span>
                      </label>
                      <select class="custom-select custom-select-sm" id="outlet" name="outlet[]">
                        <option value="">--Pilih Outlet--</option>
                        @foreach($outlet as $outlet)
                       <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <!--end of col-md-3-->

                  <div class="col-md-3">
                    <div class="form-group ">
                      <label class="text-sm font-weight-bold">Harga Per Unit Di Outlet
                      <span class="text-warning">*</span>
                      </label>
                      <input type="text" class="form-control form-control-sm  @error('price') is-invalid @enderror" name="price[]" placeholder="Harga Tindakan Di Tiap Outlet" id="price" value="{{ old('price') }}" autocomplete="off" >
                      <font color="blue">
                        <b>Contoh: 75000
                        </b>
                      </font><br/>
                    </div>
                  </div> 
                  <div class="input-group-addon" style="margin-top:30px;"> 
                    <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fas fa-plus"></i></a>
                  </div>
                </div>
                <!--end of row outlet dan Harga-->

                <!--row outlet dan Harga -->
                <div class="row fieldGroupCopy" style="display:none;">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="text-sm font-weight-bold">Outlet 
                        <span class="text-warning">*</span>
                      </label>
                      <select class="custom-select custom-select-sm" id="outlet" name="outlet[]">
                        <option value="">--Pilih Outlet--</option>
                        @foreach($gerai as $outlet)
                       <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <!--end of col-md-3-->

                  <div class="col-md-3">
                    <div class="form-group ">
                      <label class="text-sm font-weight-bold">Harga Per Unit Di Outlet
                      <span class="text-warning">*</span>
                      </label>
                      <input type="text" class="form-control form-control-sm  @error('price') is-invalid @enderror" name="price[]" placeholder="Harga Tindakan Di Tiap Outlet" id="price" value="{{ old('price') }}" autocomplete="off" >
                      <font color="blue">
                        <b>Contoh: 75000
                        </b>
                      </font><br/>
                    </div>
                  </div> 
                  <br/>
                  <div class="input-group-addon" style="margin-top:30px;"> 
                    <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fas fa-trash"></i></a>
                </div>
                </div>
                <!--end of row outlet dan Harga-->

                
                <div class="row">
                <div class="col-md-5">
                    <div class="form-group" >
                    <div class="form-control @error('isVisibleToPasien') is-invalid @enderror ">
                      <label class="text-sm font-weight-bold">
                        Dapat Dilihat Pasien?
                      <span class="text-warning">*</span>
                      </label>
                      <div class="col-md-6">
                                           
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" >
                                <div class="form-control @error('isVisibleToPasien') is-invalid @enderror ">
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="rbYa">
                                        <input type="radio" class="form-check-input" id="isVisibleToPasien" name="isVisibleToPasien"  value="1">Ya
                                        </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <div class="form-control @error('isVisibleToPasien') is-invalid @enderror ">
                            <div class="form-check-inline">
                                <label class="form-check-label" for="rbTidak">
                                <input type="radio" class="form-check-input" id="isVisibleToPasien" name="isVisibleToPasien" value="0">Tidak
                                </label>
                              </div>
                              </div>
                        </div>
                        </div>
                    </div>
                    </div>
                  </div>
            </div>
            
            </div>
                
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="far fa-save"> Simpan</i></button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('tindakan.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
                  </div>
                </form>
            </div>
             <!--end of class card-->
        </div> 
         <!--end of class="col-md-12"-->
    </div>
    <!-- end of class row-->
</div>
<!-- end of class="container-fluid mt-3"-->
<script>
  $(document).ready(function(){
  // membatasi jumlah inputan
  var maxGroup = 50;
  
  //melakukan proses multiple input 
  $(".addMore").click(function(){
      if($('body').find('.fieldGroup').length < maxGroup){
          var fieldHTML = '<div class="row fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
          $('body').find('.fieldGroup:last').after(fieldHTML);
      }else{
          alert('Maximum '+maxGroup+' groups are allowed.');
      }
  });
  
  //remove fields group
  $("body").on("click",".remove",function(){ 
      $(this).parents(".fieldGroup").remove();
  });
});
</script>
@endsection
 