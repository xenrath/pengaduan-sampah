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
    <a href="{{ url('admin/user') }}" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data Pengaduan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/user') }}" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Data User
        </p>
    </a>
</li>