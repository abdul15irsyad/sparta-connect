<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\MailHelper;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        // if user not verified
        if (!$user->email_verified_at) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'please verify your email first');
        }

        // if user not active
        if (!$user->status) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'your account is not active, please contact admin');
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

    public function forgot_password_process(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        // if no user with email
        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'email not found');
        }

        // if user's email not verified
        if (!$user->email_verified_at) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'verify your email first');
        }

        // create new token and then send to email
        $data = [
            'subject' => 'Reset Password',
            'markdown' => 'mails.reset-password',
        ];
        MailHelper::send_token_to_user('App\Models\User', $user, 'forgot_password', $data);

        // input activity log
        // activity()
        //     ->log('has request forgot password')
        //     ->causedBy($user);

        return redirect()
            ->back()
            ->withInput()
            ->with('type', 'success')
            ->with('message', 'email sent, please check your email');
    }

    public function reset_password(Request $request)
    {
        $token = $request->input('token');

        $token = Token::where('token', $token)
            ->where('status', 1)
            ->where('used_at', null)
            ->where('type', 'forgot_password')
            ->first();

        // if token invalid
        if (!$token) {
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new request');
        }

        $user = User::find($token->tokenable->id);
        // if user not found
        if (!$user) {
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // token valid
        $data = [
            'title' => 'Reset Password',
            'token' => $token,
        ];
        return view('pages.auth.reset-password', $data);
    }

    public function reset_password_process(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])./',
            'confirm_password' => 'same:new_password'
        ]);

        $token = $request->input('token');
        $password = $request->input('new_password');

        $token = Token::where('token', $token)
            ->where('status', 1)
            ->where('used_at', null)
            ->where('type', 'forgot_password')
            ->first();

        // if token invalid
        if (!$token) {
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new request');
        }

        // update token
        $token->status = 0;
        $token->used_at = Carbon::now();
        $token->save();

        // update user password
        $user = User::find($token->tokenable_id);
        $user->password = Hash::make($password);
        $user->save();

        // notify user
        // $data = [
        //     'database' => [
        //         'title' => 'Reset Password Success',
        //         'desc' => 'your password has been successfully changed'
        //     ],
        //     'mail' => [
        //         'subject' => 'Reset Password Success',
        //         'markdown' => 'mails.reset-password-success',
        //         'user' => $user,
        //     ]
        // ];
        // $user->notify(new UserNotification($data));

        // input activity log
        // activity()
        //     ->log('has reset password')
        //     ->causedBy($user);

        return redirect()
            ->route('login')
            ->with('type', 'success')
            ->with('message', 'password successfully changed, please login with a new password');
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect()
            ->route('login');
    }
}
