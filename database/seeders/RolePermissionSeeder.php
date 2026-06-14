<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $manager = Role::create(['name' => 'manager']);

        // Permission::create(['name' => 'create content']);
        // Permission::create(['name' => 'edit content']);
        // Permission::create(['name' => 'delete content']);
    }
}
