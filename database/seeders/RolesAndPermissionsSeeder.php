<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission::create(['name' => 'vehicle.viewAny']);
        // Permission::create(['name' => 'vehicle.view']);
        // Permission::create(['name' => 'vehicle.create']);
        // Permission::create(['name' => 'vehicle.update']);
        // Permission::create(['name' => 'vehicle.delete']);

        $user = Role::where('name', 'User')->first();
        $admin = Role::where('name', 'Admin')->first();

        $user->syncPermissions(['vehicle.viewAny', 'vehicle.view']);

        $admin->syncPermissions(['vehicle.viewAny', 'vehicle.view', 'vehicle.create', 'vehicle.update', 'vehicle.delete']);
    }
}
