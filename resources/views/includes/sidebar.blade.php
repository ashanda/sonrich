@php
$role = auth()->user()->role;
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link">
    <img src="{{asset('adminlte/dist/img/logo.png')}}" alt="AdminLTE Logo" class="w-100" style="opacity: .8">
    <!-- <span class="brand-text font-weight-light">SONRICH</span> -->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('adminlte/dist/img/user.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="/edit-profile" class="d-block">{{ Auth::user()->fname." ".Auth::user()->lname }}</a>
        @if (Auth::user()->role == 2)
        <p class="text-white" style="font-size: 10px;">{{ 'Super Admin' }}</p>
        @elseif (Auth::user()->role == 1)
        <p class="text-white" style="font-size: 10px;">{{ 'Admin' }}</p>
        @else
        <p class="text-white" style="font-size: 10px;">{{ 'User' }}</p>
        @endif

      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul id="Slide_nav" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/home" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/kyc" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Kyc
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/product" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Products
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            @if ($role == 2 )

            <li class="nav-item">
              <a href="/product/create" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Products</p>
              </a>
            </li>
            @endif

            @if ($role == 2 || $role == 1)
            <li class="nav-item">
              <a href="/product" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Products</p>
              </a>
            </li>

            @endif
            @if ($role == 0)
            <li class="nav-item">
              <a href="/buy_product" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ready to buy products</p>
              </a>
            </li>

            @endif
          </ul>
        </li>
        <li class="nav-item">
          <a href="/product" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Oders
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            @if ($role == 2 || $role == 1)
            <li class="nav-item">
              <a href="/oders" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pending Oders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/all-oders" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Oders</p>
              </a>
            </li>
            @endif
            @if ($role == 0)
            <li class="nav-item">
              <a href="/oders" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Purchesed product</p>
              </a>
            </li>


            @endif
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="/genealogy" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Genealogy
            </p>
          </a>
        </li>
        
        
        @if ($role == 0 || $role == 1)
        <li class="nav-item">
          <a href="/wallet" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Wallet


            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="/p2p_history" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              P2P History


            </p>
          </a>

        </li>
        @endif
        @if ($role == 2)
        <li class="nav-item">
          <a href="/commission_reports" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Commission Report
            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Request
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/friend_request" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Friend Package Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/p2p" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>P2P</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if ($role == 1 || $role == 2)
        <li class="nav-item">
          <a href="/gas_fee_collect" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Gas Fee Collect


            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Reports
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/users_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Users Reports</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/binary_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Binary Points Reports</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/binary_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Binary Points Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/direct_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Direct Points Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/level_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Level Points Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/daily_report" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Daily Points Reports</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </nav>

    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>