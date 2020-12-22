@extends('layouts.app')

@section('content')
	<div style="text-align: center">
		<h2 style="margin-top: 100px">Edit Post</h2>
		<form action="{{ route('update',["id"=>$info->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<label>Title</label>
			<input type="text" name="title" value="{{ $info->title }}">
			<br>
			<br>
			<label>Text</label>
			<textarea name="text">{{ $info->text }}</textarea>
			<br>
			<br>
			<label>Likes</label>
			<input type="text" name="likes" value="{{ $info->likes }}" placeholder="Type who likes this...">
			<br>
			<br>

			<button class="btn btn-primary" type="submit">Save</button>
			<br>
			<br>
			<a class="btn btn-outline-dark" href="{{ url()->previous() }}">Go Back</a>
		</form>
	</div>
@endsection