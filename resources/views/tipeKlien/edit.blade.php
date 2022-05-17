@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Ubah Data Tipe Klien</h4>
                </div>
            
                <form action="{{ '/tipeklien/update' }}" method="POST" >
                    @csrf
                    @method('PATCH')
                <div class="card-body">
                    <p class="card-title" style="font-size:18px;">Form Ubah Data Tipe Klien</p>
                 <input type="hidden" name="idtipe_klien" value="{{ $tipeklien->id }}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Tipe Klien
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="nameType" id="nameType" class="form-control form-control-sm @error('nameType') is-invalid @enderror"  placeholder="Nama Tipe Klien"  value="{{ old('nameType', $tipeklien->nameType) }}" autocomplete="off" />
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
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('tipeklien.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
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