@extends('layouts.app')

@section('content')
	<div style="text-align: center">
		<h2 style="margin-top: 100px">Post Something</h2>
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
			<input type="hidden" name="author" value="{{ Auth()->user()->name }}">

			<button class="btn btn-primary" type="submit">Save</button>
			<br>
			<br>
			<a class="btn btn-outline-dark" href="{{ route('index') }}">Go Back</a>
		</form>
	</div>
@endsection