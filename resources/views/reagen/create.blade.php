@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Tambah Data Reagen</h4>
                </div>
                <form action="{{ '/reagen' }}" method="POST">
                    @csrf
                <div class="card-body">
                    <p class="card-title" style="font-size:18px;">Form Tambah Data Reagen</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="text-sm font-weight-bold">Nama Reagen
                                <span class="text-warning">*</span>
                                </label>
                                <input type="text" name="nameReagen" id="nameReagen" class="form-control form-control-sm @error('nameReagen') is-invalid @enderror"  placeholder="Nama Reagen"  value="{{ old('nameReagen') }}" autocomplete="off" />
                                <!-- error message untuk nama outlet -->
                                @error('nameReagen')
                                <div class="alert alert-danger mt-2">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="text-sm font-weight-bold">Target Gen
                                <span class="text-warning">*</span>
                              </label> 
                              <select class="js-example-basic-multiple js-states form-control" id="targetgen" name="targetgen[]" multiple="multiple" style="width: 99%" data-placeholder="----Pilih Target Gen----">
                                @foreach($target as $targets)
                                <option value="{{ $targets->id }}">{{ $targets->nameTargetGen }}</option>
                                @endforeach
                            </select>
                            </div>
                             <!-- error message untuk target gen -->
                              @error('targetgen')
                              <div class="alert alert-danger mt-2">
                                {{ $message }}
                              </div>
                              @enderror
                          </div>
                          <!--end of col-md-6-->
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" >
                            <div class="form-control @error('isActive') is-invalid @enderror ">
                              <label class="text-sm font-weight-bold">
                                Aktif dipakai sekarang?
                              <span class="text-warning">*</span>
                              </label>
                              <div class="col-md-6">
                                                   
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <div class="form-control @error('isActive') is-invalid @enderror ">
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="rbYa">
                                                <input type="radio" class="form-check-input" id="isActive" name="isActive"  value="1">Ya
                                                </label>
                                              </div>
                                      </div>
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <div class="form-control @error('isActive') is-invalid @enderror ">
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="rbTidak">
                                        <input type="radio" class="form-check-input" id="isActive" name="isActive" value="0">Tidak
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
                    <!--end of row-->
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="far fa-save"> Simpan</i></button>
                    <a class="btn btn-secondary btn-sm" href="{{ '/reagen' }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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