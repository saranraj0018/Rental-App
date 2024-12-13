<!-- Main Sidebar Container -->
@php
    $permissions = getAdminPermissions();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/img/valam.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Rental Cars</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                @if (in_array('dashboard_view', $permissions))
                    <li class="nav-item">
                        <a href="dashboard.html" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
                @if (in_array('hub_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('pickup-delivery.list') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Hub panel</p>
                        </a>
                    </li>
                @endif

                @if (in_array('booking_completed_view', $permissions))

                <li class="nav-item">
                    <a href="{{ route('complete.booking') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Booking Complete</p>
                    </a>
                </li>
                @endif

                @if (in_array('booking_pending_view', $permissions))

                <li class="nav-item">
                    <a href="{{ route('pending.booking') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Booking Pending</p>
                    </a>
                </li>
                @endif


                @if (in_array('booking_cancel_view', $permissions))

                <li class="nav-item">
                    <a href="{{ route('cancel.booking.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Booking Cancel</p>
                    </a>
                </li>
                @endif


                @if (in_array('user_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('user.list') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-address-book"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif

                @if (in_array('city_list_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('city.list') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>City List</p>
                        </a>
                    </li>
                @endif

                @if (in_array('cities_map_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('city.map') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-map"></i>
                            <p>Cities Map</p>
                        </a>
                    </li>
                @endif

                @if (in_array('car_listing_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('car.list') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-car"></i>
                            <p>Car Listing</p>
                        </a>
                    </li>
                @endif

                @if (in_array('car_block_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('car-block.list') }}" class="nav-link">
                            <!-- <i class="nav-icon fas fa-tag"></i> -->
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Car block</p>
                        </a>
                    </li>
                @endif

                @if (in_array('car_availablity_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('car-available.list') }}" class="nav-link">
                            <!-- <i class="nav-icon fas fa-tag"></i> -->
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Car Availability</p>
                        </a>
                    </li>
                @endif

                {{-- @if (in_array('user_view', $permissions)) --}}
                <li class="nav-item">
                    <a href="{{ route('car-swap.list') }}" class="nav-link">
                        <i class="nav-icon fas fa fa-map"></i>
                        <p>Swap Cars</p>
                    </a>
                </li>
                {{-- @endif --}}


                @if (in_array('roles_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('user-role.list') }}" class="nav-link">
                            <i class="nav-icon  fas fa-users"></i>
                            <p>User Roles</p>
                        </a>
                    </li>
                @endif

                @if (in_array('holidays_view', $permissions))
                    <li class="nav-item">
                        <a href="{{ route('holidays.list') }}" class="nav-link">
                            <i class="nav-icon  far fa-file-alt"></i>
                            <p>Holidays</p>
                        </a>
                    </li>
                @endif


                <!-- Manage Section with Hide/Show Functionality -->
                <li class="nav-item">
                    <a href="#manageSection" class="nav-link" data-bs-toggle="collapse">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Manage Section
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>








                    <ul class="nav nav-treeview collapse" id="manageSection">
                        <!-- Hub Panel -->
                        @if (in_array('general_settings_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('general.list') }}" class="nav-link">
                                    <i class="nav-icon fas fa-car"></i>
                                    <p>General Setting </p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('banner_section_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('banner.list') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Banner Section</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('coupon_view', $permissions))
                            <!-- Car Listing -->

                            <li class="nav-item">
                                <a href="{{ route('coupon.list') }}" class="nav-link">
                                    <i class="nav-icon fas fa-car"></i>
                                    <p>Coupon</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('real_time_information_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('car-info.view') }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p> Real Time Information</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('brands_and_vacation_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('brand.view') }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Brands And Vacation</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('faq_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('faq.list') }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>FAQ</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('policy.list', ['section' => 'policy']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Privacy Policy</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('terms.list', ['section' => 'terms']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Terms & Conditions</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('shipping.list', ['section' => 'shipping']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Shipping</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('refunds.list', ['section' => 'refunds']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Refund</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('pricing.list', ['section' => 'pricing']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Pricing</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('others_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('cancel.list', ['section' => 'cancel']) }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Cancellation</p>
                                </a>
                            </li>
                        @endif

                        @if (in_array('important_points_view', $permissions))
                            <li class="nav-item">
                                <a href="{{ route('ipr-info.view') }}" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Important Points</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
