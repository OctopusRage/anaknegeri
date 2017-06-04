@if(session('message'))
<nav class="navbar  navbar-inverse bg-inverse">
   <span class="navbar-text">
      {{ session('message') }}, {{ Auth::user()->name }}
    </span>
</nav>
@endif