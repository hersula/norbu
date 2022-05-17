@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Tambah Data Target Gen</h4>
                </div>
                <form action="{{ route('targetgen.store') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <p class="card-title" style="font-size:18px;">Form Tambah Data Target Gen</p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group ">
                          <label class="text-sm font-weight-bold">Nama Target Gen
                          <span class="text-warning">*</span>
                          </label>
                          <input type="text" name="nameTargetGen" id="nameTargetGen" class="form-control form-control-sm @error('nameTargetGen') is-invalid @enderror"  placeholder="Nama targetgen"  value="{{ old('nameTargetGen') }}" autocomplete="off" />
                          @error('nameTargetGen')
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
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="far fa-save"> Simpan</i></button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('targetgen.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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