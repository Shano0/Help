@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 100px; text-align: center;">

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
		<label><b>Author: </b>{{ $info->author }}</label>
		<br>
		<br>
		<a class="btn btn-outline-dark" href="{{ url()->previous() }}">Go Back</a>
	</div>
@endsection