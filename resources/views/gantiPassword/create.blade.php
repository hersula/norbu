@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> Ubah Password Karyawan</h4>
                </div>
            
                <form action="{{ route('gantiPassword.store') }}" method="POST">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Ubah Password Karyawan</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Karyawan
                        </label>
                        <input readonly type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"  placeholder="Nama Karyawan"  value="{{ session('fullName') }}" autocomplete="off" />
                        <!-- error message untuk nama roles -->
                        @error('name')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">         
                        <label class="text-sm font-weight-bold">Password
                          <span class="text-warning">*</span>
                        </label>
                        <div class="input-group" id="show_hide_password">
                        <input required type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" 
                          name="password" placeholder="Password" id="password" value="{{ old('password') }}" autocomplete="off" >
                          <span class="input-group-text" id="basic-addon1">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                          </span>
                        </div>
                        <!-- error message untuk password -->
                        @error('password')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                         @enderror
                      </div>
                    </div>   
                    <!--end of cold-md-6-->
                  </div>
                  <!--the end of div class="row"-->
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" id="btnSave" class="btn btn-success btn-sm"><i class="fas fa-save"> </i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('gantiPassword.index') }}"><i class="fas fa-arrow-left"> </i> Kembali</a>
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