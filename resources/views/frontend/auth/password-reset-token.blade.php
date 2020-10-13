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

            <form action="{{ route('passwordResetToken') }}" method="post" class="bg-white">

            @csrf


              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                placeholder="Type Email" aria-describedby="helpId">
              </div>


              <button type="submit" class="btn btn-primary text-white text-uppercase">Send</button>
       
            </form>
          </div>
      </div>
    </div>
      </div>
    </div>
        @endsection
