@extends('layouts.member')
@section('contents')
<div class="container ">
  <div class="row mt-3 justify-content-center" >
      <div class="col-md-6">      
            <div class="card card-profile ">
                <div class="card-header">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('images/icon_avatar.png') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">{{ session('fullName') }}</div>       
                        <div class="view-profile">
                            <button   type="button" class="btn btn-rounded btn-login"  style="" id="pilihLokasi">Change Password</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number " style="background: rgb(23, 238, 209);border-radius:5px">email</div>
                            <div class="title">{{ $profile->email }}</div>
                        </div>
                        <div class="col">
                            <div class="number" style="background: rgb(23, 238, 209);border-radius:5px">Phone</div>
                            <div class="title">{{ $profile->phone }}</div>
                        </div>
                        <div class="col">
                            <div class="number" style="background: rgb(23, 238, 209);border-radius:5px">Status</div>
                            <div class="title">{{ $profile->status }}</div>
                        </div>
                    </div>
                </div>
            </div>     
  </div>
</div>
@endsection