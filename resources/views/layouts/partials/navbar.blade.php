<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">
        <i class="icon-menu">
            
        </i>
    </button>
    <a class="navbar-brand text-info text-center" href="/">
            <i class="icon-graduation">
                
            </i>
            Anaknegeri
    </a>
    <ul class="nav navbar-nav d-md-down-none"  >
        <li class="nav-item px-3" >
            <form class="form-inline my-2 my-lg-0 text-center">
                <div class="input-group">
                    <input type="text"  name="search-form" id="search-form" class="form-control" placeholder="Cari Campaign">
                    <span class="input-group-btn">  
                        <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </li>
    </ul>
<ul class="nav navbar-nav ml-auto">
    <li class="nav-item px-3 d-md-down-none">
        <a class="nav-link active" href="{{ route('campaign') }}">Campaign</a>
    </li>
    <li class="nav-item dropdown pr-3 ">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/avatars/6.jpg') }} " class="img-avatar" alt="admin@bootstrapmaster.com">
            <span class="d-md-down-none">Full Name</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right mr-3">
            <a class="dropdown-item"  href="{{ url('/loginadmin') }}"><i class="icon-login"></i> Login</a>
            <a class="dropdown-item"  href="{{ url('/registeradmin') }}"><i class="icon-people"></i> Register</a>
            <a class="dropdown-item"  href="{{ route('profile') }}"><i class="icon-user"></i> Profil</a>
            <a class="dropdown-item"  href="{{ route('profile-campaign') }}"><i class="icon-cursor"></i> Campaign</a>
            <a class="dropdown-item"  href="{{ route('profile-wallet') }}"><i class="icon-wallet"></i> Dompet</a>
            <a class="dropdown-item"  href="{{ route('profile-account') }}"><i class="icon-settings"></i> Akun</a>
            <div class="divider"></div>
            <a class="dropdown-item" href="#"><i class="icon-logout"></i> Logout</a>
        </div>
    </li>
</ul>
</header>