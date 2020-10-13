<!--FULL SIZE MENU -->
<div class="ui inverted menu menu-top">
  <div class="ui container">
    <a class="ui huge label item icon hidden-mobile hidden-tablet" href="#">@yield('title', Settings::getMetaTitle())</a>

    @if(isset($sorted_albums) && count($sorted_albums))
    <div class="ui item floating  dropdown labeled icon">
      <span class="text">Select Album</span>
      <i class="dropdown icon"></i>
      <div class="menu">
          @include('partials._nav_albums')
      </div>
    </div>
    @endif
    <div class="ui item floating  dropdown labeled icon">
      <span class="text">Article Categories</span>
      <i class="dropdown icon"></i>
      <div class="menu">
          @include('partials._nav_categories')
      </div>
    </div>
  <!--   <a class="item hidden-mobile hidden-tablet" href="{{ url('about') }}">About</a> -->

   
    <form class="ui right item search-form-sm hidden-mobile hidden-tablet" action="{{ url('search') }}">
      <div class="item">
        <div class="ui search">
          <div class="ui icon input">
            <input class="prompt top" type="text" name="query" placeholder="Search articles....">
            <i class="search icon"></i>
          </div>
          <div class="results"></div>
        </div>
      </div>
    </form>
  
   <!--  @if (Auth::guest())

      <a class="ui right item" href="{{ route('login') }}">Login</a>
      <a class="ui item" href="{{ route('register') }}">Register</a>

    @else

    <a class="ui right item"  href="{{ url('dashboard') }}"> <img class="ui avatar mini image  hidden-mobile" src="{{(!empty(Auth::user()->avatar))? url('/storage/images/avatars/'.Auth::user()->avatar) : url('images/avatars/avatar_default.png') }}">&nbsp;Dashboard</a>
    @if(Session::has( config('blogger.auth.impersonification.session_name')))
       <a class="item hidden-mobile hidden-tablet" href="{{ url('dashboard/back-to-admin-mode') }}" name="back-to-admin-mode"><i class="spy icon"></i> Back to Admin Mode</a>
    @endif
    <a class="item" href="{{ route('logout') }}" name="logout"><i class="power icon"></i> Log out</a>

    @endif -->
  </div>
</div>
<!--END OF FULL SIZE MENU-->
