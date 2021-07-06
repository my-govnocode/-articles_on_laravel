@extends('layouts.base')

@section('title', 'Create News')

@section('contents')

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <h3>Добавить новость</h3>

                <form id="contact-form" method="post" action="{{ route('news.index') }}">
                    @csrf

                    @include('layouts.form_news', ['button' => 'Создать'])

                </form>

            </div><!-- /.col-lg-8 col-lg-offset-2 -->

        </div> <!-- /.row-->

    </div> <!-- /.container-->
    <br>

@endsection
