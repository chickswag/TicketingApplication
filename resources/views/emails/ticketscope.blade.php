@component('mail::message')
Hello {{ $details['fullnames'] }},
<p>Your ticket No #{{ $details['ticket_number'] }} has been logged successfully,
    <br/>to do a follow-up on your ticket please click <a href="{{ env('APP_URL') }}:{{ env('APP_PORT') }}/{{$details['link']}}" >here</a>
</p>
@component('mail::button', ['url' => $details['link']])
Click here...
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
