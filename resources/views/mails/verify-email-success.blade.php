@component('mail::message')
# Email Verification Success

Hello, {{ $user->username }}<br>
Your email has been verified.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
