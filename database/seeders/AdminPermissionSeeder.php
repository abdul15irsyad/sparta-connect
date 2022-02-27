<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\AdminPermission;

class AdminPermissionSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            // Admin
            ["name" => "Create Admin"],
            ["name" => "Read Admin"],
            ["name" => "Update Admin"],
            ["name" => "Delete Admin"],
            // Role
            ["name" => "Create Role"],
            ["name" => "Read Role"],
            ["name" => "Update Role"],
            ["name" => "Delete Role"],
            // Permission
            ["name" => "Create Permission"],
            ["name" => "Read Permission"],
            ["name" => "Update Permission"],
            ["name" => "Delete Permission"],
            // Activity Log
            ["name" => "Read Activity Log"],
            // User
            ["name" => "Create User"],
            ["name" => "Read User"],
            ["name" => "Update User"],
            ["name" => "Delete User"],
            // User Activity Log
            ["name" => "Read User Activity Log"],
            // Setting
            ["name" => "Read Setting"],
            ["name" => "Update Setting"],
        ];

        foreach ($rows as $row) {
            $permission = new AdminPermission;
            $permission->name = $row['name'];
            $permission->slug = Str::slug($row['name']);
            $permission->save();
        }
    }
}
