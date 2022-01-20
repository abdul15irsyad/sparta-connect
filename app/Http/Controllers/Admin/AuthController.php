<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\MailHelper;
use App\Helpers\TokenHelper;
use App\Models\Token;
use App\Models\AdminUser;
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
        return view('admin.pages.auth.login', $data);
    }

    public function login_process(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $remember_me = $request->input('remember') == "on" ? true : false;

        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $data = [
            $field => $username,
            'password'  => $password,
        ];

        // find admin user
        $admin_user = AdminUser::where($field, $username)->first();
        if (!$admin_user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'username or password incorrect');
        }

        // check password
        $auth = Hash::check($password, $admin_user->password);
        if (!$auth) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'username or password incorrect');
        }

        // if admin user not verified
        if (!$admin_user->email_verified_at) {
            return redirect()
                ->route('admin-login')
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'please verify your email first');
        }

        // if admin user not active
        if (!$admin_user->status) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'your account is not active');
        }
        auth('admin')->attempt($data, $remember_me);

        return redirect()->route('admin-dashboard');
    }

    public function verify_email_process(Request $request)
    {
        $token = $request->input('token');

        $token = Token::where('token', $token)
            ->where('status', 1)
            ->where('used_at', null)
            ->where('type', 'verification')
            ->first();

        // if token invalid
        if (!$token) {
            return redirect()
                ->route('admin-login')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route('admin-login')
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new forgot password request');
        }

        $admin_user = AdminUser::find($token->tokenable->id);
        // if admin user not found
        if (!$admin_user) {
            return redirect()
                ->route('admin-forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // update token
        $token->status = 0;
        $token->used_at = Carbon::now();
        $token->save();

        // assign email verified date
        $admin_user->email_verified_at = Carbon::now();
        $admin_user->save();

        // // notify user
        // $data = [
        //     'database' => [
        //         'title' => 'Email Verification Success',
        //         'desc' => 'your email has been verified'
        //     ],
        //     'mail' => [
        //         'subject' => 'Email Verification Success',
        //         'markdown' => 'mails.verify-email-success',
        //         'user' => $admin_user,
        //     ]
        // ];
        // $admin_user->notify(new UserNotification($data));

        return redirect()
            ->route('admin-login')
            ->with('type', 'success')
            ->with('message', 'your email has been verified');
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Forgot Password'
        ];
        return view('admin.pages.auth.forgot-password', $data);
    }

    public function forgot_password_process(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $admin_user = AdminUser::where('email', $email)->first();

        // if no admin user with email
        if (!$admin_user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'warning')
                ->with('message', 'email not found');
        }

        // if user's email not verified
        if (!$admin_user->email_verified_at) {
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
        MailHelper::send_token_to_user('App\Models\AdminUser', $admin_user, 'forgot_password', $data);

        // input activity log
        // activity()
        //     ->log('has request forgot password')
        //     ->causedBy($admin_user);

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
                ->route('admin-forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route('admin-forgot-password')
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new request');
        }

        $admin_user = AdminUser::find($token->tokenable->id);
        // if admin user not found
        if (!$admin_user) {
            return redirect()
                ->route('forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // token valid
        $data = [
            'token' => $token,
            'title' => 'Reset Password'
        ];
        return view('admin.pages.auth.reset-password', $data);
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
                ->route('admin-forgot-password')
                ->with('type', 'warning')
                ->with('message', 'invalid link');
        }

        // if token expired
        if (Carbon::now()->gt($token->expired_at)) {
            $token->status = 0;
            $token->save();
            return redirect()
                ->route('admin-forgot-password')
                ->with('type', 'warning')
                ->with('message', 'link expired, please make a new request');
        }

        // update token
        $token->status = 0;
        $token->used_at = Carbon::now();
        $token->save();

        // update user password
        $admin_user = AdminUser::find($token->tokenable_id);
        $admin_user->password = Hash::make($password);
        $admin_user->save();

        // notify user
        $data = [
            'database' => [
                'title' => 'Reset Password Success',
                'desc' => 'your password has been successfully changed'
            ],
            'mail' => [
                'subject' => 'Reset Password Success',
                'markdown' => 'mails.reset-password-success',
                'user' => $admin_user,
            ]
        ];
        // $user->notify(new UserNotification($data));

        // input activity log
        // activity()
        //     ->log('has reset password')
        //     ->causedBy($admin_user);

        return redirect()
            ->route('admin-login')
            ->with('type', 'success')
            ->with('message', 'password successfully changed, please login with a new password');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()
            ->route('admin-login');
    }
}
