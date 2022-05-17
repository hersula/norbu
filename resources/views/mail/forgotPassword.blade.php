<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Norbu-Medika</title>
</head>
<body>
<h5>Halo {{ $Token['name'] }}</h5>
<h5>Selamat datang di Norbu-Medika</h5>
     
    <p>Silahkan klick untuk ubah password <a href="{{ url("resetPassword").'/'.$Token['token'] }}">click here!</a></p><br>
    {{-- <p>Silahkan klick untuk ubah password <a href="{{ 'resetPassword/'}}{{ $Token['token'] }}">click here!</a></p><br> --}}
</body>
</html>