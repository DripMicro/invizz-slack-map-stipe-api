@component('mail::message')
# INVIZZ

Welcome to Shellngn.<br>
Please confirm your email address by clicking on the button below.

@component('mail::button', ['url' => 'mail::message'])
Confirm Email
@endcomponent

Sincerely,<br>
INVIZZ Team
@endcomponent
