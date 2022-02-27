<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\AdminRole;

class AdminRoleSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                "name" => "Super Admin",
                "desc" => "Has the highest access level for the entire function in account",
            ], [
                "name" => "Admin",
                "desc" => "Has the second highest access level, but can not access the Account Management and User Activity Log",
            ], [
                "name" => "Copywriter",
                "desc" => null,
            ]
        ];

        foreach ($rows as $row) {
            $role = new AdminRole;
            $role->name = $row['name'];
            $role->slug = Str::slug($row['name']);
            $role->desc = $row['desc'];
            $role->save();
        }
    }
}
