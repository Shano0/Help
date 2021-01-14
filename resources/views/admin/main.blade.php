<!DOCTYPE html>
<html>
<head>
	<title>Admin Home</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class="body p-0 sign_body" style="background: #0e0e0e url(https://movie.ge/theme/img/authorization-cover.png);  background-size: cover; background-repeat: no-repeat;">
	<div class="container" style="text-align: center; margin-top: 6%; background-color: #ffffff; width: 30%">
		<h1>Wellcome</h1>
		<h3>This is Main Page for Admin</h3>
		<br>
		<h4>Choose an option</h4>
		{{-- 1 --}}
		<a class="btn btn-success" href="{{ route('addmovie') }}">Add Movie</a>
		{{-- 2 --}}
		<a class="btn btn-success" href="{{ route('addserial') }}">Add Serial</a>
		<br>
		<br>


		{{-- 3 --}}
		<a class="btn btn-success" href="{{ route('addactor') }}">Add Actor</a>
		{{-- 4 --}}
		<a class="btn btn-success" href="{{ route('addgenre') }}">Add Genre</a>
		<br>
		<br>

		{{-- 5 --}}
		<a class="btn btn-success" href="{{ route('addgenretomovie') }}">Add Genre To Movie</a>
		{{-- 6 --}}
		<a class="btn btn-success" href="{{ route('addgenretoserial') }}">Add Genre To Serial</a>
		<br>
		<br>

		{{-- 7 --}}
		<a class="btn btn-success" href="{{ route('addactortomovie') }}">Add Actor To Moive</a>
		{{-- 8 --}}
		<a class="btn btn-success" href="{{ route('addactortoserial') }}">Add Actor To Serial</a>
		<br>
		<br>

		<a class="btn btn-danger" href="{{ route('deletemovie') }}">Delete Moive</a>
		{{-- 8 --}}
		<a class="btn btn-danger" href="{{ route('deleteserial') }}">Delete Serial</a>
		<br>
		<br>

	</div>
</body>
</html>