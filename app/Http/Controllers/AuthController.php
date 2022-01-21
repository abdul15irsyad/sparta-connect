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

    public function login_process(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        // $remember_me = $request->input('remember') == "on" ? true : false;
        $remember_me = true;

        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $data = [
            $field => $username,
            'password'  => $password,
        ];

        // find user
        $user = User::where($field, $username)->first();
        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'username or password incorrect');
        }

        // check password
        $auth = Hash::check($password, $user->password);
        if (!$auth) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'username or password incorrect');
        }

        // if admin user not verified
        if (!$user->email_verified_at) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'please verify your email first');
        }

        // if admin user not active
        if (!$user->status) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'your account is not active');
        }
        auth('web')->attempt($data, $remember_me);

        return redirect()->route('home');
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
