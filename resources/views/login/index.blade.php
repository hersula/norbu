<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Norbu-Medika</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">
	<style>
		#textFormSignIn {
			font-weight:bold;
		}
	</style>

</head>
<body class="login" style="background-color: #17AE9D;">
	<div class="wrapper wrapper-login p-5">	
		<div class="container container-login animated fadeIn">
			<div class="row text-center">
				<div class="col-md-12">				
					<h3><img src="{{ asset('images/logo/logo.png') }}" alt="" width="90px" ></h3>
				
				</div>
			</div>		
			<h3 class="text-center pt-3 font-weight-bold">SIGN IN TO MEMBER</h3>
			<form action="{{ 'signMember' }}" method="POST">		
				@csrf
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input id="email" name="email" type="text" class="form-control input-border-bottom text-center  @error('email') is-invalid @enderror"  value="{{ old('email') }}" >
					@error('email')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
					<label id="textFormSignIn" for="email" class="placeholder">Email</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom text-center @error('password') is-invalid @enderror" >
					<label id="textFormSignIn" for="password" class="placeholder">Password</label>
					@error('password')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label id="textFormSignIn"  class="custom-control-label" for="rememberme">Remember Me</label>
					</div>				
					<a href="{{ 'resetPassword' }}" class="link float-right"  style="color: #17AE9D;">Forget Password ?</a>
				</div>
				<div class="form-action mb-3">
					<button  type="submit" class="btn btn-rounded btn-login text-primary"  style="background: rgb(160, 206, 52);color: #17AE9D;">Sigin</button>
				</div>
			</form>
				<div class="login-account">
					<span id="textFormSignIn" class="msg">Don't have an account yet ?</span>
					<a href="{{ 'registration' }}"  style="color: #17AE9D;">Sign Up</a>
				
				</div>
			</div>
		</div>
		
	</div>
	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/ready.js') }}"></script>
	@if(session('success'))
    <script>
         swal("{{ session('success') }}", {
								icon: "success",
								buttons : {
									confirm : {
										className: 'btn btn-success'
									}
								}   
					});
    </script>
@endif
	@if(session('error'))
    <script>
       	swal("{{ session('error') }}", {
						icon : "error",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
							}
						},
					});
    </script>
@endif
</body>
</html>