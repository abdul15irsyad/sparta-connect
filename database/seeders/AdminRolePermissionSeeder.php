<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminRole;
use App\Models\AdminRolePermission;

class AdminRolePermissionSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'slug' => 'super-admin',
                'permissions' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
            ],
            [
                'slug' => 'admin',
                'permissions' => [14, 15, 16, 17, 18, 19],
            ],
        ];

        foreach ($rows as $row) {
            foreach ($row['permissions'] as $permission) {
                $role = AdminRole::where('slug', $row['slug'])->first();

                $role_permission = new AdminRolePermission;
                $role_permission->admin_permission_id = $permission;
                $role_permission->admin_role_id = $role->id;
                $role_permission->save();
            }
        }
    }
}
