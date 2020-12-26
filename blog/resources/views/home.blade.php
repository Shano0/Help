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
                    <a class="btn btn-outline-primary" href="{{ route('index') }}">Index Page</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
