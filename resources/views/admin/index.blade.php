@extends('layouts.base')

@section('title', 'Admin Panel')

@section('sidebar')
@include('layouts.without_sidebar')
@endsection

@section('contents')
<h3><a href="{{ route('admin.articles') }}">Статьи</a></h3>
<h3><a href="{{ route('admin.news') }}">Новости</a></h3>
<h3><a href="{{ route('admin.reports') }}">Отчеты</a></h3>
@endsection
