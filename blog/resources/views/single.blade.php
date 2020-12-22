<!DOCTYPE html>
<html>
<head>
	<title>{{ $info->title }}</title>
</head>
<body>
	<div class="container" style="margin-top: 150px; text-align: center;">

		<h2>See details of {{ $info->title }}</h2>
		<br>
		<br>
		<label><b>Title: </b>{{ $info->title }}</label>
		<br>
		<br>
		<label><b>Text: </b>{{ $info->text }}</label>
		<br>
		<br>
		<label><b>This Post Like: </b>{{ $info->likes }}</label>
		<br>
		<br>
		<a href="{{ route('index') }}">Go Back</a>
	</div>
</body>
</html>