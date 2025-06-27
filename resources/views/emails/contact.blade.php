@component('mail::message')
# Xin chào {{ $name }}
{!! $message !!}

Cảm ơn bạn,<br>
{{ config('app.name') }}
@endcomponent
