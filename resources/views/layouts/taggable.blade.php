@extends('layouts.base')

@section('title', 'Articles')]

<div class="container">
@section('contents')
<div class="row">
<div class="col-md-6">
    <h3 class="text-center">Статьи</h3>
    @foreach($articles as $article)
            <div class="col-md-12">
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <a class="text-dark" href="{{ route('articles.show', $article->code) }}">{{$article->title}}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{$article->created_at->toFormattedDateString()}}</div>
                        <p class="card-text mb-auto">{{$article->short_message}}</p>            
                        @include('layouts.tags', ['tags' => $article->tags])
                        @can('update', $article)
                        <a href="{{ route('articles.edit', $article->code) }}">Редактировать</a>
                        @endcan
                        @can('delete', $article)
                        <form action="{{ route('articles.destroy', $article->code) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button>Удалить</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
    @endforeach
</div>

<div class="col-md-6">
    <h3 class="text-center">Новости</h3>
    @foreach($news as $oneNews)
            <div class="col-md-12">
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <a class="text-dark" href="{{ route('news.show', $oneNews->code) }}">{{$oneNews->title}}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{$oneNews->created_at->toFormattedDateString()}}</div>
                        <p class="card-text mb-auto">{{$oneNews->short_message}}</p>
                        @include('layouts.tags', ['tags' => $oneNews->tags])
                    </div>
                </div>
            </div>
    @endforeach
</div>
</div>
@endsection
</div>