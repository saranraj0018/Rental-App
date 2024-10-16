<?php


use Carbon\Carbon;
function hubList(): array
{
    return ['632' => 'coimbatore'];
}

function formDate($date, $format = 'Y-m-d')
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}
function formDateTime($date, $format = 'Y-m-d h:i')
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

function block_type(): array
{
    return ['0' => 'Maintenance','1' => 'Discretionary','2' => 'Availability Type','3' => 'U-refurbish',
        '4' => 'U-recovery','5' => 'It-reserve'
        ];
}

function reason_type(): array
{
    return ['0' => 'Major Repair','1' => 'Accident','2' => 'Running Repair','3' => 'Service',
        '4' => 'Others','5' => 'Buffer','6' => 'GPS-Issue','7' => 'Forced-Extension','8' => 'Others'
    ];
}

function getAdminPermissions()
{
    static $permissions = null;

    if ($permissions === null) {
        $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        $role = !empty($admin->role) ? \App\Models\Role::find($admin->role) : null;
        $permissions = !empty($role->permissions) ? json_decode($role->permissions) : [];
    }

    return $permissions;
}

function showDateTime($date, $format = 'm/d/Y h:i:s A')
{
    return Carbon::parse($date)->format($format);
}

function showDate($date, $format = 'm/d/Y')
{
    return Carbon::parse($date)->format($format);
}
