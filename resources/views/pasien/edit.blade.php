@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;">Ubah Data Pasien</h4>
                </div>
                <form action="{{ route('pasien.update', $pasiens->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                <div class="card-body">
                    <p class="card-title" style="font-size:18px;">Form Ubah Data Pasien</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">NIK (Nomor Induk Kependudukan)
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="nik" id="nik" class="form-control form-control-sm @error('nik') is-invalid @enderror"  placeholder="Identity Number (KTP/Passport)"  value="{{ old('nik', $pasiens->nik) }}" autocomplete="off" />
                        <!-- error message untuk NIK -->
                        @error('nik')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Passport (Opsional)
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="passport" id="passport" class="form-control form-control-sm @error('passport') is-invalid @enderror"  placeholder="Identity Number (KTP/Passport)"  value="{{ old('passport', $pasiens->passport) }}" autocomplete="off" />
                        <!-- error message untuk Passpor -->
                        @error('passport')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror"  placeholder="Full Name"  value="{{ old('name', $pasiens->name) }}" autocomplete="off" />
                        <!-- error message untuk Nama Pasien -->
                        @error('name')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nomor Handphone
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror"  placeholder="Full Name"  value="{{ old('phone', $pasiens->phone) }}" autocomplete="off" />
                        <!-- error message untuk Nomor Handphone -->
                        @error('phone')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->
                  </div>
                  <!--end of row nama dan nomor handphone-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" >
                      <div class="form-control @error('isWNA') is-invalid @enderror ">
                        <label class="text-sm font-weight-bold">
                          Kewarganegaraan
                        <span class="text-warning">*</span>
                        </label>
                        <div class="col-sm-6">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbWNI">
                            <input type="radio" class="form-check-input" id="isWNA" name="isWNA"  value="0"  {{ $pasiens->isWNA == 0 ? 'checked':'' }}>WNI
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbWNA">
                            <input type="radio" class="form-check-input" id="isWNA" name="isWNA" value="1"  {{ $pasiens->isWNA == 1 ? 'checked':'' }}>WNA
                            </label>
                          </div>
                        </div>
                        <!-- error message untuk isWNA -->
                        @error('isWNA')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      </div>
                      <!--Akhir form group Radio Button isWNA-->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Country
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="country" id="country" class="form-control form-control-sm @error('country') is-invalid @enderror"  placeholder="Country"  value="{{ old('country', $pasiens->country) }}" autocomplete="off" />
                        <!-- error message untuk Country -->
                        @error('country')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->
                  </div>
                   <!--end of row kewarganegaraan dan country-->
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" >
                      <div class="form-control @error('gender') is-invalid @enderror ">
                        <label class="text-sm font-weight-bold">
                          Jenis Kelamin
                        <span class="text-warning">*</span>
                        </label>
                        <div class="col-sm-6">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbLaki-laki">
                            <input type="radio" class="form-check-input" id="gender" name="gender"  value="Laki-laki"  {{ $pasiens->gender == 'Laki-laki' ? 'checked':'' }}>Laki-laki
                            </label>
                          </div>
                          <div class="form-check-inline">
                            <label class="form-check-label" for="rbPerempuan">
                            <input type="radio" class="form-check-input" id="gender" name="gender" value="Perempuan"  {{ $pasiens->gender == 'Perempuan' ? 'checked':'' }}>Perempuan
                            </label>
                          </div>
                        </div>
                        <!-- error message untuk Jenis Kelamin -->
                        @error('gender')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      </div>
                      <!--Akhir form group Radio Button Jenis Kelamin-->
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Alamat
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" placeholder="Address" id="address" value="{{ old('address', $pasiens->address) }}" autocomplete="off" />
                         <!-- error message untuk alamat pasien -->
                        @error('address')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!--end of row Jenis Kelamin dan Alamat-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Tempat Lahir
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="placeOfBirth" id="placeOfBirth" class="form-control form-control-sm @error('placeOfBirth') is-invalid @enderror"  placeholder="Place of Birth"  value="{{ old('placeOfBirth', $pasiens->placeOfBirth) }}" autocomplete="off" />
                        <!-- error message untuk Tempat Lahir Pasien -->
                        @error('placeOfBirth')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Tanggal Lahir
                        <span class="text-warning">*</span>
                        </label>
                        <input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control form-control-sm @error('dateOfBirth') is-invalid @enderror"  placeholder="Date of Birth"  value="{{ old('dateOfBirth', $pasiens->dateOfBirth) }}" autocomplete="off" />
                        <!-- error message untuk Tanggal Lahir Pasien -->
                        @error('dateOfBirth')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->
                  </div>
                  <!--end of row Tempat Lahir dan Tanggal Lahir-->

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Email
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror"  placeholder="Email"  value="{{ old('email', $pasiens->email) }}" autocomplete="off" />
                        <!-- error message untuk Email Pasien -->
                        @error('email')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <!--end of cold-md-6-->
                            
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="UploadFoto" style="padding-top:9px;font-weight:bold;">Foto</label>
                          <div class="col-sm-3">
                          @if($pasiens->avatar =='' || $pasiens->avatar =='null' || $pasiens->avatar =='NULL')         
                             <img src="{{ asset('images/icon_avatar.png') }}" width='210' height='200'>         
                          @else
                            <img src="{{ asset('avatarPasien/' . $pasiens->avatar) }}" width='210' height='200'>        
                          @endif
                          </div>
                          <div class="col-sm-3">
                            <input type="file" name="avatar" value="{{ old('avatar', $pasiens->avatar) }}">
                          </div>
                        </div>
                        <div class="col-sm-10">
                            <span style="color:blue; font-weight:bold;">Format Foto: .JPEG,.JPG, atau .PNG</span>
                        </div>
                    </div>
                     <!--end of cold-md-6-
  
                  </div>
                </div>
                 <!--end of class card body-->
                  <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('pasien.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
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

