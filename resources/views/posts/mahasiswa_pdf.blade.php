<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>Laporan Posts</h1>
		<table class="table table-bordered">
            <tr>
                <th width="20px" class="text-center">Title</th>
                <th>Content</th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->title }}</td>
                <td>{{$post->content}}</td>
            </tr>
            @endforeach
        </table>
	</div>
</body>
</html>
