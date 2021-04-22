@component('mail::message')
# Статья обновлена.

# Название: {{ $article->title }}

# Описание:  {{ $article->short_message }}
# Текст: {{ $article->message }}

@component('mail::button', ['url' => route('articles.show', $article->code)])
Посмотреть Задачу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
