<form action="@yield('route')" method="post">
    @csrf

    <div class="messages"></div>

    <div class="controls">

        @include('errors')

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <textarea id="form_email" type="text" name="body" class="form-control" placeholder="Введите текст"></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <br>

        <button class="btn btn-success btn-send">Отправить коментарий</button>
    </div>
</form><br><br>