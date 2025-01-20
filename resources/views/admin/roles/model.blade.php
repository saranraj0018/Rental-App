<div class="modal fade" id="add_user_role" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_role_label">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_role_form">
                    <div class="form-row w-75">
                        <label for="role">User Role</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="role">
                        <div class="invalid-feedback">
                            Please enter the Role.
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" id="save_user_role" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@php

    $permissions = [
     [
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'permissions' => [
                'view' => 'View Dashboard',

            ],
        ],
        [
            'name' => 'User',
            'slug' => 'user',
            'permissions' => [
                'view' => 'View User List',
                'view_docs' => 'View User Documents',
                'export' => 'Export User Data',
            ],
        ],

        [
            'name' => 'City List',
            'slug' => 'city_list',
            'permissions' => [
                'view' => 'View City List',
                'create' => 'Create City',
                'update' => 'Update City',
                'delete' => 'Delete City',
            ],
        ],

        [
            'name' => 'Cities Map',
            'slug' => 'cities_map',
            'permissions' => [
                'view' => 'View Cities Map',
                'create' => 'Create Cities Map',
            ],
        ],

        [
            'name' => 'Car Listing',
            'slug' => 'car_listing',
            'permissions' => [
                'view' => 'View Car List',
                'view_history' => 'View Car History',
                'create_car' => 'Create Car',
                'create_model' => 'Create Car Model',
                'update' => 'Update Car/Model',
                'delete' => 'Delete Car/Model',
                'update_model' => 'Update Car Model',
            ],
        ],

        [
            'name' => 'Car Block',
            'slug' => 'car_block',
            'permissions' => [
                'view' => 'View Car Block',
                'create' => 'Create Car Block',
                'update' => 'Update Car Block',
                'delete' => 'Delete Car Block',
            ],
        ],

        [
            'name' => 'Swap Cars',
            'slug' => 'swap_cars',
            'permissions' => [
                'view' => 'Swap Cars View',
                'search' => 'Swap Cars Search',
                'history' => 'Swap Cars History',
            ],
        ],

        [
            'name' => 'Car Availability',
            'slug' => 'car_availablity',
            'permissions' => [
                'view' => 'View Car Availability',
            ],
        ],

        [
            'name' => 'Roles and Permissions',
            'slug' => 'roles',
            'permissions' => [
                'view' => 'View Roles',
                'create' => 'Create Roles',
                'update' => 'Update Roles',
                'delete' => 'Delete Roles',
            ],
        ],

        [
            'name' => 'Holidays',
            'slug' => 'holidays',
            'permissions' => [
                'view' => 'View Holidays',
                'create' => 'Create Holidays',
                'update' => 'Update Holidays',
                'delete' => 'Delete Holidays',
                  'history' => 'View Holiday History',
            ],
        ],

        [
            'name' => 'General Settings',
            'slug' => 'general_settings',
            'permissions' => [
                'view' => 'View General Settings',
                'update' => 'Update General Settings',
            ],
        ],

        [
            'name' => 'Banner Section',
            'slug' => 'banner_section',
            'permissions' => [
                'view' => 'View Banner Section',
                'update' => 'Update Banner Section',
            ],
        ],

        [
            'name' => 'Coupons',
            'slug' => 'coupon',
            'permissions' => [
                'view' => 'View Coupons',
                'create' => 'Create Coupons',
                'update' => 'Update Coupons',
                'delete' => 'Delete Coupons',
                  'history' => 'View Coupon History',
            ],
        ],

        [
            'name' => 'Real-Time Information',
            'slug' => 'real_time_information',
            'permissions' => [
                'view' => 'View Real-Time Information',
                'update' => 'Update Real-Time Information',
            ],
        ],
 [
            'name' => 'Brands and Vacation',
            'slug' => 'brands_and_vacation',
            'permissions' => [
                'view' => 'View Brands and Vacation',
                "create" => "Create brands and Vacation"
            ],
        ],

        [
            'name' => 'FAQs',
            'slug' => 'faq',
            'permissions' => [
                'view' => 'View FAQs',
                'create' => 'Create FAQs',
                'update' => 'Update FAQs',
                'delete' => 'Delete FAQs',
            ],
        ],

        [
            'name' => 'Others',
            'slug' => 'others',
            'permissions' => [
                'view' => 'View Others',
                'update' => 'Update Others',
            ],
        ],

        [
            'name' => 'Important Points',
            'slug' => 'important_points',
            'permissions' => [
                'view' => 'View Important Points',
                'update' => 'Update Important Points',
            ],
        ],

        [
            'name' => 'Hub and Booking Management',
            'slug' => 'hub',
            'permissions' => [
                'view' => 'View Hub Data',
                'export' => 'Export Hub Data',
                'create' => 'Create Booking',
                'risk_status' => 'Manage Risk Status',
                'risk_comments' => 'Manage Risk Commands',
                'reschedule' => 'Reschedule Hub',
                'cancel_booking' => 'Cancel Hub Booking',
            ],
        ],
        [
            'name' => 'Bookings',
            'slug' => 'booking',
            'permissions' => [
                'completed_view' => 'Booking Complete',
                'pending_view' => 'Booking Pending',
                'cancel_view' => 'Booking Cancel',
                'revert' => 'Revert Booking',
                'update' => 'Update Booking',
            ],
        ],
    ];

@endphp

{{--Edit User Role with permission--}}

<div class="modal fade" id="edit_user_role" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_role_label">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_role_edit_form">
                    <div class="form-row w-50">
                        <label for="register_number">User</label>
                        <input type="text" class="form-control" id="user_role" disabled>
                    </div>

                    <div class="mt-5">
                        @foreach ($permissions as $perm)
                            <div class="form-row mt-2">
                                <div class="form-group col-md-12">
                                    <label for="roles">{{ $perm['name'] }}</label>
                                    <div id="roles">
                                        @foreach ($perm['permissions'] as $guard)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input perm" type="checkbox"
                                                    id="{{ $perm['slug'] . '_' . array_keys($perm['permissions'], $guard)[0] }}"
                                                    name="role[]"
                                                    value="{{ $perm['slug'] . '_' . array_keys($perm['permissions'], $guard)[0] }}">
                                                <label class="form-check-label"
                                                    for="{{ $perm['slug'] . '_' . array_keys($perm['permissions'], $guard)[0] }}">
                                                    {{ $guard }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" id="update_user_role" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_role_model" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm_delete_row">Delete</button>
            </div>
        </div>
    </div>
</div>

