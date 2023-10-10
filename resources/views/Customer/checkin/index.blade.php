<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/checkinstyle.css">
    @include('layouts.link')
    <title>Document</title>
</head>

<body>
    <div class="form-box">
        <form action="{{ route('customer.checkin.store', ['table' => $table]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="logo">
                <img src="/images/logo.png" alt="">
            </div>
            <div class="input-box">
                <label for="name" class="form-label">Your name:</label>
                <input type="text" class="form-control" id="name" name="name">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="input-box">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="text" class="form-control" id="phone" name="phone">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->get('phone') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="input-box" hidden>
                <input type="text" class="form-control" value="{{ $table->id }}" id="table_id" name="table_id">
            </div>
            <div class="button-action">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
