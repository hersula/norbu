@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Lihat Data Reagen</h4>
                </div>
            
                <form action="" method="POST">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Lihat Data Reagen</p>
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Reagen
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" name="nameReagen" id="nameReagen" class="form-control form-control-sm @error('nameReagen') is-invalid @enderror"  placeholder="Nama Reagen"  value="{{ old('name', $reagen->nameReagen) }}" autocomplete="off" />
                       
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Target Gen
                          <!--
                          <span class="text-warning">*</span>
                          -->
                        </label> 
                        <select disabled class="js-example-basic-multiple js-states form-control" id="targetgen" name="targetgen[]" multiple="multiple" data-placeholder="Pilih Target Gen">
                        @foreach($targetgen as $item)
                          <option value="{{$item->id}}" selected>{{ $item->nameTargetGen}}</option>
                        @endforeach
                        @foreach($masterTargetGen as $item)
                        <option value="{{$item->id}}">{{ $item->nameTargetGen}}</option>
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
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <div class="col-sm-6">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbYa">
                            <input disabled type="radio" class="form-check-input" id="isActive" name="isActive"  value="1" {{ $reagen->isActive == 1 ? 'checked':'' }}>Ya
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbTidak">
                            <input disabled type="radio" class="form-check-input" id="isActive" name="isActive" value="0" {{ $reagen->isActive== 0 ? 'checked':'' }}>Tidak
                            </label>
                          </div>
                        </div>
                      </div>
                      </div>
                      <!--Akhir form group Radio Button isActive-->
                    </div>

                    <div class="col-md-6">
                      
                    </div>
                  </div>
                  <!--end of row alamat dan isFaskes-->
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <a class="btn btn-secondary btn-sm" href="{{ route('reagen.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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