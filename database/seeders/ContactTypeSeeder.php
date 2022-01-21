<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactType;
use Str;

class ContactTypeSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            ['name' => 'Phone', 'icon' => 'fas fa-phone'],
            ['name' => 'WhatsApp', 'icon' => 'fab fa-whatsapp'],
            ['name' => 'Instagram', 'icon' => 'fab fa-instagram'],
            ['name' => 'Facebook', 'icon' => 'fab fa-facebook'],
            ['name' => 'Line', 'icon' => 'fab fa-line'],
            ['name' => 'Tiktok', 'icon' => 'fab fa-tiktok'],
            ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin'],
        ];

        foreach ($rows as $row) {
            $contact_type = new ContactType;
            $contact_type->name = $row['name'];
            $contact_type->slug = Str::slug($row['name']);
            $contact_type->icon = $row['icon'];
            $contact_type->save();
        }
    }
}
