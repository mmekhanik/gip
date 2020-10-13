@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }}
                </div>

                <div class="card-body">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <textarea name="body" rows="3" class="form-control" placeholder="What is on your mind?"></textarea>
                        <button type="submit" class="btn btn-primary" >Post</button>
                    </form>
                   <!--  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                </div>
                <hr>    
                <div class="card-body">
                    @foreach($messages as $message)
                        <h5><a href="/u/{{ $message->user->id}}">{{ $message->user->name}}</a></h5>
                        {{ $message->body }}
                        <br/>
                        <small> {{ $message->created_at->format('d/m/Y') }}</small>
                        <hr>
                    @endforeach

                </div>
                <div class="alert alert-success" role="alert">
                            {{ 'marina' }}
                        </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Notificatins</div>
                <div class="card-body">
                    @foreach($user->Notifications as $notification)
                        <h5><a href="/u/{{ $notification->data['user_id']}}">{{ $notification->data['user_name']}}</a> started following you!</h5>
                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
