<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin | Norbu-Medika</title>
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
	<style>
		#textFormSignIn {
			font-weight:bold;
		}
	</style>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">

</head>
<body class="login" style="background-color: #17AE9D;">
	<div class="wrapper wrapper-login p-5">	
		<div class="container container-login animated fadeIn">
			<div class="row text-center">
				<div class="col-md-12">				
					<h3><img src="{{ asset('images/logo/logo.png') }}" alt="" width="90px" ></h3>
					
					<h3 class="text-center">SIGN IN TO ADMIN</h3>
				</div>
			</div>		
			<form action="{{ '/sigIn' }}" method="post">			
				@csrf	
				<div class="login-form">
					<div class="form-group">
						<label for="password" class="placeholder"><b>Email</b></label>
						<input id="email" name="email" type="text" class="form-control  @error('email') is-invalid @enderror"  value="{{ old('email') }}" >
						@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
							@enderror
					</div>
				<div class="form-group">
					<label  for="password" class="placeholder"><b>Password</b></label>
					<a href="#" class="link float-right">Forget Password ?</a>
					<div class="position-relative">
						<input id="password" name="password" type="password" class="form-control  @error('password') is-invalid @enderror"  value="{{ old('password') }}">
						@error('password')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
						@enderror
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-action-d-flex mb-3">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label id="textFormSignIn" class="custom-control-label m-0" for="rememberme">Remember Me</label>
					</div>
					<button class="btn col-md-5 float-right mt-3 mt-sm-0 fw-bold" style="background: rgb(160, 206, 52);color: #101616;">Sign In</button>
					
				</div>
				
			</form>
			
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