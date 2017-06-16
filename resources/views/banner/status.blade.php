@if(session('message'))
<nav class="navbar  navbar-inverse bg-inverse">
   <span class="navbar-text">
      {{ session('message') }}
    </span>
</nav>
@endif
