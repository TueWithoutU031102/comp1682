@if (Session::has('success'))
    <div class="alert alert-success my-3" role="alert">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-error my-3" role="alert">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif
