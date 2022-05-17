@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Ubah Data Reagen</h4>
                </div>
            
                <form action="{{ route('reagen.update', $reagen->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Ubah Data Reagen</p>
                  <!-- Notifikasi menggunakan flash session data -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                    @endif

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Reagen
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="nameReagen" id="nameReagen" class="form-control form-control-sm @error('nameReagen') is-invalid @enderror"  placeholder="Nama Reagen"  value="{{ old('name', $reagen->nameReagen) }}" autocomplete="off" />
                        <!-- error message untuk nama reagen -->
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
                        <select class="js-example-basic-multiple js-states form-control" id="targetgen" name="targetgen[]" multiple="multiple" data-placeholder="Pilih Target Gen">
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
                        <span class="text-warning">*</span>
                        </label>
                        <div class="col-sm-6">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbYa">
                            <input type="radio" class="form-check-input" id="isActive" name="isActive"  value="1" {{ $reagen->isActive == 1 ? 'checked':'' }}>Ya
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbTidak">
                            <input type="radio" class="form-check-input" id="isActive" name="isActive" value="0" {{ $reagen->isActive== 0 ? 'checked':'' }}>Tidak
                            </label>
                          </div>
                        </div>
                        <!-- error message untuk isActive -->
                        @error('isActive')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
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
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</i>
                    </button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('reagen.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</i>
                    </a>
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