<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Index Customer page</title>
</head>

<body>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    customer page
    <div class="button-action">
        <a href="{{ route('customer.create') }}" class="btn btn-primary">Booking</a>
    </div>
    <div class="button-action">
        <a href="" class="btn btn-primary">Payment</a>
    </div>
    <div class="button-action">
        <a href="" class="btn btn-primary">Review</a>
    </div>
    <div class="button-action">
        <a href="" class="btn btn-primary">Call staffs</a>
    </div>
    <div class="button-action">
        <a href="{{ route('customer.menu.index') }}" class="btn btn-primary">Menu</a>
    </div>
</body>

</html>
