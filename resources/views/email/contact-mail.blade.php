@component('mail::message')
# Hello Boss, Someone sent message you from Contact Form

<h4>Name - {{$details['name']}}</h4>
<h4>Phone - {{$details['phone']}}</h4>
<h4>Subject - {{$details['subject']}}</h4>
<h4>Message - {{$details['sms']}}</h4>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
