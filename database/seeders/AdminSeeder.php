<?php

namespace Database\Seeders;

use App\Models\Tenants\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Super Admin',
        	'username' => 'admin',
        	'email' => 'admin@admin.com',
        	'password' => Hash::make('aaaaaaaa'),
        ]);

       $user->assignRole('super-admin');
//       $user->createDefaultAccount();
    }
}
