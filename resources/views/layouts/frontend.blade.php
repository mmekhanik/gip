@extends('layouts.masterblog')

@section('body_styles')
  @yield('styles')
@stop

@section('body_content')


<div class="pusher">
    <div class="main-content">
      @include('partials._nav_top')
      <div class="ui grid padded">
        <div class="ui container">
          @yield('content')
          @include('partials._cookies_message')
        </div>
      </div>

      @include('partials._footer')

    </div>

    @include('partials._contact_form_modal')
    @include('partials._scroll_top')
  </div><!--end of pusher-->
@stop

@section('body_scripts')
  @yield('scripts')
@stop
@section('body_post_scripts')
  @yield('post_scripts')
@stop
