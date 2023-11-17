@if (Session::has('success'))
    <div class="alert alert-success my-3" role="alert">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
