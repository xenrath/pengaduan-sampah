<li class="nav-header">Dashboard</li>
<li class="nav-item">
    <a href="{{ url('pengguna') }}" class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('pengguna/pengaduan') }}" class="nav-link {{ request()->is('pengguna/pengaduan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Buat Pengaduan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('pengguna/list-pengaduan') }}" class="nav-link {{ request()->is('pengguna/list-pengaduan*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            List Pengaduan
        </p>
    </a>
</li>