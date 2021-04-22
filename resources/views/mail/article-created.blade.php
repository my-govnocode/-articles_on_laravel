@component('mail::message')
# Создана новая статья. 

# Название: {{ $article->title }}

{{ $article->short_message }}

@component('mail::button', ['url' => route('articles.show', $article->code)])
Посмотреть Задачу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
