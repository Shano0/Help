@extends('layouts.app')

@section('content')

	<div class="container" style="text-align: center; margin-top: 50px">

		<table class="container" style="margin-left: auto; margin-right: auto;">
			
			<h2>See All Post Here</h2>

			<a class="btn btn-outline-primary" href="{{ route('create') }}">Add Another Post </a>

			<a style="margin-left: 10px" class="btn btn-outline-primary" href="{{ route('profile') }}"> My Profile</a>

			<br>
			<br>

			<tr>
				<th>N</th>
				<th>Title</th>
				<th>Author</th>
				<th>Action</th>
			</tr>
			@foreach($posts as $post)
			<tr>
				<td>{{ ++$loop->index }}</td>
				<td>{{ $post->title }}</td>
				<td>{{ $post->author }}</td>
				<td>
				@if(Auth()->user()->name == $post->author) 
					<a class="btn btn-success" href="{{ route('single',["id"=>$post->id]) }}">See</a>
					<a class="btn btn-warning" href="{{ route('edit',["id"=>$post->id]) }}">Edit</a>
					<a class="btn btn-danger" href="{{ route('delete',["id"=>$post->id]) }}">Delete</a>
				@else
					<a class="btn btn-outline-success" href="{{ route('single',["id"=>$post->id]) }}">See</a>
					<a class="btn btn-outline-warning" href="#AccessDenied">Edit</a>
					<a class="btn btn-outline-danger" href="#AccessDenied">Delete</a>
				@endif
				</td>
			</tr>
			@endforeach
			
		</table>
		
	</div>

@endsection