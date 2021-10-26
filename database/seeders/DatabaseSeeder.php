<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user = User::create([
            'first_name'=>'naeem',
            'last_name'=> 'soltany',
            'name'=>'mason',
            'email' => 'mason.hows11@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('1289..//nS')
        ]);

        $user1 = User::create([
            'first_name'=>'james',
            'last_name'=> 'bowman',
            'name' => 'james',
            'email'=>'james@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'=>Hash::make('1289..//nS'),
        ]);

        $role_admin = Role::create(['name'=>'admin']);
        $user->assignRole($role_admin);
    }
}
