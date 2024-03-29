<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="/" style="display: flex; align-items: center;" class="text-nowrap logo-img">
            <img src="/assets/images/logos/favicon.png" width="35" alt="" />
            <h3 class="mt-2" style="margin-left: 10px; font-weight: bold;">APP KASIR</h3>
        </a>
        
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">UI COMPONENTS</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/produk" aria-expanded="false">
              <span>
                <i class="ti ti-list"></i>
              </span>
              <span class="hide-menu">Produk</span>
            </a>
          </li>
          
          @if (auth()->user()->level=='Kasir')
          <li class="sidebar-item">
            <a class="sidebar-link" href="/pelanggan" aria-expanded="false">
              <span>
                <i class="ti ti-article"></i>
              </span>
              <span class="hide-menu">Pelanggan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/penjualan" aria-expanded="false">
              <span>
                <i class="ti ti-cash"></i>
              </span>
              <span class="hide-menu">Penjualan</span>
            </a>
          </li>
        
          @endif
          
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">AUTH</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/login" aria-expanded="false">
              <span>
                <i class="ti ti-login"></i>
              </span>
              <span class="hide-menu">Login</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/pengguna" aria-expanded="false">
              <span>
                <i class="ti ti-user-plus"></i>
              </span>
              <span class="hide-menu">Pengguna</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>