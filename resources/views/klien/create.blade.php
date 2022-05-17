@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Tambah Data Klien</h4>
                </div>
            
                <form action="{{ route('klien.store') }}" method="POST">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Tambah Data Klien</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Klien
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="nameClient" id="nameClient" class="form-control form-control-sm @error('nameClient') is-invalid @enderror"  placeholder="Nama Klien"  value="{{ old('nameClient') }}" autocomplete="off" />
                        <!-- error message untuk nama klien -->
                        @error('nameClient')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                          <label class="text-sm font-weight-bold">Alamat
                          <span class="text-warning">*</span>
                          </label>
                          <input type="text" name="address" id="address" class="form-control form-control-sm @error('address') is-invalid @enderror"  placeholder="Alamat Klien"  value="{{ old('address') }}" autocomplete="off" />
                          <!-- error message untuk alamat klien -->
                          @error('address')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                    <!--end of cold-md-6-->
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Tipe Klien<span class="text-warning">*</span></label>
                        <select type="text" class="custom-select custom-select-sm" name="typeClientID" id="typeClientID">
                          <option style="font: size 13px;" value="">--Pilih Tipe Klien--</option>
                          @foreach($tipeklien as $tipekliens)
                          <option style="font-size:13px;" value="{{ $tipekliens->id }}">{{ $tipekliens->nameType }}</option>
                          @endforeach
                        </select>
                        <!-- error message untuk tipe klien -->
                        @error('typeClientID')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of col-md-6-->
                    <div class="col-md-6">
                        <div class="form-group ">
                          <label class="text-sm font-weight-bold">Nomor Telepon
                          <span class="text-warning">*</span>
                          </label>
                          <input type="text" name="phone" id="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror"  placeholder="Nomor Telepon"  value="{{ old('phone') }}" autocomplete="off" />
                          <!-- error message untuk nomor telepon -->
                          @error('phone')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                      </div>
                  </div>
                  <!--end of row tipe klien dan nomor telepon-->
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="far fa-save"> Simpan</i></button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('klien.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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


