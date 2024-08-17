<li class="nav-header">Dashboard</li>
<li class="nav-item">
    <a href="{{ url('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-header">Menu</li>
<li class="nav-item">
    <a href="{{ url('admin/pengaduan') }}" class="nav-link {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data Pengaduan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/petugas') }}" class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data Petugas
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/pengguna') }}" class="nav-link {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data Pengguna
        </p>
    </a>
</li>