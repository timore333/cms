<?php

namespace Database\Seeders;

use App\Models\Tenants\Admin\Permission;
use App\Models\Tenants\Admin\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{

    /**
     * the roles to be created
     *
     * @var array
     */
    protected $roles = ['super-admin', 'reception', 'doctor', 'accountant'];

    /**
     * the models to assign permissions to.
     *
     * permissions include view create update delete
     *
     * @var array
     */
    protected $models = [
        'users',
        'roles',
        'permissions',
        'patients',
        'patient medical file',
        'products',
        'price lists',
        'insurance',
        'suppliers',
        'banks',
        'allergies',
        'diseases',
        'labs',
        'drugs',
    ];

    protected $access = [
        'dashboards',
        'calendar',
        'user management',
        'medical',
        'store',
        'ledgers',
        'setting',
        'reception',
        'accountant',
        'doctor'

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
//        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        $this->createPermissions();

        // create roles
        $this->createRoles();

        // assign all permissions to super-admin
        $role = Role::find(1);
        $role->givePermissionTo(Permission::all());
    }


    public function createPermissions()
    {
        foreach($this->models as $model) {
            Permission::create(['name' => 'view ' . $model]);
            Permission::create(['name' => 'create ' . $model]);
            Permission::create(['name' => 'update ' . $model]);
            Permission::create(['name' => 'delete ' . $model]);

        }

        foreach($this->access as $key) {
            Permission::create(['name' => 'access ' . $key]);
        }
    }

    public function createRoles()
    {
        foreach($this->roles as $role) {
            $role = Role::create(['name' => $role]);
        }
    }
}
