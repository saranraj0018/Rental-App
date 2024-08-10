<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset("admin/img/valam.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Rental Cars</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.html" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pickup-delivery.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Hub panel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa fa-cogs"></i>
                        <p>Control panel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="brands.html" class="nav-link">
                        <i class="nav-icon fas fa fa-map"></i>
                        <p>Cities Map</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('car.list')}}" class="nav-link">
                        <i class="nav-icon fas fa fa-car"></i>
                        <p>Car Listing</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <!-- <i class="nav-icon fas fa-tag"></i> -->
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Car Availability</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="orders.html" class="nav-link">
                        <i class="nav-icon fas fa fa-flag"></i>
                        <p>Inspection Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="discount.html" class="nav-link">
                        <i class="nav-icon fa fa-credit-card" aria-hidden="true"></i>
                        <p>Payment Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users.html" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Upload files</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages.html" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Swap panel</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
