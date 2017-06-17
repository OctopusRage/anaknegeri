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
        <a class="nav-link {{ Request::segment(1) === 'campaign' ? 'active' : null }}" href="{{ route('campaign.home') }}">Campaign</a>
    </li>
    <li class="nav-item dropdown pr-3 ">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/avatars/6.jpg') }} " class="img-avatar" alt="admin@bootstrapmaster.com">
            <span class="d-md-down-none">@if(Auth::check()) {{  Auth::user()->name }} @else Guest @endif</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right mr-3">
             @if (Route::has('login'))
                @if (Auth::check())
                    @if (Auth::user()->hasRole('administrator'))
                         <div class="dropdown-header text-center">
                            <strong>Administrator</strong>
                        </div>
                        <a class="dropdown-item"  href="{{ route('admin.index') }}"><i class="icon-speedometer"></i> Dashboard</a>
                    @endif
                     @if (Auth::user()->hasRole('organization'))
                         <div class="dropdown-header text-center">
                            <strong>Organisasi</strong>
                        </div>
                        <a class="dropdown-item"  href="{{ route('admin.index') }}"><i class="icon-speedometer"></i> Profil Publik</a>
                    @endif

                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a class="dropdown-item"  href="{{ route('profile.home')}}"><i class="icon-user"></i> Profil</a>
                    <a class="dropdown-item"  href="{{ route('profile-campaign') }}"><i class="icon-cursor"></i> Campaign</a>
                    <a class="dropdown-item"  href="{{ route('profile.wallet') }}"><i class="icon-wallet"></i> Dompet</a>
                    <a class="dropdown-item"  href="{{ route('profile-account') }}"><i class="icon-settings"></i> Akun</a>
                    <a class="dropdown-item" href="{{ route('authenticated.logout')}}"><i class="icon-logout"></i> Logout</a>
                @else
                    <a class="dropdown-item"  href="{{ route('login') }}"><i class="icon-login"></i> Login</a>
                    <a class="dropdown-item"  href="{{ route('register') }}"><i class="icon-people"></i> Register</a>
                @endif
            @endif

            
        </div>
    </li>
</ul>
</header>