<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Index Customer page</title>
</head>

<body>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    customer page
    <div class="button-action">
        <a href="{{ route('customer.book.create') }}" class="btn btn-primary">Booking</a>
    </div>
    <div class="button-action">
        <a href="" class="btn btn-primary">Payment</a>
    </div>
    <div class="button-action">
        <a href="{{ route('customer.review.create') }}" class="btn btn-primary">Review</a>
    </div>
    <div class="button-action">
        <form action="{{ route('customer.notification.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary">Call Staff</button>
        </form>
    </div>
    <div class="button-action">
        <a href="{{ route('customer.menu.index') }}" class="btn btn-primary">Menu</a>
    </div>
</body>

</html>
