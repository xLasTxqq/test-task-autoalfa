<?php

namespace Database\Seeders;

use App\Models\User;
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

        $permissions = [
            ['name' => User::PERMISSION_COMMENT_AND_RATE_BOOKS],
            ['name' => User::PERMISSION_CREATE_DELETE_USERS],
            ['name' => User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS],
            ['name' => User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS],
            ['name' => User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS],
            ['name' => User::PERMISSION_SUBSCRIBE_TO_BOOKS],
            ['name' => User::PERMISSION_UPDATE_OTHERS_PASSWORD],
            ['name' => User::PERMISSION_UPDATE_SELF_PASSWORD]
        ];

        foreach ($permissions as $permission)
            Permission::create($permission);

        Role::create(['name' => 'admin'])->givePermissionTo([
            User::PERMISSION_CREATE_DELETE_USERS,
            User::PERMISSION_UPDATE_OTHERS_PASSWORD,
        ]);

        Role::create(['name' => 'librarian'])->givePermissionTo([
            User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS,
            User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS,
            User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS,
            User::PERMISSION_COMMENT_AND_RATE_BOOKS,
            User::PERMISSION_SUBSCRIBE_TO_BOOKS
        ]);

        Role::create(['name' => 'client'])->givePermissionTo([
            User::PERMISSION_UPDATE_SELF_PASSWORD,
            User::PERMISSION_SUBSCRIBE_TO_BOOKS,
            User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS,
            User::PERMISSION_COMMENT_AND_RATE_BOOKS
        ]);
    }
}
