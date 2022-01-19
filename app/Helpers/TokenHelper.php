<?php

namespace App\Helpers;

use App\Models\Token;
use Carbon\Carbon;
use DB, Str;

class TokenHelper
{
    public static function generate_token($type)
    {
        // loop generate token if exist
        do {
            $token = Str::random(64);
            $token_exist = Token::where('token', $token)
                ->where('type', $type)
                ->where('status', 1)
                ->where('used_at', null)->first();
        } while ($token_exist !== null);

        return $token;
    }

    public static function check_token($token, $route)
    {
        // if token invalid
        if (!$token) {
            return redirect()
                ->route($route)
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route($route)
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new request');
        }
    }
}
