@extends('layouts.base')

@section('title', 'Feedbacks')

@section('contents')
    <h3>Админ Раздел</h3>
    @foreach($adminBlogs as $adminBlog)
        <div style="border: solid 1px blue; border-radius: 5px;">
            <div class="mb-1 text-muted">{{$adminBlog->created_at->toFormattedDateString()}}</div>
            <h5>{{$adminBlog->email}}</h5>
            {{$adminBlog->message}}
        </div><br>
    @endforeach
@endsection
