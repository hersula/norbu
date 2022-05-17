@extends('layouts.admin')
@section('contents')
<div class="container-fluid mt-3">  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight:bold;"> Tambah Data Tipe Pembayaran</h4>
                </div>
            
                <form action="{{ route('tipepembayaran.store') }}" method="POST" id="formTambahPayment">
                  @csrf
                <div class="card-body">
                  <p class="card-title" style="font-size:18px;">Form Tambah Data Tipe Pembayaran</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="text-sm font-weight-bold">Nama Tipe Pembayaran
                        <span class="text-warning">*</span>
                        </label>
                        <input type="text" name="namePayment" id="namePayment" class="form-control form-control-sm @error('namePayment') is-invalid @enderror"  placeholder="Nama Tipe Pembayaran"  value="{{ old('namePayment') }}" autocomplete="off" />
                        <!-- error message untuk nama tipe pembayaran -->
                        @error('namePayment')
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
                    <button type="submit" name="simpan" id="btnSave" class="btn btn-success btn-sm"><i class="fas fa-save"> </i> Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="{{ route('tipepembayaran.index') }}"><i class="fas fa-arrow-left"> </i> Kembali</a>
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