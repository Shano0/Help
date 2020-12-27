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
				@if(Auth::user()->id == 1)
					@if(App\Post::where('id', $post->id)->firstOrFail()->is_approved == 1)
						<a class="btn btn-dark approve" url="{{ route('approve',[$post->id]) }}">Disapprove</a>
					@else
						<a class="btn btn-outline-dark approve" url="{{ route('approve',["id"=>$post->id]) }}">Approve</a>
					@endif
				@endif
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$.ajaxSetup({
    		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		});

		$('.approve').click(function(e){
			e.preventDefault()
			$this=$(this)
			$.ajax({
				url: $this.attr('url'),
				success: function(gl){
					if($this.hasClass('btn btn-outline-dark')){
						$this.removeClass('btn btn-outline-dark');
						$this.addClass('btn btn-dark');
						$this.html('Disapprove');
						
					} else{
						$this.removeClass('btn btn-dark')
						$this.addClass('btn btn-outline-dark');
						$this.html('Approve');
					}
					console.log(gl)
				},
				error:function(err){
					console.log(err.responseJSON.message)
					alert(err)
				}
			})
		})
	})
	</script>

@endsection