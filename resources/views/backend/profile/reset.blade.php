@extends('layouts.backend')

@section('title', 'Profile')

@section('content')

<div class="ui segment large">
  {!! Breadcrumbs::render('backend.profile') !!}
</div><!--end of segment-->

<div class="ui segment teal padded">
<h2>Update profile</h2>
<form class="ui form" method="POST" action="{{url('dashboard/profilereset')}}">
{{method_field('PUT')}}

  {{csrf_field()}}
  @include('partials._errors')
  @include('partials._success',['flashSuccess'=>'status'])
  <div class="field fluid {{ $errors->has('email') ? 'error' : '' }}">
    <label for="email">E-mail address</label>
    <div class="ui input">
      <input type="text" name="email" id="email" placeholder="E-mail address" value="{{ ($user->email) ?? old('email')}}" autofocus>
    </div>
  </div>

  <div class="field fluid {{ $errors->has('password') ? 'error' : '' }}">
    <label for="password">Password</label>
    <div class="ui input action">
      <input type="password" id="password" name="password" class="show-new-password-field" placeholder="Password" required>
      <button class="ui icon primary button show-new-password" tabindex="-1">
        <i class="eye icon"></i>
      </button>
    </div>
  </div>

  <div class="field fluid {{ $errors->has('password') ? 'error' : '' }}">
    <label for="password_confirmation">Password Confirmation</label>
    <div class="ui input action">
      <input type="password" id="password_confirmation"  name="password_confirmation" class="show-new-password-confirmation-field" placeholder="Password Confirmation">
      <button class="ui icon primary button show-new-password-confirmation" tabindex="-1">
        <i class="eye icon"></i>
      </button>
    </div>
  </div>

   <button class="ui fluid fluid primary submit button" type="submit" name="submit">
      Reset Password
   </button>
</form>
</div>

@endsection
