<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ProvinceSeeder::class);
        // $this->call(RegencySeeder::class);
        // $this->call(DistrictSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ContactTypeSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
