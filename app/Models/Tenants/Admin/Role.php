<?php

namespace App\Models\Tenants\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
	public function removeAllPermissions()
	{
	    foreach ($this->permissions as $permission) {
	        $this->revokePermissionTo($permission);
	    }
	}

}
