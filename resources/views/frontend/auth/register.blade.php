@extends('layouts.master')
@section('content')


<!-- Page Content -->
<div class="container">

  <div class="row">
    <div class="col-8 m-auto">
           
      {{ photon_notification($errors) }}
      <div class="card">
          <div class="card-header font-weight-bold">{{ __('REGISTER') }}</div>

          <div class="card-body">

            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="bg-white">

            @csrf


              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" 
                placeholder="Type name">
              </div>


              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                placeholder="Type Email" aria-describedby="helpId">
              </div>


              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" 
                aria-describedby="helpId" placeholder="Enter Password">
              </div>

              <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirmpassword" class="form-control" 
                aria-describedby="helpId" placeholder="Enter Confirm Password">
              </div>

              <button type="submit" class="btn btn-primary text-white text-uppercase">Register</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    @endsection
