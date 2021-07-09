@include('layouts.header')
<div class="row">
    <div class="col-md-8 blog-main">
        @yield('contents')
    </div>

    @section('sidebar')
        @include('layouts.sidebar')
    @show
</div>

@include('layouts.footer')