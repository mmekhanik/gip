<div class="ui vertical segment inverted footer">
   <div class="ui center aligned middle aligned container footer-container">
     <div class="ui stackable inverted divided grid">
       <div class="five wide column">
         <h4 class="ui inverted header">Shortcuts</h4>
         <div class="ui inverted link list">
           <a href="{{ url('/') }}" class="item">Home</a>
           <a href="{{ url('/articles') }}" class="item">Articles</a>
           <a href="{{ url('/albums') }}" class="item">Albums</a>
           <a href="{{ url('about') }}" class="item">About</a>
           @if(!Auth::check())
           <a href="{{ url('login') }}" class="item">Login</a>
           <a href="{{ url('register') }}" class="item">Registration</a>
           @endif
         </div>
       </div>
       <div class="five wide column">
         <h4 class="ui inverted header">Address</h4>
         <div class="ui inverted link list">
           <div class="item"><i class="users icon"></i>Gipirion, Inc</div>
           <div class="item"><i class="marker icon"></i>  New Providence, NJ USA</div>
           <a class="item" href="mailto:marina_mekhanik@yahoo.com"><i class="mail icon"></i> mailto:marina_mekhanik@yahoo.com</a>
            <a class="item" href="http://www.github.com/mmekhanik"><i class="github icon"></i> http://www.github.com/mmekhanik</a>
           <a class="item" href="http://www.example.com"><i class="linkify icon"></i> http://www.example.com</a>
        </div>
       </div>
       <div class="six wide column">
        <h4 class="ui inverted header">Support this free open-source project</h4>
        <p>All help comes directly from the community</p>
        <p><button class="ui button primary"><i class="paypal icon"></i> Donate now!</button></p>
       </div>
     </div>
     <div class="ui inverted section divider"></div>
     <a href="{{ url('/') }}">
       <img src="{{ url('img/apple-touch-icon.png') }}" class="ui centered mini image" alt="{{config('app.name')}}">
     </a>
     <div class="ui horizontal inverted small divided link list">
       <a class="item" href="{{ url('sitemap') }}">Site Map</a>
       <a class="item" href="{{ url('terms-and-conditions') }}">Terms and Conditions</a>
       <a class="item" href="{{ url('privacy-policy') }}">Privacy Policy</a>
     </div>
     <div>
       @include('partials._credits_footer')
     </div>
   </div>
 </div>
