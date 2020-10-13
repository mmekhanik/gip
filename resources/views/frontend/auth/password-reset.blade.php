@extends('layouts.master')
@section('content')


    <!-- Page Content -->
    <div class="container my-5">

      <div class="row">
          <div class="col-8 m-auto">

            {{ photon_notification($errors) }}
            <div class="card">
            <div class="card-header font-weight-bold">{{ __('RESET YOUR PASSWORD') }}</div>

              <div class="card-body">

            <form action="{{ route('passwordReset') }}" method="post" class="bg-white">

            @csrf

            <input type="hidden" value="{{ $token }}" name="token">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
              placeholder="Type Email" aria-describedby="helpId" value="{{ $email }}">
              </div>

              <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" 
                  placeholder="Type password" aria-describedby="helpId">
                  </div>

                  <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="cpassword" class="form-control" 
                      placeholder="Confirm password" aria-describedby="helpId">
                      </div>
            
              <button type="submit" class="btn btn-primary text-white text-uppercase">Reset Password</button>
       
            </form>
          </div>
      </div>
    </div>
      </div>
    </div>
        @endsection
