@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Ubah Data Hasil Tes</h4>
                </div>
             
                <form action="{{ route('hasiltes.update', $hasils->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Ubah Data Hasil Tes</p>
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
                        <label class="text-sm font-weight-bold">ID Transaksi
                        <!--
                        <span class="text-warning">*</span>
                      -->
                        </label>
                        <input readonly type="text" name="idTransaction" id="idTransaction" class="form-control form-control-sm @error('idTransaction') is-invalid @enderror"  placeholder="ID Transaksi"  value="{{ old('idTransaction', $hasils->idTransaction) }}" autocomplete="off" />
                        <!-- error message untuk ID Transaksi -->
                        @error('idTransaction')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-sm font-weight-bold">Nama Pasien 
                          <span class="text-warning">*</span>
                        </label>
                        <select readonly type="text" class="custom-select custom-select-sm" name="idPasien">
                          @foreach($pasien as $pasiens)
                          <option value="{{ $pasiens->id }}" {{ $pasiens->id == $hasils->idPasien ? 'selected' : '' }}>{{ $pasiens->name }}
                          </option>
                          @endforeach
                        </select>
                         <!-- error message untuk pasien -->
                        @error('idPasien')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of col-md-6-->
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Pemeriksaan
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm @error('pemeriksaan') is-invalid @enderror" name="pemeriksaan" placeholder="Pemeriksaan" id="pemeriksaan" value="{{ old('pemeriksaan', $hasils->pemeriksaan) }}" autocomplete="off" />
                         <!-- error message untuk pemeriksaan -->
                        @error('pemeriksaan')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Spesimen
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm @error('spesimen') is-invalid @enderror" name="spesimen" placeholder="Spesimen" id="spesimen" value="{{ old('spesimen', $hasils->spesimen) }}" autocomplete="off" />
                         <!-- error message untuk spesimen -->
                        @error('spesimen')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!--end of row pemeriksaan dan spesimen-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Hasil
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm @error('hasil') is-invalid @enderror" name="hasil" placeholder="Hasil" id="hasil" value="{{ old('hasil', $hasils->hasil) }}" autocomplete="off" />
                         <!-- error message untuk hasil -->
                        @error('spesimen')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Keterangan
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input type="text" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Keterangan" id="keterangan" value="{{ old('keterangan', $hasils->keterangan) }}" autocomplete="off" />
                         <!-- error message untuk keterangan -->
                        @error('keterangan')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
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
                        <input type="text" class="form-control form-control-sm @error('nameTargetGen') is-invalid @enderror" name="nameTargetGen" placeholder="Nama Target Gen" id="nameTargetGen" value="{{ old('nameTargetGen', $hasils->nameTargetGen) }}" autocomplete="off" />
                         <!-- error message untuk Nama Target Gen -->
                        @error('nameTargetGen')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 0
                        <!--
                        <span class="text-warning">*</span>
                        -->
                        </label>
                        <input type="text" class="form-control form-control-sm @error('gen0') is-invalid @enderror" name="gen0" placeholder="Gen 0" id="gen0" value="{{ old('gen0', $hasils->gen0) }}" autocomplete="off" />
                         <!-- error message untuk gen0 -->
                        @error('gen0')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
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
                        <input type="text" class="form-control form-control-sm @error('gen1') is-invalid @enderror" name="gen1" placeholder="Gen 1" id="gen1" value="{{ old('gen1', $hasils->gen1) }}" autocomplete="off" />
                         <!-- error message untuk gen1 -->
                        @error('gen1')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 2
                        <!--
                        <span class="text-warning">*</span>
                      -->
                        </label>
                        <input type="text" class="form-control form-control-sm @error('gen2') is-invalid @enderror" name="gen2" placeholder="Gen 2" id="gen2" value="{{ old('gen2', $hasils->gen2) }}" autocomplete="off" />
                         <!-- error message untuk Gen 2 -->
                        @error('gen2')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
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
                        <input type="text" class="form-control form-control-sm @error('gen3') is-invalid @enderror" name="gen3" placeholder="Gen 3" id="gen3" value="{{ old('gen3', $hasils->gen3) }}" autocomplete="off" />
                         <!-- error message untuk Gen3 -->
                        @error('gen3')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 4
                        <!--
                        <span class="text-warning">*</span>
                      -->
                        </label>
                        <input type="text" class="form-control form-control-sm @error('gen4') is-invalid @enderror" name="gen4" placeholder="Gen 4" id="gen4" value="{{ old('gen4', $hasils->gen4) }}" autocomplete="off" />
                         <!-- error message untuk keterangan -->
                        @error('gen4')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Gen 5
                        <!--
                        <span class="text-warning">*</span>
                      -->
                        </label>
                        <input type="text" class="form-control form-control-sm @error('gen5') is-invalid @enderror" name="gen5" placeholder="Gen 5" id="gen5" value="{{ old('gen5', $hasils->gen5) }}" autocomplete="off" />
                         <!-- error message untuk keterangan -->
                        @error('gen5')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                  </div>
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</i></button>
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