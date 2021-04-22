@component('mail::message')
# Статья удалена.

# Название: {{ $article->title }}

# Описание:  {{ $article->short_message }}
# Текст: {{ $article->message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
