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
@endsection
