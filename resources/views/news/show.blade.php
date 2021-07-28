@extends('layouts.base')

@section('title', 'News Show')

@section('sidebar')
@include('layouts.without_sidebar')
@endsection

@section('contents')
    <div class="col-md-6">
        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <h3 class="mb-0">
                    <a class="text-dark" href="{{ route('articles.show', $news->code) }}">{{$news->title}}</a>
                </h3>
                <div class="mb-1 text-muted">{{$news->created_at->toFormattedDateString()}}</div>
                <p class="card-text mb-auto">{{$news->message}}</p>
                @include('layouts.tags', ['tags' => $news->tags])
                @can('update', $news)
                <a href="{{ route('news.edit', $news->code) }}">Редактировать</a>
                @endcan
                @can('delete', $news)
                <form action="{{ route('news.destroy', $news->code) }}" method="post">
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

    @include('layouts.form_comment', ['route' => route('comments.news', $news->code)])

    <h5>Коментарии</h5> <br>
    @foreach($comments as $comment)
        <div style="border: solid 1px blue; border-radius: 5px;">
            <div class="mb-1 text-muted">{{$comment->created_at->toFormattedDateString()}}</div>
            <h5>{{$comment->user->email}}</h5>
            {{$comment->body}}
        </div><br>
    @endforeach
@endsection
