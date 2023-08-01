<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars mt-1"></i></a>
    </li>

    <input type="hidden" id="modeSelect" value="curr2">

    <!-- <li class="nav-item">
      <select class="mt-1" id="modeSelect" onchange="updateCurrency()">
        <option value="curr1">Currency 1</option>
        <option value="curr2" selected>Currency 2</option>
      </select>
    </li> -->

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->

    <!-- Messages Dropdown Menu -->
    @if (Auth::user()->role == 1)
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"> {{ count(gas_fee_collect())}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"> {{ count(gas_fee_collect())}} Notifications</span>
        <div class="dropdown-divider"></div>

        <div class="dropdown-divider"></div>
        @foreach ( gas_fee_collect() as $data)
        <a href="#" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> {{ $data->id}} - {{ $data->fname." ".$data->lname }}
          <span class="float-right text-muted text-sm">{{ $data->total_package_earnings }}</span>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach


    </li>
    @endif

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt mt-1"></i>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li> -->
    <li class="nav-link">
      <i class="fas fa-moon drkMode" onclick="drkMode()" id="drkMode"></i>
    </li>
    <li class="nav-item">
      <form method="POST" class="mb-0" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="nav-link lh-1 mt-1">{{ __('Logout') }}
        </a>
      </form>
    </li>

  </ul>
</nav>