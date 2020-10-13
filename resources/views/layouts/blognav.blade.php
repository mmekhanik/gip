  <div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link" href="#">Home</a>
    <a class="nav-link" href="#">
      Friends
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
    <a class="nav-link" href="/post" class="active">Blogs</a>
    <a class="nav-link" href="/post/create">Create Post</a>
    <a class="nav-link" href="/about" >About Us</a>
     @if(Auth::check())
        <a class="navbar-toggler ml-auto" href="#">{{  Auth::user()->name }}</a>
      @endif
     
  </nav>
</div>
