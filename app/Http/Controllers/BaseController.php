<?php

namespace App\Http\Controllers;
abstract class BaseController extends Controller
{
    /**
     * // You can add your common methods here
     *
     * Example of a common method for permission checks
     * @param $requiredPermission
     * @return void
     */
    protected function authorizePermission($requiredPermission): void
    {
        $permissions = getAdminPermissions();
            if (!in_array($requiredPermission, $permissions)) {
                abort(403, 'Unauthorized.');
        }
    }
}
