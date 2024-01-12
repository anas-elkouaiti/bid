@component('mail::message')
# Customer Assistance

Message sent from {{ $name }}:<br>
{{ $body }}

@component('mail::button', ['url' => 'http://localhost:8000'])
Check Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
