@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Lihat Data Tipe Klien</h4>
                </div>
            
                <form action="{{ route('tipeklien.update', $tipeklien->id) }}" method="POST" id="formUbahTipeKlien">
                  @csrf
                <div class="card-body">
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Tipe Klien
                   
                        </label>
                        <input disabled type="text" name="nameType" id="nameType" class="form-control form-control-sm @error('nameType') is-invalid @enderror"  placeholder="Nama Tipe Klien"  value="{{ old('nameType', $tipeklien->nameType) }}" autocomplete="off" />
                        <!-- error message untuk nama tipe klien -->
                        @error('nameType')
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
                   
                    <a class="btn btn-secondary btn-sm" href="{{ route('tipeklien.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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