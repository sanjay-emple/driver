@component('mail::message')
 
Hi {{ $user_data['name'] }},

Congratulation {{ $user_data['name'] }}, you have been invite {{ $user_data['invite_from'] }} to be part of a growing team.

 
All you have to do now is register an starting earning money.


We look forward to working with you and helping you grow


@component('mail::button', ['url' => $user_data['url']])
Register
@endcomponent

Kind Regards


{{ $user_data['invite_from'] }}
@endcomponent
