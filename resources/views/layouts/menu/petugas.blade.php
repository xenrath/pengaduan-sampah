<li class="nav-header">Dashboard</li>
<li class="nav-item">
    <a href="{{ url('petugas') }}" class="nav-link {{ request()->is('petugas') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('petugas/pengaduan') }}" class="nav-link {{ request()->is('petugas/pengaduan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data Pengaduan
        </p>
    </a>
</li>