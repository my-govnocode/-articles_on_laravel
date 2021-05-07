@extends('layouts.base')

@section('title', 'Articles')

@section('contents')
    <h3>Статьи</h3>
    @if (Session::has('success'))
        <h4 style="color: green;">{{ Session::get('success') }}</h4>
    @endif
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
                    <a href="{{ route('articles.edit', $article->code) }}">Редактировать</a>
                    <a href="{{ route('admin.approved', $article->code) }}">{{ $arr[$article->approved] }}</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
