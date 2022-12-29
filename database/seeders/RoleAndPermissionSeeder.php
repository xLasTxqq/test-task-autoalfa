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
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::truncate();
        Role::truncate();

        Permission::create(['name'=>'update_and_delete_users']);
        Permission::create(['name'=>'update_password']);
        Permission::create(['name'=>'update_and_delete_books']);
        Permission::create(['name'=>'give_and_take_books']);
        Permission::create(['name'=>'book_and_cancel']);

        Role::create(['name'=>'admin'])->givePermissionTo([
            'update_and_delete_users',
            'update_password'
        ]);

        Role::create(['name'=>'librarian'])->givePermissionTo([
            'update_and_delete_books',
            'give_and_take_books'
        ]);

        Role::create(['name'=>'client'])->givePermissionTo([
            'book_and_cancel',
        ]);
    }
}
