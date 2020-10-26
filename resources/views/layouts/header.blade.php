<header class="site-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-1 pt-0">
        <a class="text-muted" href="#subscribe"><img style ="max-width:70px; margin-top: -7px;" src="/img/apple-touch-icon.png" alt="Gipirion Inc"></a>
      </div>
      <div class="col-5 text-left">

        <a class="site-header-logo text-dark" href="#">{{Settings::getMetaTitle()}}</a>
      </div>
   
     <!--  <div class="search-bar">
        <i class="icon fa fa-search"></i>
        <input class="input-text" type="text" name="eingabe" placeholder="Suche">
      </div> -->
     <!--  <div class="col-6 d-flex justify-content-end align-items-left">
        <div class="col-md-6 search-bar">
          <a class="text-muted icon ml-0" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
          </a> -->
          <!-- <div class="searcher input-text">
            <form id="quicksearch" method="post">
              <div class="searcher-inner input-text">
                <input active id="story" name="story" placeholder="Введите слово для поиска..." type="text" />
                <button type="submit" title="Найти">Найти</button>
              </div>
            </form>
        </div> -->
      
       <!--    <input class="form-control input-text searcher" type="text" name="search" placeholder="Search"/>
        
        </div> -->

        <!-- <i class="fa fa-search show-search"></i> -->
      <!--   <div class="searcher input-text">
          <form id="quicksearch" method="post">
            <input type="hidden" name="do" value="search" />
            <input type="hidden" name="subaction" value="search" />
            <div class="searcher-inner">
              <input id="story" name="story" placeholder="Введите слово для поиска..." type="text" />
              <button type="submit" title="Найти">Найти</button>
            </div>
          </form>
        </div> -->
        

      <!--   @guest
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign In</a>
          @if (Route::has('register'))
            <div class="col-md-4">
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
          @endif
        @else
        <div class="col-md-4">
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
         @endguest
      </div> -->
      <div class="col-4 d-flex justify-content-end align-items-center">
       <!--  <a class="text-muted" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a> -->

        @guest
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign In</a>
          @if (Route::has('register'))
            <div class="col-md-6">
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
          @endif
        @else
        <div class="col-md-6">
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
         @endguest
      </div>
    </div>
  </header>