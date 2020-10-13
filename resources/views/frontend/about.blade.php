
@extends('layouts.master')
@section('content')

<div class="bg-white p-0">
  <div class="container-fluid">
     <div class="col-md-12">
        <div class="row rounded overflow-hidden flex-md-row  position-relative">
          <div class="col-md-12 col d-flex flex-column position-static">
              <h1 style="color: #3d5670;"  class="display-4 font-italic align-items-center">About Us</h1>
          </div>
        </div>
      </div> 
<!--   <section>
   @if (count($teams) > 0)
      @foreach ($teams as $team)

          <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class=" position-static d-none d-lg-block">
            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Admin">
              <title>{{ $team->name }}</title>
              <rect width="100%" height="100%" fill="#3d5670"/>
              <image width="200px" height="250px" href="{{ photon_thumbnail($team->thumbnail, '\teams') }}" />
              <text x="50%" y="90%" fill="#eceeef" dy=".1em">
              </text>
            </svg>
          </div>
          <div class="col p-4 d-flex flex-column col-auto ">
            <strong class="d-inline-block mb-2 text-primary"> {{ $team->description }}</strong>
            <h3 class="mb-0">{{ $team->name }}</h3>
            <div class="mb-1 text-muted">Nov 11</div>
            <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="stretched-link">Continue reading</a>
             <p>
                          <a href="#" class="pl-0 pr-3"><span class="icon-twitter"></span></a>
                          <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                          <a href="#" class="pl-3 pr-3"><span class="icon-facebook"></span></a>
              </p>
          </div>
        </div>
                
      @endforeach
  @endif
 
</section> -->
</div>     
    <div class="row justify-content-center">
            <div class="col-md-12">
              <!-- <div class="row mb-5 site-section">
                <div class="col-12 ">
                  <h2 class="site-section-heading text-center">About Us</h2>
                </div>
              </div> -->
    
              {{-- <div class="row mb-5">
                <div class="col-md-7">
                  <img src="images/img_2.jpg" alt="Images" class="img-fluid">
                </div>
                <div class="col-md-4 ml-auto">
                  <h3>Our Mission</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus vel tenetur explicabo necessitatibus, ad soluta consectetur illo qui voluptatem. Quis soluta maiores eum. Iste modi voluptatum in repudiandae fugiat suscipit dolorum harum, porro voluptate quis? Alias repudiandae dicta doloremque voluptates soluta repellendus, unde laborum quo nam, ullam facere voluptatem similique.</p>
                </div>
              </div> --}}
    
             
              <div class="row site-section">
                @if (count($teams) > 0)
                    @foreach ($teams as $team)
                    <div class="col-md-6 col-lg-6 col-xl-4 text-center mb-5">
                    <img src="{{ photon_thumbnail($team->thumbnail, '\teams') }}" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
                    <h2 class="text-black font-weight-light mb-4">{{ $team->name }}</h2>
                        <p class="mb-4">
                          {{ $team->description }}
                        </p>
                        <p>
                          <a href="#" class="pl-0 pr-3"><span class="icon-twitter"></span></a>
                          <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                          <a href="#" class="pl-3 pr-3"><span class="icon-facebook"></span></a>
                        </p>
                      </div>
                              
                    @endforeach
                @endif
              </div>
            </div>
        
          </div>
      
      </div>
@endsection