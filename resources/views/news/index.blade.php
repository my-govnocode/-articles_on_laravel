@extends('layouts.base')

@section('title', 'News')

@section('contents')
    <h3>Новости</h3>
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
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
    {{$news->onEachSide(3)->links()}}
@endsection
