<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            [
                'user_id' => 1,
                'label' => 'Rumah',
                'province_id' => '36',
                'regency_id' => '3674',
                'district_id' => '3674030',
                'detail' => 'Gg. H. Saumin No.38, Pamulang Timur',
            ]
        ];

        foreach ($rows as $row) {
            $address = new Address;
            $address->user_id = $row['user_id'];
            $address->label = $row['label'];
            $address->province_id = $row['province_id'];
            $address->regency_id = $row['regency_id'];
            $address->district_id = $row['district_id'];
            $address->detail = $row['detail'];
            $address->save();
        }
    }
}
