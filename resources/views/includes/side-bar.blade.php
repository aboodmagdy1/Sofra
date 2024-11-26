<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">El-MAGD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/img/user8-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('admin.profile')}}" class="d-block"> {{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('admin.cities.index')}}" class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                Cities 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.districts.index')}}" class="nav-link">
              <i class="nav-icon fas fa-location-dot"></i>
              <p>
                {{__('Districts')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.categories.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                {{__('Categories')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.payment-methods.index')}}" class="nav-link">
              <i class="nav-icon fas fa-money-check-dollar"></i>
              <p>
                {{__('Payment Methods')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.commisions.index')}}" class="nav-link">
              <i class="nav-icon fas fa-sack-dollar "></i>
              <p>
                {{__('Commissions')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.offers.index')}}" class="nav-link">
              <i class="nav-icon fas fa-percent "></i>
              <p>
                {{__('Offers')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.contacts.index')}}" class="nav-link">
              <i class="nav-icon fas fa-address-book "></i>
              <p>
                {{__('Contacts')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.settings')}}" class="nav-link">
              <i class="nav-icon fas fa-gear "></i>
              <p>
                {{__('Settings')}}
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>