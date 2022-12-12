@component('mail::message')
# Subscribed Email Confirmation Link

Click the below button to confirm your email

@component('mail::button', ['url' => 'http://localhost:8000/subscriber-send-mail/mail/confirm/link/sent/'.$details['link']])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
