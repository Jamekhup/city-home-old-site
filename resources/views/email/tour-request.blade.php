@component('mail::message')
# Someone Request A Tour - 

<h4>Name - {{$details['name']}}</h4>
<h4>Email - {{$details['email']}}</h4>
<h4>Phone - {{$details['phone']}}</h4>
<h4>Preferred Date - {{$details['date']}}</h4>
<h4>Preferred Time - {{$details['time']}}</h4>
<h4>Preferred Type- {{$details['type']}}</h4>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
