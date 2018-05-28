@component('mail::message')
 
Hi, {{ $user_data['name'] }}

Please click below link for register.

@component('mail::button', ['url' => $user_data['url']])
Register
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
