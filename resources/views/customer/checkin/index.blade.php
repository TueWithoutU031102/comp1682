<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0A0D7F" />
    <link rel="stylesheet" type="text/css" href="/css/checkinstyle.css">
    {{-- @include('layouts.link') --}}
    <title>Checkin</title>
</head>

<body>
    <div class="form-box">
        <form action="{{ route('customer.checkin.store', ['table' => $table]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="logo">
                <img src="/images/Logotet.png" alt="">
            </div>
            <div class="input-box">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="text" class="form-control" placeholder="Tên" id="name" name="name">
            </div>
            <div class="input-box">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->get('mssv') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="text" class="form-control" placeholder="Mã số sinh viên" id="mssv" name="mssv">
            </div>
            <div class="input-box">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->get('phone') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input type="text" class="form-control" placeholder="Số điện thoại" id="phone" name="phone">
            </div>
            <div class="input-box" hidden>
                <input type="text" class="form-control" value="{{ $table->id }}" id="table_id" name="table_id">
            </div>
            <div class="button-action">
                <button type="submit" class="btn btn-primary">Nhận bàn</button>
            </div>
        </form>
    </div>
</body>

</html>
