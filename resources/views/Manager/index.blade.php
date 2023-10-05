<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Index Manager page</title>
</head>

<body>
    manager page
    <div class="container">
        <br>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="button-action">
            <a href="" class="btn btn-primary">Payment</a>
        </div>
        <div class="button-action">
            <a href="" class="btn btn-primary">Review</a>
        </div>
        <div class="button-action">
            <a href="{{ route('manager.book.index') }}" class="btn btn-primary">Booking</a>
        </div>
        <div class="button-action">
            <a href="/manager/indexMenu" class="btn btn-primary">Menu</a>
        </div>
    </div>
</body>

</html>
