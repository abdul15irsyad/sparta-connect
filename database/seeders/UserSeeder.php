<?php

namespace Database\Seeders;

use DB, Hash, MailHelper;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $verify_email = false;
        $rows = [
            [
                'name' => 'Irsyad Abdul Hamid Darussalam',
                'username' => 'irsyadabdul12',
                'email' => 'abdulirsyad15@gmail.com',
                'password' => 'Qwerty123',
                'gender' => 'r',
                'pob' => 'Bekasi',
                'dob' => '1998-05-22',
                'impression' => 'test impression',
                'message' => 'test message',
            ],
        ];

        foreach ($rows as $row) {
            $user = new User;
            $user->name = $row['name'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->email_verified_at = $verify_email ? null : Carbon::now();
            $user->password = Hash::make($row['password']);
            $user->gender = $row['gender'];
            $user->pob = $row['pob'];
            $user->dob = $row['dob'];
            $user->impression = $row['impression'];
            $user->message = $row['message'];
            $user->save();

            // send token to email
            if ($verify_email) {
                $user = User::where('username', $row['username'])->first();
                $data = [
                    'subject' => 'Email Verification',
                    'markdown' => 'mails.verify-email',
                ];
                MailHelper::send_token_to_user('App\Models\User', $user, 'verification', $data);
            }
        }
    }
}
