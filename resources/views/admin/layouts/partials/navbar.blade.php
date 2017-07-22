<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
    
    <a class="navbar-brand text-info text-center" href="{{route('admin.index')}}">
            <i class="icon-graduation">
                
            </i>
            Anaknegeri
    </a>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">
                <i class="icon-menu"></i>
            </a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{route('home')}} " target="_blank"><i class="icon-action-redo"></i>&nbsp; Ke Website</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown pr-3 ">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img @if(Auth::user()->profile_img !=null) src="{{ asset('img/avatars/')}}/{{ $user->profile_img }}" @else src="{{ asset('img/primary.png' )}}" @endif class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="d-md-down-none">{{  Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right mr-3">
                <a class="dropdown-item"  href="#"><i class="icon-settings"></i> Pengaturan</a>
                <div class="divider"></div>
                <a class="dropdown-item" href="{{ route('authenticated.logout')}}"><i class="icon-logout"></i> Logout</a>
            </div>
        </li>
    </ul>
</header>