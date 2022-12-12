@component('mail::message')
# Hi, Check out the interesting Property in Yangon

You received this email since someone shared you.
<h4>Message - {{$details['sms']}}</h4>

@component('mail::button', ['url' => $details['url']])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
