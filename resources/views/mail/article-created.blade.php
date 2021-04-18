@component('mail::message')
# Новая Задача {{ $article->title }}

{{ $article->short_message }}

@component('mail::button', ['url' => '/articles/' . $article->code])
Посмотреть Задачу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
