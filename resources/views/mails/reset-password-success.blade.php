@component('mail::message')
# Reset Password Success

Hello, {{ $user->username }}<br>
Your password has been successfully changed.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
