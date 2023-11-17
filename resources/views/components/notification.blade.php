

@if ($errors->any())
<div class="alert alert-error my-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success my-3" role="alert">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
