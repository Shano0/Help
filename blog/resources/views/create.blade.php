<!DOCTYPE html>
<html>
<head>
	<title> Create </title>
</head>
<body>
	<div style="text-align: center">
		<h2 style="margin-top: 150px">Post Something</h2>
		<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<label>Title</label>
			<input type="text" name="title">
			<br>
			<br>
			<label>Text</label>
			<textarea name="text"></textarea>
			<br>
			<br>
			<label>Likes</label>
			<input type="text" name="likes" placeholder="Type who likes this...">
			<br>
			<br>

			<button class="btn btn-primary" type="submit">Save</button>
			<br>
			<br>
			<a href="{{ route('index') }}">Go Back</a>
		</form>
	</div>
</body>
</html>