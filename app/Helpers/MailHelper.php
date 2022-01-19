<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Jobs\SendEMail;
use App\Helpers\TokenHelper;
use App\Models\Token;

class MailHelper
{
    // create new token and then send to email
    public static function send_token_to_user($user_type, $user, $token_type, $data_email)
    {
        // generate token
        $new_token = TokenHelper::generate_token($token_type);

        // if user have previous token
        $previous_token = Token::where('type', $token_type)
            ->where('status', 1)
            ->where('used_at', null)
            ->where('tokenable_type', $user_type)
            ->where('tokenable_id', $user->id)
            ->first();

        if ($previous_token) {
            $previous_token->status = 0;
            $previous_token->save();
        }

        // add token to database
        $expired_at = Carbon::now()->addHours(1);
        $token = new Token;
        $token->token = $new_token;
        $token->type = $token_type;
        $token->tokenable_type = $user_type;
        $token->tokenable_id = $user->id;
        $token->expired_at = $expired_at;
        $token->save();

        // send token to user email
        $route = $user_type == 'App\Models\AdminUser' ? 'admin-reset-password' : 'reset-password';
        $data = [
            'subject' => $data_email['subject'],
            'user' => $user,
            'token' => $token,
            'url' => route($route, ['token' => $token->token]),
            'markdown' => $data_email['markdown'],
        ];

        // queue email in server
        dispatch(new SendEmail($user->email, $data));
    }
}
