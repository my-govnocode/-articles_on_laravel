@extends('layouts.base')

@section('title', 'Admin Panel')

@section('sidebar')
@include('layouts.without_sidebar')
@endsection

@section('contents')

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<h3>Отчёты:</h3>
<h3><a href="{{ route('admin.reports.totals') }}">Итого</a></h3>
@endsection
