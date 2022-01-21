<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $rows = [
            ['contact_type_id' => 2, 'detail' => '088809151020', 'user_id' => 1],
            ['contact_type_id' => 3, 'detail' => 'abdul15irsyad', 'user_id' => 1],
        ];

        foreach ($rows as $row) {
            $contact = new Contact;
            $contact->contact_type_id = $row['contact_type_id'];
            $contact->detail = $row['detail'];
            $contact->user_id = $row['user_id'];
            $contact->save();
        }
    }
}
