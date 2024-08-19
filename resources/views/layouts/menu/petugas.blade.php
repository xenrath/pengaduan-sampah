<li class="nav-header">Dashboard</li>
<li class="nav-item">
    <a href="{{ url('petugas') }}" class="nav-link {{ request()->is('petugas') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-header">Pengaduan</li>
<li class="nav-item">
    <a href="{{ url('petugas/menunggu') }}" class="nav-link {{ request()->is('petugas/menunggu*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clock"></i>
        <p>
            Pengaduan Menunggu
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('petugas/diproses') }}" class="nav-link {{ request()->is('petugas/diproses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-spinner"></i>
        <p>
            Pengaduan Proses
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('petugas/selesai') }}" class="nav-link {{ request()->is('petugas/selesai*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-check"></i>
        <p>
            Pengaduan Selesai
        </p>
    </a>
</li>
