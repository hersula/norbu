<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin|Norbu Medika </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png"/>

	<!--font awesome and ion icon-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!--end of font awesome and ion icon-->
	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset('assets/css/fonts.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="{{ asset('mycss/my.css') }}" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	<!--   Core JS Files   -->
	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Moment JS -->
	<script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>

	<!-- Chart JS -->
	<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Bootstrap Toggle -->
	<script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Google Maps Plugin -->
	<script src="{{ asset('assets/js/plugin/gmaps/gmaps.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
	

	<!-- Azzara JS -->
	<script src="{{ asset('assets/js/ready.min.js') }}"></script>
	<!--icon-->
	<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
	<!--select 2-->
	
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  	{{-- <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script> --}}
	<!--end of select2-->
	<style>
		table, th {
  			font-weight:bold;
		}
	</style>
</head>
<body class="bg-white" style="color: #060606">
	
	<div class="wrapper">
		<div class="main-header" style="background:rgb(225, 200, 13)">
			<!-- Logo Header -->
			<div class="logo-header">				
				<a href="index.html" class="logo font-weight-bold m-2" style="color:rgb(232, 243, 238);">				
					NORBU MEDIKA
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize ml-3">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg p-3 " style="background: #43d3a8">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center ">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<h4 style="color:#ffffff;">Welcome, {{ session('fullName') }} | {{ session('outlet') }}</h4>
							
							</a>
							
							<ul class="dropdown-menu dropdown-user animated fadeIn">
						
								<li>
									<a class="dropdown-item btn btn" href="#" id="changeoutlet" data-toggle="modal" data-target="#exampleModal">Change Outlet</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{'/logOut' }}">Logout</a>
								</li>
							</ul>

						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
	

		<!-- Sidebar -->
		<div class="sidebar" >
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					
					<ul class="nav">
						<li class="nav-item ">
							<a href="{{ '/dashboard' }}">
								<i class="fas fa-home"></i>
								<p>DASHBOARD</p>
								
							</a>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fa fa-plus-square"></i>
								<p>TRANSAKSI RAWAT JALAN</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('rawatjalan.index') }}">
											<span class="sub-item">Pendaftaran</span>
										</a>
									</li>
									<li>
										<a href="{{ route('riwayatTindakan.index') }}">
											<span class="sub-item">Riwayat Tindakan</span>
										</a>
									</li>
									<li>
										<a href="{{ route('hasil-tes-antigen-nonFaskes.index') }}">
											<span class="sub-item">Hasil Tes Antigen</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
							<i class="fa fa-hospital-o"></i>
								<p>FASKES</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ '/faskes' }}">
											<span class="sub-item">Pendaftaran</span>
										</a>
									</li>
									<li>
										<a href="{{ route('hasil-tes-antigen-Faskes.index') }}">
											<span class="sub-item">Hasil Tes Antigen</span>
										</a>
									</li>
									<li>
										<a href="forms/forms.html">
											<span class="sub-item">Hasil Tes PCR</span>
										</a>
									</li>		
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
							    <i class="fa fa-flask"></i>
								<p>LABORATORIUM</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="tables/tables.html">
											<span class="sub-item">Admin Sample</span>
										</a>
									</li>
									<li>
										<a href="tables/datatables.html">
											<span class="sub-item">Hasil Tes PCR</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#maps">
							   <i class="fas fa-copy"></i>
								<p>MASTER</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="maps">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('roles.index') }}">
											<span class="sub-item">Role</span>
										</a>
									</li>
									<li>
										<a href="{{ route('outlet.index') }}">
											<span class="sub-item">Outlet</span>
										</a>
									</li>
									<li>
										<a href="{{ route('karyawan.index') }}">
											<span class="sub-item">Karyawan</span>
										</a>
									</li>
									<li>
										<a href="{{'/tindakan' }}">
											<span class="sub-item">Tindakan</span>
										</a>
									</li>
									<li>
										<a href="{{ route('pasien.index') }}">
											<span class="sub-item">Pasien</span>
										</a>
									</li>
									<li>
										<a href="{{ route('targetgen.index') }}">
											<span class="sub-item">Target Gen</span>
										</a>
									</li>
									<li>
										<a href="{{ route('reagen.index') }}">
											<span class="sub-item">Reagen</span>
										</a>
									</li>
									<li>
										<a href="{{ route('hasiltes.index') }}">
											<span class="sub-item">Hasil Tes</span>
										</a>
									</li>
									<li>
										<a href="{{ route('tipeklien.index') }}">
											<span class="sub-item">Tipe Klien</span>
										</a>
									</li>
									<li>
										<a href="{{ route('klien.index') }}">
											<span class="sub-item">Klien</span>
										</a>
									</li>
									<li>
										<a href="{{ route('tipepembayaran.index') }}">
											<span class="sub-item">Tipe Pembayaran</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#charts">
							   <i class="fa fa-cog"></i>
								<p>UTILITY</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('gantiPassword.index') }}">
											<span class="sub-item">Ganti Password</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="sub-item">Log File</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				@yield('contents')		

			</div>	
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Topbar</h4>
						<div class="btnSwitch">
							<button type="button" class="changeMainHeaderColor" data-color="blue"></button>
							<button type="button" class="selected changeMainHeaderColor" data-color="purple"></button>
							<button type="button" class="changeMainHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeMainHeaderColor" data-color="green"></button>
							<button type="button" class="changeMainHeaderColor" data-color="orange"></button>
							<button type="button" class="changeMainHeaderColor" data-color="red"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
						</div>
					</div>
				</div>
			</div>
		
		</div>
		<!-- End Custom template -->
	</div>
</div>
<script>
  $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
          event.preventDefault();
          if($('#show_hide_password input').attr("type") == "text"){
              $('#show_hide_password input').attr('type', 'password');
              $('#show_hide_password i').addClass( "fa-eye-slash" );
              $('#show_hide_password i').removeClass( "fa-eye" );
          }else if($('#show_hide_password input').attr("type") == "password"){
              $('#show_hide_password input').attr('type', 'text');
              $('#show_hide_password i').removeClass( "fa-eye-slash" );
              $('#show_hide_password i').addClass( "fa-eye" );
          }
      });
  });
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
</script>
<script>
  


  </script>


	
</body>


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
</html>