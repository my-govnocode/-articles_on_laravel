@extends('layouts.base')

@section('title', 'Create Articles')

@section('contents')
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <h3>Добавить статью</h3>

                <form id="contact-form" method="post" action="{{ route('articles') }}">
                    @csrf

                    <div class="messages"></div>

                    <div class="controls">

                        @include('errors')

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Индетификатор</label>
                                    <input id="form_email" type="text" name="code" value="{{ old('code') }}" class="form-control" placeholder="Введите индетификатор"  data-error="Email не укзан.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_title">Заголовок</label>
                                    <input id="form_title" type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Введите заголовок статьи"  data-error="Заголок не указан.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Краткое описание статьи</label>
                                    <textarea id="form_message" name="short_message" class="form-control" placeholder="Введите содержание статьи" rows="4"  data-error="Содержание статьи не указано.">{{ old('short_message') }}</textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Детальное описание статьи</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Введите содержание статьи" rows="4"  data-error="Содержание статьи не указано.">{{ old('message') }}</textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Создать статью">
                            </div>
                        </div>

                    </div>

                </form>

            </div><!-- /.col-lg-8 col-lg-offset-2 -->

        </div> <!-- /.row-->

    </div> <!-- /.container-->
    <br>
@endsection
