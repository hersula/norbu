@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Lihat Data Outlet</h4>
                </div>
             
                <form action="{{ route('outlet.update', $outlet->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Lihat Data Outlet</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Outlet
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" name="namaOutlet" id="namaOutlet" class="form-control form-control-sm @error('namaOutlet') is-invalid @enderror"  placeholder="Nama Outlet"  value="{{ old('namaOutlet', $outlet->name) }}" autocomplete="off" />
                       
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Nomor Telepon
                         <!--
                         <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" id="phone" name="phone"  class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="Nomor Telepon" autocomplete="off" value="{{ old('phone', $outlet->phone) }}"/>
                      
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Alamat Outlet
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" placeholder="Alamat Outlet" id="address" value="{{ old('address', $outlet->address) }}" autocomplete="off" />
                        
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group" >
                      <div class="form-control @error('isFaskes') is-invalid @enderror ">
                        <label class="text-sm font-weight-bold">
                          Termasuk Faskes?
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <div class="col-sm-6">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbYa">
                            <input disabled type="radio" class="form-check-input" id="isFaskes" name="isFaskes"  value="1"  {{ $outlet->isFaskes == 1 ? 'checked':'' }}>Ya
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbTidak">
                            <input disabled type="radio" class="form-check-input" id="isFaskes" name="isFaskes" value="0"  {{ $outlet->isFaskes == 0 ? 'checked':'' }}>Tidak
                            </label>
                          </div>
                        </div>
                        <!-- error message untuk isFaskes -->
                        @error('isFaskes')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      </div>
                      <!--Akhir form group Radio Button isFaskes-->
                    </div>
                  </div>
                  <!--end of row alamat dan isFaskes-->
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <a class="btn btn-secondary btn-sm" href="{{ route('outlet.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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
@endsection