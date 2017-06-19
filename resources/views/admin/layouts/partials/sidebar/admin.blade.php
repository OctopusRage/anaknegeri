<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.index')}}"><i class="icon-speedometer"></i> Dashboard</a>
            </li>

            <li class="nav-title">
                Kelola Content
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.campaign')}}"><i class="icon-cursor"></i> Campaign</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.campaign')}}"><i class="icon-note"></i> Pelaporan</a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-user"></i> User</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.user')}}"><i class="icon-list"></i> Data User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}"><i class="icon-user-following"></i> Verifikasi User</a>
                    </li>
                </ul>
            </li>
            
             <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Wallet</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.wallet')}}"><i class="icon-list"></i> Data Wallet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}"><i class="icon-check"></i> Konfirmasi Transfer</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}"><i class="icon-drawer"></i> Permintaan Penarikan</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}"><i class="icon-settings"></i> Pengaturan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}"><i class="icon-globe"></i> Website</a>
            </li>

        </ul>
    </nav>
</div>