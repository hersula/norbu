<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Norbu-Medika</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Open+Sans:300,400,600,700"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
            urls: ['../assets/css/fonts.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">
</head>

<body class="login" style="background-color: #17AE9D;">
    <div class="wrapper wrapper-login p-5">
        <div class="container container-login animated fadeIn">
            <div class="row text-center">
                <div class="col-md-12">
                    <h3><img src="{{ asset('images/logo/logo.png') }}" alt="" width="90px"></h3>
                    <h3>Reset Password</h3>
                </div>
            </div>
            <form action="{{ 'resetPassword'}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" value="{{ $token }}" name="token">
                <div class="login-form">
                    <div class="form-group">
                        <div class="form-group form-floating-label ">
                            <input  id="password" name="password" type="password" class="form-control input-border-bottom text-center @error('password') is-invalid @enderror" >
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                            <label for="password" class="placeholder ">Password</label>
                            <div class="show-password">
                                <i class="flaticon-interface"></i>
                            </div>
                        </div>           
                        <div class="form-group form-floating-label">
                            <input  id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom text-center @error('confirmpassword') is-invalid @enderror" >
                            @error('confirmpassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                            <label for="confirmpassword" class="placeholder ">Confirm Password</label>
                            <div class="show-password">
                                <i class="flaticon-interface"></i>
                            </div>
                        </div>
                        <div class="form-action ">
                            <button type="submit" class="btn btn-rounded btn-login text-primary"
                                style="background: rgb(160, 206, 52);color: #17AE9D;">Send</button>
                        </div>
                    </div>
            </form>
            <div class="login-account">
                <span class="msg">Back to initial activity ?</span>
                <a href="{{ '/' }}" style="color: #17AE9D;">Back</a>

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
        buttons: {
            confirm: {
                className: 'btn btn-success'
            }
        }
    });
    </script>
    @endif
    @if(session('error'))
    <script>
    swal("{{ session('error') }}", {
        icon: "error",
        buttons: {
            confirm: {
                className: 'btn btn-danger'
            }
        },
    });
    </script>
    @endif
</body>

</html>