<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
</head>
<body>
	<div class="container" style="text-align: center; margin-top: 100px">

		<table class="container" style="margin-left: auto; margin-right: auto;">
			
			<h2>See All Post Here</h2>

			<a href="{{ route('create') }}">Add Another Post</a>

			<br>
			<br>

			<tr>
				<th>N</th>
				<th>Title</th>
				<th>Action</th>
			</tr>
			@foreach($posts as $post)
			<tr>
				<td>{{ ++$loop->index }}</td>
				<td>{{ $post->title }}</td>
				<td> 
					<a href="{{ route('single',["id"=>$post->id]) }}">See</a>
					<a href="{{ route('edit',["id"=>$post->id]) }}">Edit</a>
					<a href="{{ route('delete',["id"=>$post->id]) }}">Delete</a>
				</td>
			</tr>
			@endforeach
			
		</table>
		
	</div>
</body>
</html>