<ol class="breadcrumb 
@if(session('message'))
mb-0
@endif">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>

    <!-- Breadcrumb Menu-->
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-secondary" href="#"><i class="icon-clock"></i>&nbsp; <?php echo date("d-m-Y H:i:s"); ?></a>
        </div>
    </li>
</ol>
@if(session('message'))
<nav class="navbar  navbar-inverse bg-primary mb-4">
   <span class="navbar-text">
      {{ session('message') }}, {{ Auth::user()->name }}
    </span>
</nav>
@endif