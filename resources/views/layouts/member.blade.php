<!DOCTYPE html>
<html lang="en">
  <head>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">  
    <link rel="stylesheet" href="{{ asset('mycss/mycss.css') }}" />
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

	<!-- Sweet Alert -->
	<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Norbu-Medika</title>
  </head>
  <body >
    <nav class="p-5">  
      <div class="logo"><h5 class=""> <img src="{{ asset('images/logo-landscape.svg') }}" alt=""><br><small id="cvd">Covid 19 PCR & Antigen</small></h5></div>
      <ul>
      
        <li><a href="{{ '/home' }}" ><button class="btn btn" id="home">Home</button> </a></li>
        <li><a href="{{ '/pendaftaran' }}" ><button class="btn btn  mr-3" id="pendaftaran">Pendaftaran</button></a></li>
        <li><a href="{{ '/pemesanan' }}" ><button class="btn btn  mr-3" id="pesanan">Pemesanan </button></a></li>
        <li><a href="{{ '/riwayat' }}" ><button class="btn btn  mr-3" id="riwayat">Riwayat </button></a></li>
        <li><a href="{{ 'profile' }}" ><button class="btn btn  mr-3" id="profile">Profile</button></a></li>
        <li><a href="{{ '/logout' }}" class="p-3 mr-3"><button class="btn btn "  id="logout"><i class="fas fa-sign-out-alt"></i> logout</button></a></li>
      
      </ul>
      <div class="toggle-menu">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
    <div class="container-fluid">
        
        @yield('contents')
    </div>
          
    </div>
  </body>
  <script src="{{ asset('myjs/myjs.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
