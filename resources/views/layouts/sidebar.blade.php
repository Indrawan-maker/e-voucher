<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
    <span class="brand-text font-weight-light">E-VOUCHER</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        @if(auth()->user()->role === 'superadmin')
        <!-- MENU SUPERADMIN -->
        <li class="nav-item">
          <a wire:navigate href="{{ route('superadmin.dashboard.index') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">SUPER ADMIN</li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('superadmin.transaksi.index') }}" class="nav-link @yield('menuSuperAdminTransaksi')">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>TRANSAKSI</p>
          </a>
        </li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('superadmin.pembayaran.index') }}" class="nav-link @yield('menuSuperAdminPembayaran')">
            <i class="nav-icon fas fa-credit-card"></i>
            <p>PEMBAYARAN</p>
          </a>
        </li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('superadmin.toko.index') }}" class="nav-link @yield('menuSuperAdminToko')">
            <i class="nav-icon fas fa-store"></i>
            <p>TOKO</p>
          </a>
        </li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('superadmin.voucher.index') }}" class="nav-link @yield('menuSuperAdminVoucher')">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>VOUCHER</p>
          </a>
        </li>
        @else
        <!-- MENU ADMIN TOKO -->
        <li class="nav-item">
          <a wire:navigate href="{{ route('admin.dashboard.index') }}" class="nav-link @yield('menuAdminDashboard')">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">ADMIN TOKO</li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('admin.transaksi.index') }}" class="nav-link @yield('menuAdminTransaksi')">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>TRANSAKSI</p>
          </a>
        </li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('admin.pembayaran.index') }}" class="nav-link @yield('menuAdminPembayaran')">
            <i class="nav-icon fas fa-credit-card"></i>
            <p>PEMBAYARAN</p>
          </a>
        </li>
        <li class="nav-item">
          <a wire:navigate href="{{ route('admin.voucher.index') }}" class="nav-link @yield('menuAdminVoucher')">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>VOUCHER</p>
          </a>
        </li>
        @endif

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
