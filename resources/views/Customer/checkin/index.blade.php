<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    {{-- @php
        dd($table);
    @endphp --}}
    <form action="{{ route('customer.checkin.store', ['table' => $table]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <h1>Nhập tên của bạn</h1>
        <h1></h1>
        <div class="input-box">
            <label for="name" class="form-label">Your name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="input-box">
            <label for="phone" class="form-label">Phone number:</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="input-box" hidden>
            <input type="text" class="form-control" value="{{ $table->id }}" id="table_id" name="table_id">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
