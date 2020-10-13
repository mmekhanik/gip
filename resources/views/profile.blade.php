@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <form form method="POST" enctype="multipart/form-data" action="{{ route('follow') }}">
                         {{ csrf_field() }}
                        <input type="hidden" name="user" value="{{ $user->id }}">
                        @if (Auth::user()->isFollowing($user))
                            <input class="btn btn-danger float-right" value="Unfollow!" name="unfollow" type="submit" ></input>
                        @else
                            <input class="btn btn-primary float-right" value="Follow!" name="follow" type="submit" ></input>
                        @endif
                    </form>
                <div class="card-body">
                  
                   <!--  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                </div>
                <hr>    
                <div class="card-body">
                    @foreach($messages as $message)
                        <h5>{{ $message->user->name}}</h5>
                        {{ $message->body }}
                        <br/>
                        <small> {{ $message->created_at->format('d/m/Y') }}</small>
                        <hr>
                    @endforeach
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
