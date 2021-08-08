@extends('layouts.base')

@section('title', 'Articles')

@section('sidebar')
@include('layouts.without_sidebar')
@endsection

@section('contents')

<h5>Общее количество статей <strong>{{ $articlesCount }}</strong></h5><br>
<h5>Общее количество новостей <strong>{{ $newsCount }}</strong></h5><br>

@if(!empty($userWithLargeNumberArticles))
<h5>ФИО автора, у которого больше всего статей на сайте <strong>{{ $userWithLargeNumberArticles->name }}</strong></h5><br>
@endif

@if(!empty($articleMax))
<h5>Самая большая статья <a href="{{ route('articles.show', $articleMax->code) }}">{{ $articleMax->title }}</a> количество симолов в ней <strong>{{ strlen($articleMax->message) }}</strong></h5><br>
@endif

@if(!empty($articleMin))
<h5>Самая маленькая статья <a href="{{ route('articles.show', $articleMin->code) }}">{{ $articleMin->title }}</a> количество симолов в ней <strong>{{ strlen($articleMin->message) }}</strong></h5><br>
@endif

@if(!empty($averageNumberArticles))
<h5>Средние количество статей у активных пользователей <strong>{{ $averageNumberArticles }}</strong></h5><br>
@endif

@if(!empty($articleNoPermanent))
<h5>Самая непостоянная статья <a href="{{ route('articles.show', $articleNoPermanent->code) }}">{{ $articleNoPermanent->title }}</a></h5><br>
@endif

@if(!empty($articleDiscussed))
<h5>Самая обсуждаемая статья <a href="{{ route('articles.show', $articleDiscussed->code) }}">{{ $articleDiscussed->title }}</a></h5><br>
@endif
@endsection