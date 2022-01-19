<?php

namespace Database\Seeders;

use DB, Hash, MailHelper;
use Carbon\Carbon;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verify_email = false;
        $rows = [
            [
                "name" => "Irsyad Abdul",
                "username" => "irsyadabdul",
                "email" => "abdulirsyad15@gmail.com",
                "password" => "Qwerty123",
                "admin_role_id" => 1,
            ],
            [
                "name" => "Dota Lubda",
                "username" => "dotalubda",
                "email" => "dotalubda225@gmail.com",
                "password" => "Qwerty123",
                "admin_role_id" => 2,
            ],
        ];

        foreach ($rows as $row) {
            $admin_user = new AdminUser;
            $admin_user->name = $row['name'];
            $admin_user->username = $row['username'];
            $admin_user->email = $row['email'];
            $admin_user->email_verified_at = $verify_email ? null : Carbon::now();
            $admin_user->password = Hash::make($row['password']);
            $admin_user->admin_role_id = $row['admin_role_id'];
            $admin_user->save();

            if ($verify_email) {
                // send activation token to user email
                $admin_user = AdminUser::where('username', $row['username'])->first();

                // create new token and then send to email
                $data = [
                    'subject' => 'Email Verification',
                    'markdown' => 'mails.verify-email',
                ];
                MailHelper::send_token_to_user('App\Models\AdminUser', $admin_user, 'verification', $data);
            }
        }
    }
}
