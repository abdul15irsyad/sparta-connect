@component('mail::message')
# Email Verification

Hello, {{ $user->username }}<br>
Please click button below to verify your email.

@component('mail::button', ['url' => $url])
Verify Email
@endcomponent

This link only valid until {{ date_format($token->expired_at,'H:i - F j, Y') }}.<br><br>

If button doesn't work, please copy this url to your browser<br>
{{ $url }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
