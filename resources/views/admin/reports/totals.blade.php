@extends('layouts.base')

@section('title', 'Result')

@section('sidebar')
@include('layouts.without_sidebar')
@endsection

@section('contents')
<h2>Сгенерировать отчёт</h2>

<form action="{{ route('admin.reports.totals') }}" method="post">
    @csrf

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="news" value="news" checked>
        <label class="form-check-label">
        Новости
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="articles" value="articles" checked>
        <label class="form-check-label">
        Статьи
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="tags" value="tags" checked>
        <label class="form-check-label">
        Теги
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="comments" value="comments" checked>
        <label class="form-check-label">
        Комментарии
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="users" value="users" checked>
        <label class="form-check-label">
        Пользователи
        </label>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-success btn-send" value="Сгенерировать отчёт">
        </div>
    </div>
</form>
@endsection

