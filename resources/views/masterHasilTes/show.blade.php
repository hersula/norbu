@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Lihat Data Hasil Tes</h4>
                </div>
             
                <form action="" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Lihat Data Hasil Tes</p>
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">ID Transaksi
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input readonly type="text" name="idTransaction" id="idTransaction" class="form-control form-control-sm @error('idTransaction') is-invalid @enderror"  placeholder="ID Transaksi"  value="{{ old('idTransaction', $hasils->idTransaction) }}" autocomplete="off" />
                     
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Nama Pasien 
                        <!--
                          <span class="text-warning">*</span>
                        -->
                        </label>
                        <select disabled type="text" class="custom-select custom-select-sm" name="idPasien">
                          @foreach($pasien as $pasiens)
                          <option value="{{ $pasiens->id }}" {{ $pasiens->id == $hasils->idPasien ? 'selected' : '' }}>{{ $pasiens->name }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!--end of col-md-6-->
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Pemeriksaan
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('pemeriksaan') is-invalid @enderror" name="pemeriksaan" placeholder="Pemeriksaan" id="pemeriksaan" value="{{ old('pemeriksaan', $hasils->pemeriksaan) }}" autocomplete="off" />
                       
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Spesimen
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('spesimen') is-invalid @enderror" name="spesimen" placeholder="Spesimen" id="spesimen" value="{{ old('spesimen', $hasils->spesimen) }}" autocomplete="off" />
                      </div>
                    </div>
                  </div>
                  <!--end of row pemeriksaan dan spesimen-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Hasil
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('hasil') is-invalid @enderror" name="hasil" placeholder="Hasil" id="hasil" value="{{ old('hasil', $hasils->hasil) }}" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Keterangan
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Keterangan" id="keterangan" value="{{ old('keterangan', $hasils->keterangan) }}" autocomplete="off" />
                       
                      </div>
                    </div>
                  </div>
                    <!--end of row hasil dan keterangan-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Target Gen
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('nameTargetGen') is-invalid @enderror" name="nameTargetGen" placeholder="Nama Target Gen" id="nameTargetGen" value="{{ old('nameTargetGen', $hasils->nameTargetGen) }}" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 0
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen0') is-invalid @enderror" name="gen0" placeholder="Gen 0" id="gen0" value="{{ old('gen0', $hasils->gen0) }}" autocomplete="off" />
                      </div>
                    </div>
                  </div>
                  <!--end of row nama target gen and Gen 0-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 1
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen1') is-invalid @enderror" name="gen1" placeholder="Gen 1" id="gen1" value="{{ old('gen1', $hasils->gen1) }}" autocomplete="off" />
                      
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 2
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen2') is-invalid @enderror" name="gen2" placeholder="Gen 2" id="gen2" value="{{ old('gen2', $hasils->gen2) }}" autocomplete="off" />
                        
                      </div>
                    </div>
                  </div>
                  <!--end of row gen 1 and gen 2-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 3
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen3') is-invalid @enderror" name="gen3" placeholder="Gen 3" id="gen3" value="{{ old('gen3', $hasils->gen3) }}" autocomplete="off" />
                     
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 4
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen4') is-invalid @enderror" name="gen4" placeholder="Gen 4" id="gen4" value="{{ old('gen4', $hasils->gen4) }}" autocomplete="off" />
                    
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 5
                        <!--
                        <span class="text-warning">*</span>
                       -->
                        </label>
                        <input disabled type="text" class="form-control form-control-sm @error('gen5') is-invalid @enderror" name="gen5" placeholder="Gen 5" id="gen5" value="{{ old('gen5', $hasils->gen5) }}" autocomplete="off" />
                         
                      </div>
                    </div>

                  </div>
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <a class="btn btn-secondary btn-sm" href="{{ route('hasiltes.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</i></a>
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