<ol class="breadcrumb 
@if(session('message'))
mb-0
@endif">

<li class="breadcrumb-item"><a href="/admin">Admin</a></li>

@php 
  $bread = URL::to('/admin'); 
  $link = Request::path(); 
  $subs = explode("/", $link);
@endphp

@if (Request::path() != '/')

  @for($i = 1; $i < count($subs); $i++)

    @php 
      $bread = $bread."/".$subs[$i]; 
      $title = urldecode($subs[$i]);
      $title = str_replace("-", " ", $title);
      $title = title_case($title);
    @endphp
    @if ($i == count($subs)-1)
        <li class="breadcrumb-item">{{ $title }}</li>
    @else
    <li class="breadcrumb-item"><a href="{{ $bread }}">{{ $title }}</a></li>
    @endif
    

  @endfor

@endif
</ol>
@if(session('message'))
<nav class="navbar  navbar-inverse bg-primary mb-4">
   <span class="navbar-text">
      {{ session('message') }}, {{ Auth::user()->name }}
    </span>
</nav>
@endif
