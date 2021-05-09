@extends('layouts.base')


@section('title', 'Contacts')

@section('contents')
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <h3>Оставить отзыв</h3>

                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif

                <form id="contact-form" method="post" action="{{ route('contacts') }}">
                    @csrf

                    <div class="messages"></div>

                    <div class="controls">

                        @include('errors')

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Введите email"  data-error="Email не укзан.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Сообщение</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Введите содержание статьи" rows="4"  data-error="Содержание статьи не указано."></textarea>
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
