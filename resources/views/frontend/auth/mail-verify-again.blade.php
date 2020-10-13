@extends('layouts.master')
@section('content')


    <!-- Page Content -->
    <div class="container my-5">
        <div class="row">

            <div class="col-7 m-auto">
                {{ photon_notification($errors) }}
                   <div class="card">
                <div class="card-header font-weight-bold">{{ __('YOUR EMAIL IS NOT VERIFIED') }}</div>

                <div class="card-body">
                              <form action="{{ route('verifyAgain') }}" method="post">
                                      @csrf
                                      @method('PUT')
                                       <label for="email">Email</label>
                                      <input type="text" name="email" class="form-control mb-3">
                                      <input type="submit" value="Resent verification" 
                                      class="btn btn-primary text-white text-uppercase">
                                  </form>
                            </div>
                          </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    @endsection
