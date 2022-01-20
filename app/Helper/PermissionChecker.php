<?php

namespace App\Helper;

class PermissionChecker
{
    public static function CheckPermission($permission)
    {
        if (Auth()->user()->can($permission)) {
            return true;
        }else{
            abort(403);
        }
    }
}
