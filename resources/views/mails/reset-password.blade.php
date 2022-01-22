@component('mail::message')
# Reset Password

Hello, {{ $user->username }}<br>
You recently asked to reset your password, click the button below to reset.

@component('mail::button', ['url' => $url])
    Reset Password
@endcomponent

This link only valid until {{ date_format($token->expired_at, 'H:i - F j, Y') }}, if you do not request a password
reset, please ignore this email.<br><br>

If button doesn't work, please copy this url to your browser<br>
<a href="{{ $url }}">{{ $url }}</a><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
