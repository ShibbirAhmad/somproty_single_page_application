<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard = 'admin';

    public static function adminPermission() {
     $permissions = [];
        foreach (Permission::all() as $permission) {
         if (session()->get('admin')->can($permission->name)) {
          $permissions[] = $permission->name;
      }
    }
    return $permissions;
    }
}
