@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center;" class="card-header">Profile</div>

                <div style="text-align: center;" class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <br>
                    <br>
                    <a class="btn btn-outline-primary" href="{{ route('index') }}">Go To Index Page</a>
                </div>
            </div>

            <div style="text-align: center;">
                <br>
                <label><b>Name: </b>{{ Auth()->user()->name }}</label>
                <br>
                <label><b>Email: </b>{{ Auth()->user()->email }}</label>
                <br>
                <label><b>My Posts</b></label>
                <br>
                    @if(count($posts)==0)
                        <label><b> No Posts From You </b></label>
                    @else
                <table style="margin-right: auto; margin-left: auto;">

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
                            <a class="btn btn-success" href="{{ route('single',["id"=>$post->id]) }}">See</a>
                            <a class="btn btn-warning" href="{{ route('edit',["id"=>$post->id]) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('delete',["id"=>$post->id]) }}">Delete</a>
                        </td>
                    </tr>
                    
                @endforeach
                </table>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
