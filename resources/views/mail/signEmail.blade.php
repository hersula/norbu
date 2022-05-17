<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Norbu-Medika </title>
</head>
<body>
    <h4 >Halo {{ $EmailData['name'] }}   </h4>   
<h5>Selamat datang di Norbu-Medika</h5>
    <p>Silahkan klick untuk verifikasi <a href="{{ url('') }}/verifyLogin/{{ $EmailData['verifikasi_code'] }}">click here!</a></p>
   
</body>
</html>