  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
      <span class="brand-text font-weight-light">E-Voucher</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a wire:navigate href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashobard
              </p>
            </a>
          </li>
          <li class="nav-header">SUPER ADMIN</li>
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.toko.index') }}" class="nav-link @yield('menuSuperAdminToko')">
              <i class="nav-icon fas fa-store"></i>
              <p>
                TOKO
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.transaksi.index') }}" class="nav-link @yield('menuSuperAdminTransaksi')">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                TRANSAKSI
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.pembayaran.index') }}" class="nav-link @yield('menuSuperAdminPembayaran')">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                PEMBAYARAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.laporan.index') }}" class="nav-link @yield('menuSuperAdminLaporan')">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a wire:navigate href="{{ route('superadmin.pengaturan.index') }}" class="nav-link @yield('menuSuperAdminPengaturan')">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                PENGATURAN
              </p>
            </a>
          </li>
          <li class="nav-header">ADMIN</li>
          <li class="nav-item">
            <a wire:navigate href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                RIWAYAT TRANSAKSI
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>