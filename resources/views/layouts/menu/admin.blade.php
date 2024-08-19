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
    <a href="{{ url('admin/pengaduan-menunggu') }}" class="nav-link {{ request()->is('admin/pengaduan-menunggu*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Pengaduan Menunggu
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/pengaduan-proses') }}" class="nav-link {{ request()->is('admin/pengaduan-proses*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Pengaduan Proses
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/pengaduan-riwayat') }}" class="nav-link {{ request()->is('admin/pengaduan-riwayat*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Riwayat Pengaduan
        </p>
    </a>
</li>
<li class="nav-header">Lainnya</li>
<li class="nav-item">
    <a href="{{ url('admin/petugas') }}" class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Petugas
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('admin/pengguna') }}" class="nav-link {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
        <i class="nav-icon far fa-circle"></i>
        <p>
            Data Pengguna
        </p>
    </a>
</li>
