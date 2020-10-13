     @if ($flash = session('message'))
        <div id="flash-message" class="alert alert-success {{ session()->has('message_important') ? 'alert-important':'' }}" name="alert">
          @if (session()->has('message_important'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          @endif
          {{ $flash }}
        </div>
      @endif