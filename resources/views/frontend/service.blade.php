
@extends('layouts.master')
@section('pagespecificstyles')
 
@stop

@section('content')


<div class="bg-white"  data-aos="fade">
  <div class="row rounded overflow-hidden flex-md-row  position-relative">
            <div class="col-md-12 col d-flex flex-column position-static">
                <h1 style="color: #3d5670;"  class="display-4 font-italic align-items-center">Our Services</h1>
            </div>
          </div>
        <div class="container-fluid">
          
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="row">
                
                @if (count($ourservices) > 0)
                    @foreach ($ourservices as $ourservice)
                    <div class="col-md-6 col-lg-6 col-xl-4 text-center mb-5 mb-lg-5">
                      <div class="h-100 p-4 p-lg-5 bg-light site-block-feature-7">
                        <span class="display-3 text-primary mb-4 d-block">
                            <img src="{{ photon_thumbnail($ourservice->thumbnail) }}" class="img-fluid">
                        </span>
                      <h3 class="text-black h4">{{$ourservice->title  }}</h3>
                      <p>{{
                        $ourservice->description
                        }}</p>
                        <p><strong class="font-weight-bold text-primary">
                          {{ $ourservice->price()}}</strong></p>
                      </div>
                    </div>
                            
                    @endforeach
                @endif
                
    
    
              </div>
            </div>
          </div>
        </div>
      </div>
        
    
@endsection

@section('pagespecificscripts')
  
  <script>
    $(document).ready(function(){
      console.log('service');
    });
  </script>

@stop