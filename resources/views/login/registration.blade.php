<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Norbu Medika</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png"/>
	<link rel="stylesheet" href="{{ asset('mycss/my.css') }}">
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
</head>
<body class="login"  style="background-color: #17AE9D;">
	<div class="wrapper wrapper-login ">	
		<div class="container container-login animated fadeIn" id="register">
			<div class="row text-center mt-0">
				<div class="col-md-12 mt-0">
					<img src="{{ asset('images/logo/logo.png') }}" alt="" width="90px">
				</div>
			</div>	
			<h3 class="text-center pt-3">FORM REGISTRASI</h3>
            
            <form action="{{ '/registration' }}" method="post" id="myform">
                    @csrf
			<div class="login-form">
				<div class="form-group">
                    <label class="text-md font-weight-bold" for="nik">NIK</label>
                    <input type="text" class="form-control input-pill text-center @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}">
                    @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            <div class="form-group">
                <label class="text-md font-weight-bold" for="name">Full Name</label>
                <input type="text" class="form-control input-pill text-center @error('name') is-invalid @enderror" id="name" name="name" placeholder="" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label class="text-md font-weight-bold" for="email">Email</label>
                <input type="email" class="form-control input-pill text-center @error('email') is-invalid @enderror" id="email" name="email" placeholder="" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>

            <div class="form-group">
                <label class="text-md font-weight-bold" for="address">Address</label>
                <input type="text" class="form-control input-pill text-center @error('address') is-invalid @enderror" id="address" name="address" placeholder="" value="{{ old('address') }}">
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>

            <div class="form-group">
                <label  class="text-md font-weight-bold"for="phone">Phone</label>
                <input type="text" class="form-control input-pill text-center @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="" value="{{ old('phone') }}">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>      
            <div class="form-group">
                <label  class="text-md font-weight-bold"for="plaseOfbirth">Place of Birth</label>
                <input type="text" class="form-control input-pill text-center @error('placeOfBirth') is-invalid @enderror" id="placeOfbirth" placeholder="" name="placeOfBirth" value="{{ old('placeOfBirth') }}">
                @error('placeOfBirth')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>


            <div class="form-group">
                <label class="text-md font-weight-bold" for="dateOfBirth">Date of Birth</label>
                <input type="date" class="form-control input-pill text-center @error('dateOfBirth') is-invalid @enderror" id="dateOfBirth" placeholder="" name="dateOfBirth"  value="{{ old('dateOfBirth') }}">
                @error('dateOfBirth')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
          <div class="form-group   ">               
                <div class="form-check input-pill form-control  @error('gender') is-invalid @enderror ">
                    <label class="text-md font-weight-bold">Gender (Jenis Kelamin)</label><br>
                <label class="form-radio-label">
                    <input class="form-radio-input text-center  " type="radio" name="gender" value="Laki-laki" >
                    <span class="form-radio-sign">laki-laki</span>
                
                </label>
                <label class="form-radio-label ml-3">
                    <input class="form-radio-input text-center" type="radio" name="gender" value="Perempuan">
                    <span class="form-radio-sign">perempuan</span>
                </label>               
            </div>   
            @error('gender')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>      
       <div class="form-group   ">          
            <div class="form-check input-pill form-control @error('kewarganegaraan') is-invalid @enderror ">
                <label class="text-md font-weight-bold">Kewarganegaraan</label><br>
                <label class="form-radio-label">
                    <input class="form-radio-input " type="radio" name="kewarganegaraan" value="WNI" id="WNI">
                    <span class="form-radio-sign">WNI</span>
                </label>
                <label class="form-radio-label ml-3">
                    <input class="form-radio-input" type="radio" name="kewarganegaraan" value="WNA" id="WNA">
                    <span class="form-radio-sign">WNA</span>
                </label>
            </div>
            @error('kewarganegaraan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
    
        <div class="form-group">
            <label class="text-md font-weight-bold"for="pillSelect">Asal</label>
            <input type="text" class="form-control  input-pill text-center" id="isWni" placeholder="" name="country[]">
            <div  id="isWna" style="display: none;">          
                <select class="select2bs4 form-control form-control-sm" name="country[]">
                <option hidden_value>---Country---</option>
                @foreach ($country as $item)         
                <option  class="bg-white border-0" style="" value="{{ $item->id }}">{{ $item->country_name }}</option>                 
                @endforeach
                </select>   
            </div>     
        </div>
          
        <div class="form-group ">
            <label  class="text-md font-weight-bold" for="passport">Passport (<span class="text-success">optional</span> )</label>
                <input  id="passport" name="passport" type="passport" class="form-control input-pill text-center"  value="{{ old('passport') }}">
            </div>
            <div class="form-group form-floating-label ">
                <input  id="password" name="password" type="password" class="form-control input-border-bottom text-center @error('password') is-invalid @enderror" >
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
                <label class="text-md font-weight-bold" for="password">Password</label>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
            </div>

            <div class="form-group form-floating-label">
                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom text-center @error('confirmpassword') is-invalid @enderror" >
                @error('confirmpassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
                <label class="text-md font-weight-bold" for="confirmpassword">Confirm Password</label>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
            </div>
            <div class="form-action mb-2">
                <button id="btnSubmit" type="button" class="btn btn-rounded btn-login"  style="background: rgb(160, 206, 52);color: #17AE9D;">Registrasi</button>
            </div>
            <div class="login-account">
                <span class="msg"> Haven't an account yet?</span>
                <a href="{{ '/' }}" style="color: #17AE9D;">Sign Up</a> 
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
<!-- Sweet Alert -->
<script>     
$('#btnSubmit').click(function(e) {
	swal({
		title: 'yakin?',
		text: "Data anda sudah benar?",
		type: 'warning',
		buttons:{
			confirm: {
				text : 'Yes',
				className : 'btn btn-success'
			},
			cancel: {
				visible: true,
				text : 'Cancel',
				className: 'btn btn-danger'
			}      			
		}
	}).then((willSave) => {
		if (willSave) {                    
        formSubmit(e);						
		} else {
			swal("Data tidak di simpan", {
                title: 'info? ',
				buttons : {
					confirm : {
						className: 'btn btn-success'
					}
				}
			});
		}
	});
});

   function formSubmit(e){            
        $('#myform').submit();     
        e.preventDefault()                 
    }
</script>

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
<script>
     $(document).ready(function () {
        $("#WNI").change(function() {
            let CountryWni = $("#WNI").val();           
            if(CountryWni=="WNI"){
            $("#isWni").val("Indonesia").show();
                $("#isWna").hide();    
            }                    
        });
        $("#WNA").change(function() {
            let CountryWna = $("#WNA").val();  
            if(CountryWna=="WNA"){
            $("#isWni").hide();
                $("#isWna").val("").trigger('change').show();                   
            }            
        });
    });
    $('.select2bs4').select2({
            theme: 'bootstrap4',
            width: 'null',
        });
</script>
</body>
</html>