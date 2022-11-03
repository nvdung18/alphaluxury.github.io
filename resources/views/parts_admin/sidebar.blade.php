<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('frontend_admin/images/faces/face1.jpg') }}" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">David Grey. H</span>
          <span class="text-secondary text-small">Project Manager</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#revenue" aria-expanded="false" aria-controls="revenue">
        <span class="menu-title">Revenue</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-chart-bar menu-icon"></i>
      </a>
      <div class="collapse" id="revenue">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('ad.monthly-revenue') }}">Monthly Revenue</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('ad.monthly-revenue') }}">Weekly Revenue</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('ad.monthly-revenue') }}">Daily Revenue</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ad.receipt') }}">
        <span class="menu-title">Receipt</span>
        <i class="mdi mdi-receipt menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ad.order') }}">
        <span class="menu-title">Order</span>
        <i class="mdi mdi-file-document menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ad.product') }}">
        <span class="menu-title">Product</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ad.trademark') }}">
        <span class="menu-title">Trademark</span>
        <i class="mdi mdi-source-branch menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#acc" aria-expanded="false" aria-controls="acc">
        <span class="menu-title">Account</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-box menu-icon"></i>
      </a>
      <div class="collapse" id="acc">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Employee</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Customer</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>