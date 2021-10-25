@component('mail::message')
# Отчёт
# Итог

@foreach($data as $name => $element)
    @if($element !== null)
        #{{ $name }}: {{ $element }}
    @endif
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
