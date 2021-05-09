@extends('layouts.base')

@section('title', 'Feedbacks')

@section('contents')
    <h3>Отзывы</h3>
    @foreach($feedbacks as $feedback)
        <div style="border: solid 1px blue; border-radius: 5px;">
            <div class="mb-1 text-muted">{{$feedback->created_at->toFormattedDateString()}}</div>
            <h5>{{$feedback->email}}</h5>
            {{$feedback->message}}
        </div><br>
    @endforeach
@endsection
