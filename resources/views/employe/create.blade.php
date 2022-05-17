@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Tambah Data Karyawan</h4>
                </div>
            
                <form action="{{ route('karyawan.store') }}" method="POST">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Tambah Data Karyawan</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Karyawan
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"  placeholder="Nama Karyawan"  value="{{ old('name') }}" autocomplete="off" />
                        <!-- error message untuk nama karyawan -->
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
                        name="password" placeholder="Password" id="password" 
                        value="{{ old('password') }}" autocomplete="off" >
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

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Email
                        <span class="text-warning">*</span>
                        </label>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" placeholder="Email" id="email" value="{{ old('email') }}" autocomplete="off" />
                         <!-- error message untuk email karyawan -->
                        @error('email')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Outlet <span class="text-warning">*</span></label>
                        <select type="text" class="custom-select custom-select-sm" name="outlet" id="outlet">
                          <option style="font: size 13px;" value="">--Pilih Outlet--</option>
                          @foreach($outlet as $outlet)
                          <option style="font-size:13px;" value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                          @endforeach
                        </select>
                        <!-- error message untuk outlet -->
                        @error('outlet')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of col-md-6-->
                  </div>
                  <!--end of row email dan outlet-->


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nomor Handphone
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror"  placeholder="Nomor Handphone"  value="{{ old('phone') }}" autocomplete="off" />
                        <!-- error message untuk nomor handphone -->
                        @error('phone')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Role <span class="text-warning">*</span></label>
                        <!--
                        <select multiple="multiple" class="custom-select custom-select-sm" id="role" name="role[]">
                          <option value="">--Pilih Role--</option>
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                          @endforeach
                        </select>
                        -->
                       
                        <select class="js-example-basic-multiple js-states form-control" id="role" name="role[]" multiple="multiple" data-placeholder="Pilih Role">
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                          @endforeach
                        </select>
                      </div>
                       <!-- error message untuk nomor handphone -->
                        @error('role')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end of col-md-6-->
                  </div>
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="far fa-save"> Simpan</i></button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('karyawan.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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


