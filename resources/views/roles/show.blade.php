@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Lihat Data Outlet</h4>
                </div>
            
                <form action="" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Lihat Data Roles</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Role
                     
                        </label>
                        <input disabled type="text" name="roleName" id="roleName" class="form-control form-control-sm @error('roleName') is-invalid @enderror"  placeholder="Nama Role"  value="{{ old('roleName', $roles->roleName) }}" autocomplete="off" />
                    </div>
                    <div class="col-md-6">
                      
                    </div>
                  </div>

                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <a class="btn btn-secondary btn-sm" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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