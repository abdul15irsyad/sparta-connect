<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\MailHelper;
use App\Helpers\TokenHelper;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('pages.auth.login', $data);
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Forgot Password'
        ];
        return view('pages.auth.forgot-password', $data);
    }

    public function reset_password()
    {
        $data = [
            'title' => 'Reset Password'
        ];
        return view('pages.auth.reset-password', $data);
    }
}
