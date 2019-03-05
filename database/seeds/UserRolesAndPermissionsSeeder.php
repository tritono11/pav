<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user super-admin
        $user = User::create([
            'name'          => 'Angelo Cultrera',
            'email'         => 'info@angelocultrera.it',
            'password'      => bcrypt('angelo111'),
            'b_verified'    => 1,
        ]);
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'all']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        
        $user->assignRole('admin');
    }
}
