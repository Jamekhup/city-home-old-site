@component('mail::message')
# Request to Apply From -

<h4>Name - {{$details['name']}}</h4>
<h4>Email - {{$details['email']}}</h4>
<h4>Phone - {{$details['phone']}}</h4>
<h4>Message - {{$details['sms']}}</h4>

@component('mail::button', ['url' => $details['url']])
Check request item
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
