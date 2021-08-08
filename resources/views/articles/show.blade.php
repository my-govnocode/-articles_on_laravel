@extends('layouts.base')

@section('title', 'Articles Show')

@section('contents')
    <div class="col-md-6">
        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <h3 class="mb-0">
                    <a class="text-dark" href="{{ route('articles.show', $article->code) }}">{{$article->title}}</a>
                </h3>
                <div class="mb-1 text-muted">{{$article->created_at->toFormattedDateString()}}</div>
                <p class="card-text mb-auto">{{$article->message}}</p>
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

    <h5>Написать коментарий</h5>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @include('layouts.form_comment', ['route' => route('comments.article', $article->code)])

    @forelse($history as $item)
        <br><hr>
            <p5>{{$item->email}} - {{$item->pivot->created_at}}</p5><br>
            <p5>Было - {{$item->pivot->before}}</p5><br>
            <p5>Стало - {{$item->pivot->after}}</p5><br>
        @empty
        <p>Нет изменений.</p>
    @endforelse
    <hr>

    <h5>Коментарии</h5> <br>
        @foreach($comments as $comment)
            <div style="border: solid 1px blue; border-radius: 5px;">
                <div class="mb-1 text-muted">{{$comment->created_at->toFormattedDateString()}}</div>
                <h5>{{$comment->user->email}}</h5>
                {{$comment->body}}
            </div><br>
        @endforeach
@endsection
