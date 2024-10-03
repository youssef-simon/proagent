<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Permission::create(['name' => 'create-admins']);
        Permission::create(['name' => 'edit-admins']);
        Permission::create(['name' => 'delete-admins']);

    /*    Permission::create(['name' => 'create-blog-posts']);
        Permission::create(['name' => 'edit-blog-posts']);
        Permission::create(['name' => 'delete-blog-posts']);
 */
        $adminRole = Role::create(['name' => 'Admin']);
      $teacherRole = Role::create(['name' => 'Teacher']);

       $adminRole->givePermissionTo([
            'create-admins',
            'edit-admins',
            'delete-admins',
        ]);

       /*  $editorRole->givePermissionTo([
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);   */
    }
}
