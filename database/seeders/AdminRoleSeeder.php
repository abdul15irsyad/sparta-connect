<?php

namespace Database\Seeders;

use DB, Str;
use Illuminate\Database\Seeder;
use App\Models\AdminRole;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
