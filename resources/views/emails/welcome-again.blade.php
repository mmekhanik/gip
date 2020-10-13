

@component('mail::message')
# Introduction
##Subject :  Thank you so much for registering to {{ config('app.name') }}! 
Welcome to Gipirion, {{ $user->name }}
Your registration have been successfull , please verify your account from below link to browse the site.

@component('mail::button', ['url' => 'http://gipirion.local/post'])
Verify Now
@endcomponent

@component('mail::Panel', ['url' => ''])
Thank you for using our application!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
