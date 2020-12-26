@extends('layouts.app')

@section('content')
	<div style="text-align: center">
		<h2 style="margin-top: 100px">Add Post</h2>
		<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<label>Title</label>
			<input type="text" name="title">
			<br>
			<br>

			<input type="hidden" name="author" value="{{ Auth()->user()->name }}">

			<button class="btn btn-primary" type="submit">Save</button>
			<br>
			<br>
			<a class="btn btn-outline-dark" href="{{ url()->previous() }}">Go Back</a>
		</form>
	</div>
@endsection