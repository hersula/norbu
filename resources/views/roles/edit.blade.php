@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> Ubah Data Role</h4>
                </div>
          
                <form action="{{ route('roles.update', $roles->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Ubah Data Roles</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Role
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="roleName" id="roleName" class="form-control form-control-sm @error('roleName') is-invalid @enderror"  placeholder="Nama Role"  value="{{ old('roleName', $roles->roleName) }}" autocomplete="off" />
                        <!-- error message untuk nama roles -->
                        @error('roleName')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      
                    </div>
                  </div>

                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
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
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('fail'))
    <div class="alert alert-danger">
       {{Session::get('fail')}}
    </div>
@endif