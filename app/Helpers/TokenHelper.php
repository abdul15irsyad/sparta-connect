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
}
